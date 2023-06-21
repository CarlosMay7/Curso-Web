<?php

namespace Model;

class Tarea extends ActiveRecord {
    protected static $tabla = "tareas";
    protected static $columnasDB = ["id", "nombre", "estado", "proyectoid"];

    public $id;
    public $nombre;
    public $estado;
    public $proyectoid;

    public function __construct($args= []) {
        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? "";
        $this->estado = $args["estado"] ?? 0;
        $this->proyectoid = $args["proyectoid"] ?? "";
    }
}