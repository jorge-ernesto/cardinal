<?php // Modelo, clase con los métodos para insertar, editar, listar y eliminar

// Incluimos la conexion a la base de datos
require '../config/Conexion.php';

class Categoria {
    // Implementamos nuestro constructor
    public function __construct() {
        
    }
    
    // Implementamos un método para insertar registros
    public function insertar($nombre,$descripcion) {
        $sql = "insert into categoria (nombre,descripcion,condicion)
                values('$nombre','$descripcion','1')";
        return ejecutarConsulta($sql);
    }
    
    // Implementamos un método para editar los registros
    public function editar($idcategoria,$nombre,$descripcion) {
        $sql = "update categoria
                set    nombre = '$nombre',descripcion = '$descripcion'
                where  idcategoria = '$idcategoria'";
        return ejecutarConsulta($sql);
    }
    
    // Implementamos un método para desactivar categorías
    public function desactivar($idcategoria) {
        $sql = "update categoria
                set    condicion = '0'
                where  idcategoria = '$idcategoria'";
        return ejecutarConsulta($sql);
    }
    
    // Implementamos un método para desactivar categorías
    public function activar($idcategoria) {
        $sql = "update categoria
                set    condicion = '1'
                where  idcategoria = '$idcategoria'";
        return ejecutarConsulta($sql);
    }
    
    // Implementamos un método para mostrar los datos de un registro a modificar
    public function mostrar($idcategoria) {
        $sql = "select *
                from  categoria
                where idcategoria = '$idcategoria'";        
        return ejecutarConsultaSimpleFila($sql);
    }
    
    // Implementamos un método para listar los registros
    public function listar() {
        $sql = "select *
                from   categoria";
        return ejecutarConsulta($sql);
    }
}

?>
