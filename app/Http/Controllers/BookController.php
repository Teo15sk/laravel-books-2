<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Authors;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('title')->paginate(30);

        return view('book.index', compact('books'));
    }
}