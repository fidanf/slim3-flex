<?php

namespace App\Session;


class Flash
{
    protected $session;

    protected $messages;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
        $this->loadFlashMessagesIntoCache();

        $this->clear();
    }

    public function has($key)
    {
        return isset($this->messages[$key]);
    }

    public function get($key)
    {
        if ($this->has($key)) {
            return $this->messages[$key];
        }
    }

    public function now($key, $value)
    {
        $this->session->set('flash', array_merge(
            $this->session->get('flash') ?? [], [$key => $value]
        ));
    }

    protected function clear()
    {
        $this->session->clear('flash');
    }

    protected function loadFlashMessagesIntoCache()
    {
        $this->messages = $this->getAll();
    }

    protected function getAll()
    {
        return $this->session->get('flash');
    }
}
