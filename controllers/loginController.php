<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/controllers/core/userController.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/models/User.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/utils/file.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/utils/validator.php");

session_start();

if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST["login"]))) {

    $username = $_POST["username"];   // empty
    $password = $_POST["password"];   // empty

    if (checkLength($username)) {
        $_SESSION["ERROR"] = "Username must not be empty.";
    } else if (checkLength($password)) {
        $_SESSION["ERROR"] = "Password must not be empty.";
    } else {
        $user = getUserByUsername($username);
        if (!$user || !password_verify($password, $user->password)) {
            $_SESSION["ERROR"] = "Wrong username and password.";
        } else {
            $_SESSION["USER"] = $user;
            header("Location: " . $_SERVER["HTTP_ORIGIN"] . "/home.php");
            die("Oops. Something when wrong.");
        }
    }
} else {
    $_SESSION["ERROR"] = "Invalid request.";
}

header("Location: " . $_SERVER["HTTP_REFERER"]);
die("Oops. Something when wrong.");
