<?php
    require "../includes/app.php";

    //Revisa el login
    autenticado();

    use App\Propiedad;
    use App\Vendedor;

    //Implementar metodo para obtener las propiedades con active record
    $propiedades = Propiedad::all();
    $vendedores = Vendedor::all();

    
    //Mensaje condicional
    $resultado = $_GET["resultado"] ?? null; //El ?? es como un placeholder, si no encuentra el valor de resultado con el get lo toma como null

    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        $id = $_POST["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){

            $tipo = $_POST["tipo"];

            if(validarContenido($tipo)){
                if($_POST["tipo"] === "propiedad"){
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();                
                } elseif ($_POST["tipo"] === "vendedor") {
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }            
            } 
        }
    }
    //Incluir template
    incluirTemplate("header");
?>

    <main class="contenedor seccion">
        <h2>Administrador Bienes Raices</h2>

        <?php  
            $mensaje = mostrarNoti(intval($resultado));

            if($mensaje): ?>

            <p class="alerta exito"> <?php echo s($mensaje); ?></p>

            <?php endif ?>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
        <a href="/admin/vendedores/crear.php" class="boton boton-amarillo">Nuevo Vendedor</a>

        <h2>Propiedades</h2>

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
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block" value="Eliminar"></input>
                        </form>
                        <a class="boton-amarillo-block"  href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

        <h2>Vendedores</h2>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!--Mostrar resultados-->
            <?php foreach ($vendedores as $vendedor):    ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                    <td> $ <?php echo $vendedor->telefono; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id;  ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton-rojo-block" value="Eliminar"></input>
                        </form>
                        <a class="boton-amarillo-block"  href="/admin/vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    </main>

<?php
    incluirTemplate("footer");
?>