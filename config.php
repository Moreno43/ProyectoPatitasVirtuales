
<?php
// Establecer la zona horaria predeterminada a 'America/Lima ya que es la unica que me funciona que sea igual a colombia'
date_default_timezone_set('America/Lima');

// Iniciar una sesión
session_start();

// Definir la constante 'RUTA' con la URL base del proyecto
define('RUTA', 'http://localhost/shop/');

// Configuración de la base de datos
define('DB_HOST', 'localhost'); 
define('DB_USER', 'root');      
define('DB_NAME', 'shop');      
define('DB_PASS', '');          

// Configuración de PayPal
define('CLIENT_ID_PAYPAL', 'ARtELM9gW5sQcYEDb-11-jdoPAig6Y--f9Ggu9-RStP0QO4QrECMBHzzQaownQd1lZCL4yoJEOmYo8CN');
?>
