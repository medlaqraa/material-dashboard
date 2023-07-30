<?php 
include ('../config/dbcon.php');

function redirect($url,$message){
    $_SESSION['message'] = $message;
        header('location: '.$url);
        exit();
}

function getAll($table){
    global $con;
    $query = "SELECT * FROM $table";
    $query_result = mysqli_query($con, $query);
    return $query_result;
}


function getByID($table, $id){
    global $con;
    $query = "SELECT * FROM $table WHERE id = '$id'";
    $query_result = mysqli_query($con, $query);
    return $query_result;
}
?>