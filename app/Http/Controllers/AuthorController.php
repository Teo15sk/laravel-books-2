<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        return "Hello from Author";
    }

    public function show($id)
    {
        $author = Author::find($id);

        return view('author.show', compact('author'));
    }
}