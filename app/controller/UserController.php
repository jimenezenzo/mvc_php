<?php
namespace App\controller;
use \App\model\User;
use \App\core\Email;
use \App\core\View;

class UserController
{
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
            View::render("auth/login.html", ["errores" => $errores]);
            die();
        }

        try {
            $user = User::findEmail($data["email"]);
            if (!empty($user)) {
                if ($user->verificado === "N") {
                    $errores[] = "Tenes que verificar tu cuenta";
                    $_SESSION['errores'] = $errores;
                    header('Location: /login');
                    die();
                }

                if (md5($data["contraseña"]) === $user->password) {
                    $_SESSION['auth'] = $user;
                    header('Location: /home');
                    die();
                }
            }

            $errores[] = "Email o contraseña incorrecta";
            $_SESSION['errores'] = $errores;
            header('Location: /login');
            die();
        } catch (Exception $e) {
            $_SESSION['errores'] = "Hubo un error: ".$e->getMessage();
            header('Location: /login');
            die();
        }
        
    }

    public function register(){
        $data["nombre"] = $_POST["nombre"];
        $data["apellido"] = $_POST["apellido"];
        $data["email"] = $_POST["email"];
        $data["password"] = $_POST["password"];
        $data["password_repet"] = $_POST["password_repet"];
        $data["token"] = $this->generateRandomString();

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
            $_SESSION['errores'] = $errores;
            header('Location: /registro');
            die();
        }

        try {
            User::create($data);
            // $mail = new Email();
            // $vista = "<p> Hola bienvenido a la web, confirma tu cuenta </p>";
            // $mail->enviarEmail($email, 'Confirmar cuenta', $vista);
            $_SESSION["status"] = "Usuario creado correctamente";
            header("Location: /registro");
            die();
        } catch (Exception $e) {
            $_SESSION['errores'] = "Error al registrar ".$e->getMessage();
            header('Location: /registro');
            die();
        }
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    } 

    public function logout()
    {
        if (isset($_SESSION['auth'])) {
            session_destroy();
            header('Location: /');
        }
    }

}
