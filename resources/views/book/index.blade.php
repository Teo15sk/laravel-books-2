@extends('layouts.main')

@section('content')

    <h1>Book index</h1>
        <div class="book-index__pagination">{{ $books->links('vendor.pagination.default') }}</div>
        <div class="book-index">
            @foreach ($books as $book)
            <div class="book">
                <img src="{{ $book->image }}" alt="{{ $book->title . ' cover' }}" class="book__img">
            <div>
                    
                    @foreach ($book->authors as $author)
                    <div class="book__author"><a href="{{ action('AuthorController@show', $author->id) }}">{{ $author->name }}</a></div>
                    @endforeach
                    <div class="book__title">{{ $book->title }}</div>
            </div>

            </div>
                
            @endforeach
        </div>
    <div class="book-index__pagination">{{ $books->links('vendor.pagination.default') }}</div>
@endsection