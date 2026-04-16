<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product, Category, Status};
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['category','status'])->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create', ['categories'=>Category::all(),'statuses'=>Status::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name'=>'required','category_id'=>'required|exists:categories,id',
            'price'=>'required|integer|min:0','quantity'=>'required|integer|min:0',
            'status_id'=>'required|exists:status,id','file'=>'required|image|max:2048']);
        $prefixes = [1=>'TS',2=>'PS',3=>'CS',4=>'HJ',5=>'AC',6=>'LS'];
        $code = ($prefixes[$request->category_id] ?? 'PR'). '-' .time();
        $filename = uniqid().'-'.$request->file('file')->getClientOriginalName();
        $request->file('file')->storeAs('products',$filename,'public');
        Product::create(['code'=>$code,'name'=>$request->name,
            'description'=>$request->description,'category_id'=>$request->category_id,
            'price'=>$request->price,'quantity'=>$request->quantity,
            'status_id'=>$request->status_id,'image_path'=>$filename]);
        return redirect()->route('admin.products.index')->with('success','Product added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with(['category','status','variants'])->findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit',['product'=>$product,'categories'=>Category::all(),'statuses'=>Status::all()]);
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
        $product = Product::findOrFail($id);
        $request->validate(['name'=>'required','category_id'=>'required|exists:categories,id',
            'price'=>'required|integer|min:0','status_id'=>'required|exists:status,id',
            'file'=>'nullable|image|max:2048']);
        $data = $request->only(['name','description','category_id','price','quantity','status_id']);
        if ($request->hasFile('file')) {
            if ($product->image_path) Storage::disk('public')->delete('products/'.$product->image_path);
            $filename = uniqid().'-'.$request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs('products',$filename,'public');
            $data['image_path'] = $filename;
        }
        $product->update($data);
        return redirect()->route('admin.products.index')->with('success','Product updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image_path) Storage::disk('public')->delete('products/'.$product->image_path);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success','Product deleted.');
    }

    public function updateStock(Request $request, $variantId)
    {
        $variant = \App\Models\ProductVariant::findOrFail($variantId);
        $request->validate(['stock'=>'required|integer|min:0']);
        $variant->update(['stock'=>$request->stock]);
        return back()->with('success','Stock updated.');
    }
}
