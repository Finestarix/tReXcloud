<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/controllers/core/shareController.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/models/Share.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/utils/file.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/utils/validator.php");

session_start();

if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST["dummyFolder"]))) {
    $id = $_POST["id"];
    $path = $_POST["path"];
    $result = generateDummyFolders($id, $path, 10);

    if ($result) {
        $_SESSION["MESSAGE"] = "Dummy folders has been successfully created.";
        $_SESSION["MESSAGE_TYPE"] = "success";
    } else {
        $_SESSION["MESSAGE"] = "Failed to create a folder.";
        $_SESSION["MESSAGE_TYPE"] = "error";
    }
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    die("Oops. Something when wrong.");

} else if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST["dummyFile"]))) {
    $id = $_POST["id"];
    $path = $_POST["path"];
    $result = generateDummyFiles($id, $path, 10);

    if ($result) {
        $_SESSION["MESSAGE"] = "Dummy files has been successfully created.";
        $_SESSION["MESSAGE_TYPE"] = "success";
    } else {
        $_SESSION["MESSAGE"] = "Failed to create a files.";
        $_SESSION["MESSAGE_TYPE"] = "error";
    }
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    die("Oops. Something when wrong.");

} else if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST["deleteFolder"]))) {
    $id = $_POST["id"];
    $path = $_POST["path"];
    $type = $_POST["type"];
    $result = deleteFoldersFiles($id, $path);

    if ($result) {
        $_SESSION["MESSAGE"] = "Folder has been successfully deleted.";
        $_SESSION["MESSAGE_TYPE"] = "success";
    }
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
    $result = deleteFoldersFiles($id, $path);

    if ($result) {
        $_SESSION["MESSAGE"] = "File has been successfully deleted.";
        $_SESSION["MESSAGE_TYPE"] = "success";
    }
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    die("Oops. Something when wrong.");

} else if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST["downloadFolder"]))) {
    $id = $_POST["id"];
    $path = $_POST["path"];
    $pathSplit = explode("/", $path);
    $folder = $pathSplit[count($pathSplit) - 2];
    $result = downloadFolder($id, $path, $folder);

    if ($result) {
        $_SESSION["MESSAGE"] = "Folder has been successfully downloaded.";
        $_SESSION["MESSAGE_TYPE"] = "success";
    } else {
        $_SESSION["MESSAGE"] = "Failed to download folder.";
        $_SESSION["MESSAGE_TYPE"] = "error";
    }
    die("Oops. Something when wrong.");

} else if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST["downloadFile"]))) {
    $id = $_POST["id"];
    $path = $_POST["path"];
    $result = downloadFile($id, $path);

    if ($result) {
        $_SESSION["MESSAGE"] = "File has been successfully downloaded.";
        $_SESSION["MESSAGE_TYPE"] = "success";
    } else {
        $_SESSION["MESSAGE"] = "Failed to download file.";
        $_SESSION["MESSAGE_TYPE"] = "error";
    }
    die("Oops. Something when wrong.");

} else if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST["renameFolder"]))) {
    $id = $_POST["id"];
    $type = $_POST["type"];
    $path = $_POST["path"];
    $folder = $_POST["folder"];
    $newFolder = $_POST["newFolder"];
    if (!checkFolderFileName($newFolder)) {
        $_SESSION["MESSAGE"] = "Folder name must not contains reserved character.";
        $_SESSION["MESSAGE_TYPE"] = "error";
    } else {
        $result = renameFolderFile($id, $path, $folder, $newFolder);
        if ($result == 1) {
            $_SESSION["MESSAGE"] = "The folder name is already taken.";
            $_SESSION["MESSAGE_TYPE"] = "error";
        } else if ($result == 2) {
            $_SESSION["MESSAGE"] = "Failed to rename a folder.";
            $_SESSION["MESSAGE_TYPE"] = "error";
        } else if ($result == 3) {
            $_SESSION["MESSAGE"] = "Folder has been successfully renamed.";
            $_SESSION["MESSAGE_TYPE"] = "success";
        }
    }

    if ($type == "parent") {
        $pathURL = parse_url($_SERVER["HTTP_REFERER"], PHP_URL_PATH) . "?path=" . $path . $newFolder . "/";
        header("Location: " . $_SERVER["HTTP_ORIGIN"] . $pathURL);
    } else if ($type == "child") {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
    die("Oops. Something when wrong.");

} else if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST["renameFile"]))) {
    $id = $_POST["id"];
    $path = $_POST["path"];
    $file = $_POST["file"];
    $newFile = $_POST["newFile"];
    if (!checkFolderFileName($newFile)) {
        $_SESSION["MESSAGE"] = "File name must not contains reserved character.";
        $_SESSION["MESSAGE_TYPE"] = "error";
    } else if (!checkFileExtension($newFile)) {
        $_SESSION["MESSAGE"] = "File extension must be between doc, docx, xls, xlsx, ppt, pptx, gif, jpg, png, pdf, txt, and zip.";
        $_SESSION["MESSAGE_TYPE"] = "error";
    } else {
        $result = renameFolderFile($id, $path, $file, $newFile);
        if ($result == 1) {
            $_SESSION["MESSAGE"] = "The file name is already taken.";
            $_SESSION["MESSAGE_TYPE"] = "error";
        } else if ($result == 2) {
            $_SESSION["MESSAGE"] = "Failed to rename a file.";
            $_SESSION["MESSAGE_TYPE"] = "error";
        } else if ($result == 3) {
            $_SESSION["MESSAGE"] = "File has been successfully renamed.";
            $_SESSION["MESSAGE_TYPE"] = "success";
        }
    }

    header("Location: " . $_SERVER["HTTP_REFERER"]);
    die("Oops. Something when wrong.");

} else if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST["createFolder"]))) {
    $id = $_POST["id"];
    $path = $_POST["path"];
    $newFolder = $_POST["newFolder"];
    if (!checkFolderFileName($newFolder)) {
        $_SESSION["MESSAGE"] = "Folder name must not contains reserved character.";
        $_SESSION["MESSAGE_TYPE"] = "error";
    } else {
        $result = createFolder($id, $path, $newFolder);
        if ($result) {
            $_SESSION["MESSAGE"] = "Folder has been successfully created.";
            $_SESSION["MESSAGE_TYPE"] = "success";
        } else {
            $_SESSION["MESSAGE"] = "Failed to create a folder.";
            $_SESSION["MESSAGE_TYPE"] = "error";
        }
    }

    header("Location: " . $_SERVER["HTTP_REFERER"]);
    die("Oops. Something when wrong.");

} else if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST["shareFolder"]))) {
    $id = $_POST["id"];
    $path = $_POST["path"];
    $share = getShareByUserIdPath($id, $path);
    if (!$share) {
        $share = new Share($id, $path);
        insertShare($share);
    }

    $_SESSION["share"] = $_SERVER["HTTP_ORIGIN"]  . parse_url($_SERVER["HTTP_REFERER"], PHP_URL_PATH) . "?id=" . $share->id;
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    die("Oops. Something when wrong.");

} else if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST["uploadFiles"]))) {
    $id = $_POST["id"];
    $path = $_POST["path"];
    $files = $_FILES["files"];
    $result = uploadFiles($id, $path, $files);
    if ($result) {
        $_SESSION["MESSAGE"] = "Files has been successfully uploaded.";
        $_SESSION["MESSAGE_TYPE"] = "success";
    } else {
        $_SESSION["MESSAGE"] = "Failed to upload file.";
        $_SESSION["MESSAGE_TYPE"] = "error";
    }

    header("Location: " . $_SERVER["HTTP_REFERER"]);
    die("Oops. Something when wrong.");

}

header("Location: " . $_SERVER["HTTP_REFERER"]);
die("Oops. Something when wrong.");