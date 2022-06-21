<?php 
   
   # CHECK USER SESSION 
    if (!isset($_SESSION['user'])) {
         header("location: ".url('login.php'));
         exit(); 
    }
?>