<?php

# You can omit requiring Composer’s autoload file if you’re working in a framework (e.g. Laravel) that sets up autoloading for you
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

$response = $service->videos->listVideos(
    'snippet',
    ['id' => 'fG08dcJ8xFE']
);

dump($response);
