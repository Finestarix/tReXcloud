<?php

function checkRange($number, $minRange = 1, $maxRange = 100): bool
{
    return $number < $minRange || $number > $maxRange;
}

function checkLength($string, $minLength = 1, $maxLength = 255): bool
{
    return strlen($string) < $minLength || strlen($string) > $maxLength;
}

function checkEqual($string1, $string2): bool
{
    return $string1 != $string2;
}

function checkAlphabet($string): bool
{
    return !ctype_alpha($string);
}

function checkNumeric($string): bool
{
    return !ctype_digit($string);
}

function checkAlphanumeric($string): bool
{
    return !ctype_alnum($string);
}

function checkValidDate($month, $day, $year): bool
{
    return !checkdate($month, $day, $year);
}