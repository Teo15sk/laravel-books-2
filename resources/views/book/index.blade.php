@extends('layouts.main')

@section('content')

    <h1>Book index</h1>

    <div class="book-index">
        @foreach ($books as $book)
        <div class="book__wrapper">
            <img src="{{ $book->image }}" alt="{{ $book->title . ' cover' }}" class="book__img">
            
            @foreach ($book->authors as $author)
            <div class="book__author"><strong>{{ $author->name }},</strong></div>
            @endforeach
            <div class="book__title">{{ $book->title }}</div>

        </div>
            
        @endforeach
    </div>
<div class="book-index__pagination">{{ $books->links('vendor.pagination.default') }}</div>
@endsection