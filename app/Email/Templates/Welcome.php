<?php

namespace App\Email\Templates;

use App\Email\Mailable;
use App\Models\User;

class Welcome extends Mailable
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject("Welcome {$this->user->username}")
            ->view('emails/welcome.twig')
            ->with([
                'user' => $this->user
            ]);
    }
}