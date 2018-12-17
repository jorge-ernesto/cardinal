<?php

require_once '../conexion/conexion.php';

class permiso {

    public function __construct() { }

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

    public function login($username, $password) {
        $sql = "select id,nombre,tipo_documento,num_documento,direccion,telefono,email,cargo,username,imagen
                from   usuarios
                where  username = '$username' and password = '$password' and estado = 1";
        return execute($sql);
    }

}

?>
