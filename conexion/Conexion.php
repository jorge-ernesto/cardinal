<?php

$mysqli = new mysqli('localhost','root','','cardinal');
mysqli_query($mysqli,'set names utf8');

if(mysqli_connect_errno()){ //Si tenemos un error en la conexión
    printf('Error estableciendo conexión con la base de datos: ',myqsli_connect_error());
    die();
}

function execute($sql){
    global $mysqli; //Utilizamos la variable global $conexion
    $query = $mysqli->query($sql); //Se ejecuta la query, la cadena sql se recibe por parametro
    return $query;
}

function findById($sql){
    global $mysqli;
    $query = $mysqli->query($sql);
    $fila = $query->fetch_assoc(); //Obtenemos una fila como resultado
    return $fila;
}

function executeWithFindByLastId($sql){
    global $mysqli;
    $mysqli->query($sql);
    return $mysqli->insert_id; //Retornamos haciendo uso de la setencia insert_id, la llave primaria del ultimo registro insertado
}

function clearString($str){
    global $mysqli;
    $str = mysqli_real_escape_string($mysqli,trim($str)); //Escapamos los caracteres especiales de una cadena, usamos la codificación utf8
    return htmlspecialchars($str); //Retornamos la variable $str
}

?>
