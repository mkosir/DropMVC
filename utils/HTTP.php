<?php

namespace DroplineMVC\Utils;

class HTTP
{
    /**
     * Page redirection - HTTP 1.1/302 Found
     * 302 status code is automatically set in HTTP header by PHP, since it knows "Location" attribute is used only in redirections.
     * Note: turn on output buffering (if not already default), since header changes must be made before any HTML output.
     * @param string $location
     */
    public static function headerRedirectTo(string $location)
    {
        header("Location: " . $location);
        exit; // Just send the header with redirection info and quit php, no other code needs to be executed.
    }

    public static function reqIsPOST(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public static function reqIsGET(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }
}