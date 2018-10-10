<?php

namespace App\Auth;

class Recaller
{
    protected $separator = '|';

    public function generate()
    {
        return [$this->generateIdentifier(), $this->generateToken()];
    }

    public function validateToken($plain, $hash)
    {
        return $this->getTokenHashForDatabase($plain) === $hash;
    }

    public function splitCookieValue($value)
    {
        return explode($this->separator, $value);
    }

    public function generateValueForCookie($identifier, $token)
    {
        return $identifier . $this->separator . $token;
    }

    public function getTokenHashForDatabase($token)
    {
        return hash('sha256', $token);
    }

    protected function generateIdentifier()
    {
        return bin2hex(random_bytes(32));
    }

    protected function generateToken()
    {
        return bin2hex(random_bytes(32));
    }
}