<?php

include_once '../conexion/conexion.php';

class Persona {

    public function __construct() { }

    public function listarProveedor() {
        $sql = "select   *
                from     personas
                where    tipo_persona = 'Proveedor'
                order by id";
        return execute($sql);
    }

    public function listarCliente() {
        $sql = "select   *
                from     personas
                where    tipo_persona = 'Cliente'
                order by id";
        return execute($sql);
    }

    public function buscar($id) {
        $sql = "select *
                from   personas
                where  id = '$id'";
        return findById($sql);
    }

    public function guardar($tipoPersona, $nombre, $tipoDocumento, $numDocumento, $direccion, $telefono, $email) {
        $sql = "insert into personas (tipo_persona,nombre,tipo_documento,num_documento,direccion,telefono,email)
                values('$tipoPersona','$nombre','$tipoDocumento','$numDocumento','$direccion','$telefono','$email')";
        return execute($sql);
    }

    public function editar($id, $tipoPersona, $nombre, $tipoDocumento, $numDocumento, $direccion, $telefono, $email) {
        $sql = "update personas
                set    tipo_persona = '$tipoPersona',nombre = '$nombre',tipo_documento = '$tipoDocumento',num_documento = '$numDocumento',direccion = '$direccion',telefono = '$telefono',email = '$email'
                where  id = '$id'";
        return execute($sql);
    }

    public function eliminar($id) {
        $sql = "delete from personas where id = '$id'";
        return execute($sql);
    }

}

?>
