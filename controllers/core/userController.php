<?php

$FILE_USER = "users";

function getUserByUsername($username) {
    global $FILE_USER;

    $users = readFileJSON($FILE_USER);
    foreach($users as $user) {
        if (!checkEqual($user->username, $username)) {
            return $user;
        }
    }
    return false;
}

function insertUser($user) {
    global $FILE_USER;

    $users = readFileJSON($FILE_USER);
    $users[] = $user;
    writeFileData($FILE_USER, $users);
}
