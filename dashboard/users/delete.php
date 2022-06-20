<?php 
require '../helpers/dbconnection.php';
require '../helpers/functions.php';

$id = $_GET['id'];

### Getting User ID to remove image from uploads folder
$sqlSelectUser ="select image from user where user_id=$id";
$operation = DoQuery($sqlSelectUser);
$data = mysqli_fetch_assoc($operation);

if(RemoveFile($data['image'])){
    $sqlDelete = "delete from user where user_id=$id";
    $operation = DoQuery($sqlDelete);

    if($op){
        $message = ['success' => 'Role Deleted Successfully'];
        }else{
        $message = ['error' => 'Error Deleting Role'];
        }
      }else{
        $message = ['error' => 'Error Deleting File Try Again '];
      }
        $_SESSION['message'] = $message;
        header("Location: index.php");

?>