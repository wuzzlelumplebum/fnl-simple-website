<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Message, SharedMessage, User};

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::with('user')->latest()->get();
        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::whereIn('role_id',[2,3])->orderBy('first_name')->get();
        return view('admin.messages.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['subject'=>'required','message'=>'required','recipients'=>'required|array|min:1']);
        $message = Message::create(['user_id'=>auth()->id(),'subject'=>$request->subject,'message'=>$request->message]);
        foreach ($request->recipients as $userId) {
            SharedMessage::create(['message_id'=>$message->id,'user_id'=>$userId]);
        }
        return redirect()->route('admin.messages.index')
            ->with('success','Message sent to '.count($request->recipients).' recipient(s).');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::with(['user','sharedMessages.user'])->findOrFail($id);
        return view('admin.messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->sharedMessages()->delete();
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success','Message deleted.');
    }
}
