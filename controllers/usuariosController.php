<?php
require_once '../models/usuarios.php';

// Obtener la opción del parámetro GET
$option = (empty($_GET['option'])) ? '' : $_GET['option'];
$usuarios = new UsuariosModel();

// Realizar diferentes acciones según la opción seleccionada
switch ($option) {
    case 'acceso':
        // Acción: Verificar acceso de usuario
        $accion = file_get_contents('php://input');
        $array = json_decode($accion, true);
        $email = $array['email'];
        $password = $array['password'];
        $result = $usuarios->comprobarCorreo($email);
        if (empty($result)) {
            $res = array('tipo' => 'error', 'mensaje' => 'EMAIL NO EXISTE');
        } else {
            if (password_verify($password, $result['clave'])) {
                $_SESSION['nombre'] = $result['nombre'];
                $_SESSION['correo'] = $result['correo'];
                $_SESSION['id_usuario'] = $result['id_usuario'];
                $perfil = (empty($result['perfil'])) ? 'assets/img/avatar.png' : $result['perfil'];
                $_SESSION['perfil'] = $perfil;
                $res = array('tipo' => 'success', 'mensaje' => 'ok');
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'CONTRASEÑA INCORRECTA');
            }
        }
        echo json_encode($res);
        break;
    case 'listar':
        // Acción: Obtener lista de usuarios
        $data = $usuarios->getUsers();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] = '<div class="d-flex">
                <a class="btn btn-danger btn-sm" onclick="deleteUser(' . $data[$i]['id_usuario'] . ')"><i class="fas fa-eraser"></i></a>
                <a class="btn btn-primary btn-sm" onclick="editUser(' . $data[$i]['id_usuario'] . ')"><i class="fas fa-edit"></i></a>
                </div>';            
        }
        echo json_encode($data);
        break;
    case 'save':
        // Acción: Guardar o actualizar un usuario
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $clave = $_POST['clave'];
        $id_user = $_POST['id_user'];
        if ($id_user == '') {
            $consult = $usuarios->comprobarCorreo($correo);
            if (empty($consult)) {
                $hash = password_hash($clave, PASSWORD_DEFAULT);
                $result = $usuarios->saveUser($nombre, $correo, $hash, $telefono);
                if ($result) {
                    $res = array('tipo' => 'success', 'mensaje' => 'USUARIO REGISTRADO');
                } else {
                    $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL AGREGAR');
                }
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'EL CORREO YA EXISTE');
            }
        } else {
            $result = $usuarios->updateUser($nombre, $correo, $telefono, $id_user);
            if ($result) {
                $res = array('tipo' => 'success', 'mensaje' => 'USUARIO MODIFICADO');
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL MODIFICAR');
            }
        }
        echo json_encode($res);
        break;
    case 'delete':
        // Acción: Eliminar un usuario
        $id = $_GET['id'];
        $data = $usuarios->deleteUser($id);
        if ($data) {
            $res = array('tipo' => 'success', 'mensaje' => 'USUARIO ELIMINADO');
        } else {
            $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL ELIMINAR');
        }
        echo json_encode($res);
        break;
    case 'edit':
        // Acción: Obtener información de un usuario para editar
        $id = $_GET['id'];
        $data = $usuarios->getUser($id);
        echo json_encode($data);
        break;
    case 'logout':
        // Acción: Cerrar sesión
        session_destroy();
        if (empty($_SESSION)) {
            $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL SALIR');
        } else {
            $res = array('tipo' => 'success', 'mensaje' => 'OK');
        }
        echo json_encode($res);        
        break;
    default:
        // Acción por defecto o ninguna opción válida
        // code...
        break;
}

