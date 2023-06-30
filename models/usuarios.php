<?php
require_once '../config.php';
require_once 'conexion.php';
class UsuariosModel{
    private $pdo, $con;
    public function __construct() {
        $this->con = new Conexion(); // Se crea una instancia de la clase Conexion para establecer la conexión a la base de datos
        $this->pdo = $this->con->conectar(); // Se obtiene la conexión PDO
    }

    public function getUsers()
    {
        $consult = $this->pdo->prepare("SELECT * FROM usuarios WHERE estado = 1"); // Se prepara la consulta SQL para obtener todos los usuarios activos
        $consult->execute(); // Se ejecuta la consulta
        return $consult->fetchAll(PDO::FETCH_ASSOC); // Se retorna el resultado de la consulta como un array asociativo
    }

    public function getUser($id)
    {
        $consult = $this->pdo->prepare("SELECT * FROM usuarios WHERE id_usuario = ?"); // Se prepara la consulta SQL para obtener un usuario específico por su ID
        $consult->execute([$id]); // Se ejecuta la consulta pasando el ID del usuario como parámetro
        return $consult->fetch(PDO::FETCH_ASSOC); // Se retorna el resultado de la consulta como un array asociativo
    }

    public function comprobarCorreo($correo)
    {
        $consult = $this->pdo->prepare("SELECT * FROM usuarios WHERE correo = ? AND estado = 1"); // Se prepara la consulta SQL para comprobar si existe un usuario con el mismo correo y está activo
        $consult->execute([$correo]); // Se ejecuta la consulta pasando el correo del usuario como parámetro
        return $consult->fetch(PDO::FETCH_ASSOC); // Se retorna el resultado de la consulta como un array asociativo
    }

    public function saveUser($nombre, $correo, $clave, $telefono)
    {
        $consult = $this->pdo->prepare("INSERT INTO usuarios (nombre, correo, clave, telefono) VALUES (?,?,?,?)"); // Se prepara la consulta SQL para guardar un nuevo usuario en la base de datos
        return $consult->execute([$nombre, $correo, $clave, $telefono]); // Se ejecuta la consulta pasando los datos del usuario como parámetros
    }

    public function deleteUser($id)
    {
        $consult = $this->pdo->prepare("UPDATE usuarios SET estado = ? WHERE id_usuario = ?"); // Se prepara la consulta SQL para eliminar un usuario por su ID (cambiando el estado a 0)
        return $consult->execute([0, $id]); // Se ejecuta la consulta pasando el nuevo estado y el ID del usuario como parámetros
    }

    public function updateUser($nombre, $correo, $telefono, $id)
    {
        $consult = $this->pdo->prepare("UPDATE usuarios SET nombre=?, correo=?, telefono=? WHERE id_usuario=?"); // Se prepara la consulta SQL para actualizar los datos de un usuario por su ID
        return $consult->execute([$nombre, $correo, $telefono, $id]); // Se ejecuta la consulta pasando los nuevos datos del usuario y el ID del usuario como parámetros
    }
}

?>