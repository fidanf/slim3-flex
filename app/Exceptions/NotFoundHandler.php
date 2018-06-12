<?php

namespace App\Exceptions;

use App\Views\View;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Handlers\AbstractHandler;

class NotFoundHandler extends AbstractHandler
{
    protected $view;

    protected $output;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function __invoke(Request $request, Response $response)
    {
        $contentType = $this->determineContentType($request);
        switch ($contentType){
            case 'application/json':
                $this->output = $this->renderNotFoundJSON($response);
                break;
            case 'text/html':
                $this->output = $this->renderNotFoundHTML($response);
                error_log('404 Not Found');
                break;
        }

        return $this->output->withStatus(404);
    }

    protected function renderNotFoundJSON(Response $response)
    {
        return $response->withJson([
            'error' => 'Not found'
        ]);
    }

    protected function renderNotFoundHTML(Response $response)
    {
        if ($this->view->exists('errors/404.twig')) {
            return $this->view->render($response, 'errors/404.twig');
        }

        return $response->write('Not found');
    }
}