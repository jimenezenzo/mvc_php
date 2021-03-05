<?php
namespace App\Controller;
use \App\Core\View;

class InicioController
{
    public function index()
    {
        if (isset($_SESSION['auth'])) {
            header("Location: /home");
            die();
        }

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
