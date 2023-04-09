<?php

include_once "../conexion/conexion.php";

class Categoria {

    public function __construct() {         
    }

    public function listar() {
        $sql = "SELECT   * 
                FROM     categorias 
                ORDER BY id";        
        return execute($sql);
    }

    public function buscar($id) {
        $sql = "SELECT * 
                FROM   categorias 
                WHERE  id = '$id'";        
        return findById($sql);
    }

    public function guardar($nombre, $descripcion) {
        $sql = "INSERT INTO categorias (nombre,descripcion,estado) VALUES('$nombre','$descripcion','1')";        
        return execute($sql);
    }

    public function editar($id, $nombre, $descripcion) {
        $sql = "UPDATE categorias
                SET    nombre = '$nombre',descripcion = '$descripcion'
                WHERE  id = '$id'";
        return execute($sql);
    }

    public function desactivar($id) {
        $sql = "UPDATE categorias
                SET    estado = '0'
                WHERE  id = '$id'";
        return execute($sql);
    }

    public function activar($id) {
        $sql = "UPDATE categorias
                SET    estado = '1'
                WHERE  id = '$id'";
        return execute($sql);
    }

    public function select() {
        $sql = "SELECT   id,nombre,descripcion
                FROM     categorias
                WHERE    estado = 1
                ORDER BY id";
        return execute($sql);
    }
    
}

?>
