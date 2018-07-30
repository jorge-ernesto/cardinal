<?php // Modelo, clase con los métodos para insertar, editar, listar y eliminar

require '../conexion/Conexion.php'; // Incluimos la conexion a la base de datos

class Categoria { // En PHP las clases se escriben comenzando con mayuscula, además del espacio (Enter) caracteristico como en Java
    
    public function __construct() { // Implementamos nuestro constructor
    }
        
    public function listar() { // Implementamos un método para listar los registros
        $sql = "select *
                from   categoria";
        return ejecutarConsulta($sql);
    }    
        
    public function insertar($nombre,$descripcion) { // Implementamos un método para insertar registros
        $sql = "insert into categoria (nom_cat,des_cat,est_cat) values('$nombre','$descripcion','1')";
        return ejecutarConsulta($sql);
    }
        
    public function mostrar($idcategoria) { // Implementamos un método para mostrar los datos de un registro a modificar         
        $sql = "select *
                from   categoria
                where  idcat = '$idcategoria'";        
        return ejecutarConsultaSimpleFila($sql);
    }
        
    public function editar($idcategoria,$nombre,$descripcion) { // Implementamos un método para editar los registros
        $sql = "update categoria
                set    nom_cat = '$nombre',des_cat = '$descripcion'
                where  idcat = '$idcategoria'";
        return ejecutarConsulta($sql);
    }
        
    public function desactivar($idcategoria) { // Implementamos un método para desactivar categorías
        $sql = "update categoria
                set    est_cat = '0'
                where  idcat = '$idcategoria'";
        return ejecutarConsulta($sql);
    }
        
    public function activar($idcategoria) { // Implementamos un método para desactivar categorías
        $sql = "update categoria
                set    est_cat = '1'
                where  idcat = '$idcategoria'";
        return ejecutarConsulta($sql);
    }
    
}

?>
