<?php
  session_start();
  include "config.php";
  include "users.php";

  $user = new User();
  $wrongMsg = "";
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
     $log = $user->check_login($_POST['username'],$_POST['password']);
     if($log == "lecturer"){
       header("location:home.php");
     }elseif($log == "registra"){
        header("location:register.php");
     }else{

       $wrongMsg = "Wrong! user name or password.";
     }
  }
?>

<!DOCTYPE html>
<html>
<head>
	<title> Class attendance</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="w3shool.css">
	<link rel="stylesheet" type="text/css" href="theme.css">
	 <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
	 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Karma", sans-serif;}
</style>
</head>
<body class="w3-theme-b5 w3-display-container"> 	 

<div class="w3-theme w3-card-4 w3-mobile w3-display-middle" style="width:30%; margin-top:300px;">

<div class="container w3-white w3-text-red w3-center">
  <?php if($wrongMsg != ""){ echo "<p> $wrongMsg </p>";}?> 
</div>
   
      <img src="image/logoifm3.jpg" alt="logo" class="w3-image">
   
   <div class="w3-container w3-center w3-card-4">
      <p>Class Attendance System </p>
   </div>
   <form action="" method="POST">
   <div class="w3-container">
      <input type="text" name="username" class="w3-input" placeholder="user name">
      <input type="password" name="password" class="w3-input" placeholder="password">
      <br>
            <a href="restriction_note.html" class="w3-button w3-round-large w3-border w3-border-white w3-hover-white">Register</a>
            <input type="submit" value="Login" class="w3-button w3-round-large w3-border w3-border-white w3-right w3-hover-white">
   </div>
   </form>
   <br>
</div>

<script type="text/javascript">

</script>
</body>
</html>