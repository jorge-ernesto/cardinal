<?php

require '../conexion/conexion.php';

class permiso {

    public function __construct() {
    }

    public function listar() {
        $sql = "select   *
                from     permisos
                order by id";
        return execute($sql);
    }

}

?>
