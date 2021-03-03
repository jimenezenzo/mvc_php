<?php
namespace App\Core;
use App\Core\Config;
use \mysqli;

abstract class Database{

    // protected $conn;

    // public function __construct()
    // {
    //     $config = new Config("config/config.ini");

    //     $this->conn = new mysqli(
    //         $config->get("database","servername"),
    //         $config->get("database","username"),
    //         $config->get("database","password"),
    //         $config->get("database","dbname")
    //     );

    //     if ($this->conn->connect_errno) {
    //         echo "Falló la conexión con MySQL: (" . $this->conn->connect_errno . ") " . $this->conn->connect_error;
    //         exit();
    //     }
    // }

    public static function connection(){
        $config = new Config("../config/config.ini");

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