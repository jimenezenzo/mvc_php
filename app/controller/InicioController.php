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
        $errores = [];
        if (isset($_SESSION["errores"])) {
            $errores = $_SESSION["errores"];
            unset($_SESSION["errores"]);
        }

        View::render("auth/login.html", ["errores" => $errores]);
    }

    public function registro()
    {
        $errores = [];
        $status = [];
        if (isset($_SESSION["errores"])) {
            $errores = $_SESSION["errores"];
            unset($_SESSION["errores"]);
        }
        if (isset($_SESSION["status"])) {
            $status = $_SESSION["status"];
            unset($_SESSION["status"]);
        }

        View::render("auth/registro.html", ["errores" => $errores,
                                            "status" => $status]);
    }
}
