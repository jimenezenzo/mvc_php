<?php
namespace App\core;

class Renderer
{
    public static function render()
    {
        $loader = new \Twig\Loader\FilesystemLoader("view");
        $twig = new \Twig\Environment($loader, []);

        return $twig;
    }
}
