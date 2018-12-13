<?php

require_once '../conexion/conexion.php';

class categoria {

    public function __construct() {
    }

    public function listar() {
        $sql = "select   *
                from     categorias
                order by id";
        return execute($sql);
    }

    public function buscar($id) {
        $sql = "select *
                from   categorias
                where  id = '$id'";
        return findById($sql);
    }

    public function guardar($nombre, $descripcion) {
        $sql = "insert into categorias (nombre,descripcion,estado)
                values('$nombre','$descripcion','1')";
        return execute($sql);
    }

    public function editar($id, $nombre, $descripcion) {
        $sql = "update categorias
                set    nombre = '$nombre',descripcion = '$descripcion'
                where  id = '$id'";
        return execute($sql);
    }

    public function desactivar($id) {
        $sql = "update categorias
                set    estado = '0'
                where  id = '$id'";
        return execute($sql);
    }

    public function activar($id) {
        $sql = "update categorias
                set    estado = '1'
                where  id = '$id'";
        return execute($sql);
    }

    public function select() { // Solo se listan las categorias activas
        $sql = "select   id,nombre,descripcion
                from     categorias
                where    estado = 1
                order by id";
        return execute($sql);
    }
}

?>
