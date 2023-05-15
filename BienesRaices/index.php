<?php
    require "includes/app.php";
    incluirTemplate("header", $inicio = true);
?>

    <main class="contenedor seccion">
        <h2>Más Sobre Nosotros</h2>

        <div class="iconos-nosotros">
            <div class="icono">
                <img class="figura" loadign="lazy" src="/build/img/icono1.svg" alt="Icono">
                <h3>Seguridad</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptate iure fugiat ea veritatis laudantium. Obcaecati deserunt sapiente, sed itaque, aperiam quod mollitia, eligendi consectetur iusto animi inventore culpa! Aperiam, dolorum.</p>
            </div>
            <div class="icono">
                <img class="figura" loadign="lazy" src="/build/img/icono2.svg" alt="Icono">
                <h3>Precio</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptate iure fugiat ea veritatis laudantium. Obcaecati deserunt sapiente, sed itaque, aperiam quod mollitia, eligendi consectetur iusto animi inventore culpa! Aperiam, dolorum.</p>
            </div>
            <div class="icono">
                <img class="figura" loadign="lazy" src="/build/img/icono3.svg" alt="Icono">
                <h3>A Tiempo</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptate iure fugiat ea veritatis laudantium. Obcaecati deserunt sapiente, sed itaque, aperiam quod mollitia, eligendi consectetur iusto animi inventore culpa! Aperiam, dolorum.</p>
            </div>
        </div>
    </main>

    <section class="seccion contenedor">
        <h2>Casas y Depas en Venta</h2>

        <?php
            $limite = 3;
            include "includes/templates/anuncios.php";
        ?>

        <div class="alinear-derecha">
            <a class="boton-verde" href="/anuncios.php">Ver todas</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario para podernos en contacto contigo</p>
        <a class="boton-amarillo-block" href="contacto.php">Contáctanos</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="/build/img/blog1.webp" type="image/webp">
                        <source srcset="/build/img/blog1.jpg" type="image/jpeg">
                        <img loading="lazy" src="/build/img/blog1.jpg" alt="Texto entrada blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Entrada en el techo de tu casa</h4>
                        <p class="informacion-meta">Escrito el: <span>06/05/2023</span> por: <span>Admin</span></p>

                        <p>Consejos para construir una terraza en el techo de tu casa</p>
                    </a>
                </div>
            </article>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="/build/img/blog2.webp" type="image/webp">
                        <source srcset="/build/img/blog2.jpg" type="image/jpeg">
                        <img loading="lazy" src="/build/img/blog2.jpg" alt="Texto entrada blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Guia para la decoración de tu hogar</h4>
                        <p class="informacion-meta">Escrito el: <span>06/05/2023</span> por: <span>Admin</span></p>

                        <p>Maximiza el espacio en tu hogar con esta guia</p>
                    </a>
                </div>
            </article>
        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>

            <div class="testimonial">
                <blockquote>
                    El personal se comportó de la mejor manera, muy buena atención y las intalaciones no pudieron estar mejores.
                    <p>-Carlos May</p>
                </blockquote>
            </div>
        </section>
    </div>

<?php
    incluirTemplate("footer");
?>