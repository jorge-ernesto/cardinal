<?php

include_once '../modelos/Permiso.php';
include_once '../conexion/conexion.php';

$objDaoPer = new Permiso();
$action = $_GET['action'];

switch($action) {
    case 'listar';
        $respuesta = $objDaoPer->listar();

        $listJson = array();
        while ($obj = $respuesta->fetch_object()) {
            $listJson[] = array(
                '0' => '<a href="javascript:ver(' . $obj->id . ')">' . $obj->id . '</a>',
                '1' => $obj->nombre
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
}

?>
