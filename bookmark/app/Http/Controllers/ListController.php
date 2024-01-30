<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class ListController extends Controller
{
    /**
     * GET /list
     */
    public function show(Request $request)
    {
        $books = $request->user()->books->sortByDesc('pivot.created_at');
        
        return view('list/show', ['books' => $books]);
    }

    /**
     * GET /list/{slug}/add
     */
    public function add(Request $request, $slug)
    {
        $book = Book::findBySlug($slug);

        return view('list/add', ['book' => $book]);
    }

    /**
     * POST /list/{slug}/save
     */
    public function save(Request $request, $slug)
    {
        # TODO: Possibly add validation to make sure we have notes ?

        $user = $request->user();
        $book = Book::findBySlug($slug);

        $user->books()->save($book, ['notes' => $request->notes]);

        return redirect('/list')->with(['flash-alert' => 'The book ' . $book->title. ' was added to your list.']);
    }

    /**
     * PUT /list/{slug?}/update
     */
    public function update(Request $request, $slug)
    {
        $book = Book::findBySlug($slug);
        $user = $request->user();

        $book = $user->books()->where('books.id', $book->id)->first();

        $book->pivot->notes = $request->notes;
        $book->pivot->save();

        return redirect('/list')->with([
            'flash-alert' => 'Your note for ' .$book->title. ' was updated.'
        ]);
    }
     
    /**
     * DELETE /list/{slug}/destroy
     */
    public function destroy(Request $request, $slug)
    {
        $book = $request->user()->books()->where('slug', $slug)->first();
        
        $book->pivot->delete();

        # Because we can remove a book from either the individual book page
        # or the list page, we redirect to whatever page this request came from
        return redirect($request->headers->get('referer'))->with([
            'flash-alert' => 'The book ' . $book->title . ' was removed from your list'
        ]);
    }
}
