<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/test-email', function () {
    Mail::raw('This is a test...', function ($message) {
        $message->to('janedoe@gmail.com')->subject('Testing 123...');
    });

    dd('Email sent!');
});