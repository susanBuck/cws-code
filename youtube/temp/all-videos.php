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

# https://developers.google.com/youtube/v3/docs/playlistItems/list
$response = $service->playlistItems->listPlaylistItems(
    'snippet',
    [
        'playlistId' => 'UUCLyz8iEvzxyhKEBzOTs6bJQ',
        'pageToken' => $_GET['pageToken'] ?? null,
        'maxResults' => 10,
    ]
);

#dump($response);

# Extract data we need from the response
$prevPageToken = $response->prevPageToken ?? null;
$nextPageToken = $response->nextPageToken ?? null;
$totalResults = $response->pageInfo->totalResults;
$videos = $response->items;
?>

<?php if($prevPageToken): ?>
    <a href='/?pageToken=<?php echo $prevPageToken?>'>Previous page</a>
<?php endif ?>

<?php if($nextPageToken): ?>
    <a href='/?pageToken=<?php echo $nextPageToken?>'>Next page</a>
<?php endif ?>

<?foreach ($videos as $video): ?>
    <div style='margin:10px 0'>
        <img 
        style='width:150px'
        src='<?php echo $video->snippet->thumbnails->high->url ?>' 
        alt='Thumbnail for the video <?php echo $video->snippet->title ?>'><br>

        <strong>Title:</strong> 
        <?php echo $video->snippet->title ?>
        <br>
        <strong>Video ID:</strong> 
        <?php echo $video->snippet->resourceId->videoId ?>
    </div>
<?php endforeach; ?>
