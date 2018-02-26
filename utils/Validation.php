<?php

namespace DroplineMVC\Utils;

class Validation
{
    /**
     * Check if string is empty.
     * @param string $string
     * @return bool
     */
    public static function stringEmpty(string $string): bool
    {
        return !isset($string) || trim($string," ") === '';
    }

    public static function validEmailFormat(string $string): bool
    {
        $emailRegex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
        return preg_match($emailRegex, $string) === 1;
    }
}