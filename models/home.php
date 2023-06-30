<?php
require_once 'config.php';
require_once 'conexion.php';
class HomeModel{
    private $pdo, $con;
    public function __construct() {
        $this->con = new Conexion(); // Se crea una instancia de la clase Conexion para establecer la conexión a la base de datos
        $this->pdo = $this->con->conectar(); // Se obtiene la conexión PDO
    }

    public function getproducts()
    {
        $consult = $this->pdo->prepare("SELECT * FROM productos WHERE estado = 1 ORDER BY id_producto DESC"); // Se prepara la consulta SQL para obtener todos los productos activos ordenados por ID de forma descendente
        $consult->execute(); // Se ejecuta la consulta
        return $consult->fetchAll(PDO::FETCH_ASSOC); // Se retorna el resultado de la consulta como un array asociativo
    }

    public function getproductsNuevos()
    {
        $consult = $this->pdo->prepare("SELECT * FROM productos WHERE estado = 1 ORDER BY id_producto DESC LIMIT 15"); // Se prepara la consulta SQL para obtener los 15 productos más recientes activos ordenados por ID de forma descendente
        $consult->execute(); // Se ejecuta la consulta
        return $consult->fetchAll(PDO::FETCH_ASSOC); // Se retorna el resultado de la consulta como un array asociativo
    }

    public function getproduct($id)
    {
        $consult = $this->pdo->prepare("SELECT * FROM productos WHERE id_producto = ?"); // Se prepara la consulta SQL para obtener un producto específico por su ID
        $consult->execute([$id]); // Se ejecuta la consulta pasando el ID del producto como parámetro
        return $consult->fetch(PDO::FETCH_ASSOC); // Se retorna el resultado de la consulta como un array asociativo
    }
}
?>
