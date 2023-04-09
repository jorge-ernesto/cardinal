<?php

session_start();

include_once '../modelos/Compra.php';
include_once '../conexion/conexion.php';

$id = isset($_POST['id']) ? clearString($_POST['id']) : '';
$idProveedor = isset($_POST['idProveedor']) ? clearString($_POST['idProveedor']) : '';
$idUsuario = $_SESSION['id'];
$tipoComprobante = isset($_POST['tipoComprobante']) ? clearString($_POST['tipoComprobante']) : '';
$serieComprobante = isset($_POST['serieComprobante']) ? clearString($_POST['serieComprobante']) : '';
$numComprobante = isset($_POST['numComprobante']) ? clearString($_POST['numComprobante']) : '';
$fechaHora = isset($_POST['fechaHora']) ? clearString($_POST['fechaHora']) : '';
$impuesto = isset($_POST['impuesto']) ? clearString($_POST['impuesto']) : '';
$granTotal2 = isset($_POST['granTotal2']) ? clearString($_POST['granTotal2']) : '';

$objDaoCom = new Compra();
$action = $_GET['action'];

switch($action) {
    case 'listar';
        $respuesta = $objDaoCom->listar();

        $listJson = array();
        while ($obj = $respuesta->fetch_object()) {
            $listJson[] = array(
                '0' => '<a href="javascript:ver(' . $obj->id . ')">' . $obj->id . '</a>',                
                '1' => $obj->proveedor,
                '2' => $obj->usuario,
                '3' => $obj->tipo_comprobante,
                '4' => $obj->serie_comprobante,
                '5' => $obj->num_comprobante,
                '6' => $obj->fecha,
                '7' => $obj->impuesto,
                '8' => $obj->total_compra,
                '9' => '<a class="btn btn-sm btn-primary" href="javascript:buscar(' . $obj->id . ')">detalle</a>',
                '10' => ($obj->estado == "Aceptado") ?
                       '<a class="btn btn-sm" style="background-color: #773CB8; color: #fff;" href="javascript:anular(' . $obj->id . ')">anular</a>' :
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

    case 'buscarDetalle';
        $respuesta = $objDaoCom->buscarDetalle($id);
        while ($obj = $respuesta->fetch_object()) {
            echo '  <tr id="row_'. $obj->id_articulo .'">' .
                        '<td class="d-none">' .
                            '<input type="hidden" name="item_id[]" value="'. $obj->id_articulo .'"></input>' .
                        '</td>' .
                        '<td>'. $obj->nombre .'</td>' .
                        '<td style="width: 150px;">' .
                            '<input class="form-control col-sm-8" id="precioCompra_'. $obj->id_articulo .'" type="number" name="precioCompra[]" value="' . $obj->precio_compra . '" min="1" step="any" onchange="calcularImporte(' . $obj->id_articulo . ');" required></input>' .
                        '</td>' .
                        '<td style="width: 150px;">' .
                            '<input class="form-control col-sm-8" id="precioVenta_'. $obj->id_articulo .'" type="number" name="precioVenta[]" value="' . $obj->precio_venta . '" min="1" step="any" required></input>' .
                        '</td>' .
                        '<td style="width: 120px;">' .
                            '<input class="form-control col-sm-8" id="cantidad_'. $obj->id_articulo .'" type="number" name="cantidad[]" value="' . $obj->cantidad . '" min="1" onchange="calcularImporte(' . $obj->id_articulo . ');" required></input>' .
                        '</td>' .
                        '<td>' .
                            '<span id="totalImporte_'. $obj->id_articulo .'">'. number_format($obj->cantidad * $obj->precio_compra, 2, ".", "") .'</span>' .
                        '</td>' .                        
                    '</tr>';
        }
    break;

    case 'guardar':
        if (empty($_POST['item_id'])) {
            echo 'Error: La compra debe tener productos para ser creada';
        } else {
            if (empty($id)) {
                $idArticulo = $_POST['item_id']; // $idArticulo es un array con el id de todos los articulos a comprar
                $cantidad = $_POST['cantidad'];
                $precioCompra = $_POST['precioCompra'];
                $precioVenta = $_POST['precioVenta'];
                $respuesta = $objDaoCom->guardar($idProveedor, $idUsuario, $tipoComprobante, $serieComprobante, $numComprobante, $fechaHora, $impuesto, $granTotal2,
                                                 $idArticulo, $cantidad, $precioCompra, $precioVenta);
                echo $respuesta ? 'Compra creada con éxito' : 'No se pudo crear compra';
            } else {
                
            }
        }        
    break;

    case 'anular';
        $respuesta = $objDaoCom->anular($id);
        echo $respuesta ? 'Compra anulada con éxito' : 'No se puede anular compra';
    break;

    case 'selectProveedor':
        include_once '../modelos/Persona.php';
        $objDaoPer = new Persona();

        $respuesta = $objDaoPer->listarProveedor();
        while ($obj = $respuesta->fetch_object()) {
            echo '<option value="'. $obj->id .'" id="'. $obj->id .'">'. $obj->nombre .'</option>';
        }
    break;
    
    case 'listarArticulosActivos':
        include_once '../modelos/Articulo.php';
        $objDaoArt = new Articulo();
        
        $respuesta = $objDaoArt->listarArticulosActivos();

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
                '7' => '<a class="btn btn-sm btn-primary" href="javascript:agregar('. $obj->id .',\''. $obj->nombre .'\')">agregar</a>'
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
}

?>
