<?php
namespace App\controller;
use \App\model\User;
use \App\core\View;
use \App\Traits\Auth;

class HomeController
{
    public function __construct()
    {
        Auth::checkAuth();
    }

    public function index()
    {
        View::render("inicio/home.html");
    }

}