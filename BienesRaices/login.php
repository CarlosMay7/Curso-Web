<?php

    require "includes/config/database.php";
    $db = conectarDB();

    $errores = [];

    if($_SERVER["REQUEST_METHOD"]==="POST"){

        $email = mysqli_real_escape_string($db, filter_var($_POST["email"], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST["password"]);

        if(!$email){
            $errores[] = "Email necesario o incorrecto";
        }

        if(!$password) {
            $errores[] = "Password necesaria";
        }

        if(empty($errores)){
            $query = "SELECT * FROM usuarios WHERE email = '$email'";

            $resultado = mysqli_query($db, $query); 

            if ($resultado -> num_rows){
                $usuario = mysqli_fetch_assoc($resultado);

                //Verificar password
                $auth = password_verify($password, $usuario["password"]);

                if ($auth){
                    //Iniciar la sesion
                    session_start();

                    //Llenar el arreglo de la sesión
                    $_SESSION["usuario"] = $usuario["email"];
                    $_SESSION["login"] = true;

                    header("Location: /admin");


                } else {
                    $errores[] = "Password incorrecto";
                }
            } else {
                $errores[] = "El usuario no existe";
            }
        }
    }
    
    require "includes/funciones.php";
    incluirTemplate("header");
?>

    <main class="contenedor seccion contenido-centrado">
        <h2>Login</h2>

        <?php foreach ($errores as $error): ?>

            <div class="alerta error"> <?php echo $error; ?></div>
        <?php endforeach; ?>

        <form method="POST" class="formulario">
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

<?php
    incluirTemplate("footer");
?>