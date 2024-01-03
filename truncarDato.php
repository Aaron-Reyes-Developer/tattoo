<?php

// TRUNCAR STRING
function truncarDato($string, $maxLength, $sufijo = '')
{
    if (strlen($string) > $maxLength) {
        $truncatedString = substr($string, 0, $maxLength) . $sufijo;
    } else {
        $truncatedString = $string;
    }
    return $truncatedString;
}
