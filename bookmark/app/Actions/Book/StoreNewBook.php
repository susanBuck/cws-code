<?php

namespace App\Actions\Book;

use App\Models\Book;
use stdClass;

class StoreNewBook
{
    public $results;

    public function __construct($newBookData)
    {
        # Do the action
        $book = new Book();
        $book->title = $newBookData->title;
        $book->slug = $newBookData->slug;
        $book->author_id = $newBookData->author_id;
        $book->published_year = $newBookData->published_year;
        $book->cover_url = $newBookData->cover_url;
        $book->info_url = $newBookData->info_url;
        $book->purchase_url = $newBookData->purchase_url;
        $book->description = $newBookData->description;
        $book->save();

        # Set up any results that might be needed from this action
        # Here I choose to set the results up as an object, but you could
        # use array syntax if you prefer
        $this->results = new stdClass();
        $this->results->book = $book;
        $this->results->title = $book->title;
    }
}
