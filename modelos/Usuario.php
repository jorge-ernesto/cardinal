<?php

include_once '../conexion/conexion.php';

class Usuario {

    public function __construct() { }

    public function listar() {
        $sql = "select     u.id, u.nombre, u.tipo_documento, u.num_documento, u.direccion, u.telefono, u.email, c.nombre as cargo, u.username, u.password, u.imagen, u.estado
                from       usuarios u
                inner join cargos c ON u.id_cargo = c.id
                order by   u.id";
        return execute($sql);
    }

    public function buscar($id) {
        $sql = "select     u.id, u.nombre, u.tipo_documento, u.num_documento, u.direccion, u.telefono, u.email, u.id_cargo as cargo, u.username, u.password, u.imagen, u.estado
                from       usuarios u
                inner join cargos c ON u.id_cargo = c.id
                where      u.id = '$id'";
        return findById($sql);
    }

    public function guardar($nombre, $tipoDocumento, $numDocumento, $direccion, $telefono, $email, $cargo, $username, $password, $imagen) {
            $sql = "insert into usuarios (nombre,tipo_documento,num_documento,direccion,telefono,email,id_cargo,username,password,imagen,estado)
                    values('$nombre','$tipoDocumento','$numDocumento','$direccion','$telefono','$email','$cargo','$username','$password','$imagen','1')";
        return execute($sql);
    }

    public function editar($id, $nombre, $tipoDocumento, $numDocumento, $direccion, $telefono, $email, $cargo, $username, $password, $imagen) {
        $sql = "update usuarios
                set    nombre = '$nombre',tipo_documento = '$tipoDocumento',num_documento = '$numDocumento',direccion = '$direccion',telefono = '$telefono',email = '$email',id_cargo = '$cargo',username = '$username',password = '$password',imagen = '$imagen'
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
