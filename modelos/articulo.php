<?php

require '../conexion/conexion.php';

class articulo {

    public function __construct() {
    }

    public function listar() {
        $sql = "select   *
                from     articulo
                order by id";
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
                set    id_categoria = '$idCategoria',codigo = "$codigo",nombre = '$nombre',stock = "$stock",descripcion = "$descripcion",codigo = "$codigo",descripcion = '$descripcion',imagen = '$imagen'
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
