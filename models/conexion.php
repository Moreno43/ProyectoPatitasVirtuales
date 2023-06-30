<?php
class Conexion{
    public function conectar()
    {
        $pdo = null; // Se declara una variable $pdo y se inicializa como null
        
        try {
            $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.'', DB_USER, DB_PASS); // Se crea una instancia de la clase PDO para establecer la conexión a la base de datos utilizando las constantes definidas en el archivo de configuración
            return $pdo; // Se retorna la instancia de la conexión PDO
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>"; // Si ocurre un error durante la conexión, se muestra un mensaje de error
            die(); // Se detiene la ejecución del script
        }
    }
}
?>
