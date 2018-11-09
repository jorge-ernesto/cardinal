<?php

require '../modelos/categoria.php';
require_once '../conexion/conexion.php'; // conexion.php no es una clase y no se puede instanciar

$idCategoria = isset($_POST['idCategoria']) ? clearString($_POST['idCategoria']) : ''; // Obtiene la variable desde categoria.js para poder mostrar, desactivar y activar
$id = isset($_POST['id']) ? clearString($_POST['id']) : ''; // Obtiene la variable desde el formulario para poder guardar
$nombre = isset($_POST['nombre']) ? clearString($_POST['nombre']) : '';
$descripcion = isset($_POST['descripcion']) ? clearString($_POST['descripcion']) : '';

$objDaoCat = new categoria();
$action = $_GET['action']; // String action = request.getParameter("action");

switch($action) {
    case 'listar';
        $respuesta = $objDaoCat->listar();

        $listJson = array(); // Declaramos un array
        while ($obj = $respuesta->fetch_object()) { // Recorremos todos los registros que obtenemos de la tabla categoria
            $listJson[] = array(
                '0' => '<a href="javascript:ver(' . $obj->id . ')">' . $obj->id . '</a>',
                '1' => $obj->nombre,
                '2' => $obj->descripcion,
                '3' => '<a class="btn btn-sm btn-primary" href="javascript:buscar(' . $obj->id . ')">editar</a>',
                '4' => ($obj->estado == 1) ?
                       '<a class="btn btn-sm btn-dark" href="javascript:desactivar(' . $obj->id . ')">desactivar</a>' :
                       '<a class="btn btn-sm btn-primary" href="javascript:activar(' . $obj->id . ')">activar</a>',
                '5' => ($obj->estado == 1) ?
                       '<h6><span class="badge badge-outline-primary">Activado</span></h6>' :
                       '<h6><span class="badge badge-outline-dark">Desactivado</span></h6>'
            );
        }

        $json = array( // Declaramos un array
            'sEcho' => 1,
            'iTotalRecords' => count($listJson),
            'iTotalDisplayRecords' => count($listJson),
            'aaData' => $listJson
        );
        echo json_encode($json);
    break;

    case 'buscar';
        $respuesta = $objDaoCat->buscar($idCategoria);
        echo json_encode($respuesta);
    break;

    case 'guardar':
        if (empty($id)) {
            $respuesta = $objDaoCat->guardar($nombre, $descripcion);
            echo $respuesta ? 'Categoría registrada' : 'Categoría no se pudo registrar';
        } else {
            $respuesta = $objDaoCat->editar($id, $nombre, $descripcion);
            echo $respuesta ? 'Categoría actualizada' : 'Categoría no se pudo actualizar';
        }
    break;

    case 'desactivar';
        $respuesta = $objDaoCat->desactivar($idCategoria);
        echo $respuesta ? 'Categoría desactivada' : 'Categoría no se puede desactivar';
    break;

    case 'activar';
        $respuesta = $objDaoCat->activar($idCategoria);
        echo $respuesta ? 'Categoría activada' : 'Categoria no se puede activar';
    break;
}

?>
