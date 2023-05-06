<?php

function obtenerServicios (){

    try {
        //Importar las credenciales (Lo que esta en database.php)
        require("databse.php");

        //Consulta SQL
        //Cualquier cosulta valida de sql
        $sql = "SELECT * FROM servicios";

        //Realizar la consulta
        $query = mysqli_query($db, $sql);
        return $query;
        /*Acceder a los resultados
        echo "<pre>";
        var_dump(mysqli_fetch_assoc($query)); //Devuelve la consulta hecha previamente en forma de arreglo asociativo, hay otras formas
        echo "<br>";
        var_dump(mysqli_fetch_all($query));
        echo "</pre>";
        */
        //Cerrar la conexion (opcional)
        //Algo opcional ya que php al terminar el archivo la cierra
        //$cerrar = mysqli_close($db);

    } catch(\Throwable $th) {
        var_dump($th);
    }


}

obtenerServicios();