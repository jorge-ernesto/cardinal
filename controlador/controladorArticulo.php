<?php

include_once '../modelos/Articulo.php';
include_once '../conexion/conexion.php';

$id = isset($_POST['id']) ? clearString($_POST['id']) : '';
$idCategoria = isset($_POST['categoria']) ? clearString($_POST['categoria']) : '';
$codigo = isset($_POST['codigo']) ? clearString($_POST['codigo']) : '';
$nombre = isset($_POST['nombre']) ? clearString($_POST['nombre']) : '';
$stock = isset($_POST['stock']) ? clearString($_POST['stock']) : '';
$descripcion = isset($_POST['descripcion']) ? clearString($_POST['descripcion']) : '';
$imagen = isset($_POST['file']) ? clearString($_POST['file']) : '';

$objDaoArt = new Articulo();
$action = $_GET['action'];

switch($action) {
    case 'listar';
        $respuesta = $objDaoArt->listar();

        $listJson = array();
        while ($obj = $respuesta->fetch_object()) {
            $listJson[] = array(
                '0' => '<a href="javascript:ver(' . $obj->id . ')">' . $obj->id . '</a>',
                '1' => $obj->nombre,
                '2' => $obj->descripcion,
                '3' => $obj->categoria,
                '4' => $obj->codigo,
                '5' => $obj->stock,
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

        $json = array(
            'draw' => 1,
            'recordsTotal' => count($listJson),
            'recordsFiltered' => count($listJson),
            'data' => $listJson
        );
        echo json_encode($json);
    break;

    case 'buscar';
        $respuesta = $objDaoArt->buscar($id);
        echo json_encode($respuesta);
    break;

    case 'guardar':
        if (!file_exists($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['file']['tmp_name'])) {
            $imagen = $_POST['fileCurrent']; // $imagen = '';
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

    case 'select';
        include_once '../modelos/Categoria.php';
        $objDaoCat = new Categoria();

        $respuesta = $objDaoCat->select();
        while ($obj = $respuesta->fetch_object()) {
            echo '<option value="'. $obj->id .'" id="'. $obj->id .'" data-subtext="'. $obj->descripcion .'">'. $obj->nombre .'</option>';
        }
    break;
}

?>
