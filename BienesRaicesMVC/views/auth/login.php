<main class="contenedor seccion contenido-centrado">
        <h2>Login</h2>

        <?php foreach ($errores as $error): ?>

            <div class="alerta error"> <?php echo $error; ?></div>
        <?php endforeach; ?>

        <form method="POST" class="formulario" action="/login">
            <fieldset>
                    <legend>Email y password</legend>

                    <label for="email">E-Mail</label>
                    <input type="email" name="email" placeholder="Tu E-Mail" id="email">

                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Tu password" id="password"> <!--Html trae el tipo password para que no se muestre el texto directo-->
            </fieldset>

            <input type="submit" value="Iniciar sesión" class="boton boton-verde">
        </form>
    </main>