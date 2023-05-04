<?php include 'includes/header.php';

$productos = [
    [
        "Nombre" => "Tablet",
        "Precio" => 200,
        "Disponible" => true
    ],
    [
        "Nombre" => "Monitor",
        "Precio" => 400,
        "Disponible" => true
    ],
    [
        "Nombre" => "Audifonos",
        "Precio" => 100,
        "Disponible" => false
    ]
];

foreach($productos as $producto){//Cerrando php para añadir HTML ?> 
    <li>
        <p>Producto: <?php echo $producto["Nombre"];?></p>
        <p>Precio: <?php echo "$" . $producto["Precio"];?></p>
        <p><?php /*Operador ternario para un if*/ echo ($producto["Disponible"]) ? "Disponible" : "No disponible";  ?></p>

        <?php
            if ($producto["Disponible"]){
                echo "<p>Disponible</P>";
            } else {
                echo "<p>No disponible</P>";
            }
        ?>
    </li>
    <?php

    echo "<pre>";
    var_dump($producto);
    echo "</pre>";

}



include 'includes/footer.php';