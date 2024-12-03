<?php
// google_login.php
session_start();
include('config.php');

$loginUrl = $googleClient->createAuthUrl();
header('Location: ' . $loginUrl);
exit();
?>