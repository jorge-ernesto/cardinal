<?php 
// Funciones para insertar, editar, listar y eliminar
// Luego los archivo JavaScript harán las peticiones Ajax a este archivo y estas funciones van a devolver datos
// Los datos serán mostrados de manera dinámica en el formulario programado en la parte de las vistas

// Incluimos la clase Categoria, require_once impiden la carga de un mismo fichero varias veces
require_once '../modelos/Categoria.php';

// Creamos un objeto, el objeto hace una instancia a la clase Categoria, al crear una instancia utilizamos el constructor de la clase
$categoria = new Categoria();

// Estructura Condicional de una sola línea
// El formulario que implementaremos enviara los datos por el metodo $_POST
$idcategoria = isset($_POST['idcategoria'])? // Si existe el objeto idcategoria del formulario y lo recibo mediante el metodo $_POST
               limpiarCadena($_POST['idcategoria']): // Si existe, lo que recibo lo envio al método limpiarCadena
               ''; // Si no existe, solo obtenemos una cadena de texto vacia
$nombre = isset($_POST['nombre'])? limpiarCadena($_POST['nombre']):'';
$descripcion = isset($_POST['descripcion'])? limpiarCadena($_POST['descripcion']):'';

// Funciones que van a devolver datos
switch ($_GET['op']) {
    case 'guardaryeditar':
        if (empty($idcategoria)) {
            $respuesta = $categoria->insertar($nombre,$descripcion);
            echo $respuesta? 'Categoría registrada':'Categoría no se pudo registrar'; // Si respuesta recibe un 1, entonces, si no
        } else {
            $respuesta = $categoria->editar($idcategoria,$nombre,$descripcion);
            echo $respuesta? 'Categoría actualizada':'Categoría no se pudo actualizar';
        }        
    break;

    case 'desactivar';
        $respuesta = $categoria->desactivar($idcategoria);
        echo $respuesta? 'Categoría desactivada':'Categoría no se puede desactivar';        
    break;

    case 'activar';
        $respuesta = $categoria->activar($idcategoria);
        echo $respuesta? 'Categoría activada':'Categoria no se puede activar';       
    break;

    case 'mostrar';
        $respuesta = $categoria->mostrar($idcategoria);        
        echo json_encode($respuesta); // Codificamos el resultado utilizando JSON
    break;

    case 'listar';
        $respuesta = $categoria->listar();
                       
        $data = array(); // Declaramos un array 
        while ($registro = $respuesta->fetch_object()) { // Recorremos todos los registros que obtenemos de la tabla categoria
            $data[] = array( // Todos los registros obtenidos se almacenan en el array $data declarado en la parte superior
                '0' => $registro->idcategoria,
                '1' => $registro->nombre,
                '2' => $registro->descripcion,
                '3' => $registro->condicion
            );
        }
                
        $resultados = array( // Declaramos un array
            'sEcho' => 1, // Información para el datatable
            'iTotalRecords' => count($data), // Enviamos el registros de datos al datatable
            'iTotalDisplayRecords' => count($data), // Enviamos el total de registros a visualizar al datatable
            'aaData' => $data // Enviamos los registros al datatable
        );        
        echo json_encode($resultados); // Codificamos los resultados utilizando JSON para poder verlos
    break;
}

?>
