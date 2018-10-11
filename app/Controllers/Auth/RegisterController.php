<?php


namespace App\Controllers\Auth;


use App\Auth\Auth;
use App\Auth\Hashing\HasherInterface;
use App\Controllers\Controller;
use App\Models\User;
use App\Session\Flash;
use App\Views\View;
use Slim\Http\Request;
use Slim\Http\Response;

class RegisterController extends Controller
{
    protected $view;

    protected $hasher;

    protected $auth;

    protected $flash;

    public function __construct(View $view, HasherInterface $hasher, Auth $auth, Flash $flash)
    {
        $this->view = $view;
        $this->hasher = $hasher;
        $this->auth = $auth;
        $this->flash = $flash;
    }

    public function index(Request $request, Response $response)
    {
        return $this->view->render($response, 'auth/register.twig');
    }

    public function register(Request $request, Response $response)
    {
        $data = $this->validateRegistration($request);

        User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $this->hasher->create($data['password']),
        ]);

        if ($this->auth->attempt($data['email'], $data['password'])) {
            $this->flash->now('success', 'You were successfully registered!');
            return $response->withRedirect('/profile');
        }

        return $response->withRedirect('/');
    }

    protected function validateRegistration(Request $request)
    {
        return $this->validate($request, [
           'email' => ['required', 'email', ['exists', User::class]],
           'username' => ['required'],
           'password' => ['required'],
           'password_confirmation' => ['required', ['equals', 'password']],
        ]);
    }


}