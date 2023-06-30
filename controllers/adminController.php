<?php
require_once '../models/admin.php'; // Se incluye el archivo del modelo AdminModel
$option = (empty($_GET['option'])) ? '' : $_GET['option']; // Se obtiene el valor de la variable 'option' de la URL, si existe
$admin = new AdminModel(); // Se crea una instancia del modelo AdminModel
switch ($option) {
    case 'totales':
        $fecha = date('Y-m-d'); // Se obtiene la fecha actual en formato 'YYYY-MM-DD'
        $data['usuario'] = $admin->getDatos('usuarios'); // Se obtienen los datos de usuarios mediante el método getDatos() del modelo AdminModel y se asignan a la clave 'usuario' del arreglo $data
        $data['productos'] = $admin->getDatos('productos'); // Se obtienen los datos de productos mediante el método getDatos() del modelo AdminModel y se asignan a la clave 'productos' del arreglo $data
        $data['pedidos'] = $admin->getDatos('pedidos'); // Se obtienen los datos de pedidos mediante el método getDatos() del modelo AdminModel y se asignan a la clave 'pedidos' del arreglo $data
        $data['ingresos'] = $admin->getIngresos($fecha); // Se obtienen los ingresos mediante el método getIngresos() del modelo AdminModel y se asignan a la clave 'ingresos' del arreglo $data, pasando la fecha actual como argumento
        echo json_encode($data); // Se devuelve el arreglo $data codificado en formato JSON
        break;
    case 'datos':
        $data = $admin->getDato(); // Se obtienen los datos mediante el método getDato() del modelo AdminModel y se asignan a la variable $data
        echo json_encode($data); // Se devuelve la variable $data codificada en formato JSON
        break;
    case 'save':
        $nombre = $_POST['nombre']; // Se obtiene el valor de la variable 'nombre' enviada mediante una solicitud POST
        $telefono = $_POST['telefono']; // Se obtiene el valor de la variable 'telefono' enviada mediante una solicitud POST
        $direccion = $_POST['direccion']; // Se obtiene el valor de la variable 'direccion' enviada mediante una solicitud POST
        $correo = $_POST['correo']; // Se obtiene el valor de la variable 'correo' enviada mediante una solicitud POST
        $id = $_POST['id']; // Se obtiene el valor de la variable 'id' enviada mediante una solicitud POST
        if (empty($id) || empty($nombre) || empty($telefono) || empty($direccion) || empty($correo)) {
            $res = array('tipo' => 'error', 'mensaje' => 'TODO LOS CAMPOS SON REQUERIDOS'); // Si alguno de los campos está vacío, se crea un arreglo $res con el tipo de error y el mensaje correspondiente
        } else {
            $result = $admin->saveDatos($nombre, $telefono, $correo, $direccion, $id); // Se llama al método saveDatos() del modelo AdminModel, pasando los datos para guardar
            if ($result) {
                $res = array('tipo' => 'success', 'mensaje' => 'REGISTRO MODIFICADO'); // Si la operación de guardar fue exitosa, se crea un arreglo $res con el tipo de éxito y el mensaje correspondiente
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL MODIFICAR'); // Si ocurrió un error al guardar, se crea un arreglo $res con el tipo de error y el mensaje correspondiente
            }
        }
        echo json_encode($res); // Se devuelve el arreglo $res codificado en formato JSON
        break;
    default:
        // Si no se proporciona una opción válida, no se ejecuta ninguna acción
        break;
}

