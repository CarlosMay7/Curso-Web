<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Ponente;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class PonentesController {
    public static function index(Router $router){
        $paginaActual = $_GET["page"] ?? "";
        $paginaActual = filter_var($paginaActual, FILTER_VALIDATE_INT);
        if(!$paginaActual || $paginaActual<1){
            header("Location: /admin/ponentes?page=1");
        }
        $registrosPagina = 7;
        $totalRegistros = Ponente::total();

        $paginacion = new Paginacion($paginaActual, $registrosPagina, $totalRegistros);

        if($paginacion->totalPaginas() < $paginaActual){
            header("Location: /admin/ponentes?page=1");
        }

        $ponentes = Ponente::paginar($registrosPagina, $paginacion->offset());

        if(!isAuth() || !isAdmin()){
            header("Location: /login");
        }
        $router->render("admin/ponentes/index", [ 
            "titulo" => "Ponentes / Conferencistas",
            "ponentes" => $ponentes,
            "paginacion" => $paginacion->paginacion()
        ]);
    }

    public static function crear(Router $router){
        
        if(!isAuth() || !isAdmin()){
            header("Location: /login");
        }

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

        $redes = json_decode($ponente->redes);
    
        $router->render("admin/ponentes/crear", [ 
            "titulo" => "Registrar Ponente",
            "alertas" => $alertas,
            "ponente" => $ponente,
            "redes" => $redes
        ]);
    }

    public static function editar (Router $router){
        if(!isAuth() || !isAdmin()){
            header("Location: /login");
        }

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

        $ponente->imagenActual = $ponente->imagen;
        $redes = json_decode($ponente->redes);

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            if(!isAdmin()){
                header("Location: /login");
            }
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
            } else {
                $_POST["imagen"] = $ponente->imagenActual;
            }

            $_POST["redes"] = json_encode($_POST["redes"], JSON_UNESCAPED_SLASHES);
            $ponente->sincronizar($_POST);
            $alertas = $ponente->validar();

            if(empty($alertas)){
                if(isset($nombreImagen)){
                    //Guardar la imagen
                    $imagenPng->save($carpetaImagenes . '/' . $nombreImagen . ".png");
                    $imagenPng->save($carpetaImagenes . '/' . $nombreImagen . ".webp");
                }

                $resultado = $ponente->guardar();
                if($resultado){
                    header("Location: /admin/ponentes");
                }
            }
        }

        $router->render("admin/ponentes/editar", [ 
            "titulo" => "Editar Ponente",
            "alertas" => $alertas,
            "ponente" => $ponente,
            "redes" => $redes
        ]);
    }

    public static function eliminar (){
        if(!isAdmin()){
            header("Location: /login");
        }
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id = $_POST["id"];
            $ponente = Ponente::find($id);

            if(!isset($ponente)){
                header("Location: /admin/ponentes");
            }

            $resultado = $ponente->eliminar();
            if($resultado){
                header("Location: /admin/ponentes");
            }
        }
    }
}