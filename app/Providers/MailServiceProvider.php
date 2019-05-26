<?php

namespace App\Providers;

use App\Email\Mailer;
use League\Container\ServiceProvider\AbstractServiceProvider;
use Swift_Mailer;
use Swift_SmtpTransport;
use App\Views\View as Twig;

class MailServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        Mailer::class,
        'mail'
    ];

    public function register()
    {
        $container = $this->getContainer();

        $container->share(Mailer::class, function () use ($container) {

            $config = $container->get('config');

            $transport = (new Swift_SmtpTransport(
                $config->get('swiftmailer.host'),
                $config->get('swiftmailer.port')
            ))
                ->setUsername($config->get('swiftmailer.username'))
                ->setPassword($config->get('swiftmailer.password'));

            $swift = new Swift_Mailer($transport);

            return (new Mailer($swift, $container->get(Twig::class)))
                ->alwaysFrom(
                    $config->get('swiftmailer.from.address'),
                    $config->get('swiftmailer.from.name')
                );
        });
    }
}
