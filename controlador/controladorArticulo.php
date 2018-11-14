<?php

require '../modelos/articulo.php';
require_once '../conexion/conexion.php'; // conexion.php no es una clase y no se puede instanciar

$id = isset($_POST['id']) ? clearString($_POST['id']) : ''; // Obtiene la variable desde articulo.js para poder buscar, guardar, desactivar y activar
$idCategoria = isset($_POST['categoria']) ? clearString($_POST['categoria']) : '';
$codigo = isset($_POST['codigo']) ? clearString($_POST['codigo']) : '';
$nombre = isset($_POST['nombre']) ? clearString($_POST['nombre']) : '';
$stock = isset($_POST['stock']) ? clearString($_POST['stock']) : '';
$descripcion = isset($_POST['descripcion']) ? clearString($_POST['descripcion']) : '';
$imagen = isset($_POST['file']) ? clearString($_POST['file']) : '';

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
                '2' => $obj->categoria,
                '3' => $obj->codigo,
                '4' => $obj->stock,
                '5' => $obj->descripcion,
                '6' => '<img src="../files/articulos/' . $obj->imagen . '" width="50"></img>',
                '7' => '<a class="btn btn-sm btn-primary" href="javascript:buscar(' . $obj->id . ')">editar</a>',
                '8' => ($obj->estado == 1) ?
                       '<a class="btn btn-sm btn-dark" href="javascript:desactivar(' . $obj->id . ')">desactivar</a>' :
                       '<a class="btn btn-sm btn-primary" href="javascript:activar(' . $obj->id . ')">activar</a>',
                '9' => ($obj->estado == 1) ?
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
        $respuesta = $objDaoArt->buscar($id);
        echo json_encode($respuesta);
    break;

    case 'guardar':
        if (!file_exists($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['file']['tmp_name'])) {
            $imagen = '';
        } else {
            $ext = explode('.', $_FILES['file']['name']);
            if ($_FILES['file']['type'] == 'image/jpg' || $_FILES['file']['type'] == 'image/jpeg' || $_FILES['file']['type'] == 'image/png') {
                $imagen = round(microtime(true)) . '.' . end($ext);
                move_uploaded_file($_FILES['file']['tmp_name'], '../files/articulos/' . $imagen);
            }
        }

        if (empty($id)) {
            $respuesta = $objDaoArt->guardar($idCategoria, $codigo, $nombre, $stock, $descripcion, $imagen);
            echo $respuesta ? 'Artículo creado con éxito' : 'No se pudo crear artículo';
        } else {
            $respuesta = $objDaoArt->editar($id, $idCategoria, $codigo, $nombre, $stock, $descripcion, $imagen);
            echo $respuesta ? 'Artículo editado con éxito' : 'No se pudo editar artículo';
        }
    break;

    case 'desactivar';
        $respuesta = $objDaoArt->desactivar($id);
        echo $respuesta ? 'Artículo desactivado con éxito' : 'No se puede desactivar artículo';
    break;

    case 'activar';
        $respuesta = $objDaoArt->activar($id);
        echo $respuesta ? 'Artículo activado con éxito' : 'No se puede activar artículo';
    break;
}

?>
