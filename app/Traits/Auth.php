<?php
namespace App\Traits;

trait Auth
{
	public static function checkAuth()
	{
		if (self::getUser() === false){
            return false;
        }

        return true;
	}

	public static function getUser()
	{
		if (isset($_SESSION['auth'])) {
			return $_SESSION['auth'];
		}

		return false;
	}

	public static function verifyAuth()
	{
		if (!self::checkAuth()) {
        	$errores[] = "Tenes que iniciar sesion";
            $_SESSION["errores"] = $errores;
            header('Location: /login');
            die();
        }
	}
}