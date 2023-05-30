<?php
    require "../includes/app.php";

    //Revisa el login
    autenticado();

    use App\Propiedad;

    //Implementar metodo para obtener las propiedades con active record
    $propiedades = Propiedad::all();
    
    //Mensaje condicional
    $resultado = $_GET["resultado"] ?? null; //El ?? es como un placeholder, si no encuentra el valor de resultado con el get lo toma como null

    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        $id = $_POST["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){

            $propiedad = Propiedad::find($id);

            $propiedad ->eliminar();

        }
    }
    //Incluir template
    incluirTemplate("header");
?>

    <main class="contenedor seccion">
        <h2>Administrador Bienes Raices</h2>

        <?php if ($resultado == 1):?>
            <p class="alerta exito">Propiedad registrada correctamente</p>
        <?php elseif($resultado ==2): ?>
            <p class="alerta exito">Propiedad actualizada correctamente</p>
        <?php elseif($resultado ==3): ?>
            <p class="alerta exito">Propiedad eliminada correctamente</p>
        <?php endif?>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!--Mostrar resultados-->
            <?php foreach ($propiedades as $propiedad):    ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td><img  class="imagen-tabla"src="/imagenes/<?php echo $propiedad->imagen;   ?>" alt="Imagen"></td>
                    <td> $ <?php echo $propiedad->precio; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id;  ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar"></input>
                        </form>
                        <a class="boton-amarillo-block"  href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </main>

<?php

    //Cerrar conexion
    mysqli_close($db); 
    incluirTemplate("footer");
?>