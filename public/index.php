<?php
require "../vendor/autoload.php";
use App\core\Router;

define("PATH_CONTROLLER", 'App\controller\\');
session_start();

$module = isset($_GET["module"]) && !empty($_GET["module"]) ? $_GET["module"] : "/";

Router::executeActionFromController($module);
