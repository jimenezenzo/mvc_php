<?php
namespace App\core;
use App\core\Config;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email
{
    private $mail;
    private $config;

    public function __construct()
    {
        $this->config = new Config("config/config.ini");
        $this->mail = new PHPMailer(true);
        $this->mail->Host = $this->config->get("email", "host");
        $this->mail->Port = $this->config->get("email", "port");
        $this->mail->Username = $this->config->get("email", "username");
        $this->mail->Password = $this->config->get("email", "password");
        $this->mail->SMTPDebug = 0;
        $this->mail->isSMTP();
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer'       => false,
                'verify_peer_name'  => false,
                'allow_self_signed' => true,
            ),
        );
        $this->mail->setFrom($this->config->get("email", "username"), 'Logistc S.A');
        $this->mail->isHTML(true);
    }

    public function enviarEmail($destinatario, $asunto, $vista, $archivo = null)
    {
        $this->mail->addAddress($destinatario);
        $this->mail->Subject = $asunto;
        $this->mail->Body = $vista;
        if (isset($archivo)) {
            $this->mail->addAttachment($archivo, $archivo);
        }
        $this->mail->send();      
    }

}
