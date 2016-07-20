<?php

function hashing($pass)
{
    return hash('sha256', salting($pass));
}

function salting($pass)
{
    $salt1 = '&tb#';
    $salt2 = '%z@f';
    $password = $salt1 . $pass . $salt2;
    return $password;
}

function sanitizeString($var)
{
    $var = htmlentities(strip_tags(stripslashes($var)),ENT_COMPAT,'UTF-8 BOM');
    return $var;
}