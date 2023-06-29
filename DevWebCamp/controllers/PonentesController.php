<?php

namespace Controllers;

use Model\Ponente;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class PonentesController {
    public static function index(Router $router){
        $ponentes = Ponente::all();

        $router->render("admin/ponentes/index", [ 
            "titulo" => "Ponentes / Conferencistas",
            "ponentes" => $ponentes
        ]);
    }

    public static function crear(Router $router){

        $alertas = [];
        $ponente = new Ponente;

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            //Verificar que haya imagen
            if(!empty($_FILES["imagen"]["tmp_name"])){
                $carpetaImagenes = "../public/img/speakers";

                //Crear carpeta si no existe

                if(!is_dir($carpetaImagenes)){
                    mkdir($carpetaImagenes, 0755, true);
                }

                $imagenPng = Image::make($_FILES["imagen"]["tmp_name"])->fit(800, 800)->encode("png", 80);
                $imagenPng = Image::make($_FILES["imagen"]["tmp_name"])->fit(800, 800)->encode("webp", 80);

                $nombreImagen = md5(uniqid(rand(), true));

                $_POST["imagen"] = $nombreImagen;
            } 

            $_POST["redes"] = json_encode($_POST["redes"], JSON_UNESCAPED_SLASHES);

            $ponente->sincronizar($_POST);

            //Validar 
            $alertas = $ponente->validar();

            //Guardar el registro
            if(empty($alertas)){
                //Guardar la imagen
                $imagenPng->save($carpetaImagenes . '/' . $nombreImagen . ".png");
                $imagenPng->save($carpetaImagenes . '/' . $nombreImagen . ".webp");

                //Guardar en la db
                $resultado = $ponente->guardar();

                if($resultado){
                    header("Location: /admin/ponentes");
                }
            }
        }
    
        $router->render("admin/ponentes/crear", [ 
            "titulo" => "Registrar Ponente",
            "alertas" => $alertas,
            "ponente" => $ponente
        ]);
    }

    public static function editar (Router $router){

        $alertas = [];
        //Validar el id
        $id = $_GET["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id){
            header("Location: /admin/ponentes");
        }

        //Obtener ponente
        $ponente = Ponente::find($id);

        if(!$ponente){
            header("Location: /admin/ponentes");
        }


        $router->render("admin/ponentes/editar", [ 
            "titulo" => "Editar Ponente",
            "alertas" => $alertas,
            "ponente" => $ponente
        ]);
    }
}