<?php
require "vendor/autoload.php";
use App\core\Renderer;

class ModuleInitializer
{
    private $renderer;

    public function __construct()
    {
        $this->renderer = Renderer::render();
    }

    public function createDefaultController()
    {
        return $this->createInicioController();
    }

    public function createExcepcionesController()
    {
        return new App\controller\ExcepcionesController();
    }

    public function createInicioController()
    {
        return new App\controller\InicioController($this->renderer);
    }

    public function createUserController()
    {
        return new App\controller\UserController($this->renderer);
    }

    public function createHomeController()
    {
        return new App\controller\HomeController($this->renderer);
    }
}
