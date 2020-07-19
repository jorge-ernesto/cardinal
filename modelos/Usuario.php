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

    public function guardar($nombre, $tipoDocumento, $numDocumento, $direccion, $telefono, $email, $cargo, $username, $password, $imagen, $permisos) {
        $sql = "insert into usuarios (nombre,tipo_documento,num_documento,direccion,telefono,email,cargo,username,password,imagen,estado)
                values('$nombre','$tipoDocumento','$numDocumento','$direccion','$telefono','$email','$cargo','$username','$password','$imagen','1')";
        $lastId = executeWithFindByLastId($sql);
        // return execute($sql);

        /**** $permisos es un array con el id de todos los permisos marcados *****/

        $contador = 0;
        $posta = true;
        while ($contador < count($permisos)) {
            $sqlDetalle = "insert into usuarios_permisos (id_usuario, id_permiso)
                            values('$lastId','$permisos[$contador]')";
            execute($sqlDetalle) ? $posta = true : $posta = false;
            $contador = $contador + 1;
        }
        return $posta;
    }

    public function editar($id, $nombre, $tipoDocumento, $numDocumento, $direccion, $telefono, $email, $cargo, $username, $password, $imagen, $permisos) {
        $sql = "update usuarios
                set    nombre = '$nombre',tipo_documento = '$tipoDocumento',num_documento = '$numDocumento',direccion = '$direccion',telefono = '$telefono',email = '$email',cargo = '$cargo',username = '$username',password = '$password',imagen = '$imagen'
                where  id = '$id'";
        execute($sql);
        // return execute($sql);

        /****/

        $sqlDelete = "delete from usuarios_permisos where id_usuario = '$id'";
        execute($sqlDelete);

        /****/

        $contador = 0;
        $posta = true;
        while ($contador < count($permisos)) {
            $sqlDetalle = "insert into usuarios_permisos (id_usuario, id_permiso)
                            values('$id', '$permisos[$contador]')";
            execute($sqlDetalle) ? $posta = true : $posta = false;
            $contador = $contador + 1;
        }
        return $posta;
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
