<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Review;

class BookController extends Controller
{
    public function index(Request $request)
    {
        // create the query builder
        $query_builder = Book::orderBy('title')
            ->limit(20);

        if($request->input('category')) {
            $category_id = $request->input('category');

            $query_builder
                ->where('category_1_id', $category_id)
                ->orWhere('category_2_id', $category_id)
                ->orWhere('category_3_id', $category_id)
                ->orWhere('category_4_id', $category_id)
                ->orWhere('category_5_id', $category_id);
        }

        $books = $query_builder->get();

        return $books;
    }

    public function bookOfTheWeek()
    {
        $book_of_the_week_id = 1089;

        $book = Book::with('authors')->findOrFail($book_of_the_week_id);

        /* return [
            'id' => $book->id,
            'title' => $book->title,
            'image' => $book->image,
            'description' => $book->description,
            'authors' => $book->authors->map(function($author) {
                return [
                    'id' => $author->id,
                    'name' => $author->name
                ];
            })
        ]; */
        
        return $book;
    }

    public function latest()
    {
        $latest_books = Book::with('authors')->orderBy('publication_date', 'desc')->limit(10)->get();

        return $latest_books;
    }

    public function show($id)
    {
        $book = Book::with("authors")->with('reviews')->findOrFail($id);
        // $book->description = strip_tags($book->description);

        return $book;
    }


    // handle submission of the review form
    public function review(Request $request, $id)
    {

        $this->validate($request, [
            'rating' =>'required|numeric|min:0|max:100',
            'text' => 'required|max:1000'
        ]);

        $user_id = 1;

        $review = Review::where('book_id', $id)->where('user_id', $user_id)->first();

        if ($review === null) {
            $review = new Review;
            $review->book_id = $id;
            $review->user_id = $user_id;
        }

        $review->rating = $request->input('rating');
        $review->text = $request->input('text');
        $review->save();

        return [
            'status' => 'success',
            'message' => 'Review was successfuly submitted.'
        ];
    }
}