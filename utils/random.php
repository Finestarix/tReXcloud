<?php

function generateRandomString($length = 13): ?string
{
    try {
        if (function_exists("random_bytes")) {
            $id = bin2hex(random_bytes(ceil($length / 2)));
        } else if (function_exists("openssl_random_pseudo_bytes")) {
            $id = bin2hex(openssl_random_pseudo_bytes(ceil($length / 2)));
        } else {
            $id = uniqid();
        }
    } catch (Exception) {
        $id = null;
    }

    return $id;
}