<?php

namespace App\Controllers;

use Framework\Controller;
use Framework\View\Render;


class SellController extends Controller
{
    public function index(array $parameters = null)
    {
        $this->add();
    }

    public function add()
    {
        Render::view('sell');
    }
}
