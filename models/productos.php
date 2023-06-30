<?php
require_once '../config.php';
require_once 'conexion.php';
class ProductosModel{
    private $pdo, $con;
    public function __construct() {
        $this->con = new Conexion(); // Se crea una instancia de la clase Conexion para establecer la conexión a la base de datos
        $this->pdo = $this->con->conectar(); // Se obtiene la conexión PDO
    }

    public function getProductos()
    {
        $consult = $this->pdo->prepare("SELECT * FROM productos WHERE estado = 1"); // Se prepara la consulta SQL para obtener todos los productos activos
        $consult->execute(); // Se ejecuta la consulta
        return $consult->fetchAll(PDO::FETCH_ASSOC); // Se retorna el resultado de la consulta como un array asociativo
    }

    public function getProducto($id_producto)
    {
        $consult = $this->pdo->prepare("SELECT * FROM productos WHERE id_producto = ?"); // Se prepara la consulta SQL para obtener un producto específico por su ID
        $consult->execute([$id_producto]); // Se ejecuta la consulta pasando el ID del producto como parámetro
        return $consult->fetch(PDO::FETCH_ASSOC); // Se retorna el resultado de la consulta como un array asociativo
    }

    public function comprobarNombre($nombre, $accion)
    {
        if ($accion == 0) {
            $consult = $this->pdo->prepare("SELECT * FROM productos WHERE titulo = ?"); // Se prepara la consulta SQL para comprobar si existe un producto con el mismo nombre
            $consult->execute([$nombre]); // Se ejecuta la consulta pasando el nombre del producto como parámetro
        } else {
            $consult = $this->pdo->prepare("SELECT * FROM productos WHERE titulo = ? AND id_producto != ?"); // Se prepara la consulta SQL para comprobar si existe otro producto con el mismo nombre pero con un ID diferente
            $consult->execute([$nombre, $accion]); // Se ejecuta la consulta pasando el nombre del producto y el ID del producto actual como parámetros
        }
        return $consult->fetch(PDO::FETCH_ASSOC); // Se retorna el resultado de la consulta como un array asociativo
    }

    public function save($nombre, $descripcion, $precio, $stock, $imgname)
    {
        $consult = $this->pdo->prepare("INSERT INTO productos (titulo, descripcion_corta, precio_normal, stock, foto_destacada) VALUES (?,?,?,?,?)"); // Se prepara la consulta SQL para guardar un nuevo producto en la base de datos
        return $consult->execute([$nombre, $descripcion, $precio, $stock, $imgname]); // Se ejecuta la consulta pasando los datos del producto como parámetros
    }

    public function delete($id_producto)
    {
        $consult = $this->pdo->prepare("UPDATE productos SET estado = ? WHERE id_producto = ?"); // Se prepara la consulta SQL para eliminar un producto por su ID (cambiando el estado a 0)
        return $consult->execute([0, $id_producto]); // Se ejecuta la consulta pasando el nuevo estado y el ID del producto como parámetros
    }

    public function update($nombre, $descripcion, $precio, $stock, $imgname, $id_producto)
    {
        $consult = $this->pdo->prepare("UPDATE productos SET titulo=?, descripcion_corta=?, precio_normal=?, stock=?, foto_destacada=? WHERE id_producto=?"); // Se prepara la consulta SQL para actualizar los datos de un producto por su ID
        return $consult->execute([$nombre, $descripcion, $precio, $stock, $imgname, $id_producto]); // Se ejecuta la consulta pasando los nuevos datos del producto y el ID del producto como parámetros
    }
}
?>