<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
// });

Route::post('/token', 'Api\UserController@token');

//                                              only if authenticated through Sanctum
Route::get('/user', 'Api\UserController@user')->middleware('auth:sanctum');

//                                                  only if authenticated through Sanctum
Route::post('logout', 'Api\UserController@logout')->middleware('auth:sanctum');

//          /api/books
Route::get('/books', 'Api\BookController@index');

/* Route::get('/books', function() {

    $book = new \App\Models\Book;
    $book->id = 1;
    $book->title = 'Testing book';
    $book->image = 'https://wordery.com/jackets/72908d42/the-summoners-handbook-taran-matharu-9781444947700.jpg?width=266';

    $book2 = new \App\Models\Book;
    $book2->id = 2;
    $book2->title = 'Another book';
    $book2->image = 'https://wordery.com/jackets/72908d42/the-summoners-handbook-taran-matharu-9781444947700.jpg?width=266';

    return [
        $book,
        $book2
    ];
});
 */

//          /api/categories
Route::get('/categories', 'Api\CategoryController@index');

// book of the week
//      /api/book-of-the-week
Route::get('/book-of-the-week', 'Api\BookController@bookOfTheWeek');

// latest books
//      /api/books/latest
Route::get('/books/latest', 'Api\BookController@latest');

// detail of a book
Route::get('/books/{id}', 'Api\BookController@show');

//handle the review form's submission
Route::post('/books/review/{id}', 'Api\BookController@review');