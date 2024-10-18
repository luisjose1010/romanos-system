<?php

namespace App\Controllers;

use Framework\Controller;
use Framework\Response;

class HomeController extends Controller
{
    public function index($parameters = null)
    {
        $response = new Response();
        $response->view('home');
    }
}
