<?php 
require '../helpers/dbconnection.php';
require '../helpers/functions.php';

$id = $_GET['id'];

### Getting User ID to remove image from uploads folder

    $sqlDelete = "delete from products where product_id=$id";
    $operation = DoQuery($sqlDelete);

    if($operation){
        $message = ['success' => 'Product Deleted Successfully'];
        }else{
        $message = ['error' => 'Error Deleting Product'];
        }
        $_SESSION['message'] = $message;
        header("Location: index.php");

?>