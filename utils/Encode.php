<?php

namespace DroplineMVC\Utils;

class Encode
{
    /**
     * Before outputting data to client, convert special characters (& => &amp;, " => &quot;, ' => &#039;, < => &lt;, > => &gt;)
     * to HTML entities (prevent XSS injection of client-side scripts into web pages).
     * XSS test - <script>alert('XSS Gotcha!')</script>
     * @param string $string
     * @return string The converted string.
     */
    public static function html(string $string)
    {
        return htmlspecialchars($string);
    }
}