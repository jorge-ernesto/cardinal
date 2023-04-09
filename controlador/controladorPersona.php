<?php

include_once '../modelos/Persona.php';
include_once '../conexion/conexion.php';

$id = isset($_POST['id']) ? clearString($_POST['id']) : '';
$tipoPersona = isset($_POST['tipoPersona']) ? clearString($_POST['tipoPersona']) : '';
$nombre = isset($_POST['nombre']) ? clearString($_POST['nombre']) : '';
$tipoDocumento = isset($_POST['tipoDocumento']) ? clearString($_POST['tipoDocumento']) : '';
$numDocumento = isset($_POST['numDocumento']) ? clearString($_POST['numDocumento']) : '';
$direccion = isset($_POST['direccion']) ? clearString($_POST['direccion']) : '';
$telefono = isset($_POST['telefono']) ? clearString($_POST['telefono']) : '';
$email = isset($_POST['email']) ? clearString($_POST['email']) : '';

$objDaoPer = new Persona();
$action = $_GET['action'];

switch($action) {
    case 'listarProveedor';
        $respuesta = $objDaoPer->listarProveedor();

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
                '7' => '<a class="btn btn-sm btn-primary" href="javascript:buscar(' . $obj->id . ')">editar</a>',
                '8' => '<a class="btn btn-sm btn-dark" href="javascript:eliminar(' . $obj->id . ')">eliminar</a>',
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

    case 'listarCliente';
        $respuesta = $objDaoPer->listarCliente();

        $listJson = array();
        while ($obj = $respuesta->fetch_object()) {
            $listJson[] = array(
                '0' => '<a href="javascript:ver(' . $obj->id . ')">' . $obj->id . '</a>',
                '1' => $obj->tipo_persona,
                '2' => $obj->nombre,
                '3' => $obj->tipo_documento,
                '4' => $obj->num_documento,
                '5' => $obj->direccion,
                '6' => $obj->telefono,
                '7' => $obj->email,
                '8' => '<a class="btn btn-sm btn-primary" href="javascript:buscar(' . $obj->id . ')">editar</a>',
                '9' => '<a class="btn btn-sm btn-dark" href="javascript:eliminar(' . $obj->id . ')">eliminar</a>',
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
        $respuesta = $objDaoPer->buscar($id);
        echo json_encode($respuesta);
    break;

    case 'guardar':
        if (empty($id)) {
            $respuesta = $objDaoPer->guardar($tipoPersona, $nombre, $tipoDocumento, $numDocumento, $direccion, $telefono, $email);
            echo $respuesta ? 'Persona creada con éxito' : 'No se pudo crear persona';
        } else {
            $respuesta = $objDaoPer->editar($id, $tipoPersona, $nombre, $tipoDocumento, $numDocumento, $direccion, $telefono, $email);
            echo $respuesta ? 'Persona editada con éxito' : 'No se pudo editar persona';
        }
    break;

    case 'eliminar';
        $respuesta = $objDaoPer->eliminar($id);
        echo $respuesta ? 'Persona eliminada con éxito' : 'No se puede eliminar persona';
    break;
}

?>
