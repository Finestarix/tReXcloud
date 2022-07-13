<?php

$FOLDER_PATH = $_SERVER["DOCUMENT_ROOT"] . "/database/";
$CLOUD_PATH = $_SERVER["DOCUMENT_ROOT"] . "/cloud/";

function readFileJSON($fileName): array
{
    global $FOLDER_PATH;
    $fullPath = $FOLDER_PATH . $fileName . ".json";

    if (file_exists($fullPath)) {
        if (filesize($fullPath) == 0) {
            return [];
        }

        $file = fopen($fullPath, "r");
        $data = fread($file, filesize($fullPath));
        fclose($file);
        return json_decode($data);
    }
    return [];
}

function writeFileData($fileName, $data): void
{
    global $FOLDER_PATH;
    $fullPath = $FOLDER_PATH . $fileName . ".json";

    $file = fopen($fullPath, "w+");
    fwrite($file, json_encode($data, JSON_PRETTY_PRINT));
    fclose($file);
}

function createFolder($id, $path, $folderName): void
{
    global $CLOUD_PATH;
    $fullPath = $CLOUD_PATH . $id . $path . $folderName;

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

function deleteFoldersFiles($id, $path): bool
{
    global $CLOUD_PATH;
    $fullPath = $CLOUD_PATH . $id . $path;

    if (file_exists($fullPath)) {
        if (!is_dir($fullPath)) {
            return unlink($fullPath);
        } else {
            $listDirectoriesFiles = scandir($fullPath);
            $listDirectoriesFiles = array_diff($listDirectoriesFiles, array(".", ".."));
            foreach ($listDirectoriesFiles as $directoriesFile) {
                if (!deleteFoldersFiles($id, $path . "/" . $directoriesFile)) {
                    return false;
                }
            }
            return rmdir($fullPath);
        }
    } else {
        return true;
    }
}

function downloadFolder($id, $path, $folder): void
{
    global $CLOUD_PATH;
    $fullPath = $CLOUD_PATH . $id . $path;

    if (file_exists($fullPath)) {
        $zip = new ZipArchive();
        $zip->open($folder . ".zip", ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($fullPath));
        foreach ($files as $file) {
            if (!$file->isDir()) {
                $relativePath = substr($file->getRealPath(), strlen($fullPath));
                $zip->addFile($file->getRealPath(), $relativePath);
            }
        }
        $zip->close();

        header("Cache-Control: must-revalidate");
        header("Content-Disposition: attachment; filename=\"" . basename($folder . ".zip") . "\"");
        header("Content-Length: " . filesize($folder . ".zip"));
        header("Content-Type: application/octet-stream");
        header("Expires: 0");
        readfile($folder . ".zip");
        unlink($folder . ".zip");
    }
}

function downloadFile($id, $path): void
{
    global $CLOUD_PATH;
    $fullPath = $CLOUD_PATH . $id . $path;

    if (file_exists($fullPath)) {
        header("Cache-Control: must-revalidate");
        header("Content-Disposition: attachment; filename=\"" . basename($fullPath) . "\"");
        header("Content-Length: " . filesize($fullPath));
        header("Content-Type: application/octet-stream");
        header("Expires: 0");
        readfile($fullPath);
    }
}

function renameFolderFile($id, $path, $name, $newName): void
{
    global $CLOUD_PATH;
    $oldPath = $CLOUD_PATH . $id . $path . $name;
    $newPath = $CLOUD_PATH . $id . $path . $newName;

    rename($oldPath, $newPath);
}