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

$video = $response->items[0]->snippet;

?>

<h1>Example: Get details for a single video</h1>

<h2>Title</h2>
<?php echo $video->title ?>

<h2>Thumbnail</h2>
<img 
    src='<?php echo $video->thumbnails->high->url ?>' 
    style='width:150px' 
    alt='Thumbnail for the video <?php echo $video->title ?>'>

<h2>Description</h2>
<textarea style='width:700px; height:200px'><?php echo $video->description ?></textarea>