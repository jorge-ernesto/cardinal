<?php

$conexion = new mysqli('localhost','root','','cardinal');
mysqli_query($conexion, 'set names utf8'); // En php es utf8

if (mysqli_connect_errno()) { // Si tenemos un error en la conexión
    printf('Error estableciendo conexión con la base de datos: ', myqsli_connect_error());
    exit();
}

function execute($sql) {
    global $conexion; // Utilizamos la variable global $conexion
    $query = $conexion->query($sql); // Se ejecuta la query, la cadena sql se recibe por parametro
    return $query;
}

function findById($sql) {
    global $conexion;
    $query = $conexion->query($sql);
    $row = $query->fetch_assoc(); // Obtenemos una fila como resultado
    return $row;
}

function clearString($str) {
    global $conexion;
    $str = mysqli_real_escape_string($conexion,trim($str)); // Escapamos los caracteres especiales de una cadena, usamos la codificación utf8
    return htmlspecialchars($str); // Retornamos la variable $str
}

/*
function saveWithFindId($sql) {
    global $conexion;
    $query = $conexion->query($sql);
    return $conexion->insert_id; // Retornamos haciendo uso de la setencia insert_id, la llave primaria del registro insertado
}
*/

?>
