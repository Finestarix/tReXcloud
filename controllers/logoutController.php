<?php

session_start();

if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST["logout"]))) {
    session_destroy();
    header("Location: " . $_SERVER["HTTP_ORIGIN"]);
    die("Oops. Something when wrong.");
}

header("Location: " . $_SERVER["HTTP_REFERER"]);
die("Oops. Something when wrong.");