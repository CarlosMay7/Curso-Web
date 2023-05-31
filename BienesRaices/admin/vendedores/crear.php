<?php 

    require "../../includes/app.php";
    use App\Vendedor;

    autenticado();

    $vendedor = new Vendedor;

    $errores = Vendedor::getErrores();

    if($_SERVER["REQUEST_METHOD"]==="POST") {

        $vendedor = new Vendedor($_POST["vendedor"]);

        //Validar

        $errores = $vendedor->validar();

        if (empty($errores)){
            $vendedor->guardar();
        }
    }

    incluirTemplate("header");


    ?>

<main class="contenedor seccion">
        <h2>Agregar Vendedor</h2>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php
            foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach ?>

        <form class="formulario" method="POST" action="/admin/vendedores/crear.php">
            <?php
                include "../../includes/templates/formulario_vendedores.php";
            ?>
            <input type="submit" value="Registrar Vendedor" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate("footer");
?>