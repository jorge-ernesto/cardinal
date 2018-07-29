<?php // Funciones para insertar, editar, listar y eliminar

require_once '../modelos/Categoria.php'; // Incluimos la clase Categoria, require_once impiden la carga de un mismo fichero varias veces

$objCat = new Categoria(); // Creamos un objeto, el objeto hace una instancia a la clase Categoria, al crear una instancia utilizamos el constructor de la clase

$varIdCategoria = isset($_POST['varIdCategoria'])? limpiarCadena($_POST['varIdCategoria']):''; // Obtiene la variable desde Jquery
$idcategoria = isset($_POST['idcategoria'])? limpiarCadena($_POST['idcategoria']):''; // Obtiene la variable desde el formulario
$nombre = isset($_POST['nombre'])? limpiarCadena($_POST['nombre']):'';
$descripcion = isset($_POST['descripcion'])? limpiarCadena($_POST['descripcion']):'';
// Estructura Condicional de una sola línea, el formulario que implementaremos enviara los datos por el método $_POST
// Si existe la variable varIdCategoria y lo recibo mediante el metodo $_POST
// Si existe, lo que recibo lo envio al método limpiarCadena
// Si no existe, solo obtenemos una cadena de texto vacia

switch ($_GET['op']) { // Funciones que van a devolver datos
    case 'listar';
        $respuesta = $objCat->listar();
                       
        $data = array(); // Declaramos un array 
        while ($registro = $respuesta->fetch_object()) { // Recorremos todos los registros que obtenemos de la tabla categoria
            $data[] = array( // Todos los registros obtenidos se almacenan en el array $data declarado en la parte superior
                '0' => ($registro->est_cat)? // Si la condición es true ó 1 entonces se podrá desactivar, si la condición es false ó 0 entonces se podrá activar
                       '<button class="btn btn-warning" onclick="mostrar('.$registro->idcat.')"><i class="fa fa-pencil"></i></button>'
                      .' <button class="btn btn-danger" onclick="desactivar('.$registro->idcat.')"><i class="fa fa-close"></i></button>':
                       '<button class="btn btn-warning" onclick="mostrar('.$registro->idcat.')"><i class="fa fa-pencil"></i></button>'
                      .' <button class="btn btn-primary" onclick="activar('.$registro->idcat.')"><i class="fa fa-check"></i></button>',
                '1' => $registro->nom_cat,
                '2' => $registro->des_cat,
                '3' => ($registro->est_cat)? // Si la condición es true ó 1 entonces se mostrará un label Activado, si la condición es false ó 0 entonces se mostrará un label Desactivado
                       '<span class="label bg-green">Activado</span>':
                       '<span class="label bg-red">Desactivado</span>'
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
    
    case 'mostrar';
        $respuesta = $objCat->mostrar($varIdCategoria);        
        echo json_encode($respuesta); // Codificamos el resultado utilizando JSON
    break;
    
    case 'insertar_editar':
        if (empty($idcategoria)) {
            $respuesta = $objCat->insertar($nombre,$descripcion);
            echo $respuesta? 'Categoría registrada':'Categoría no se pudo registrar'; // Si respuesta recibe un 1, entonces, si no
        } else {
            $respuesta = $objCat->editar($idcategoria,$nombre,$descripcion);
            echo $respuesta? 'Categoría actualizada':'Categoría no se pudo actualizar';
        }        
    break;        

    case 'desactivar';
        $respuesta = $objCat->desactivar($varIdCategoria);
        echo $respuesta? 'Categoría desactivada':'Categoría no se puede desactivar';        
    break;

    case 'activar';
        $respuesta = $objCat->activar($varIdCategoria);
        echo $respuesta? 'Categoría activada':'Categoria no se puede activar';       
    break;   
}

?>
