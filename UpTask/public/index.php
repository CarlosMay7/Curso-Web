<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\DashboardController;
use Controllers\LoginController;
use MVC\Router;
$router = new Router();

//Login
$router->get("/", [LoginController::class, "login"]);
$router->post("/", [LoginController::class, "login"]);
$router->get("/logout", [LoginController::class, "logout"]);

//Crear Cuenta
$router->get("/crear", [LoginController::class, "crear"]);
$router->post("/crear", [LoginController::class, "crear"]);

//Olvidé password
$router->get("/olvide", [LoginController::class, "olvide"]);
$router->post("/olvide", [LoginController::class, "olvide"]);

//Nuevo password
$router->get("/reestablecer", [LoginController::class, "reestablecer"]);
$router->post("/reestablecer", [LoginController::class, "reestablecer"]);

//Confirmar cuenta
$router->get("/mensaje", [LoginController::class, "mensaje"]);
$router->get("/confirmar", [LoginController::class, "confirmar"]);

//Zona de proyectos
$router->get("/dashboard", [DashboardController::class, "index"]);
$router->get("/crear-proyecto", [DashboardController::class, "crearProyecto"]);
$router->post("/crear-proyecto", [DashboardController::class, "crearProyecto"]);
$router->get("/proyecto", [DashboardController::class, "proyecto"]);
$router->get("/perfil", [DashboardController::class, "perfil"]);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();