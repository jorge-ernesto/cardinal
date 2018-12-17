<?php

session_start();

require_once '../modelos/Compra.php';
require_once '../conexion/conexion.php';

$id = isset($_POST['id']) ? clearString($_POST['id']) : '';
$idProveedor = isset($_POST['idProveedor']) ? clearString($P_POST['idProveedor']) : '';
$idUsuario = $_SESSION['id'];
$tipoComprobante = isset($_POST['tipoComprobante']) ? clearString($P_POST['tipoComprobante']) : '';
$serieComprobante = isset($_POST['serieComprobante']) ? clearString($P_POST['serieComprobante']) : '';
$numComprobante = isset($_POST['numComprobante']) ? clearString($P_POST['numComprobante']) : '';
$fechaHora = isset($_POST['fechaHora']) ? clearString($P_POST['fechaHora']) : '';
$impuesto = isset($_POST['impuesto']) ? clearString($P_POST['impuesto']) : '';
$totalCompra = isset($_POST['totalCompra']) ? clearString($P_POST['totalCompra']) : '';

$objDaoCom = new Compra();
$action = $_GET['action'];

switch($action) {
    case 'listar';
        $respuesta = $objDaoCom->listar();

        $listJson = array();
        while ($obj = $respuesta->fetch_object()) {
            $listJson[] = array(
                '0' => '<a href="javascript:ver(' . $obj->id . ')">' . $obj->id . '</a>',
                '1' => $obj->fecha,
                '2' => $obj->proveedor,
                '3' => $obj->usuario,
                '4' => $obj->tipo_comprobante,
                '5' => $obj->serie_comprobante,
                '6' => $obj->num_comprobante,
                '7' => $obj->impuesto,
                '8' => $obj->total_compra,
                '9' => '<a class="btn btn-sm btn-primary" href="javascript:buscar(' . $obj->id . ')">editar</a>',
                '10' => ($obj->estado == "Aceptado") ?
                       '<a class="btn btn-sm btn-dark" href="javascript:anular(' . $obj->id . ')">anular</a>' :
                       '<h6><span class="badge badge-outline-dark">Anulado</span></h6>',
                '11' => ($obj->estado == "Aceptado") ?
                       '<h6><span class="badge badge-outline-primary">Aceptado</span></h6>' :
                       '<h6><span class="badge badge-outline-dark">Anulado</span></h6>'
            );
        }

        $json = array( // Declaramos un array
            'draw' => 1,
            'recordsTotal' => count($listJson),
            'recordsFiltered' => count($listJson),
            'data' => $listJson
        );
        echo json_encode($json);
    break;

    case 'buscar';
        $respuesta = $objDaoCom->buscar($id);
        echo json_encode($respuesta);
    break;

    case 'guardar':
        if (empty($id)) {
            $idArticulo = $_POST['idArticulo']; // $idArticulo es un array con el id de todos los articulos a comprar
            $cantidad = $_POST['cantidad'];
            $precioCompra = $_POST['precioCompra'];
            $precioVenta = $_POST['precioVenta'];
            $respuesta = $objDaoCom->guardar($idProveedor, $idUsuario, $tipoComprobante, $serieComprobante, $numComprobante, $fechaHora, $impuesto, $totalCompra,
                                             $idArticulo, $cantidad, $precioCompra, $precioVenta);
            echo $respuesta ? 'Compra creada con éxito' : 'No se pudo crear compra';
        } else {

        }
    break;

    case 'anular';
        $respuesta = $objDaoCom->desactivar($id);
        echo $respuesta ? 'Compra anulada con éxito' : 'No se puede anular compra';
    break;
}

?>
