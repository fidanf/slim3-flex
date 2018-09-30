<?php

namespace App\Auth\Providers;

interface UserProviderInterface
{
    public function getByEmail($email);
    public function getById($id);
    public function updateUserPasswordHash($id, $hash);
    public function getUserByRememberIdentifier($identifier);
    public function clearUserRememberToken($id);
    public function setUserRememberToken($id, $identifier, $hash);
}