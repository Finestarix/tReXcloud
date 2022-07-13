<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/utils/random.php");

class Share
{
    public string $id;
    public string $userId;
    public string $path;

    public function __construct($userId, $path)
    {
        $this->id = strval(generateRandomString(32));
        $this->userId = $userId;
        $this->path = $path;
    }
}