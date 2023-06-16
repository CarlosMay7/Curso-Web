<?php
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{

    public $email;
    public $nombre;
    public $token;
    public function __construct($email, $nombre, $token){
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){
        //Crear objeto de email

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '856107c79736a8';
        $mail->Password = 'f06aa13c680c16';
        //Set HTML
        $mail->isHTML(true);
        $mail->CharSet = "UTF-8";

        $mail->setFrom("cuentas@appsalon.com");
        $mail->addAddress("cuentas@appsalon.com", "appsalon.com");
        $mail->Subject = "Confirma tu cuenta";

        $contenido = "<html>";
        $contenido.= "<p>Hola <strong>" . $this->nombre . "</strong> has creado tu cuenta en este salón, confírmala presionando el siguiente enlace</p>";
        $contenido.= "<p>Presiona aquí: <a href='http://" . $_ENV['URL'] . "/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido.= "<p>Si tú no solicitaste este cambio ignora este mail</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar mail
        $mail->send();
    }

    public function enviarInstrucciones(){
        //Crear objeto de email

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '856107c79736a8';
        $mail->Password = 'f06aa13c680c16';
        //Set HTML
        $mail->isHTML(true);
        $mail->CharSet = "UTF-8";

        $mail->setFrom("cuentas@appsalon.com");
        $mail->addAddress("cuentas@appsalon.com", "appsalon.com");
        $mail->Subject = "Reestablece tu password";

        $contenido = "<html>";
        $contenido.= "<p>Hola <strong>" . $this->nombre . "</strong> Has solicitado reestablecer tu password, sigue el enlace para hacerlo</p>";
        $contenido.= "<p>Presiona aquí: <a href='http://" . $_ENV['URL'] . "/recuperar?token=" . $this->token . "'>Reestablecer Password</a></p>";
        $contenido.= "<p>Si tú no solicitaste este cambio ignora este mail</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar mail
        $mail->send();
    }
}