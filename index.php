<?php

require_once 'config.php';

require_once 'controllers/homecontroller.php'; // Se incluye el controlador HomeController

$home = new Home(); // Se crea una instancia del controlador HomeController

$home->index(); // Se llama al método index() del controlador HomeController
?>

<link rel="icon" href="logo.png" type="image/png">