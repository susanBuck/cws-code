<?php

require_once 'vendor/autoload.php';

use Google\Client;
use Google\Service\YouTube;
use Google\Service\Exception;

# Configs
$apiKey = 'AIzaSyDBjgc67BCBekj0l80tnclIMx6JijByhVw';

# Initialize YouTube API client
$client = new Client();
$client->setDeveloperKey($apiKey);
$service = new YouTube($client);

$nextPageToken = null;
$videos = [];

while(!isset($response) || $nextPageToken != null) {

    $response = $service->playlistItems->listPlaylistItems(
        'snippet',
        [
            'playlistId' => 'UULyz8iEvzxyhKEBzOTs6bJQ',
            'pageToken' => $nextPageToken,
            'maxResults' => 50,
        ]
    );

    $nextPageToken = $response->nextPageToken ?? null;

    $videos = array_merge($videos, $response->items);
}

dump($videos);
