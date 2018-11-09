<?php

require '../conexion/conexion.php';

class categoria {

    public function __construct() {
    }

    public function listar() {
        $sql = "select   *
                from     categoria
                order by id";
        return execute($sql);
    }

    public function buscar($idcategoria) {
        $sql = "select *
                from   categoria
                where  id = '$idcategoria'";
        return findById($sql);
    }

    public function guardar($nombre, $descripcion) {
        $sql = "insert into categoria (nombre,descripcion,estado) values('$nombre','$descripcion','1')";
        return execute($sql);
    }

    public function editar($id, $nombre, $descripcion) {
        $sql = "update categoria
                set    nombre = '$nombre',descripcion = '$descripcion'
                where  id = '$id'";
        return execute($sql);
    }

    public function desactivar($idcategoria) {
        $sql = "update categoria
                set    estado = '0'
                where  id = '$idcategoria'";
        return execute($sql);
    }

    public function activar($idcategoria) {
        $sql = "update categoria
                set    estado = '1'
                where  id = '$idcategoria'";
        return execute($sql);
    }

}

?>
