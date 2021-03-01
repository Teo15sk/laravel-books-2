@extends('layouts.main')

@section('content')

<h1>About {{ $author->name }}</h1>

<h2>Biography</h2>
<div class="author-bio">{!! $author->bio !!}</div>

<h2>Books by {{ $author->name }}</h2>

<div class="author-book-index">
    
    @foreach ($author->books as $book)
    
        <div class="author-book">
            <img src="{{ $book->image }}" alt="{{ $book->title . ' cover' }}" class="author-book__img">
            <div class="author-book__title">{{ $book->title }}</div>
        </div>
        
    @endforeach

    </div>

@endsection