<?php

namespace App\Views;

use Psr\Http\Message\ResponseInterface;
use Twig\Environment;

class View
{
    protected $twig; 

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function render(ResponseInterface $response, $view, $data = [])
    {
        $response->getBody()->write(
            $this->make($view, $data)
        );

        return $response;
    }

    public function share(array $data)
    {
        foreach ($data as $key => $value) {
            $this->twig->addGlobal($key, $value);
        }
    }

    public function exists(string $template)
    {
        return $this->twig->getLoader()->exists($template);
    }

    public function make($view, $data = [])
    {
        return $this->twig->render($view, $data);
    }
}
