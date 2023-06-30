<?php

// Este controlador productosController maneja las operaciones relacionadas con los productos, como listarlos, guardarlos, eliminarlos y editarlos. 
// Dependiendo del valor de la variable $_GET['option'], se realiza una operación específica.

require_once '../models/productos.php';
$option = (empty($_GET['option'])) ? '' : $_GET['option'];
$productos = new ProductosModel();
switch ($option) {
    case 'listar':
        $data = $productos->getProductos(); // Obtiene la lista de productos mediante el método getProductos() del modelo ProductosModel
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] = '<div class="d-flex">
                <a class="btn btn-danger btn-sm" onclick="eliminar(' . $data[$i]['id_producto'] . ')"><i class="fas fa-eraser"></i></a>
                <a class="btn btn-primary btn-sm" onclick="edit(' . $data[$i]['id_producto'] . ')"><i class="fas fa-edit"></i></a>
            </div>'; // Agrega acciones de eliminar y editar para cada producto en la lista
        }
        echo json_encode($data); // Devuelve la lista de productos en formato JSON
        break;
    case 'save':
        // Obtiene los datos del producto a guardar mediante el método POST
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];
        $id_producto = $_POST['id_producto'];
        $img = $_FILES['imagen'];
        $fecha = date('YmdHis');
        
        // Verifica la imagen del producto y establece el nombre y la ruta de destino
        if (!empty($img['name'])) {
            $imgname = $fecha . '.jpg';
            $destino = '../assets/images/productos/' . $imgname;
        } else if (empty($img['name']) && !empty($_POST['imagen_actual'])) {
            $imgname = $_POST['imagen_actual'];
        } else {
            $imgname = 'default.png';
        }
        
        // Guarda o actualiza el producto según su ID
        if ($id_producto == '') {
            $consult = $productos->comprobarNombre($nombre, 0); // Verifica si ya existe un producto con el mismo nombre
            if (empty($consult)) {
                $result = $productos->save($nombre, $descripcion, $precio, $stock, $imgname); // Guarda el nuevo producto mediante el método save() del modelo ProductosModel
                if ($result) {
                    if (!empty($img['name'])) {
                        move_uploaded_file($img['tmp_name'], $destino); // Mueve la imagen del producto a la ruta de destino
                    }
                    $res = array('tipo' => 'success', 'mensaje' => 'PRODUCTO REGISTRADO');
                } else {
                    $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL AGREGAR');
                }
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'EL PRODUCTO YA EXISTE');
            }
        } else {
            $consult = $productos->comprobarNombre($nombre, $id_producto); // Verifica si ya existe otro producto con el mismo nombre (excepto el producto actual)
            if (empty($consult)) {
                $result = $productos->update($nombre, $descripcion, $precio, $stock, $imgname, $id_producto); // Actualiza el producto mediante el método update() del modelo ProductosModel
                if ($result) {
                    if (!empty($img['name'])) {
                        $data = $productos->getProducto($id_producto);
                        if (file_exists('../assets/images/productos/' . $data['foto_destacada'])) {
                            if ($data['foto_destacada'] != 'default.png') {
                                unlink('../assets/images/productos/' . $data['foto_destacada']); // Elimina la imagen anterior del producto
                            }
                        }
                        move_uploaded_file($img['tmp_name'], $destino); // Mueve la nueva imagen del producto a la ruta de destino
                    }
                    $res = array('tipo' => 'success', 'mensaje' => 'PRODUCTO MODIFICADO');
                } else {
                    $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL MODIFICAR');
                }
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'EL PRODUCTO YA EXISTE');
            }
        }
        echo json_encode($res); // Devuelve una respuesta JSON indicando el resultado de la operación
        break;
    case 'delete':
        $id_producto = $_GET['id'];
        $data = $productos->delete($id_producto); // Elimina el producto mediante el método delete() del modelo ProductosModel
        if ($data) {
            $temp = $productos->getProducto($id_producto);
            if (file_exists('../assets/images/productos/' . $temp['foto_destacada'])) {
                if ($temp['foto_destacada'] != 'default.png') {
                    unlink('../assets/images/productos/' . $temp['foto_destacada']); // Elimina la imagen del producto
                }
            }
            $res = array('tipo' => 'success', 'mensaje' => 'PRODUCTO ELIMINADO');
        } else {
            $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL ELIMINAR');
        }
        echo json_encode($res); // Devuelve una respuesta JSON indicando el resultado de la operación
        break;
    case 'edit':
        $id_producto = $_GET['id'];
        $data = $productos->getProducto($id_producto); // Obtiene los datos del producto mediante el método getProducto() del modelo ProductosModel
        echo json_encode($data); // Devuelve los datos del producto en formato JSON
        break;
    default:
        // code...
        break;
}

