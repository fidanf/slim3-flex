<?php

namespace App\Email\Contracts;

use App\Email\Mailer;

interface MailableInterface
{
    public function send(Mailer $mailer);
}
