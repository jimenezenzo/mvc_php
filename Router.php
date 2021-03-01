<?php

class Router{
    public static function executeActionFromController($moduleInitializer, $module, $action){
        $controllerName = self::createControllerNameFromModule($module);
        try {
            $controller = self::ejecutarMetodo($moduleInitializer, $controllerName);
            self::ejecutarMetodo($controller, $action);
        }
        catch (Exception $e){
            $controller = self::llamarMetodo($moduleInitializer, self::createControllerNameFromModule("excepciones"));
            self::llamarMetodo($controller, "index");
        }
    }

    private static  function createControllerNameFromModule($module){
        return "create" . ucfirst($module) . "Controller";
    }

    private static function ejecutarMetodo($clase, $metodo)
    {
        try {
            $validAction = self::verificar($clase, $metodo);
            return self::llamarMetodo($clase, $validAction);
        }
        catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    private static function verificar($clase, $metodo)
    {
        if (method_exists($clase, $metodo)){
            return $metodo;
        }

        throw new Exception("Error 404");
    }

    private static function llamarMetodo($clase, $metodo)
    {
        return call_user_func(array($clase, $metodo));
    }
}