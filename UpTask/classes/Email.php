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
        $mail->Port = $_ENV['MAILT_PORT'];
        $mail->Username = $_ENV['MAILT_USER'];
        $mail->Password = $_ENV['MAILT_PASS'];

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

    public function enviarInstrucciones(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['MAILT_PORT'];
        $mail->Username = $_ENV['MAILT_USER'];
        $mail->Password = $_ENV['MAILT_PASS'];

        $mail->setFrom("cuentas@uptask.com");
        $mail->addAddress("cuentas@uptask.com", "uptask.com");
        $mail->Subject = "Reestablece tu password";

        $mail->isHTML(true);
        $mail->CharSet = "UTF-8";
        
        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>, parece que olvidaste tu password, sigue el siguiente link para reestablecerlo. </p>";
        $contenido .= "<p><a href='http://" . $_ENV['URL'] . "/reestablecer?token=" . $this->token . "'>Presiona Aquí</a></p>";
        $contenido .= "<p>Si tu no pediste el cambio, ignora este mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        $mail->send();
    }
}