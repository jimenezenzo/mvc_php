<?php
namespace App\controller;
use \App\model\User;
use \App\core\Email;

class UserController
{
    private $renderer;

    public function __construct($renderer)
    {
        $this->renderer = $renderer;
    }

    public function login()
    {
        $data["email"] = $_POST['email'];
        $data["contraseña"] = $_POST['password'];

        foreach ($data as $da => $valor) {
            if (empty($valor)) {
                $errores[] = "El campo $da no puede estar vacio";
            }
        }

        if (!empty($errores)) {
            echo $this->renderer->render("auth/login.html", ["errores" => $errores]);
            die();
        }

        try {
            $user = User::findEmail($data["email"]);
            if (!empty($user)) {
                if (md5($data["contraseña"]) === $user->password) {
                    $_SESSION['auth'] = $user;
                    header('Location: /home');
                    die();
                }
            }

            $errores[] = "Usuario o contraseña incorrecto";
            echo $this->renderer->render("auth/login.html", ["errores" => $errores]);
            die();
        } catch (Exception $e) {
            echo "error capturado: ".$e->getMessage();
        }
        
    }

    public function register(){
        $data["nombre"] = $_POST["nombre"];
        $data["apellido"] = $_POST["apellido"];
        $data["email"] = $_POST["email"];
        $data["password"] = $_POST["password"];
        $data["password_repet"] = $_POST["password_repet"];

        foreach ($data as $da => $valor) {
            if (empty($valor)) {
                $errores[] = "El campo ${da} no puede estar vacio";
            }
        }

        if ($data["password"] != $data["password_repet"]) {
            $errores[] = "Las contraseñas no son iguales";
        }

        if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            $errores[] = "El email es invalido";
        }

        $email_existente = User::findEmail($data["email"]);
        if (!empty($email_existente) || !is_null($email_existente)) {
            $errores[] = "El email ya se encuentra registrado";
        }

        if (!empty($errores)) {
            echo $this->renderer->render("auth/registro.html", ["errores" => $errores]);
            die();
        }

        try {
            User::create($data);
            echo "Usuario creado";
        } catch (Exception $e) {
            echo "Error al registrar ".$e->getMessage();
        }
    }

    public function enviarEmail()
    {
        $mail = new Email();

        try {
            $vista = "<p> Hola bienvenido a la web </p>";
            $mail->enviarEmail('enzo-jimenez@hotmail.com', 'Bienvenida', $vista);
            echo "mail enviado";    
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function logout()
    {
        if (isset($_SESSION['auth'])) {
            session_destroy();
            header('Location: /');
        }
    }

}
