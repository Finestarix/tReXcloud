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

function writeFileData($fileName, $data): bool
{
    global $FOLDER_PATH;
    $fullPath = $FOLDER_PATH . $fileName . ".json";

    $file = fopen($fullPath, "w+");
    if (!$file) {
        $_SESSION["MESSAGE"] = "Failed to write file.";
        $_SESSION["MESSAGE_TYPE"] = "error";
        return false;
    }
    fwrite($file, json_encode($data, JSON_PRETTY_PRINT));
    fclose($file);
    return true;
}

function createFolder($id, $path, $folderName): bool
{
    global $CLOUD_PATH;
    $fullPath = $CLOUD_PATH . $id . $path . $folderName;

    return mkdir($fullPath);
}

function checkFoldersFiles($id, $path): bool
{
    global $CLOUD_PATH;
    $fullPath = $CLOUD_PATH . $id . $path;

    return file_exists($fullPath);
}

function generateDummyFolders($id, $path, $total): bool
{
    global $CLOUD_PATH;
    $fullPath = $CLOUD_PATH . $id . $path;

    for ($i = 0; $i < $total; $i++) {
        $folderName = substr(sha1(rand()), 0, 16);
        $result = mkdir($fullPath . $folderName);
        if (!$result) {
            return false;
        }
    }
    return true;
}

function generateDummyFiles($id, $path, $total): bool
{
    global $CLOUD_PATH;
    $fullPath = $CLOUD_PATH . $id . $path;
    $allowedExtension = ["doc", "docx", "xls", "xlsx", "ppt", "pptx", "gif", "jpg", "png", "pdf", "txt", "zip"];

    for ($i = 0; $i < $total; $i++) {
        $fileName = substr(sha1(rand()), 0, 5) . "." . $allowedExtension[array_rand($allowedExtension)];
        $result = fopen($fullPath . $fileName, "w");
        if (!$result) {
            return false;
        }
        fclose($result);
    }
    return true;
}

function getFoldersFiles($id, $path): array|bool
{
    global $CLOUD_PATH;
    $fullPath = $CLOUD_PATH . $id . $path;

    $directories = [];
    $files = [];
    $listDirectoriesFiles = scandir($fullPath);
    if (!$listDirectoriesFiles) {
        return false;
    }
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

function downloadFolder($id, $path, $folder): bool
{
    global $CLOUD_PATH;
    $fullPath = $CLOUD_PATH . $id . $path;

    if (file_exists($fullPath)) {
        $zip = new ZipArchive();
        $zip->open($CLOUD_PATH . $folder . ".zip", ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($fullPath));
        foreach ($files as $file) {
            if (!$file->isDir()) {
                $relativePath = substr($file->getRealPath(), strlen($fullPath));
                $zip->addFile($file->getRealPath(), $relativePath);
            }
        }
        $zip->close();

        header("Pragma: public");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        header("Content-Disposition: attachment; filename=\"" . basename($CLOUD_PATH . $folder . ".zip") . "\"");
        header("Content-Length: " . filesize($CLOUD_PATH . $folder . ".zip"));
        header("Content-Transfer-Encoding: binary");
        header("Content-Type: application/octet-stream");
        header("Expires: 0");
        $result = readfile($CLOUD_PATH . $folder . ".zip");
        unlink($CLOUD_PATH . $folder . ".zip");
        return $result;
    } else {
        return false;
    }
}

function downloadFile($id, $path): bool
{
    global $CLOUD_PATH;
    $fullPath = $CLOUD_PATH . $id . $path;

    if (file_exists($fullPath)) {
        header("Pragma: public");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        header("Content-Disposition: attachment; filename=\"" . basename($fullPath) . "\"");
        header("Content-Length: " . filesize($fullPath));
        header("Content-Transfer-Encoding: binary");
        header("Content-Type: application/octet-stream");
        header("Expires: 0");
        return readfile($fullPath);
    } else {
        return false;
    }
}

function renameFolderFile($id, $path, $name, $newName): int
{
    global $CLOUD_PATH;
    $oldPath = $CLOUD_PATH . $id . $path . $name;
    $newPath = $CLOUD_PATH . $id . $path . $newName;

    if (file_exists($newPath)) {
        return 1;
    }

    $result = rename($oldPath, $newPath);
    if (!$result) {
        return 2;
    }
    return 3;
}

function uploadFiles($id, $path, $files): bool {
    global $CLOUD_PATH;
    $fullPath = $CLOUD_PATH . $id . $path;

    $totalFile = count($files["name"]);
    for ($i = 0; $i < $totalFile; $i++) {
        $fileName = $files["name"][$i];
        $fileNameWithoutExtension = pathinfo($fileName, PATHINFO_FILENAME);
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $fileTempPath = $files["tmp_name"][$i];
        $fileSize = $files["size"][$i];

        if (checkFileExtension($fileName) && checkFileSize($fileSize)) {
            $targetPath = $fullPath . $fileNameWithoutExtension . "_" . time() . "." . $fileExtension;
            $result = move_uploaded_file($fileTempPath, $targetPath);
            if (!$result) {
                return false;
            }
        }
    }
    return true;
}