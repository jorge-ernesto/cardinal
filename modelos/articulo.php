<?php

require '../conexion/conexion.php';

class articulo {

    public function __construct() {
    }

    public function listar() {
        $sql = "select     a.id,a.id_categoria,c.nombre as nombreCategoria,a.codigo,a.nombre,a.stock,a.descripcion,a.imagen,a.estado
                from       articulo a
                inner join categoria c
                on         a.id_categoria = c.id
                order by   a.id";
        return execute($sql);
    }

    public function buscar($id) {
        $sql = "select *
                from   articulo
                where  id = '$id'";
        return findById($sql);
    }

    public function guardar($idCategoria, $codigo, $nombre, $stock, $descripcion, $imagen) {
        $sql = "insert into articulo (id_categoria,codigo,nombre,stock,descripcion,imagen,estado)
                values('$idCategoria','$codigo','$nombre','$stock','$descripcion','$imagen','1')";
        return execute($sql);
    }

    public function editar($id, $idCategoria, $codigo, $nombre, $stock, $descripcion, $imagen) {
        $sql = "update articulo
                set    id_categoria = '$idCategoria',codigo = '$codigo',nombre = '$nombre',stock = '$stock',descripcion = '$descripcion',imagen = '$imagen',descripcion = '$descripcion',imagen = '$imagen'
                where  id = '$id'";
        return execute($sql);
    }

    public function desactivar($id) {
        $sql = "update articulo
                set    estado = '0'
                where  id = '$id'";
        return execute($sql);
    }

    public function activar($id) {
        $sql = "update articulo
                set    estado = '1'
                where  id = '$id'";
        return execute($sql);
    }

}

?>
