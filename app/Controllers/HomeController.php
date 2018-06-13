<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class HomeController extends Controller
{
    public function index(Request $request, Response $response)
    {   
        return $this->view->render($response, 'templates/index.twig');
    }

    public function newAction(Request $request, Response $response)
    {
        $this->validate($request, [
            'email' => ['required', 'email'],
        ]);
    }
}