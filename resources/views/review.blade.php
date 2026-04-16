@extends('layouts.app')
@section('content')
<section id="book-a-table" class="book-a-table">
<div class="container" data-aos="fade-up">
    <form action="{{ route('review.store') }}" method="POST" class="php-email-form">
        @csrf
        <div class="row gy-4">
            <div class="col-md-6"><input type="text" class="form-control" value="{{ auth()->user()->first_name }}" disabled></div>
            <div class="col-md-6"><input type="text" class="form-control" value="{{ auth()->user()->last_name }}" disabled></div>
            <div class="col-md-12">
                <label class="fw-bold mb-2">Rating</label>
                <x-star-rating :interactive="true" name="rating" />
                @error('rating') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-12">
                <textarea class="form-control" name="review" rows="5"
                    placeholder="Bagaimana pengalamanmu berbelanja di F&L?" required>{{ old('review') }}</textarea>
                @error('review') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-12 text-center">
                <button type="submit" class="btn">Kirim Ulasan</button>
            </div>
        </div>
    </form>
</div>
</section>
@endsection