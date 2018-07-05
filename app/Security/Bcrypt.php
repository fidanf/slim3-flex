<?php

namespace App\Security;

use App\HasherInterface;

class Bcrypt implements HasherInterface
{
    private $options = [
        'cost' => 12
    ];

    public function create($plain)
    {
        $hash = password_hash($plain, PASSWORD_BCRYPT, $this->options());

        if (!$hash) {
            throw new RuntimeException('Bcrypt not supported.');
        }

        return $hash;
    }

    public function check($plain, $hash)
    {
        return password_verify($plain, $hash);
    }

    public function needsRehash($hash)
    {
        return password_needs_rehash($hash, PASSWORD_BCRYPT, $this->getOptions());
    }

    protected function getOptions()
    {
        return $this->options;
    }
}