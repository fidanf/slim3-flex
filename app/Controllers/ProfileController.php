<?php


namespace App\Controllers;

use App\Models\User;
use App\Views\View;
use Slim\Http\Request;
use Slim\Http\Response;

class ProfileController extends Controller
{
    protected $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function index(Request $request, Response $response)
    {
        $users = User::paginate(2);
        return $this->view->render($response, 'templates/profile.twig', compact('users'));
    }
}