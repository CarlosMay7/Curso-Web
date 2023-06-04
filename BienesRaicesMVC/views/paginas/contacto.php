<main class="contenedor seccion">
        <h2>Contacto</h2>

        <?php
            if($mensaje){ ?>
                <p class="alerta exito"> <?php echo $mensaje ?></p>;
            <?php } ?>

        <picture>
            <source srcset="/build/img/destacada3.webp" tyoe="image/webp">
            <source srcset="/build/img/destacada3.jpg" tyoe="image/jpeg">
            <img src="/build/img/destacada3.jpg" alt="Imagen destacada 3">
        </picture>

        <h2>Llene el formulario de contacto</h2>

        <form class="formulario" action="/contacto" method="POST">
            <fieldset>
                <legend>Informacion Personal</legend>

                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Tu nombre" id="nombre" name="contacto[nombre]" required>

                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje" name="contacto[mensaje]" required></textarea>
            </fieldset>

            <fieldset>
                <legend>Información sobre la propiedad</legend>

                <label for="opciones">Vende o compra</label>
                <select id="opciones" name="contacto[tipo]" required>
                    <option value="" disabled selected>--Seleccione una opción--</option>
                    <option value="Compra">Compra</option> <!--Lo que está dentro del value es lo que se manda al servidor y lo que está entre las etiquetas lo que el usuario ve-->
                    <option value="Vende">Vende</option>
                </select>

                <label for="presupuesto">Precio o presupuesto</label>
                <input type="number" placeholder="Tu presupuesto" id="presupuesto" name="contacto[precio]" required>

            </fieldset>

            <fieldset>
                <legend>Información sobre la propiedad</legend>

                <p>Cómo desea ser contactado</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <!--El name hace que se agrupen los radio buttons y solo se pueda elegir una opcion de ellos-->
                    <input type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" required>  <!--Elegir solo una opción-->
                    
                    <label for="contactar-email">E-Mail</label>
                    <input type="radio" value="email" id="contactar-email" name="contacto[contacto]" required>
                </div>

                <div id="contacto"></div>

            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </main>