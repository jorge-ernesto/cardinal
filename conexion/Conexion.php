<?php

$mysqli = new mysqli('localhost','root','','cardinal');

/* verificar la conexión */
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;    
    die();
}

/* cambiar el conjunto de caracteres a utf8 */
$mysqli->set_charset("utf8");

function execute($sql){
    global $mysqli; //Utilizamos la variable global $mysqli
    $query = $mysqli->query($sql); 
    return $query;
}
function findById($sql){
    global $mysqli;
    $query = $mysqli->query($sql);
    $fila = $query->fetch_assoc(); //Obtenemos una array como resultado    
    return $fila;
}
function executeWithFindByLastId($sql){
    global $mysqli;
    $mysqli->query($sql);
    return $mysqli->insert_id; //Retornamos haciendo uso de la setencia insert_id, la llave primaria del ultimo registro insertado
}
function clearString($str){
    global $mysqli;
    $str = mysqli_real_escape_string($mysqli,trim($str));
    return htmlspecialchars($str);                        
}
