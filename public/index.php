<?php
require "../vendor/autoload.php";
use App\core\Router;

define("PATH_CONTROLLER", 'App\controller\\');
session_start();

$module = isset($_GET["module"]) && !empty($_GET["module"]) ? $_GET["module"] : "/";

Router::add("/", "InicioController", "index", "GET");
Router::add("login", "InicioController", "ingresar", "GET");
Router::add("registro", "InicioController", "registro", "GET");
Router::add("ingresar", "UserController", "login", "POST");
Router::add("registrarse", "UserController", "register", "POST");
Router::add("logout", "UserController", "logout", "GET");
Router::add("home", "HomeController", "index", "GET");

Router::executeActionFromController($module);
