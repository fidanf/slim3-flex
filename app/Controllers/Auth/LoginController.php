<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Auth\Auth;
use App\Session\Flash;
use App\Views\View;
use Slim\Http\Request;
use Slim\Http\Response;

class LoginController extends Controller
{
    protected $auth;

    protected $view;

    protected $flash;

    public function __construct(View $view, Flash $flash, Auth $auth)
    {
        $this->view = $view;
        $this->flash = $flash;
        $this->auth = $auth;
    }

    public function index(Request $request, Response $response)
    {
        return $this->view->render($response, 'auth/login.twig');
    }

    public function login(Request $request, Response $response)
    {
        $data = $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $attempt = $this->auth->attempt($data['email'], $data['password'], isset($data['remember']));

        if (!$attempt) {
            $this->flash->now('error', 'Could not sign you in with those details.');

            return $response->withRedirect($request->getUri()->getPath());
        }

        return $response->withRedirect('/');
    }
}