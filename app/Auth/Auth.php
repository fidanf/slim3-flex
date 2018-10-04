<?php


namespace App\Auth;


use App\Auth\Hashing\HasherInterface;
use App\Auth\Providers\UserProviderInterface;
use App\Session\SessionInterface;
use Exception;

class Auth
{
    protected $session;

    protected $hasher;

    protected $userProvider;

    protected $user;

    public function __construct(SessionInterface $session, HasherInterface $hasher, UserProviderInterface $userProvider)
    {
        $this->session = $session;
        $this->hasher = $hasher;
        $this->userProvider = $userProvider;
    }

    public function attempt($email, $password, $remember = false)
    {
        $user = $this->userProvider->getByEmail($email);

        if (!$user || !$this->hasValidCredentials($user, $password)) {
            return false;
        }

        if ($this->needsRehash($user)) {
            $this->userProvider->updateUserPasswordHash($user->id, $this->hasher->create($password));
        }

        $this->setUserSession($user);

        if ($remember) {
            $this->setRememberToken($user);
        }

        return true;
    }

    private function hasValidCredentials($user, $password)
    {
        return $this->hasher->check($password, $user->password);
    }

    private function setUserSession($user)
    {
        $this->session->set($this->key(), $user->id);
    }

    private function key()
    {
        return 'id';
    }

    public function user()
    {
        return $this->user;
    }

    private function needsRehash($user)
    {
        return $this->hasher->needsRehash($user->password);
    }

    public function check()
    {
        return $this->hasUserInSession();
    }

    public function hasUserInSession()
    {
        return $this->session->exists($this->key());
    }

    private function setRememberToken($user)
    {
        //
    }

    public function setUserFromCookie()
    {
        //
    }

    public function setUserFromSession()
    {
        $user = $this->userProvider->getById($this->session->get($this->key()));

        if (!$user) {
            throw new Exception;
        }

        $this->user = $user;
    }

    public function hasRecaller()
    {
        //
    }

    public function logout()
    {
        $this->session->clear($this->key());
    }

}