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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

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
Route::get('/categories', 'Api\CategoryController@index');