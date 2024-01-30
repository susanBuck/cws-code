<?php

session_start();

require_once 'vendor/autoload.php';

use Google\Client;

# Determines where the API server redirects the user after the user completes the authorization flow
# This value must exactly match one of the authorized redirect URIs for the OAuth 2.0 client, which you configured in your client’s API Console Credentials page.
$redirectUrl = 'https://redirectmeto.com/https://demo.test';

# Create an configure client
$client = new Client();
$client->setAuthConfig('youtube.json');
$client->setRedirectUri($redirectUrl);
$client->addScope('https://www.googleapis.com/auth/youtube');


# === SCENARIO 1: PREPARE FOR AUTHORIZATION ===
if(!isset($_GET['code']) && empty($_SESSION['google_oauth_token'])) {
    $_SESSION['code_verifier'] = $client->getOAuth2Service()->generateCodeVerifier();

    # Get the URL to Google’s OAuth server to initiate the authentication and authorization process
    $authUrl = $client->createAuthUrl();

    $connected = false;
}


# === SCENARIO 2: COMPLETE AUTHORIZATION ===
# If we have an authorization code, handle callback from Google to get and store access token
if (isset($_GET['code'])) {
    # Exchange the authorization code for an access token
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code'], $_SESSION['code_verifier']);
    $client->setAccessToken($token);
    $_SESSION['google_oauth_token'] = $token;
    header('Location: ' . $redirectUrl);
}


# === SCENARIO 3: ALREADY AUTHORIZED ===
# If we’ve previously been authorized, we’ll have an access token in the session
if (!empty($_SESSION['google_oauth_token'])) {
    $client->setAccessToken($_SESSION['google_oauth_token']);
    if ($client->isAccessTokenExpired()) {
        $_SESSION['google_oauth_token'] = null;
        $connected = false;
    }
    $connected = true;
}

# === SCENARIO 4: TERMINATE AUTHORIZATION ===
if(isset($_GET['disconnect'])) {
    $_SESSION['google_oauth_token'] = null;
    $_SESSION['code_verifier'] = null;
    header('Location: ' . $redirectUrl);
}
?>

<h1>Demo</h1>
<p>
    <strong>Status:</strong>
    <?php if($connected): ?>
        Authorized.<br>
        <a href='?disconnect'>Disconnect</a><br>
    <?php else: ?>
        Not authorized.
        <a href='<?php echo $authUrl; ?>'>Authorize with YouTube...</a>
    <?php endif; ?>
</p>
