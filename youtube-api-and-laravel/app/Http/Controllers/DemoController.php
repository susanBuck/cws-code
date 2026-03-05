<?php

namespace App\Http\Controllers;

use Google\Client;
use Google\Service\YouTube;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DemoController extends Controller
{
    public function videoDetails()
    {
        # Configs
        $apiKey = config('app.youtube_api_key');

        # Initialize YouTube API client
        $client = new Client();
        $client->setDeveloperKey($apiKey);
        $service = new YouTube($client);

        # Example query just to make sure we can connect to the API
        $response = $service->videos->listVideos('snippet', ['id' => 'fG08dcJ8xFE']);

        # Output the response to confirm it worked
        dump($response);
    }

    public function index(Request $request)
    {
        # Determines where the API server redirects the user after the user completes the authorization flow
        # This value must exactly match one of the authorized redirect URIs for the OAuth 2.0 client, which you configured in your client’s API Console Credentials page.
        $redirectUrl = 'https://redirectmeto.com/https://demo.test';

        # Create an configure client
        $client = new Client();
        $client->setAuthConfig(base_path('youtube.json'));
        $client->setRedirectUri($redirectUrl);
        $client->addScope('https://www.googleapis.com/auth/youtube');

        # === SCENARIO 1: PREPARE FOR AUTHORIZATION ===
        if(!$request->has('code') && !Session::has('google_oauth_token')) {
            Session::put('code_verifier', $client->getOAuth2Service()->generateCodeVerifier());
            # Get the URL to Google’s OAuth server to initiate the authentication and authorization process
            $authUrl = $client->createAuthUrl();

            $connected = false;
        }

        # === SCENARIO 2: COMPLETE AUTHORIZATION ===
        # If we have an authorization code, handle callback from Google to get and store access token
        if ($request->has('code')) {
            # Exchange the authorization code for an access token
            $token = $client->fetchAccessTokenWithAuthCode($request->input('code'), Session::get('code_verifier'));
            $client->setAccessToken($token);
            Session::put('google_oauth_token', $token);
            return redirect($redirectUrl);
        }

        # === SCENARIO 3: ALREADY AUTHORIZED ===
        # If we’ve previously been authorized, we’ll have an access token in the session
        if (Session::has('google_oauth_token')) {
            $client->setAccessToken(Session::get('google_oauth_token'));
            if ($client->isAccessTokenExpired()) {
                Session::forget('google_oauth_token');
                $connected = false;
            }
            $connected = true;
        }

        # === SCENARIO 4: TERMINATE AUTHORIZATION ===
        if(isset($_GET['disconnect'])) {
            Session::forget('google_oauth_token');
            Session::forget('code_verifier');
            return redirect($redirectUrl);
        }

        return view('demo')->with(['connected' => $connected, 'authUrl' => $authUrl ?? null]);
    }

    public function edit()
    {
        # Edit details
        $videoId = '2hDQp6M42hg'; # Must be a video that belongs to the currently auth’d user
        $newTitle = 'New Laravel application with Herd and DBngin';

        # Set up client and service
        $client = new Client();
        $service = new YouTube($client);

        # Authorize client
        # This assumes the auth process has already happened via the code
        # available here: https://codewithsusan.com/notes/youtube-api-php-oauth-connection#the-code
        if (Session::has('google_oauth_token')) {
            $client->setAccessToken(Session::get('google_oauth_token'));
        } else {
            # If not authorized, redirect back to index
            return redirect('/');
        }

        # Get the existing snippet details for this video pre-edit
        $response = $service->videos->listVideos(
            'snippet',
            ['id' => $videoId]
        );
        $video = $response[0];
        $snippet = $video->snippet;

        # Output the snippet details before the edits
        dump($snippet);

        # Set the edits
        $snippet->setTitle($newTitle);

        # Set the snippet
        $video->setSnippet($snippet);

        # Do the update
        $response = $service->videos->update('snippet', $video);
        dump($response->snippet);
    }
}
