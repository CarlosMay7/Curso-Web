
<main class="contenedor seccion contenido-centrado">
        <h2><?php echo $propiedad->titulo; ?></h2>

        <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen destacada">

        <div class="resumen-propiedad">
            <p class="precio">$<?php echo $propiedad->precio; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="figura" loading="lazy" src="/build/img/icono_wc.svg" alt="WC">
                    <p><?php echo $propiedad->wc; ?></p>
                </li>
                <li>
                    <img class="figura" loading="lazy" src="/build/img/icono_estacionamiento.svg" alt="Estacionamiento">
                    <p><?php echo $propiedad->estacionamiento; ?></p>
                </li>
                <li>
                    <img class="figura" loading="lazy" src="/build/img/icono_dormitorio.svg" alt="Recamaras">
                    <p><?php echo $propiedad->habitaciones; ?></p>
                </li>
            </ul>
            <p><?php echo $propiedad->descripcion; ?></p>
        </div>
    </main>