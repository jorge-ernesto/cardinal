<?php

require '../conexion/conexion.php';

class categoria {

    public function __construct() {
    }

    public function listar() {
        $sql = "select * from categoria";
        return execute($sql);
    }

    public function mostrar($idcategoria) {
        $sql = "select *
                from   categoria
                where  idcat = '$idcategoria'";
        return findById($sql);
    }

    public function insertar($nombre, $descripcion) {
        $sql = "insert into categoria (nom_cat,des_cat,est_cat) values('$nombre','$descripcion','1')";
        return execute($sql);
    }

    public function editar($id, $nombre, $descripcion) {
        $sql = "update categoria
                set    nom_cat = '$nombre',des_cat = '$descripcion'
                where  idcat = '$id'";
        return execute($sql);
    }

    public function desactivar($idcategoria) {
        $sql = "update categoria
                set    est_cat = '0'
                where  idcat = '$idcategoria'";
        return execute($sql);
    }

    public function activar($idcategoria) {
        $sql = "update categoria
                set    est_cat = '1'
                where  idcat = '$idcategoria'";
        return execute($sql);
    }

}

?>
