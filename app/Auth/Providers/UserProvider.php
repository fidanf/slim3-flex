<?php


namespace App\Auth\Providers;


use App\Models\User;

class UserProvider implements UserProviderInterface
{

    public function getByUsername($username)
    {
        return User::where('username', $username)->first();
    }

    public function getById($id)
    {
        return User::where('id', $id)->first();

    }

    public function updateUserPasswordHash($id, $hash)
    {
        // TODO: Implement updateUserPasswordHash() method.
    }

    public function getUserByRememberIdentifier($identifier)
    {
        // TODO: Implement getUserByRememberIdentifier() method.
    }

    public function clearUserRememberToken($id)
    {
        // TODO: Implement clearUserRememberToken() method.
    }

    public function setUserRememberToken($id, $identifier, $hash)
    {
        // TODO: Implement setUserRememberToken() method.
    }
}