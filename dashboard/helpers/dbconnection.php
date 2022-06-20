<?php 
session_start();

//Connection parameters
$server = "localhost";
$database = "e_commerce";
$username = "root";
$password = "";

try{
    $conn = mysqli_connect($server,$username,$password,$database);

    if(!$conn){
        throw new Exception('No Connection '.mysqli_connect_error());
    }

}catch(Exception $ex){
    echo $ex->getMessage();
}
?>