<?php

include_once "../modelos/Cargo.php";

$id          = isset($_POST['id']) ? clearString($_POST['id']) : '';                   
$nombre      = isset($_POST['nombre']) ? clearString($_POST['nombre']) : '';
$descripcion = isset($_POST['descripcion']) ? clearString($_POST['descripcion']) : '';

$cargo  = new Cargo();
$action = $_GET['action'];

switch($action) {
    case "listar";
        $dataCargo = $cargo->listar();
       
        while ($fila = $dataCargo->fetch_assoc()) {
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

        $json = array(
            "draw"            => 1,
            "recordsTotal"    => count($listJson),
            "recordsFiltered" => count($listJson),
            "data"            => $listJson
        );
        
        echo json_encode($json);
    break;

    case "buscar";
        $dataCargo = $cargo->buscar($id);                
        echo json_encode($dataCargo);
    break;

    case "guardar":
        $permisos = $_POST['permisos']; //$permisos es un array con el id de todos los permisos marcados

        if (empty($id)) {
            $es_correcto = $cargo->guardar($nombre, $descripcion, $permisos);            
            echo $es_correcto ? 'Categoría creada con éxito' : 'No se pudo crear categoría'; //$es_correcto es true o false
        } else {
            $es_correcto = $cargo->editar($id, $nombre, $descripcion, $permisos);
            echo $es_correcto ? 'Categoría editada con éxito' : 'No se pudo editar categoría';
        }
    break;

    case "desactivar";
        $es_correcto = $cargo->desactivar($id);
        echo $es_correcto ? 'Categoría desactivada con éxito' : 'No se puede desactivar categoría';
    break;

    case "activar";
        $es_correcto = $cargo->activar($id);
        echo $es_correcto ? 'Categoría activada con éxito' : 'No se puede activar categoría';
    break;

    case 'permisos';
        include_once '../modelos/Permiso.php';
        $objDaoPer = new Permiso();

        /* Obtiene permisos por el id_cargo */
        $listPermisosMarcados = array();
        $id = $_GET['id'];
        $respuesta2 = $objDaoPer->permisosMarcados($id);
        while ($obj2 = $respuesta2->fetch_object()) {
            array_push($listPermisosMarcados, $obj2->id_permiso);
        }
        /* Fin Obtiene permisos */

        $respuesta = $objDaoPer->listar();
        while ($obj = $respuesta->fetch_object()) {
            $checked = in_array($obj->id, $listPermisosMarcados) ? 'checked' : ''; // Método para determinar si algún permiso de listar() {{id en la tabla permisos}} estan dentro de $listPermisosMarcados {{id_permiso en la tabla usuarios_permisos}}
            echo '  <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="permisos[]" value="'. $obj->id .'" id="customCheck_'.$obj->id.'" class="custom-control-input" '. $checked .'>
                        <label class="custom-control-label" for="customCheck_'.$obj->id.'">'. $obj->nombre .'</label>
                    </div>';
        }
    break;
}

?>
