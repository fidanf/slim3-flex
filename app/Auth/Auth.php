<?php


namespace App\Auth;


use App\Auth\Hashing\HasherInterface;
use App\Auth\Providers\UserProviderInterface;
use App\Cookie\CookieJar;
use App\Session\SessionInterface;
use Exception;

class Auth
{
    protected $session;

    protected $hasher;

    protected $recaller;

    protected $userProvider;

    protected $cookie;

    protected $user;

    public function __construct(
        SessionInterface $session, 
        HasherInterface $hasher, 
        Recaller $recaller, 
        UserProviderInterface $userProvider, 
        CookieJar $cookie
    ) {
        $this->session = $session;
        $this->hasher = $hasher;
        $this->recaller = $recaller;
        $this->userProvider = $userProvider;
        $this->cookie = $cookie;
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

    public function hasRecaller()
    {
        return $this->cookie->exists($this->recaller->getKey());
    }

    public function setUserFromSession()
    {
        $user = $this->userProvider->getById($this->session->get($this->key()));

        if (!$user) {
            throw new Exception;
        }

        $this->user = $user;
    }

    private function setRememberToken($user)
    {
        list($identifier, $token) = $this->recaller->generate();

        $this->cookie->set(
            $this->recaller->getKey(),
            $this->recaller->generateValueForCookie($identifier, $token)
        );

        $this->userProvider->setUserRememberToken(
            $user->id, $identifier, $this->recaller->getTokenHashForDatabase($token)
        );
    }

    public function setUserFromCookie()
    {
        list($identifier, $token) = $this->recaller->splitCookieValue(
            $this->cookie->get($this->recaller->getKey())
        );

        if (!$user = $this->userProvider->getUserByRememberIdentifier($identifier)) {
            $this->cookie->clear($this->recaller->getKey());
            return;
        }

        if (!$this->recaller->validateToken($token, $user->remember_token)) {
            $this->userProvider->clearUserRememberToken($user->id);
            $this->cookie->clear($this->recaller->getKey());

            throw new Exception();
        }

        $this->setUserSession($user);
    }

    public function logout()
    {
        $this->session->clear($this->key());

        if ($this->hasRecaller()) {
            $this->cookie->clear($this->recaller->getKey());
            $this->userProvider->clearUserRememberToken($this->user->id);
        }
    }

}