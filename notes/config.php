<?php
// config.php
require_once 'vendor/autoload.php'; // Composer autoload

$googleClient = new Google_Client();
$googleClient->setClientId('YOUR_GOOGLE_CLIENT_ID');
$googleClient->setClientSecret('YOUR_GOOGLE_CLIENT_SECRET');
$googleClient->setRedirectUri('http://yourwebsite.com/google_callback.php');
$googleClient->addScope('email');
$googleClient->addScope('profile');
?>