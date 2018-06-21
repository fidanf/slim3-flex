<?php

namespace App\Security;

use App\Session\SessionInterface;

class Csrf
{
    protected $persistToken = true;

    protected $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function key()
    {
        return '_token';
    }

    public function tokenIsValid($token)
    {
        return $token === $this->session->get($this->key());
    }

    public function token()
    {
        if (!$this->tokenNeedsToBeGenerated()) {
            return $this->getTokenFromSession();
        }

        $this->session->set(
            $this->key(),
            $token = bin2hex(random_bytes(32))
        );

        return $token;
    }

    protected function getTokenFromSession()
    {
        return $this->session->get($this->key());
    }

    protected function tokenNeedsToBeGenerated()
    {
        if (!$this->session->exists($this->key())) {
            return true;
        }

        if ($this->shouldPersistToken()) {
            return false;
        }

        return $this->session->exists($this->getKey());
    }

    protected function shouldPersistToken()
    {
        return $this->persistToken;
    }
}
