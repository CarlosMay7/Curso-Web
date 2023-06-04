<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {

    public static function index(Router $router){
        $propiedades = Propiedad::get(3);
        $inicio = true;
        $router->render("paginas/index", [
            "propiedades" => $propiedades,
            "inicio" => $inicio
        ]);
    }
    public static function nosotros(Router $router){

        $router->render("paginas/nosotros");
    }
    public static function propiedades(Router $router){

        $propiedades = Propiedad::all();
        $router->render("paginas/propiedades", [
            "propiedades" => $propiedades
        ]);
    }
    public static function propiedad(Router $router){
        $id = validarRedirec("/propiedades");
        $propiedad = Propiedad::find($id);
        $router->render("paginas/propiedad", [
            "propiedad" => $propiedad
        ]);
    }
    public static function blog(Router $router){
        $router->render("paginas/blog");
    }
    public static function entrada(Router $router){
        $router->render("paginas/entrada");
    }
    public static function contacto(Router $router){

        $mensaje = null;

        if($_SERVER["REQUEST_METHOD"] === "POST"){

            $respuestas = $_POST["contacto"];
            //Crear instancia phpmailer
            $mail = new PHPMailer();
            //Configurar SMTP (Protocolo para envio de emails)
            $mail->isSMTP();
            $mail->Host ='sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true; //Define si se necesita autenticar
            $mail->Username = '856107c79736a8';
            $mail->Password = 'f06aa13c680c16';
            $mail->SMTPSecure = 'tls'; //Metodo de enio de datos
            $mail->Port = 2525;

            //Configurar contenido email
            $mail->setFrom("admin@bienesraices.com");
            $mail->addAddress("admin@bienesraices.com", "BienesRaices.com"); //Quien lo recibe y donde
            $mail->Subject = "Tienes un nuevo mensaje";

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = "UTF-8";

            //Definir el contenido
            $contenido = "<html>";
            $contenido.= "<p>Tienes un nuevo mensaje</p>";
            $contenido.= "<p>Nombre: " .  $respuestas["nombre"] . "</p>";

            //Enviar de forma condicional

            if ($respuestas["contacto"] === "telefono"){
                $contenido.= "<p>Teléfono: " .  $respuestas["telefono"] . "</p>";
                $contenido.= "<p>Fecha de Contacto: " .  $respuestas["fecha"] . "</p>";
                $contenido.= "<p>Hora: " .  $respuestas["hora"] . "</p>";
            } else {
                $contenido.= "<p>E-Mail: " .  $respuestas["email"] . "</p>";
            }
            $contenido.= "<p>Mensaje: " .  $respuestas["mensaje"] . "</p>";
            $contenido.= "<p>Vende o Compra: " .  $respuestas["tipo"] . "</p>";
            $contenido.= "<p>Precio o Presupuesto: $" .  $respuestas["precio"] . "</p>";
            $contenido.= "<p>Medio de Contacto: " .  $respuestas["contacto"] . "</p>";

            
            
            $contenido .= " </html>";

            $mail->Body = $contenido;
            $mail->AltBody = "Texto sin html"; //Cuando el lector de mails no entiende el HTML

            //Enviar al email
            if ($mail->send()){
                $mensaje = "El mensaje se envió correctamente";
            } else {
                $mensaje = "Mensaje no enviado";
            }
        }
        $router->render("paginas/contacto", [
            "mensaje" => $mensaje
        ]);
    }

}