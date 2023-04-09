<?php

include_once "../conexion/conexion.php";

class Cargo {

    public function __construct() {         
    }

    public function listar() {
        $sql = "SELECT   * 
                FROM     cargos 
                ORDER BY id";        
        return execute($sql);
    }

    public function buscar($id) {
        $sql = "SELECT * 
                FROM   cargos 
                WHERE  id = '$id'";        
        return findById($sql);
    }

    public function guardar($nombre, $descripcion, $permisos) {
        $sql = "INSERT INTO cargos (nombre,descripcion,estado) VALUES('$nombre','$descripcion','1')";        
        $lastId = executeWithFindByLastId($sql);

        /* Guardar permisos */
        $contador = 0;
        $posta = true;
        while ($contador < count($permisos)) {
            $sqlDetalle = "insert into detalle_cargos (id_cargo, id_permiso)
                            values('$lastId','$permisos[$contador]')";
            execute($sqlDetalle) ? $posta=true : $posta=false;
            $contador = $contador + 1;
        }
        return $posta;
        /* Fin Guardar permisos */
    }

    public function editar($id, $nombre, $descripcion, $permisos) {
        $sql = "UPDATE cargos
                SET    nombre = '$nombre',descripcion = '$descripcion'
                WHERE  id = '$id'";
        execute($sql);

        /* Eliminar el detalle de cargos */
        $sqlDelete = "delete from detalle_cargos where id_cargo = '$id'";
        execute($sqlDelete);
        /* Fin Eliminar el detalle de cargos */

        /* Guardar permisos */
        $contador = 0;
        $posta = true;
        while ($contador < count($permisos)) {
            $sqlDetalle = "insert into detalle_cargos (id_cargo, id_permiso)
                            values('$id','$permisos[$contador]')";
            execute($sqlDetalle) ? $posta=true : $posta=false;
            $contador = $contador + 1;
        }
        return $posta;
        /* Fin Guardar permisos */
    }

    public function desactivar($id) {
        $sql = "UPDATE cargos
                SET    estado = '0'
                WHERE  id = '$id'";
        return execute($sql);
    }

    public function activar($id) {
        $sql = "UPDATE cargos
                SET    estado = '1'
                WHERE  id = '$id'";
        return execute($sql);
    }

    public function select() {
        $sql = "SELECT   id,nombre,descripcion
                FROM     cargos
                WHERE    estado = 1
                ORDER BY id";
        return execute($sql);
    }
    
}

?>
