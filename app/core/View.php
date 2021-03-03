<?php
namespace App\Core;

class View
{
    public static function render($vista, $data = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader("../view");
        $twig = new \Twig\Environment($loader, []);

        echo $twig->render($vista, $data);
    }
}
