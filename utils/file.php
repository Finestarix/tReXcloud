<?php

$FOLDER_PATH = $_SERVER["DOCUMENT_ROOT"] . "/database/";
$CLOUD_PATH = $_SERVER["DOCUMENT_ROOT"] . "/cloud/";

function readFileJSON($fileName): array
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

function writeFileData($fileName, $data): void
{
    global $FOLDER_PATH;
    $fullPath = $FOLDER_PATH . $fileName . ".json";

    $file = fopen($fullPath, "w+");
    fwrite($file, json_encode($data, JSON_PRETTY_PRINT));
    fclose($file);
}

function createFolder($path, $folderName): void
{
    global $CLOUD_PATH;
    $fullPath = $CLOUD_PATH . $path . $folderName;

    mkdir($fullPath);
}

function generateDummyFolders($id, $path, $total): void
{
    global $CLOUD_PATH;
    $fullPath = $CLOUD_PATH . $id . $path;

    for ($i = 0; $i < $total; $i++) {
        $folderName = substr(sha1(rand()), 0, 16);
        mkdir($fullPath . $folderName);
    }
}

function generateDummyFiles($id, $path, $total): void
{
    global $CLOUD_PATH;
    $fullPath = $CLOUD_PATH . $id . $path;
    $allowedExtension = ["doc", "docx", "xls", "xlsx", "ppt", "pptx", "gif", "jpg", "png", "pdf", "txt", "zip"];

    for ($i = 0; $i < $total; $i++) {
        $fileName = substr(sha1(rand()), 0, 5) . "." . $allowedExtension[array_rand($allowedExtension)];
        fopen($fullPath . $fileName, "w");
    }
}

function getFoldersFiles($id, $path): array
{
    global $CLOUD_PATH;
    $fullPath = $CLOUD_PATH . $id . $path;

    $directories = [];
    $files = [];
    $listDirectoriesFiles = scandir($fullPath);
    $listDirectoriesFiles = array_diff($listDirectoriesFiles, array(".", ".."));
    foreach ($listDirectoriesFiles as $directoriesFile) {
        if (is_dir($fullPath . $directoriesFile)) {
            $directories[] = $directoriesFile;
        } else if (is_file($fullPath . $directoriesFile)) {
            $files[] = $directoriesFile;
        }
    }

    return [$directories, $files];
}