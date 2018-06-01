<?php

namespace App\Controllers;

use Noodlehaus\Config;
use Slim\Http\Request;
use Slim\Http\Response;

class HomeController
{
    
    public function index(Request $request, Response $response, Config $c)
    {
        dump($c);
        $response->write('Home');
        return $response->withStatus(200);
    }
}