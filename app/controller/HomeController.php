<?php
namespace App\controller;
use \App\model\User;
use \App\core\View;

class HomeController
{
    public function __construct()
    {
        if (!isset($_SESSION['auth'])){
            header('Location: /');
        }
    }

    public function index()
    {
        View::render("inicio/home.html");
    }

}