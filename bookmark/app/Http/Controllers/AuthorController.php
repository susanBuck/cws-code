<?php

namespace App\Http\Controllers;

use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * GET /authors
     * Show all the authors
     */
    public function index()
    {
        $authors = Author::orderBy('first_name', 'ASC')->get();

        return view('authors/index', [
            'authors' => $authors,
        ]);
    }

    /**
    * Asks user to confirm they want to delete the author
    * GET /authors/{slug}/delete
    */
    public function delete($id)
    {
        $author = Author::find($id);

        if($author->books->count() > 0) {
            return view('authors/warn-delete', ['books' => $author->books, 'author' => $author]);
        }

        return view('authors/delete', ['author' => $author]);
    }

    /**
    * Deletes the author
    * DELETE /authors/{id}/delete
    */
    public function destroy($id)
    {
        $author = Author::find($id);

        # Remove author’s books from users’s favorite lists
        foreach($author->books as $book) {
            $book->users()->detach();
        }

        # Delete author’s books
        $author->books()->delete();
    
        # Delete author
        $author->delete();

        return redirect('/authors')->with([
            'flash-alert' => 'The author ' . $author->getFullName() . ' was deleted.'
        ]);
    }

}
