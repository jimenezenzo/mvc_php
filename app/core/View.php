<?php
namespace App\Core;

class View
{
    public static function render($vista, $data = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader("../view");
        $twig = new \Twig\Environment($loader, []);

        if (isset($_SESSION["errores"])) {
        	$data = array_merge(["errores" => $_SESSION["errores"]], $data);
        	unset($_SESSION["errores"]);
        }
        if (isset($_SESSION["status"])) {
        	$data = array_merge(["status" => $_SESSION["status"]], $data);
        	unset($_SESSION["status"]);
        }

        echo $twig->render($vista, $data);
    }
}
