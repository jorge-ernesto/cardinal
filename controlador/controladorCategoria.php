<?php

include_once "../modelos/Categoria.php";

$id          = isset($_POST['id']) ? clearString($_POST['id']) : '';                   
$nombre      = isset($_POST['nombre']) ? clearString($_POST['nombre']) : '';
$descripcion = isset($_POST['descripcion']) ? clearString($_POST['descripcion']) : '';

$categoria = new Categoria();
$action    = $_GET['action'];

switch($action) {
    case "listar";
        $dataCategoria = $categoria->listar();
       
        while ($fila = $dataCategoria->fetch_assoc()) {
            $listJson[] = array(
                "0" => $fila['id'],
                "1" => $fila['nombre'],
                "2" => $fila['descripcion'],
                "3" => '<a class="btn btn-sm btn-primary" href="javascript:buscar(' . $fila['id'] . ')">editar</a>',
                "4" => ($fila['estado'] == 1) ?
                       '<a class="btn btn-sm btn-dark" href="javascript:desactivar(' . $fila['id'] . ')">desactivar</a>' :
                       '<a class="btn btn-sm btn-primary" href="javascript:activar(' . $fila['id'] . ')">activar</a>',
                "5" => ($fila['estado'] == 1) ?
                       '<h6><span class="badge badge-outline-primary">Activado</span></h6>' :
                       '<h6><span class="badge badge-outline-dark">Desactivado</span></h6>'
            );
        }
        //print_r($listJson);

        $json = array(
            "draw"            => 1,
            "recordsTotal"    => count($listJson),
            "recordsFiltered" => count($listJson),
            "data"            => $listJson
        );
        //print_r($json);        
        
        echo json_encode($json);
    break;

    case "buscar";
        $dataCategoria = $categoria->buscar($id);        
        //print_r($dataCategoria);        
        echo json_encode($dataCategoria);
    break;

    case "guardar":
        if (empty($id)) {
            $es_correcto = $categoria->guardar($nombre, $descripcion);            
            echo $es_correcto ? 'Categor??a creada con ??xito' : 'No se pudo crear categor??a'; //$es_correcto es true o false
        } else {
            $es_correcto = $categoria->editar($id, $nombre, $descripcion);
            echo $es_correcto ? 'Categor??a editada con ??xito' : 'No se pudo editar categor??a';
        }
    break;

    case "desactivar";
        $es_correcto = $categoria->desactivar($id);
        echo $es_correcto ? 'Categor??a desactivada con ??xito' : 'No se puede desactivar categor??a';
    break;

    case "activar";
        $es_correcto = $categoria->activar($id);
        echo $es_correcto ? 'Categor??a activada con ??xito' : 'No se puede activar categor??a';
    break;
}

?>
