<?php

require_once '../conexion/conexion.php';

class permiso {

    public function __construct() {
    }

    public function listar() {
        $sql = "select   *
                from     permisos
                order by id";
        return execute($sql);
    }

    public function permisosMarcados($id) {
        $sql = "select *
                from   usuarios_permisos
                where  id_usuario = '$id'";
        return execute($sql);
    }

}

?>
