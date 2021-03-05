<?php
namespace App\Controller;
use \App\Model\User;
use \App\Core\View;
use \App\Traits\Auth;

class HomeController
{
    public function __construct()
    {
        Auth::verifyAuth();
    }

    public function index()
    {
        View::render("inicio/home.html", ["user" => Auth::getUser()]);
    }

}