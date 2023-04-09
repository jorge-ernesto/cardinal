<?php

include_once '../conexion/conexion.php';

class Compra {

    public function __construct() { }

    public function listar() { // date, obtiene solo la fecha, no la hora
        $sql = "select       c.id,c.id_proveedor,p.nombre as proveedor,c.id_usuario,u.nombre as usuario,
                             c.tipo_comprobante,c.serie_comprobante,c.num_comprobante,
                             date(c.fecha_hora) as fecha,c.impuesto,c.total_compra,c.estado
                from         compras c
                inner join   personas p   on c.id_proveedor = p.id
                inner join   usuarios u   on c.id_usuario = u.id
                order by     c.id";
        return execute($sql);
    }

    public function buscar($id) {
        $sql = "select       c.id,c.id_proveedor,p.nombre as proveedor,c.id_usuario,u.nombre as usuario,
                             c.tipo_comprobante,c.serie_comprobante,c.num_comprobante,
                             date(c.fecha_hora) as fecha,c.impuesto,c.total_compra,c.estado
                from         compras c
                inner join   personas p   on c.id_proveedor = p.id
                inner join   usuarios u   on c.id_usuario = u.id
                where        c.id = '$id'
                order by     c.id";
        return findById($sql);
    }
    
    public function buscarDetalle($id) {
        $sql = "select       a.nombre,dc.precio_compra,dc.precio_venta,dc.cantidad,dc.id_articulo
                from         detalle_compras dc
                inner join   articulos a on dc.id_articulo = a.id
                where        dc.id_compra = '$id'
                order by     dc.id";
        return execute($sql);
    }

    public function guardar($idProveedor, $idUsuario, $tipoComprobante, $serieComprobante, $numComprobante, $fechaHora, $impuesto, $granTotal2,
                            $idArticulo, $cantidad, $precioCompra, $precioVenta) {
        $sql = "insert into compras (id_proveedor,id_usuario,tipo_comprobante,serie_comprobante,num_comprobante,fecha_hora,impuesto,total_compra,estado)
                values('$idProveedor','$idUsuario','$tipoComprobante','$serieComprobante','$numComprobante','$fechaHora','$impuesto','$granTotal2','Aceptado')";
        $lastId = executeWithFindByLastId($sql);
        // return execute($sql);

        /*****/
                
        $numComprobanteFormateado = str_pad($lastId, 10, '0', STR_PAD_LEFT);
        $sqlUpdate = "update compras
                      set num_comprobante = '$numComprobanteFormateado'
                      where id = '$lastId'";
        execute($sqlUpdate);
        
        /**** $idArticulo es un array con el id de todos los articulos a comprar *****/

        $contador = 0;
        $posta = true;
        while ($contador < count($idArticulo)) {
            $sqlDetalle = "insert into detalle_compras (id_compra, id_articulo, cantidad, precio_compra, precio_venta)
                           values('$lastId','$idArticulo[$contador]','$cantidad[$contador]','$precioCompra[$contador]','$precioVenta[$contador]')";
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
