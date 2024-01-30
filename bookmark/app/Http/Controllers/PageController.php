<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * GET /
     */
    public function welcome()
    {
        # If there is data stored in the session as the results of doing a search
        # that data will be extracted from the session and passed to the view
        # to display the results
        return view('pages/welcome', [
            'searchResults' => session('searchResults', null)
        ]);
    }

    /**
     * GET /contact
     */
    public function contact()
    {
        return view('pages/contact');
    }
}
