<?php

require_once '../modelos/usuario.php';
require_once '../conexion/conexion.php';

$id = isset($_POST['id']) ? clearString($_POST['id']) : '';
$nombre = isset($_POST['nombre']) ? clearString($_POST['nombre']) : '';
$tipoDocumento = isset($_POST['tipoDocumento']) ? clearString($_POST['tipoDocumento']) : '';
$numDocumento = isset($_POST['numDocumento']) ? clearString($_POST['numDocumento']) : '';
$direccion = isset($_POST['direccion']) ? clearString($_POST['direccion']) : '';
$telefono = isset($_POST['telefono']) ? clearString($_POST['telefono']) : '';
$email = isset($_POST['email']) ? clearString($_POST['email']) : '';
$cargo = isset($_POST['cargo']) ? clearString($_POST['cargo']) : '';
$username = isset($_POST['username']) ? clearString($_POST['username']) : '';
$password = isset($_POST['password']) ? clearString($_POST['password']) : '';
$imagen = isset($_POST['file']) ? clearString($_POST['file']) : '';

$objDaoUsu = new usuario();
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
            'sEcho' => 1,
            'iTotalRecords' => count($listJson),
            'iTotalDisplayRecords' => count($listJson),
            'aaData' => $listJson
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

        $cipher = hash("SHA512", $password); // Hash SHA512

        if (empty($id)) {
            $respuesta = $objDaoUsu->guardar($nombre, $tipoDocumento, $numDocumento, $direccion, $telefono, $email, $cargo, $username, $cipher, $imagen, $_POST['permisos']);
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

    case 'checkboxes';
        require_once '../modelos/permiso.php';
        $objDaoPer = new permiso();

        $respuesta = $objDaoPer->listar();
        while ($obj = $respuesta->fetch_object()) {
            echo '<div class="custom-control custom-checkbox">
                      <input type="checkbox" name="permisos[]" value="'. $obj->id .'" id="customCheck_'.$obj->id.'" class="custom-control-input">
                      <label class="custom-control-label" for="customCheck_'.$obj->id.'">'. $obj->nombre .'</label>
                  </div>';
        }
    break;
}

?>
