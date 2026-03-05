<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

class DemoController extends Controller
{
    public function index()
    {
        $email = 'test@gmail.com';
        $subject = 'This is the subject';
        $body = '<h1>This is the body of the email...</h1>';

        # Send the plain text email
        Mail::raw($body, function ($message) use ($email, $subject) {
            $message->to($email)
                    ->subject($subject . ' plain text');
        });

        # Send the HTML email
        Mail::html($body, function ($message) use ($email, $subject) {
            $message->to($email)
                    ->subject($subject . ' html');
        });

        # Send the HTML email using a View
        $body = view('demo')->render();
        Mail::html($body, function ($message) use ($email, $subject) {
            $message->to($email)
                    ->subject($subject . ' html from a View');
        });
    }
}
