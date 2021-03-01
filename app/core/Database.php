<?php
namespace App\core;
use App\core\Config;
use \mysqli;

abstract class Database{

    public static function connection(){
        $config = new Config("config/config.ini");

        $mysqli = new mysqli(
            $config->get("database","servername"),
            $config->get("database","username"),
            $config->get("database","password"),
            $config->get("database","dbname")
        );

        if ($mysqli->connect_errno) {
            echo "Falló la conexión con MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            exit();
        }

        return $mysqli;
    }

}