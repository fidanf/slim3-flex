<?php

namespace App\Auth\Hashing;

interface HasherInterface
{
    public function create($plain);

    public function check($plain, $hash);

    public function needsRehash($hash);
}
