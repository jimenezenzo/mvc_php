<?php

namespace App\model;
use App\core\Database;
use \Exception;

class User extends Database 
{
	public static function all()
	{
		$conn = parent::connection();
		$sql = "SELECT * FROM users";
        $resultObj = [];
        if ($resultado = $conn->query($sql)) {
            while ($obj = $resultado->fetch_object()) {
                $resultObj[] = $obj;
            }

            $resultado->close();
            $conn->close();
            return $resultObj;
        }

        echo "Error: " . $sql . "<br>" . $conn->error;
	}

	public static function create($data)
	{
		$conn = parent::connection();
		$stmt = $conn->prepare("INSERT INTO users (nombre, apellido, email, password, verificado, token, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sssssss", $nombre, $apellido, $email, $password, $verificado, $token, $created_at);

		$nombre = $data["nombre"];
		$apellido = $data["apellido"];
		$email = $data["email"];
		$password = md5($data["password"]);
		$verificado = "N";
		$token = $data["token"];
		$created_at = date("Y-m-d H:i:s");
		$stmt->execute();

		$stmt->close();
		$conn->close();
	}

	public static function findEmail($email)
	{
        $conn = parent::connection();
        $sql = "SELECT * FROM users WHERE users.email = '$email'";
        if ($resultado = $conn->query($sql)) {
            $obj = $resultado->fetch_object();
            $resultado->close();
            $conn->close();
            return $obj;
        }

        echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
