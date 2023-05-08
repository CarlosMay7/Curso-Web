<?php

require "app.php";
function incluirTemplate(string $template, bool $inicio=false){
    include TEMPLATES_URL . "/{$template}.php";
}