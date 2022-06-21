<?php 
require '../helpers/dbconnection.php';
require '../helpers/functions.php';

$id = $_GET['id'];

### Getting User ID to remove image from uploads folder
$operation = DoQuery($sqlSelectUser);
$data = mysqli_fetch_assoc($operation);


    $sqlDelete = "delete from products where product_id=$id";
    $operation = DoQuery($sqlDelete);

    if($op){
        $message = ['success' => 'Product Deleted Successfully'];
        }else{
        $message = ['error' => 'Error Deleting Product'];
        }
        $_SESSION['message'] = $message;
        header("Location: index.php");

?>