<?php

session_start();

include_once '../modelos/Usuario.php';
include_once '../conexion/conexion.php';

$id = isset($_POST['id']) ? clearString($_POST['id']) : '';
$nombre = isset($_POST['nombre']) ? clearString($_POST['nombre']) : '';
$tipoDocumento = isset($_POST['tipoDocumento']) ? clearString($_POST['tipoDocumento']) : '';
$numDocumento = isset($_POST['numDocumento']) ? clearString($_POST['numDocumento']) : '';
$direccion = isset($_POST['direccion']) ? clearString($_POST['direccion']) : '';
$telefono = isset($_POST['telefono']) ? clearString($_POST['telefono']) : '';
$email = isset($_POST['email']) ? clearString($_POST['email']) : '';
$cargo = isset($_POST['cargo']) ? clearString($_POST['cargo']) : '';
$username = isset($_POST['username']) ? clearString($_POST['username']) : '';
// $password = isset($_POST['password']) ? clearString($_POST['password']) : '';
$imagen = isset($_POST['file']) ? clearString($_POST['file']) : '';

$objDaoUsu = new Usuario();
$action = $_GET['action'];

switch($action) {
    case 'listar';
        $respuesta = $objDaoUsu->listar();

        $listJson = array();
        while ($obj = $respuesta->fetch_object()) {
            $listJson[] = array(
                '0' => '<a href="javascript:ver(' . $obj->id . ')">' . $obj->id . '</a>',
                '1' => $obj->nombre,
                '2' => $obj->tipo_documento,
                '3' => $obj->num_documento,
                '4' => $obj->direccion,
                '5' => $obj->telefono,
                '6' => $obj->email,
                '7' => $obj->cargo,
                '8' => $obj->username,
                '9' => $obj->password,
                '10' => '<img src="../files/usuarios/' . $obj->imagen . '" width="50"></img>',
                '11' => '<a class="btn btn-sm btn-primary" href="javascript:buscar(' . $obj->id . ')">editar</a>',
                '12' => ($obj->estado == 1) ?
                       '<a class="btn btn-sm btn-dark" href="javascript:desactivar(' . $obj->id . ')">desactivar</a>' :
                       '<a class="btn btn-sm btn-primary" href="javascript:activar(' . $obj->id . ')">activar</a>',
                '13' => ($obj->estado == 1) ?
                       '<h6><span class="badge badge-outline-primary">Activado</span></h6>' :
                       '<h6><span class="badge badge-outline-dark">Desactivado</span></h6>'
            );
        }

        $json = array(
            'draw' => 1,
            'recordsTotal' => count($listJson),
            'recordsFiltered' => count($listJson),
            'data' => $listJson
        );
        echo json_encode($json);
    break;

    case 'buscar';
        $respuesta = $objDaoUsu->buscar($id);
        echo json_encode($respuesta);
    break;

    case 'guardar':
        if (!file_exists($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['file']['tmp_name'])) {
            $imagen = $_POST['fileCurrent']; // $imagen = '';
        } else {
            $ext = explode('.', $_FILES['file']['name']);
            if ($_FILES['file']['type'] == 'image/jpg' || $_FILES['file']['type'] == 'image/jpeg' || $_FILES['file']['type'] == 'image/png') {
                $imagen = round(microtime(true)) . '.' . end($ext);
                move_uploaded_file($_FILES['file']['tmp_name'], '../files/usuarios/' . $imagen);
            }
        }

        $password = $_POST['password'];
        $cipher = hash("MD5", $password);

        if (empty($id)) {
            $respuesta = $objDaoUsu->guardar($nombre, $tipoDocumento, $numDocumento, $direccion, $telefono, $email, $cargo, $username, $cipher, $imagen);
            echo $respuesta ? 'Usuario creado con éxito' : 'No se pudo crear usuario';
        } else {
             $respuesta = $objDaoUsu->editar($id, $nombre, $tipoDocumento, $numDocumento, $direccion, $telefono, $email, $cargo, $username, $cipher, $imagen);
            echo $respuesta ? 'Usuario editado con éxito' : 'No se pudo editar usuario';
        }
    break;

    case 'desactivar';
        $respuesta = $objDaoUsu->desactivar($id);
        echo $respuesta ? 'Usuario desactivado con éxito' : 'No se puede desactivar usuario';
    break;

    case 'activar';
        $respuesta = $objDaoUsu->activar($id);
        echo $respuesta ? 'Usuario activado con éxito' : 'No se puede activar usuario';
    break;

    case 'select';
        include_once '../modelos/Cargo.php';
        $cargo = new Cargo();

        $respuesta = $cargo->select();
        while ($obj = $respuesta->fetch_object()) {
            echo '<option value="'. $obj->id .'" id="'. $obj->id .'">'. $obj->nombre .'</option>';
        }
    break;

    case 'login';
        include_once '../modelos/Permiso.php';
        $objDaoPer = new Permiso();

        /*****/

        $username = $_POST['username'];
        $password = $_POST['password'];
        $cipher = hash("MD5", $password);

        /*****/

        $respuesta = $objDaoPer->login($username, $cipher);
        $obj = $respuesta->fetch_object();
        if (isset($obj)) { // Determina si una variable está definida y no es null
            $_SESSION['id'] = $obj->id; // Declaramos variables de sesión
            $_SESSION['nombre'] = $obj->nombre;
            $_SESSION['username'] = $obj->username;
            $_SESSION['imagen'] = $obj->imagen;

            /****/

            $listPermisosMarcados = array();

            $respuestaPermisos = $objDaoPer->permisosMarcados($obj->id_cargo);
            while ($objPermisos = $respuestaPermisos->fetch_object()) {
                array_push($listPermisosMarcados, $objPermisos->id_permiso);
            }

            $_SESSION['escritorio'] = in_array(1, $listPermisosMarcados) ? 1 : 0 ; // Método para determinar si 1 esta dentro de $listPermisosMarcados
            $_SESSION['almacen'] = in_array(2, $listPermisosMarcados) ? 1 : 0 ;
            $_SESSION['compras'] = in_array(3, $listPermisosMarcados) ? 1 : 0 ;
            $_SESSION['ventas'] = in_array(4, $listPermisosMarcados) ? 1 : 0 ;
            $_SESSION['acceso'] = in_array(5, $listPermisosMarcados) ? 1 : 0 ;
            $_SESSION['consultas'] = in_array(6, $listPermisosMarcados) ? 1 : 0 ;

            /****/
        }
        echo json_encode($obj);
    break;

    case 'signOut':
        session_unset(); // Limpiamos las variables de sesión
        session_destroy(); // Destruimos las variables de sesión
        header('Location: ../vistas/login.php');
    break;
}

?>
