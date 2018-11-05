<?php

require '../modelos/categoria.php';
require_once '../conexion/conexion.php'; // conexion.php no es una clase y no se puede instanciar

$varIdCategoria = isset($_POST['varIdCategoria']) ? clearString($_POST['varIdCategoria']) : ''; // Obtiene la variable de categoria.js
$idcategoria = isset($_POST['idcategoria']) ? clearString($_POST['idcategoria']) : ''; // Obtiene la variable desde el listarCategoria.php
$nombre = isset($_POST['nombre']) ? clearString($_POST['nombre']) : '';
$descripcion = isset($_POST['descripcion']) ? clearString($_POST['descripcion']) : '';

$objDaoCat = new categoria();
$action = $_GET['action'];

switch($action) {
    case 'listar';
        $respuesta = $objDaoCat->listar();

        $listJson = array(); // Declaramos un array
        while ($obj = $respuesta->fetch_object()) { // Recorremos todos los registros que obtenemos de la tabla categoria
            $listJson[] = array(
                '0' => ($obj->est_cat == 1) ?
                       '<button class="btn btn-warning" onclick="mostrar('.$obj->idcat.')"><i class="fa fa-pencil"></i></button>'
                      .' <button class="btn btn-danger" onclick="desactivar('.$obj->idcat.')"><i class="fa fa-close"></i></button>' :
                       '<button class="btn btn-warning" onclick="mostrar('.$obj->idcat.')"><i class="fa fa-pencil"></i></button>'
                      .' <button class="btn btn-primary" onclick="activar('.$obj->idcat.')"><i class="fa fa-check"></i></button>',
                '1' => $obj->nom_cat,
                '2' => $obj->des_cat,
                '3' => ($obj->est_cat == 1) ?
                       '<span class="label bg-aqua">Activo</span>' :
                       '<span class="label bg-black">Inactivo</span>'
            );
        }

        $json = array( // Declaramos un array
            'sEcho' => 1,
            'iTotalRecords' => count($listJson),
            'iTotalDisplayRecords' => count($listJson),
            'aaData' => $listJson
        );
        echo json_encode($json); // Codificamos los resultados utilizando JSON para poder verlos
    break;

    case 'mostrar';
        $respuesta = $objDaoCat->mostrar($varIdCategoria);
        echo json_encode($respuesta); // Codificamos el resultado utilizando JSON
    break;

    case 'guardar':
        if (empty($idcategoria)) {
            $respuesta = $objDaoCat->insertar($nombre,$descripcion);
            echo $respuesta? 'Categoría registrada':'Categoría no se pudo registrar'; // Si respuesta recibe un 1, entonces, si no
        } else {
            $respuesta = $objDaoCat->editar($idcategoria,$nombre,$descripcion);
            echo $respuesta? 'Categoría actualizada':'Categoría no se pudo actualizar';
        }
    break;

    case 'desactivar';
        $respuesta = $objDaoCat->desactivar($varIdCategoria);
        echo $respuesta? 'Categoría desactivada':'Categoría no se puede desactivar';
    break;

    case 'activar';
        $respuesta = $objDaoCat->activar($varIdCategoria);
        echo $respuesta? 'Categoría activada':'Categoria no se puede activar';
    break;
}

?>
