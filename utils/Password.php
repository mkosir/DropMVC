<?php

namespace DroplineMVC\Utils;

class Password
{
    /**
     * Class for messing around with algorithms. In production always use password_hash() PHP function (bcrypt algorithm).
     * @param string $algorithm The algorithm (MD5, SHA1, Whirlpool, etc)
     * @param string $data The data to encode.
     * @param string $salt The salt.
     * @return string The hashed/salted data.
     */
    public static function create($algorithm, $data, $salt)
    {
        $context = hash_init($algorithm, HASH_HMAC, $salt);

        hash_update($context, $data);

        return hash_final($context);
    }
}