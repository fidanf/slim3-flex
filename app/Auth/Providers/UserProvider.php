<?php


namespace App\Auth\Providers;


use App\Models\User;

class UserProvider implements UserProviderInterface
{

    public function getByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function getById($id)
    {
        return User::where('id', $id)->first();

    }

    public function updateUserPasswordHash($id, $hash)
    {
        return $this->getById($id)->update([
            'password' => $hash
        ]);
    }

    public function getUserByRememberIdentifier($identifier)
    {
        return User::where('remember_identifier', $identifier)->first();
    }

    public function clearUserRememberToken($id)
    {
        return $this->getById($id)->update([
            'remember_token' => null,
            'remember_identifier' => null
        ]);

    }

    public function setUserRememberToken($id, $identifier, $hash)
    {
        return $this->getById($id)->update([
            'remember_identifier' => $identifier,
            'remember_token' => $hash,
        ]);
    }
}