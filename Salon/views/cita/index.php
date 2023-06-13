<h1 class="nombre-pagina">Crear Nueva Cita</h1>
<p class="descripcion-pagina">Elige tus servicios y coloca tus datos</p>

<div class="barra">
    <p>Hola <?php echo $nombre ?? ""; ?></p>

    <a class="boton" href="/logout">Cerrar Sesión</a>
</div>
<div class="app">

<nav class="tabs">
    <button class="actual" type="button" data-paso="1">Servicios</button>
    <button type="button" data-paso="2">información Cita</button>
    <button type="button" data-paso="3">Resumen</button>
</nav>
    <div id="paso-1" class="seccion">
        <h2>Servicios</h2>
        <p class="text-center">Elige tus servicios</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>
    <div id="paso-2" class="seccion">
        <h2>Datos y Cita</h2>
        <p class="text-center">Coloca Tus Datos</p>
        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" placeholder="Tu Nombre" value="<?php echo $nombre; ?>" disabled>                
            </div>

            <div class="campo">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" min="<?php echo date("Y-m-d", strtotime("+1 day")); ?>">                
            </div>
            <div class="campo">
                <label for="hora">Hora</label>
                <input type="time" id="hora">                
            </div>

            <input type="hidden" id="id" value="<?php echo $id;?>">

        </form>
    </div>
    <div id="paso-3" class="seccion contenido-resumen">
        <h2>Resumen</h2>
        <p class="text-center">Verifica tu información</p>
    </div>

    <div class="paginacion">
        <button id="anterior" class="boton">&laquo; Anterior</button>
        <button id="siguiente" class="boton">Siguiente &raquo;</button>
    </div>
</div>

 <?php
    $script = "
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    <script src='build/js/app.js'></script>
    ";
 ?>