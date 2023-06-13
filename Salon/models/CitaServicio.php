<?php

namespace Model;

class CitaServicio extends ActiveRecord {
    protected static $tabla = "citasservicios";
    protected static $columnasDB = ["id", "citasid", "servicioid"];

    public $id;
    public $citasid;
    public $servicioid;

    public function __construct($args = []){
        $this->id = $args["id"] ?? null;
        $this->citasid = $args["citasid"] ?? "";
        $this->servicioid = $args["servicioid"] ?? "";
    }
}