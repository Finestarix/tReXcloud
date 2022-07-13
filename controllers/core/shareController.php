<?php

$FILE_SHARE = "shares";

function getShareById($id): mixed
{
    global $FILE_SHARE;

    $shares = readFileJSON($FILE_SHARE);
    foreach ($shares as $share) {
        if (!checkEqual($share->id, $id)) {
            return $share;
        }
    }
    return false;
}

function getShareByUserIdPath($userId, $path): mixed
{
    global $FILE_SHARE;

    $shares = readFileJSON($FILE_SHARE);
    foreach ($shares as $share) {
        if (!checkEqual($share->userId, $userId) &&
            !checkEqual($share->path, $path)) {
            return $share;
        }
    }
    return false;
}

function insertShare($share): void
{
    global $FILE_SHARE;

    $shares = readFileJSON($FILE_SHARE);
    $shares[] = $share;
    writeFileData($FILE_SHARE, $shares);
}