<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Author;

class DemoController extends Controller
{
    /**
     * many-to-many
     * foreign key constraint fails
     */
    public function demo2()
    {
        $book = Book::first();
        $author = $book->author;
        $author->delete();
    }

    /**
     * one-to-many
     * foreign key constraint fails
     */
    public function demo1()
    {
            
        $book = Book::first();
        $author = $book->author;
        
        $author->books()->delete();

        $author->delete();

        dump('Done.');
    }


    /**
     * ANY (GET/POST/PUT/DELETE)
     * /demo/{n?}
     * This method accepts all requests to /demo/ and
     * invokes the appropriate method.
     * http://bookmark.yourdomain.com.loc/demo => Shows a listing of all demo routes
     * http://bookmark.yourdomain.com.loc/demo/1 => Invokes demo1
     * http://bookmark.yourdomain.com.loc/demo/5 => Invokes demo5
     * http://bookmark.yourdomain.com.loc/demo/999 => 404 not found
     */
    public function index(Request $request, $n = null)
    {
        $methods = [];

        # Load the requested `demoN` method
        if (!is_null($n)) {
            $method = 'demo' . $n; # demo1

            # Invoke the requested method if it exists; if not, throw a 404 error
            return (method_exists($this, $method)) ? $this->$method($request) : abort(404);
        } # If no `n` is specified, show index of all available methods
        else {
            # Build an array of all methods in this class that start with `demo`
            foreach (get_class_methods($this) as $method) {
                if (strstr($method, 'demo')) {
                    $methods[] = $method;
                }
            }

            # Load the view and pass it the array of methods
            return view('demo')->with([
                'methods' => $methods,
                'books' => Book::all(),
                'fields' => [
                    'id', 'updated_at', 'created_at', 'slug', 'title', 'author', 'published_year'
                ]
            ]);
        }
    }
}
