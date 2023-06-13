<h1 clas="nombre-pagina">Panel de Administración</h1>

<?php include_once __DIR__ . "/../templates/barra.php"; ?>
 
<h2>Buscar Citas</h2>
<div class="citas">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input 
                type="date"
                id="fecha"
                name="fecha"  
                value="<?php echo $fecha; ?>"  
            >
        </div>
    </form>
</div>

<?php
    if(count($citas) === 0){
        echo "<h2> No hay citas en esa fecha </h2>";
    }
?>
<div id="citas-admin">
    <ul class="citas">
    <?php 
        $idCita = 0;
        foreach($citas as $key => $cita){
            if($idCita !== $cita->id){
                $total = 0;
    ?>
        <li>
            <p>ID: <span><?php echo $cita->id; ?></span></p>
            <p>Cliente: <span><?php echo $cita->cliente; ?></span></p>
            <p>Hora: <span><?php echo $cita->hora; ?></span></p>
            <p>E-mail: <span><?php echo $cita->email; ?></span></p>
            <p>Teléfono: <span><?php echo $cita->telefono; ?></span></p>
        </li>

        <h3>Servicios</h3>

        <?php
                $idCita = $cita->id;
            } //Fin if

            $total += $cita->precio; 
        ?>

        <p class="servicio"><?php echo $cita->servicio . " $" . $cita->precio; ?></p>

        <?php
            $actual = $cita->id;
            $siguiente = $citas[$key+1]->id ?? 0;

            if (esUltimo($actual, $siguiente)){ ?>

            <p class="total">Total: <span>$<?php echo $total; ?></span></p>

            <form action="/api/eliminar" method="POST">
                <input type="hidden" name="id" value = "<?php echo $cita->id; ?>">
                <input type="submit" class="boton-eliminar" value="Eliminar">
            </form>
        <?php
            } //Fin if es ultimo
        } //Fin foreach
    ?>

    </ul>
</div>

<?php
    $script = "<script src = 'build/js/buscador.js'></script>";
?>