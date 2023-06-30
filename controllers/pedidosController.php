<?php

//Este controlador se encarga de manejar las acciones relacionadas con los pedidos en una tienda virtual. 
//La opción 'listar' obtiene los pedidos, incluyendo el detalle de los productos asociados a cada uno. La opción 'cambiar' se utiliza para 
//cambiar el estado de un pedido. La opción 'savePedido' se utiliza para guardar un nuevo pedido y realizar las actualizaciones correspondientes en el stock de los productos.


require_once '../models/pedidos.php'; // Se incluye el archivo del modelo PedidosModel
$option = (empty($_GET['option'])) ? '' : $_GET['option']; // Se obtiene el valor de la variable 'option' de la URL, si existe
$pedidos = new PedidosModel(); // Se crea una instancia del modelo PedidosModel
switch ($option) {
    case 'listar':
        $data = $pedidos->getPedidos(); // Se obtienen los pedidos mediante el método getPedidos() del modelo
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['productos'] = '';
            $data[$i]['cantidad'] = '';
            $productos = $pedidos->getProductos($data[$i]['id']); // Se obtienen los productos del pedido mediante el método getProductos() del modelo, pasando el id del pedido
            foreach ($productos as $producto) {
                $data[$i]['productos'] .= '<li>' . $producto['nombre'] . '</li>'; // Se concatenan los nombres de los productos en formato de lista HTML
                $data[$i]['cantidad'] .= '<li>' . $producto['cantidad'] . '</li>'; // Se concatenan las cantidades de los productos en formato de lista HTML
            }
            $estado = ($data[$i]['estado']) ? '' : 'checked'; // Se establece el estado del pedido como checked o vacío, dependiendo del valor del estado en la base de datos
            $data[$i]['accion'] = '<div class="btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-primary">
                <input type="checkbox" ' . $estado . ' onchange="cambiar(' . $data[$i]['id'] . ')">
            </label>
        </div>'; // Se crea el botón de acción para cambiar el estado del pedido
        }
        echo json_encode($data); // Se devuelve los datos de los pedidos codificados en formato JSON
        break;
    case 'cambiar':
        $id_pedido = $_GET['id']; // Se obtiene el valor de la variable 'id' de la URL
        $data = $pedidos->cambiar($id_pedido); // Se cambia el estado del pedido mediante el método cambiar() del modelo, pasando el id del pedido
        if ($data) {
            $res = array('tipo' => 'success', 'mensaje' => 'ESTADO MODIFICADO');
        } else {
            $res = array('tipo' => 'error', 'mensaje' => 'ERROR');
        }
        echo json_encode($res); // Se devuelve la respuesta codificada en formato JSON
        break;
    case 'savePedido':
        $datos = file_get_contents('php://input'); // Se obtienen los datos enviados mediante una solicitud POST
        $json = json_decode($datos, true); // Se decodifican los datos JSON en un array asociativo
        $nombre = $json['nombre'];
        $direccion = $json['direccion'];
        $telefono = $json['telefono'];
        $transaccion = $json['detalle']['id'];
        $total = $json['detalle']['purchase_units'][0]['amount']['value'];
        $fecha = date('Y-m-d');
        $pedido = $pedidos->savePedido($transaccion, $fecha, $nombre, $direccion, $telefono, $total); // Se guarda el pedido mediante el método savePedido() del modelo
        if ($pedido > 0) {
            foreach ($_SESSION['carrito']['productos'] as $id => $cantidad) {
                $producto = $pedidos->getProducto($id); // Se obtiene la información del producto mediante el método getProducto() del modelo, pasando el id del producto
                $stock = $producto['stock'] - $cantidad;
                $pedidos->actualizarStock($stock, $id); // Se actualiza el stock del producto mediante el método actualizarStock() del modelo
                $pedidos->registrarDetalle($pedido, $id, $producto['titulo'], $producto['precio_normal'], $cantidad); // Se registra el detalle del pedido mediante el método registrarDetalle() del modelo
            }
            unset($_SESSION['carrito']['productos']);
            $res = array('tipo' => 'success', 'mensaje' => 'PEDIDO REGISTRADO');
        } else {
            $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL REGISTRAR PEDIDO');
        }
        echo json_encode($res); // Se devuelve la respuesta codificada en formato JSON
        break;
    default:
        // Si no se proporciona una opción válida, no se ejecuta ninguna acción
        break;
}

