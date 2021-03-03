<?php
namespace App\Core;

class Router{
    
    public static function executeActionFromController($module)
    {
        $rutas = self::rutas();
        $module = self::removeQueryStringVariables($module);
        
        if (array_key_exists($module, $rutas)) {
            $namespace = $rutas[$module]["namespace"];
            $namespace = str_replace("/", "\\", $namespace);
            $action = $rutas[$module]["action"];
            $controller = PATH_CONTROLLER.$namespace;

            if (class_exists($controller)) {

                if (method_exists($controller, $action)) {

                    $controller_object = new $controller();
                    return call_user_func(array($controller_object, $action));
                }
            }
        }
        
        echo "Error 404";
    }

    public static function removeQueryStringVariables($url)
    {
        if ($url != '') {
            $parts = explode('&', $url, 2);

            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }

        return $url;
    }

    public static function rutas()
    {
        return $rutas = [
            "/" => array(
                "namespace" => "InicioController",
                "action" => "index"
            ),
            "login" => array(
                "namespace" => "InicioController",
                "action" => "ingresar"
            ),
            "registro" => array(
                "namespace" => "InicioController",
                "action" => "registro"
            ),
            "ingresar" => array(
                "namespace" => "UserController",
                "action" => "login"
            ),
            "registrarse" => array(
                "namespace" => "UserController",
                "action" => "register"
            ),
            "logout" => array(
                "namespace" => "UserController",
                "action" => "logout"
            ),
            "home" => array(
                "namespace" => "HomeController",
                "action" => "index"
            )
        ];
    }
}