<?php

require_once '../conexion/conexion.php';

class usuario {

    public function __construct() { }

    public function listar() {
        $sql = "select       c.id,date(c.fecha_hora),c.id_proveedor,p.nombre as proveedor,c.id_usuario,u.nombre as usuario,
                             c.tipo_comprobante,c.serie_comprobante,c.num_comprobante,
                             c.impuesto,c.total_compra,c.estado
                from         compras c
                inner join   personas p   on c.id_proveedor = p.id
                inner join   usuarios u   on c.id_usuario = u.id";
        return execute($sql);
    }

    public function buscar($id) {
        $sql = "select       c.id,date(c.fecha_hora),c.id_proveedor,p.nombre as proveedor,c.id_usuario,u.nombre as usuario,
                             c.tipo_comprobante,c.serie_comprobante,c.num_comprobante,
                             c.impuesto,c.total_compra,c.estado
                from         compras c
                inner join   personas p   on c.id_proveedor = p.id
                inner join   usuarios u   on c.id_usuario = u.id
                where        c.id = '$id'";
        return findById($sql);
    }

    public function guardar($idProveedor, $idUsuario, $tipoComprobante, $serieComprobante, $numComprobante, $fechaHora, $impuesto, $totalCompra,
                            $idArticulo, $cantidad, $precioCompra, $precioVenta) {
        $sql = "insert into compras (id_proveedor,id_usuario,tipo_comprobante,serie_comprobante,num_comprobante,fecha_hora,impuesto,total_compra,estado)
                values('$idProveedor','$idUsuario',$tipoComprobante,$serieComprobante,$numComprobante,$fechaHora,$impuesto,$totalCompra,'Aceptado')";
        $lastId = executeWithFindByLastId($sql);
        // return execute($sql);

        /**** $idArticulo es un array con el id de todos los articulos a comprar *****/

        $contador = 0;
        $posta = true;
        while ($contador < count($idArticulo)) {
            $sqlDetalle = "insert into detalle_compras (id_compra, id_articulo, cantidad, precio_compra, precio_venta)
                            values('$lastId', '$idArticulo[$contador]', $cantidad[$contador], $precioCompra[$contador], $precioVenta[$contador])";
            execute($sqlDetalle) ? $posta = true : $posta = false;
            $contador = $contador + 1;
        }
        return $posta;
    }

    public function anular($id) {
        $sql = "update compras
                set    estado = 'Anulado'
                where  id = '$id'";
        return execute($sql);
    }

}

?>
