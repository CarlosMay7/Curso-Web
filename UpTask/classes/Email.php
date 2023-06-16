<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {
    protected $email;
    protected $nombre;
    protected $token;

    public function __construct($email, $nombre, $token) {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '856107c79736a8';
        $mail->Password = 'f06aa13c680c16';

        $mail->setFrom("cuentas@uptask.com");
        $mail->addAddress("cuentas@uptask.com", "uptask.com");
        $mail->Subject = "Confirma tu cuenta";

        $mail->isHTML(true);
        $mail->CharSet = "UTF-8";
        
        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>, has creado tu cuenta en UpTask. Confirmala a continuación. </p>";
        $contenido .= "<p><a href='http://" . $_ENV['URL'] . "/confirmar?token=" . $this->token . "'>Presiona Aquí</a></p>";
        $contenido .= "<p>Si tu no creaste esta cuenta, ignora este mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        $mail->send();
    }
}