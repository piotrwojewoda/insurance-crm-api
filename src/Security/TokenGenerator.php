<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 07.01.19
 * Time: 13:43
 */

namespace App\Security;


class TokenGenerator
{
    private const ALPHABET = '';

    public function getRandomSecureToken(int $length = 30) : string
    {
        return bin2hex(openssl_random_pseudo_bytes($length));
    }
}
