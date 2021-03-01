<?php
namespace App\controller;
use \App\model\User;

class HomeController
{
    private $renderer;

    public function __construct($renderer)
    {
        $this->renderer = $renderer;

        if (!isset($_SESSION['auth'])){
            header('Location: /');
        }
    }

    public function index()
    {
        echo $this->renderer->render("inicio/home.html");
    }

}    