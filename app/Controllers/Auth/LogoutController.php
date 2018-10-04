<?php

namespace App\Controllers\Auth;

use App\Auth\Auth;
use App\Controllers\Controller;
use Slim\Http\Request;
use Slim\Http\Response;

class LogoutController extends Controller
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function logout(Request $request, Response $response)
    {
        $this->auth->logout();

        return $response->withRedirect('/');
    }
}
