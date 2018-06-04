<?php

namespace App\Controllers;

use App\Views\View;

abstract class Controller
{
    protected $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }
}