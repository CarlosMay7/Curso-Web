<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Recupera tu Acceso a DevWebCamp</p>

    <?php
        require_once __DIR__ . "/..//templates/alertas.php";
    ?>

    <form class="formulario" method="POST" action="/olvide">
        <div class="formulario__campo">
            <label class="formulario__label" for="email">E-Mail</label>
            <input 
                type="email"
                class="formulario__input"
                placeholder="Tu E-Mail"
                id="email"
                name="email"
            >
        </div>

        <input type="submit" class="formulario__submit" value="Enviar Instrucciones">
    </form>

    <div class="acciones">
    <a class="acciones__enlace" href="/login">¿Ya tienes una cuenta? Inicia Sesión</a>
        <a class="acciones__enlace" href="/registro">¿Aún no tienes cuenta? Crea una</a>
    </div>
</main>