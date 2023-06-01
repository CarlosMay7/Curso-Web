<?php 

    require "../../includes/app.php";
    use App\Vendedor;

    autenticado();

    $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header("Location: /admin");
    }

    //Obtener arreglo vendedor
    $vendedor = Vendedor::find($id);

    $errores = Vendedor::getErrores();

    if($_SERVER["REQUEST_METHOD"]==="POST") {

        //Asignar valores

        $args = $_POST["vendedor"];

        $vendedor->sincronizar($args);
        //Validar
        $errores = $vendedor->validar();

        if(empty($errores)){
            $vendedor->guardar();
        }

    }

    incluirTemplate("header");


    ?>

<main class="contenedor seccion">
        <h2>Actualizar Vendedor</h2>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php
            foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach ?>

        <form class="formulario" method="POST">
            <?php
                include "../../includes/templates/formulario_vendedores.php";
            ?>
            <input type="submit" value="Actualizar" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate("footer");
?>