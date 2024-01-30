<?php

# ref: # https://developers.google.com/youtube/v3/docs/videos/update

session_start();

require_once 'vendor/autoload.php';

use Google\Client;
use Google\Service\YouTube;

# Edit details
$videoId = '2hDQp6M42hg'; # Must be a video that belongs to the currently auth’d user
$newTitle = 'New Laravel application with Herd and DBngin';

# Set up client and service
$client = new Client();
$service = new YouTube($client);

# Autho-rize client
# This assumes the auth process has already happened via the code
# available here: https://codewithsusan.com/notes/youtube-api-php-oauth-connection#the-code
if (!empty($_SESSION['google_oauth_token'])) {
    $client->setAccessToken($_SESSION['google_oauth_token']);
    if ($client->isAccessTokenExpired()) {
        $_SESSION['google_oauth_token'] = null;
        header('Location: index.php');
    }
} else {
    # If not authorized, redirect back to index
    header('Location: index.php');
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
