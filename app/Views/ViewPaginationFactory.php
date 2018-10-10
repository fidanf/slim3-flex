<?php

namespace App\Views;

use App\Views\View;

class ViewPaginationFactory
{
	protected $view;

	protected $rendered;

	public function __construct(View $view)
	{
		$this->view = $view;
	}

	public function make($view, $data = [])
	{
		$this->rendered = $this->view->make($view, $data);

		return $this;
	}

	public function render()
	{
		return $this->rendered;
	}
}