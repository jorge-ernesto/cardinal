<?php

$mysqli = new mysqli('localhost','root','','cardinal');
mysqli_set_charset($mysqli, "utf8");
if(mysqli_connect_errno()){
    printf('Error estableciendo conexión con la base de datos: ',myqsli_connect_error());
    die();
}

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

?>
