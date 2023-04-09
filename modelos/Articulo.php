<?php

include_once '../conexion/conexion.php';

class Articulo {

    public function __construct() { }

    public function listar() {
        $sql = "select     a.id,c.nombre as categoria,a.codigo,a.nombre,a.stock,a.descripcion,a.imagen,a.estado
                from       articulos a
                inner join categorias c
                on         a.id_categoria = c.id
                order by   a.id";
        return execute($sql);
    }       

    public function buscar($id) {
        $sql = "select *
                from   articulos
                where  id = '$id'";
        return findById($sql);
    }

    public function guardar($idCategoria, $codigo, $nombre, $stock, $descripcion, $imagen) {
        $sql = "insert into articulos (id_categoria,codigo,nombre,stock,descripcion,imagen,estado)
                values('$idCategoria','$codigo','$nombre','$stock','$descripcion','$imagen','1')";
        return execute($sql);
    }

    public function editar($id, $idCategoria, $codigo, $nombre, $stock, $descripcion, $imagen) {
        $sql = "update articulos
                set    id_categoria = '$idCategoria',codigo = '$codigo',nombre = '$nombre',stock = '$stock',descripcion = '$descripcion',imagen = '$imagen'
                where  id = '$id'";
        return execute($sql);
    }

    public function desactivar($id) {
        $sql = "update articulos
                set    estado = '0'
                where  id = '$id'";
        return execute($sql);
    }

    public function activar($id) {
        $sql = "update articulos
                set    estado = '1'
                where  id = '$id'";
        return execute($sql);
    }
    
    public function listarArticulosActivos() {
        $sql = "select     a.id,c.nombre as categoria,a.codigo,a.nombre,a.stock,a.descripcion,a.imagen,a.estado
                from       articulos a
                inner join categorias c
                on         a.id_categoria = c.id                
                where      a.estado = 1
                order by   a.id";
        return execute($sql);
    }
    
}

?>
