<?php 

   session_start();
   include "config.php";
   include "users.php";


   $user = new User();

   $user->user_logout();
   $user->setAll_to_null();

   header("location:index.php"); 


 ?>