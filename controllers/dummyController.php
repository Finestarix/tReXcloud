<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/utils/file.php");

if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST["dummyFolder"]))) {

    $id = $_POST["id"];
    $path = $_POST["path"];

    generateDummyFolders($id, $path, 10);

    header("Location: " . $_SERVER["HTTP_REFERER"]);
    die("Oops. Something when wrong.");
} else if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST["dummyFile"]))) {

    $id = $_POST["id"];
    $path = $_POST["path"];

    generateDummyFiles($id, $path, 10);

    header("Location: " . $_SERVER["HTTP_REFERER"]);
    die("Oops. Something when wrong.");
}

header("Location: " . $_SERVER["HTTP_REFERER"]);
die("Oops. Something when wrong.");