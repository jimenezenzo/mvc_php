<?php
namespace App\Traits;

trait Auth
{
	public static function checkAuth()
	{
		if (!isset($_SESSION['auth'])){
            $errores[] = "Tenes que iniciar sesion";
            $_SESSION["errores"] = $errores;
            header('Location: /login');
        }
	}
}