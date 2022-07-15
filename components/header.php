<?php
session_start();

if (empty($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] === "off") {
    $location = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: " . $location);
    die("Oops. Something when wrong.");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title><?= $title ?> | tReXcloud</title>
    <link rel="shortcut icon" type="image/x-icon" href="public/favicon.ico">

    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js"></script>
</head>