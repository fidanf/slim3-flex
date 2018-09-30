<?php


namespace App\Controllers;


use Slim\Http\Request;
use Slim\Http\Response;

class ProfileController extends Controller
{
    public function index(Request $request, Response $response)
    {
        return $this->view->render($response, 'templates/profile.twig');
    }
}