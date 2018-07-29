<?php // Conexión a la base de datos

require_once 'global.php'; // Incluimos las variables globales, require_once impiden la carga de un mismo fichero varias veces

$conexion = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
mysqli_query($conexion, 'SET NAMES "' . DB_ENCODE . '"');

if (mysqli_connect_errno()) { // Si tenemos un posible error en la conexión lo mostramos
    printf('Error estableciendo conexión con la base de datos: %s\n',myqsli_connect_error());
    exit();
}

if (!function_exists('ejecutarConsulta')) {
    function ejecutarConsulta($sql) {
        global $conexion; // Utilizamos la variable global $conexion, que está declara en la parte superior
        $query = $conexion->query($sql); // Se ejecuta la query, la sentencia sql se recibe por parametro y se almacena en la variable $query
        return $query; // Retornamos la variable $query
    }

    function ejecutarConsultaSimpleFila($sql) {
        global $conexion;
        $query = $conexion->query($sql);
        $row = $query->fetch_assoc(); // Obtenemos una fila como resultado y se almacena en un array
        return $row; // Retornamos el array
    }

    function ejecutarConsultaRetornarID($sql) {
        global $conexion;
        $query = $conexion->query($sql);
        return $conexion->insert_id; // Retornamos haciendo uso de la setencia insert_id, la llave primaria del registro insertado
    }

    function limpiarCadena($str) {
        global $conexion;
        $str = mysqli_real_escape_string($conexion,trim($str)); // Escapamos los caracteres especiales de una cadena, usamos la codificación de los caracteres que definimos anteriormente y se almacena en la variable $str
        return htmlspecialchars($str); // Retornamos la variable $str
    }
}

?>
