<?php

function checkRange($number, $minRange = 1, $maxRange = 100)
{
    return $number < $minRange || $number > $maxRange;
}

function checkLength($string, $minLength = 1, $maxLength = 255)
{
    return strlen($string) < $minLength || strlen($string) > $maxLength;
}

function checkEqual($string1, $string2)
{
    return $string1 != $string2;
}

function checkAlphabeth($string)
{
    return !ctype_alpha($string);
}

function checkNumeric($string)
{
    return !ctype_digit($string);
}

function checkAlphanumeric($string)
{
    return !ctype_alnum($string);
}

function checkValidDate($month, $day, $year)
{
    return !checkdate($month, $day, $year);
}
