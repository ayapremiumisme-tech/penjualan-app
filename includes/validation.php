<?php

function required($value)
{
    return trim($value) != '';
}

function validEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function minLength($value, $length)
{
    return strlen($value) >= $length;
}

function maxLength($value, $length)
{
    return strlen($value) <= $length;
}

function numeric($value)
{
    return is_numeric($value);
}