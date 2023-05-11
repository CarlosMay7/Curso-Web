<?php
    require "includes/funciones.php";
    incluirTemplate("header");
?>

    <main class="contenedor seccion contenido-centrado">
        <h2>Casa en venta frente al bosque</h2>

        <picture>
            <source srcset="/build/img/destacada.webp" type="image/webp">
            <source srcset="/build/img/destacada.jpg" type="image/jpeg">
            <img loading="lazy" src="/build/img/destacada.jpg" alt="Imagen destacada">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">$3,000,000</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="figura" loading="lazy" src="/build/img/icono_wc.svg" alt="WC">
                    <p>3</p>
                </li>
                <li>
                    <img class="figura" loading="lazy" src="/build/img/icono_estacionamiento.svg" alt="Estacionamiento">
                    <p>3</p>
                </li>
                <li>
                    <img class="figura" loading="lazy" src="/build/img/icono_dormitorio.svg" alt="Recamaras">
                    <p>3</p>
                </li>
            </ul>

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum, esse. Rem deleniti quaerat enim quam expedita quae placeat dolorum, aspernatur architecto. Accusamus, animi reprehenderit mollitia vitae laboriosam enim illo culpa.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur esse quo eos quibusdam sit, minus ratione architecto corrupti eligendi praesentium, harum ab repudiandae nostrum laboriosam molestias quaerat dolores quidem delectus.</p>
        </div>
    </main>

<?php
    incluirTemplate("footer");
?>