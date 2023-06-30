<?php
require_once '../config.php';
require_once 'conexion.php';
class PedidosModel{
    private $pdo, $con;
    public function __construct() {
        $this->con = new Conexion(); // Se crea una instancia de la clase Conexion para establecer la conexión a la base de datos
        $this->pdo = $this->con->conectar(); // Se obtiene la conexión PDO
    }

    public function getPedidos()
    {
        $consult = $this->pdo->prepare("SELECT * FROM pedidos"); // Se prepara la consulta SQL para obtener todos los pedidos
        $consult->execute(); // Se ejecuta la consulta
        return $consult->fetchAll(PDO::FETCH_ASSOC); // Se retorna el resultado de la consulta como un array asociativo
    }

    public function getProducto($id)
    {
        $consult = $this->pdo->prepare("SELECT * FROM productos WHERE id_producto = $id"); // Se prepara la consulta SQL para obtener un producto específico por su ID
        $consult->execute(); // Se ejecuta la consulta
        return $consult->fetch(PDO::FETCH_ASSOC); // Se retorna el resultado de la consulta como un array asociativo
    }

    public function getProductos($id_pedido)
    {
        $consult = $this->pdo->prepare("SELECT * FROM detalle_compra WHERE id_pedido = $id_pedido"); // Se prepara la consulta SQL para obtener los productos de un pedido específico por su ID
        $consult->execute(); // Se ejecuta la consulta
        return $consult->fetchAll(PDO::FETCH_ASSOC); // Se retorna el resultado de la consulta como un array asociativo
    }

    public function savePedido($transaccion, $fecha, $nombre, $direccion, $telefono, $total)
    {
        $consult = $this->pdo->prepare("INSERT INTO pedidos (transaccion, fecha, nombre, direccion, telefono, total) VALUES (?,?,?,?,?,?)"); // Se prepara la consulta SQL para guardar un nuevo pedido en la base de datos
        $consult->execute([$transaccion, $fecha, $nombre, $direccion, $telefono, $total]); // Se ejecuta la consulta pasando los datos del pedido como parámetros
        return $this->pdo->lastInsertId(); // Se retorna el ID del último pedido insertado en la base de datos
    }

    public function registrarDetalle($id_pedido, $id, $nombre, $precio, $cantidad)
    {
        $consult = $this->pdo->prepare("INSERT INTO detalle_compra (id_pedido, id_producto, nombre, precio, cantidad) VALUES (?,?,?,?,?)"); // Se prepara la consulta SQL para registrar el detalle de un pedido en la base de datos
        return $consult->execute([$id_pedido, $id, $nombre, $precio, $cantidad]); // Se ejecuta la consulta pasando los datos del detalle del pedido como parámetros
    }

    public function cambiar($id_pedido)
    {
        $consult = $this->pdo->prepare("UPDATE pedidos SET estado = ? WHERE id = ?"); // Se prepara la consulta SQL para cambiar el estado de un pedido por su ID
        return $consult->execute([0, $id_pedido]); // Se ejecuta la consulta pasando el nuevo estado y el ID del pedido como parámetros
    }

    public function actualizarStock($stock, $id)
    {
        $consult = $this->pdo->prepare("UPDATE productos SET stock = ? WHERE id_producto = ?"); // Se prepara la consulta SQL para actualizar el stock de un producto por su ID
        return $consult->execute([$stock, $id]); // Se ejecuta la consulta pasando el nuevo stock y el ID del producto como parámetros
    }
}
?>
