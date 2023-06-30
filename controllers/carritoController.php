<?php
require_once '../models/productos.php'; // Se incluye el archivo del modelo ProductosModel
$option = (empty($_GET['option'])) ? '' : $_GET['option']; // Se obtiene el valor de la variable 'option' de la URL, si existe
$productos = new ProductosModel(); // Se crea una instancia del modelo ProductosModel
switch ($option) {
    case 'agregar':
        if (isset($_POST['id_producto'])) {
            $id_producto = $_POST['id_producto']; // Se obtiene el valor de la variable 'id_producto' enviada mediante una solicitud POST
            if (!empty($id_producto)) {
                if (isset($_SESSION['carrito']['productos'][$id_producto])) {
                    $_SESSION['carrito']['productos'][$id_producto] = 1; // Si el producto ya existe en el carrito, se actualiza la cantidad a 1
                } else {
                    $_SESSION['carrito']['productos'][$id_producto] = 1; // Si el producto no existe en el carrito, se agrega con una cantidad de 1
                }
                $cantidad = count($_SESSION['carrito']['productos']); // Se cuenta la cantidad de productos en el carrito
                $msg = array('msg' => 'producto añadido', 'icono' => 'success', 'total' => $cantidad); // Se crea un arreglo $msg con un mensaje de éxito, el icono correspondiente y la cantidad total de productos en el carrito
            } else {
                $msg = array('msg' => 'error fatal', 'icono' => 'error'); // Si ocurre un error al agregar el producto, se crea un arreglo $msg con un mensaje de error
            }
        } else {
            $msg = array('msg' => 'error fatal', 'icono' => 'error'); // Si ocurre un error al agregar el producto, se crea un arreglo $msg con un mensaje de error
        }
        echo json_encode($msg); // Se devuelve el arreglo $msg codificado en formato JSON
        break;
    case 'eliminar':
        $id_producto = $_GET['id']; // Se obtiene el valor de la variable 'id' de la URL
        if (isset($_SESSION['carrito']['productos'][$id_producto])) {
            unset($_SESSION['carrito']['productos'][$id_producto]); // Si el producto existe en el carrito, se elimina
            $data = array('icono' => 'success', 'msg' => 'PRODUCTO ELIMINADO DEL CARRITO'); // Se crea un arreglo $data con un mensaje de éxito
        } else {
            $data = array('icono' => 'error', 'msg' => 'ERROR AL PRODUCTO ELIMINAR'); // Si ocurre un error al eliminar el producto, se crea un arreglo $data con un mensaje de error
        }
        echo json_encode($data); // Se devuelve el arreglo $data codificado en formato JSON
        break;
    case 'ver':
        $total = 0;
        if (isset($_SESSION['carrito']['productos'])) {
            if(!empty($_SESSION['carrito']['productos'])){
                foreach ($_SESSION['carrito']['productos'] as $id => $cantidad) {
                    $producto = $productos->getProducto($id); // Se obtiene el producto del modelo ProductosModel mediante el método getProducto(), pasando el id del producto
                    $total += $producto['precio_normal'] * $cantidad; // Se calcula el total sumando el precio del producto multiplicado por la cantidad
                }
            }
        }
        echo json_encode($total); // Se devuelve el total codificado en formato JSON
        break;
    default:
        // Si no se proporciona una opción válida, no se ejecuta ninguna acción
        break;
}
