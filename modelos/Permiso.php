<?php

include_once '../conexion/conexion.php';

class Permiso {

    public function __construct() { }

    public function listar() {
        $sql = "select   *
                from     permisos
                order by id";
        return execute($sql);
    }

    public function permisosMarcados($id) {
        $sql = "select *
                from   detalle_cargos
                where  id_cargo = '$id'";
        return execute($sql);
    }

    public function login($username, $password) {
        $sql = "select     u.id, u.nombre, u.tipo_documento, u.num_documento, u.direccion, u.telefono, u.email, u.id_cargo as id_cargo, u.username, u.password, u.imagen, u.estado
                from       usuarios u
                inner join cargos c ON u.id_cargo = c.id
                where      u.username = '$username' and u.password = '$password' and u.estado = 1 and c.estado = 1";
        return execute($sql);

        
    }

}

?>
