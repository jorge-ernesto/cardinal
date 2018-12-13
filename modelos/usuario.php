<?php

require_once '../conexion/conexion.php';

class usuario {

    public function __construct() {
    }

    public function listar() {
        $sql = "select   *
                from     usuarios
                order by id";
        return execute($sql);
    }

    public function buscar($id) {
        $sql = "select *
                from   usuarios
                where  id = '$id'";
        return findById($sql);
    }

    public function guardar($nombre, $tipoDocumento, $numDocumento, $direccion, $telefono, $email, $cargo, $username, $password, $imagen) {
        $sql = "insert into usuarios (nombre,tipo_documento,num_documento,direccion,telefono,email,cargo,username,password,imagen,estado)
                values('$nombre','$tipoDocumento','$numDocumento','$direccion','$telefono','$email','$cargo','$username','$password','$imagen','1')";
        return execute($sql);
    }

    public function editar($id, $nombre, $tipoDocumento, $numDocumento, $direccion, $telefono, $email, $cargo, $username, $password, $imagen) {
        $sql = "update usuarios
                set    nombre = '$nombre',tipo_documento = '$tipoDocumento',num_documento = '$numDocumento',direccion = '$direccion',telefono = '$telefono',email = '$email',cargo = '$cargo',username = '$username',password = '$password',imagen = '$imagen'
                where  id = '$id'";
        return execute($sql);
    }

    public function desactivar($id) {
        $sql = "update usuarios
                set    estado = '0'
                where  id = '$id'";
        return execute($sql);
    }

    public function activar($id) {
        $sql = "update usuarios
                set    estado = '1'
                where  id = '$id'";
        return execute($sql);
    }

}

?>
