<?php
namespace App\controller;
use \App\core\View;

class InicioController
{
    public function index()
    {
        View::render("bienvenida.html");
    }

    public function ingresar()
    {
        View::render("auth/login.html");
    }

    public function registro()
    {
        View::render("auth/registro.html");
    }
}
