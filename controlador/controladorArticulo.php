<?php

require '../modelos/articulo.php';
require_once '../conexion/conexion.php'; // conexion.php no es una clase y no se puede instanciar

$idArticulo = isset($_POST['idArticulo']) ? clearString($_POST['idArticulo']) : ''; // Obtiene la variable desde categoria.js para poder buscar, desactivar y activar

$id = isset($_POST['id']) ? clearString($_POST['id']) : ''; // Obtiene la variable desde el formulario para poder guardar
$idCategoria = isset($_POST['idCategoria']) ? clearString($_POST['idCategoria']) : '';
$codigo = isset($_POST['codigo']) ? clearString($_POST['codigo']) : '';
$nombre = isset($_POST['nombre']) ? clearString($_POST['nombre']) : '';
$stock = isset($_POST['stock']) ? clearString($_POST['stock']) : '';
$descripcion = isset($_POST['descripcion']) ? clearString($_POST['descripcion']) : '';
$imagen = isset($_POST['imagen']) ? clearString($_POST['imagen']) : '';

$objDaoArt = new articulo();
$action = $_GET['action']; // String action = request.getParameter("action");

switch($action) {
    case 'listar';
        $respuesta = $objDaoArt->listar();

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
        $respuesta = $objDaoArt->buscar($idArticulo);
        echo json_encode($respuesta);
    break;

    case 'guardar':
        if (empty($id)) {
            $respuesta = $objDaoArt->guardar($idCategoria, $codigo, $nombre, $stock, $descripcion, $imagen);
            echo $respuesta ? 'Artículo creado con éxito' : 'No se pudo crear artículo';
        } else {
            $respuesta = $objDaoArt->editar($id, $idCategoria, $codigo, $nombre, $stock, $descripcion, $imagen);
            echo $respuesta ? 'Artículo editado con éxito' : 'No se pudo editar artículo';
        }
    break;

    case 'desactivar';
        $respuesta = $objDaoArt->desactivar($idArticulo);
        echo $respuesta ? 'Artículo desactivado con éxito' : 'No se puede desactivar artículo';
    break;

    case 'activar';
        $respuesta = $objDaoArt->activar($idArticulo);
        echo $respuesta ? 'Artículo activado con éxito' : 'No se puede activar artículo';
    break;
}

?>
