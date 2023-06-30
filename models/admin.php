<?php
require_once '../config.php'; // Se incluye el archivo de configuración
require_once 'conexion.php'; // Se incluye el archivo de conexión a la base de datos

class AdminModel{
    private $pdo, $con; // Se declaran las propiedades privadas $pdo y $con
    
    public function __construct() {
        $this->con = new Conexion(); // Se crea una instancia de la clase Conexion
        $this->pdo = $this->con->conectar(); // Se establece la conexión a la base de datos y se asigna a la propiedad $pdo
    }

    public function getDatos($table)
    {
        $consult = $this->pdo->prepare("SELECT COUNT(*) AS total FROM $table WHERE estado = ?"); // Se prepara la consulta SQL para obtener el número de registros de una tabla con un estado específico
        $consult->execute([1]); // Se ejecuta la consulta SQL con el estado = 1
        return $consult->fetch(PDO::FETCH_ASSOC); // Se retorna el resultado de la consulta como un array asociativo
    }

    public function getIngresos($fecha)
    {
        $consult = $this->pdo->prepare("SELECT SUM(total) AS total FROM pedidos WHERE fecha = ?"); // Se prepara la consulta SQL para obtener la suma de los totales de los pedidos de una fecha específica
        $consult->execute([$fecha]); // Se ejecuta la consulta SQL con la fecha proporcionada
        return $consult->fetch(PDO::FETCH_ASSOC); // Se retorna el resultado de la consulta como un array asociativo
    }

    public function getDato()
    {
        $consult = $this->pdo->prepare("SELECT * FROM configuracion"); // Se prepara la consulta SQL para obtener todos los datos de la tabla 'configuracion'
        $consult->execute(); // Se ejecuta la consulta SQL
        return $consult->fetch(PDO::FETCH_ASSOC); // Se retorna el resultado de la consulta como un array asociativo
    }

    public function saveDatos($nombre, $telefono, $correo, $direccion, $id)
    {
        $consult = $this->pdo->prepare("UPDATE configuracion SET nombre=?, telefono=?, correo=?, direccion=? WHERE id_config = ?"); // Se prepara la consulta SQL para actualizar los datos de la tabla 'configuracion'
        return $consult->execute([$nombre, $telefono, $correo, $direccion, $id]); // Se ejecuta la consulta SQL con los valores proporcionados y se retorna el resultado de la ejecución
    }
}
?>
