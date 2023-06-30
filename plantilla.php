

<?php
require_once 'config.php'; // Se incluye el archivo de configuración

require_once 'controllers/plantillaController.php'; // Se incluye el controlador PlantillaController

$plantilla = new Plantilla(); // Se crea una instancia del controlador PlantillaController

$archivo = (!empty($_GET['pagina'])) ? $_GET['pagina'] : null; // Se obtiene el valor de la variable 'pagina' de la URL, si existe

if ($archivo == 'carrito' && $archivo != null) {
    $plantilla->carrito(); // Si el archivo es 'carrito', se llama al método carrito() del controlador PlantillaController
    exit; // Se finaliza la ejecución del script
}

if ($archivo == 'login' && $archivo != null) {
    $plantilla->login(); // Si el archivo es 'login', se llama al método login() del controlador PlantillaController
    exit; // Se finaliza la ejecución del script
}

//  PERMISOS //
$id_user = $_SESSION['id_usuario']; // Se obtiene el valor de la variable de sesión 'id_usuario'

if (empty($id_user)) { // Si la variable de sesión 'id_usuario' está vacía
    header('Location: ./'); // Se redirige a la página principal
}

// HEADER //
require_once 'views/includes/header.php'; // Se incluye el archivo de encabezado (header)

if (isset($_GET['pagina'])) { // Si se ha proporcionado un valor para la variable 'pagina' en la URL
    if (empty($_GET['pagina'])) { // Si el valor de 'pagina' está vacío
        $plantilla->index(); // Se llama al método index() del controlador PlantillaController
    } else {
        try {
            $archivo = $_GET['pagina']; // Se obtiene el valor de la variable 'pagina'
            if ($archivo == 'usuarios') {
                $plantilla->usuarios(); // Si el archivo es 'usuarios', se llama al método usuarios() del controlador PlantillaController
            } else if ($archivo == 'configuracion') {
                $plantilla->configuracion(); // Si el archivo es 'configuracion', se llama al método configuracion() del controlador PlantillaController
            } else if ($archivo == 'productos') {
                $plantilla->productos(); // Si el archivo es 'productos', se llama al método productos() del controlador PlantillaController
            } else if ($archivo == 'pedidos') {
                $plantilla->pedidos(); // Si el archivo es 'pedidos', se llama al método pedidos() del controlador PlantillaController
            } else {
                $plantilla->notFound(); // Si el archivo no coincide con ninguno de los anteriores, se llama al método notFound() del controlador PlantillaController
            }
        } catch (PDOException $th) {
            $plantilla->notFound(); // Si ocurre una excepción, se llama al método notFound() del controlador PlantillaController
        }
    }
} else {
    $plantilla->index(); // Si no se ha proporcionado un valor para la variable 'pagina' en la URL, se llama al método index() del controlador PlantillaController
}

require_once 'views/includes/footer.php'; // Se incluye el archivo de pie de página (footer)

function fechaColombia()
{
    $mes = array(
        "", "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre"
    );
    return date('d') . " de " . $mes[date('n')] . " de " . date('Y'); // Se devuelve una cadena formateada con la fecha actual en formato "d de mes de año" (por ejemplo, "31 de mayo de 2023")
}

?>