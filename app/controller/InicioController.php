<?php
namespace App\controller;

class InicioController
{
    private $renderer;

    public function __construct($renderer)
    {
        $this->renderer = $renderer;
    }

    public function index()
    {
        echo $this->renderer->render("bienvenida.html");
    }

    public function ingresar()
    {
        echo $this->renderer->render("auth/login.html");
    }

    public function registro()
    {
        echo $this->renderer->render("auth/registro.html");
    }
}
