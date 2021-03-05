<?php
namespace App\Core;

class Router{
    private static $rutas = array();

    public static function executeActionFromController($module)
    {
        $rutas = static::$rutas;
        
        if (array_key_exists($module, $rutas)) {
            $namespace = $rutas[$module]["namespace"];
            $namespace = str_replace("/", "\\", $namespace);
            $action = $rutas[$module]["action"];
            $controller = PATH_CONTROLLER.$namespace;
            $method = $rutas[$module]["method"];

            if (class_exists($controller) && method_exists($controller, $action)) {

               if ($_SERVER["REQUEST_METHOD"] === $method) {

                    $controller_object = new $controller();
                    return call_user_func(array($controller_object, $action));
                }
                else{

                    http_response_code(405);
                    echo "405 Method Not Allowed";
                    die();
                }
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }

    public static function add($ruta, $controller, $action, $method)
    {
        $newRuta = array($ruta => array(
            "namespace" => $controller,
            "action" => $action,
            "method" => $method));

        static::$rutas = array_merge(static::$rutas, $newRuta);
    }

}