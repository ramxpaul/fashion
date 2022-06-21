<?php 

 session_start(); 
 require 'helpers/functions.php';

 session_destroy(); 

    header('Location: '.url('login.php'));
