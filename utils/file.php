<?php

$FOLDER_PATH = $_SERVER["DOCUMENT_ROOT"] . "/database/";
$CLOUD_PATH = $_SERVER["DOCUMENT_ROOT"] . "/cloud/";
$SHARED_PART = $CLOUD_PATH . "/SHARED/";

function readFileJSON($fileName)
{
    global $FOLDER_PATH;
    $fullPath = $FOLDER_PATH . $fileName . ".json";

    if (!file_exists($fullPath)) {
        $file = fopen($fullPath, "w");
        fclose($file);
    }

    $file = fopen($fullPath, "r");
    $data = null;
    if (filesize($fullPath) > 0) {
        $data = fread($file, filesize($fullPath));
    }
    fclose($file);

    return json_decode($data);
}

function writeFileData($fileName, $data)
{
    global $FOLDER_PATH;
    $fullPath = $FOLDER_PATH . $fileName . ".json";

    $file = fopen($fullPath, "w+");
    fwrite($file, json_encode($data, JSON_PRETTY_PRINT));
    fclose($file);
}

function createRootFolder($folderName)
{
    global $CLOUD_PATH, $SHARED_PART;

    if (!file_exists($SHARED_PART)) {
        mkdir($SHARED_PART);
    }

    mkdir($CLOUD_PATH . $folderName);
    mkdir($SHARED_PART . $folderName);
}