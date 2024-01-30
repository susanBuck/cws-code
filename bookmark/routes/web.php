<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\App;

/**
 * Misc
 */
Route::get('/', [PageController::class, 'welcome']);
Route::get('/contact', [PageController::class, 'contact']);

# Filter route that was used to demonstrate working with multiple route parameters
Route::get('/books/filter/{category}/{subcategory}', [BookController::class, 'filter']);

# Only enable the following development-specific routes if we’re *not* running the application in the `production` environment
if (!App::environment('production')) {
    Route::get('/test/login-as/{userId}', [TestController::class, 'loginAs']);
    Route::get('/test/refresh-database', [TestController::class, 'refreshDatabase']);

    # It’s a good idea to move the demo route into this if condition
    # so that our demo routes are not available on production
    Route::any('/demo/{n?}', [DemoController::class, 'index']);
}

Route::group(['middleware' => 'auth'], function () {

    /**
     * Authors - Read
     */
    Route::get('/authors', [AuthorController::class, 'index']);


    /**
     * Authors - Delete
     */
    # Show the page to confirm deletion of an author
    Route::get('/authors/{id}/delete', [AuthorController::class, 'delete']);

    # Process the deletion of an author
    Route::delete('/authors/{id}', [AuthorController::class, 'destroy']);


    /**
     * Books - Create
     */
    # Make sure the create route comes before the `/books/{slug}` route so it takes precedence
    Route::get('/books/create', [BookController::class, 'create']);

    # Note the use of the post method in this route
    Route::post('/books', [BookController::class, 'store']);

    /**
     * Books - Read
     */
    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books/{slug}', [BookController::class, 'show']);

    /**
     * Books - Update
     */
    # Show the form to edit a specific book
    Route::get('/books/{slug}/edit', [BookController::class, 'edit']);

    # Process the form to edit a specific book
    Route::put('/books/{slug}', [BookController::class, 'update']);

    /**
     * Books - Delete
     */
    # Show the page to confirm deletion of a book
    Route::get('/books/{slug}/delete', [BookController::class, 'delete']);

    # Process the deletion of a book
    Route::delete('/books/{slug}', [BookController::class, 'destroy']);

    /**
     * List
     */
    Route::get('/list', [ListController::class, 'show']);
    Route::get('/list/{slug}/add', [ListController::class, 'add']);
    Route::post('/list/{slug}/save', [ListController::class, 'save']);
    Route::put('/list/{slug}/update', [ListController::class, 'update']);
    Route::delete('/list/{slug}/destroy', [ListController::class, 'destroy']);


    /**
     * Books - Misc
     */
    Route::get('/search', [BookController::class, 'search']);
});
