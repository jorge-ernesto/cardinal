<?php

require_once '../conexion/conexion.php';

class usuario {

    public function __construct() { }

    public function listar() {
        $sql = "select   *
                from     usuarios
                order by id";
        return execute($sql);
    }

    public function buscar($id) {
        $sql = "select *
                from   usuarios
                where  id = '$id'";
        return findById($sql);
    }

    public function guardar($idProveedor, $idUsuario, $tipoComprobante, $serieComprobante, $numComprobante, $fechaHora, $impuesto, $totalCompra,
                            $idArticulo, $cantidad, $precioCompra, $precioVenta) {
        $sql = "insert into compras (id_proveedor,id_usuario,tipo_comprobante,serie_comprobante,num_comprobante,fecha_hora,impuesto,total_compra,estado)
                values('$idProveedor','$idUsuario',$tipoComprobante,$serieComprobante,$numComprobante,$fechaHora,$impuesto,$totalCompra,'1')";
        $lastId = executeWithFindByLastId($sql);
        // return execute($sql);

        /**** $idArticulo es un array con el id de todos los articulos a comprar *****/

        $contador = 0;
        $posta = true;
        while ($contador < count($idArticulo)) {
            $sqlDetalle = "insert into detalle_compras (id_compra, id_articulo, cantidad, precio_compra, precio_venta)
                            values('$lastId', '$idArticulo[$contador]', $cantidad[$contador], $precioCompra['$contador'], $precioVenta['$contador'])";
            execute($sqlDetalle) ? $posta = true : $posta = false;
            $contador = $contador + 1;
        }
        return $posta;
    }

    public function editar($id, $nombre, $tipoDocumento, $numDocumento, $direccion, $telefono, $email, $cargo, $username, $password, $imagen, $permisos) {
        $sql = "update usuarios
                set    nombre = '$nombre',tipo_documento = '$tipoDocumento',num_documento = '$numDocumento',direccion = '$direccion',telefono = '$telefono',email = '$email',cargo = '$cargo',username = '$username',password = '$password',imagen = '$imagen'
                where  id = '$id'";
        execute($sql);
        // return execute($sql);

        /****/

        $sqlDelete = "delete from usuarios_permisos where id_usuario = '$id'";
        execute($sqlDelete);

        /****/

        $numeroElementos = 0;
        $posta = true;
        while ($numeroElementos < count($permisos)) {
            $sqlPermisos = "insert into usuarios_permisos (id_usuario, id_permiso)
                            values('$id', '$permisos[$numeroElementos]')";
            execute($sqlPermisos) ? $posta = true : $posta = false;
            $numeroElementos = $numeroElementos + 1;
        }
        return $posta;
    }

    public function desactivar($id) {
        $sql = "update usuarios
                set    estado = '0'
                where  id = '$id'";
        return execute($sql);
    }

    public function activar($id) {
        $sql = "update usuarios
                set    estado = '1'
                where  id = '$id'";
        return execute($sql);
    }

}

?>
