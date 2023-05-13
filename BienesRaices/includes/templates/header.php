<?php

    if (!isset($_SESSION)){
        session_start();
    }

    $auth = $_SESSION["login"] ?? false;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes raices</title>

    <link rel="preload" href="/build/css/app.css" as="style">
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>

    <header class="header <?php echo $inicio ? "inicio" : ""; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/index.php">
                <img src="/build/img/logo.svg" alt="Logo">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="Icono menu responsive">
                </div>
                <div class="derecha">
                    <img class="boton-darkmode"src="/build/img/dark-mode.svg" alt="Boton dark mode">
                    <div class="navegacion">
                        <a href="/nosotros.php">Nosotros</a>
                        <a href="/anuncios.php">Anuncios</a>
                        <a href="/blog.php">Blog</a>
                        <a href="/contacto.php">Contacto</a>

                        <?php if ($auth): ?>

                            <a href="/cerrarSesion.php">Cerrar Sesión</a>
                        
                        <?php endif; ?>
                    </div>
                </div>

            </div>
            <?php if($inicio){?>
            <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php } ?>
        </div>
    </header>