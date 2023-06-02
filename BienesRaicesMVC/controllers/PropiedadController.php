<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController{

    public static function index(Router $router){
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();

        $resultado = $_GET["resultado"] ?? null;

        $router->render("propiedades/admin", [
            "propiedades" => $propiedades,
            "resultado" => $resultado,
            "vendedores" => $vendedores
        ]);
    }
    public static function crear(Router $router){
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        //Arreglo mensajes de error
        $errores = Propiedad::getErrores();

        if($_SERVER["REQUEST_METHOD"]==="POST") {

            //Crea una instancia de la propiedad
            $propiedad = new Propiedad($_POST["propiedad"]);
    
            //Crear nombre unico de imagen
            $nombreImagen = md5( uniqid( rand(), true)) . ".jpg"; //Generar nombres aleatorios dificiles de repetir
    
            //Set imagen
            //Resize a la imagen con Intervention
            if ($_FILES["propiedad"]["tmp_name"]["imagen"]) {
                $image = Image::make($_FILES["propiedad"]["tmp_name"]["imagen"]) -> fit(800,600);
                //Asigna la imagen como atributo de la propiedad
                $propiedad->setImagen($nombreImagen);  
            }
    
            $errores = $propiedad->validar();
    
            if (empty($errores)){
    
                if(!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
                //Guardar la imagen
                $image->save(CARPETA_IMAGENES . $nombreImagen); //Se le ingresa el path a donde guardar la imagen
    
                //Guarda en bd
                $propiedad->guardar();
    
            }
        }

        $router->render("propiedades/crear", [
            "propiedad" => $propiedad,
            "vendedores" => $vendedores,
            "errores" => $errores
        ]);
    }
    public static function actualizar(Router $router){
        $id = validarRedirec('/admin');

        $propiedad = Propiedad::find($id);

        $errores = Propiedad::getErrores();

        $vendedores = Vendedor::all();

        if($_SERVER["REQUEST_METHOD"]==="POST") {

            $args = $_POST["propiedad"]; //Toma el arreglo llamado propiedad que se lleno en el formulario con el name
    
            $propiedad->sincronizar($args);
    
            //Validar
            $errores = $propiedad->validar();
            
            //Subir archivos
            $nombreImagen = md5( uniqid( rand(), true)) . ".jpg"; //Generar nombres aleatorios dificiles de repetir
    
            if ($_FILES["propiedad"]["tmp_name"]["imagen"]) {
                $image = Image::make($_FILES["propiedad"]["tmp_name"]["imagen"]) -> fit(800,600);
                //Asigna la imagen como atributo de la propiedad
                $propiedad->setImagen($nombreImagen);  
            }
        
            //Revisar que no haya errores
            if (empty($errores)){
                //Guardar imagen si existe
                if ($_FILES["propiedad"]["tmp_name"]["imagen"]) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                
                $propiedad -> guardar();
                
            }
        }

        $router->render("/propiedades/actualizar", [
            "propiedad" => $propiedad,
            "errores" => $errores,
            "vendedores" => $vendedores

        ]);
    }

    public static function eliminar(){

        if ($_SERVER["REQUEST_METHOD"] === "POST"){
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
            if($id){
    
                $tipo = $_POST["tipo"];
    
                if(validarContenido($tipo)){
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar(); 
                } 
            }
        }
    }
}