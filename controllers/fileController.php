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

} else if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST["deleteFolder"]))) {
    $id = $_POST["id"];
    $path = $_POST["path"];
    $type = $_POST["type"];
    deleteFoldersFiles($id, $path);

    if ($type == "parent") {
        $pathSplit = explode("/", $path);
        $pathSplit = array_slice($pathSplit, 0, count($pathSplit) - 2);
        $pathNew = implode("/", $pathSplit) . "/";
        $pathURL = parse_url($_SERVER["HTTP_REFERER"], PHP_URL_PATH) . "?path=" . $pathNew;
        header("Location: " . $_SERVER["HTTP_ORIGIN"] . $pathURL);
    } else if ($type == "child") {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
    die("Oops. Something when wrong.");

} else if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST["deleteFile"]))) {
    $id = $_POST["id"];
    $path = $_POST["path"];
    deleteFoldersFiles($id, $path);

    header("Location: " . $_SERVER["HTTP_REFERER"]);
    die("Oops. Something when wrong.");

} else if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST["downloadFolder"]))) {
    $id = $_POST["id"];
    $path = $_POST["path"];
    $pathSplit = explode("/", $path);
    $directory = $pathSplit[count($pathSplit) - 2];
    downloadFolder($id, $path, $directory);

    die("Oops. Something when wrong.");

} else if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST["downloadFile"]))) {
    $id = $_POST["id"];
    $path = $_POST["path"];
    downloadFile($id, $path);

    die("Oops. Something when wrong.");

}

header("Location: " . $_SERVER["HTTP_REFERER"]);
die("Oops. Something when wrong.");