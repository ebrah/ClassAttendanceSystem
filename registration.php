<?php 
      session_start();
      include "config.php";
     include "users.php";
     include "course.php";
     $usr = new User();
     $crse = new Course();

     $_SESSION['CORS1'] = 0;
     $_SESSION['CORS2'] = 0;
     $_SESSION['CORS3'] = 0;
     $_SESSION['lecture_id'] = 0;

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
       // $_POST['fname'];
       // $_POST['lname'];
       // $_POST['uname'];
       // $_POST['occupation'];
       // $_POST['email'];
       // $_POST['phone'];
       // $_POST['password'];

       $usrId = $usr->reg_user($_POST['fname'],$_POST['lname'],$_POST['email'],$_POST['phone'],$_POST['occupation'],
                        $_POST['uname'],$_POST['password']);
       $_SESSION['lecture_id'] = $usrId;
       
      if($_POST['occupation'] == 'lecturer'){
         if($_POST['course1'] != ""){
           if($usrId != 0){
             $crse->lecture_course($usrId,$_POST['course1']);
                 //move id course to finder method
               $_SESSION['CORS1'] = $_POST['course1'];
           }
       } 
        if($_POST['course2'] != ""){
            if($usrId != 0){
             $crse->lecture_course($usrId,$_POST['course2']);
                 //move id course to finder method
               $_SESSION['CORS2'] = $_POST['course2'];
           }
       } 
        if($_POST['course3'] != ""){
            if($usrId != 0){
             $crse->lecture_course($usrId,$_POST['course3']);
                 //move id course to finder method
               $_SESSION['CORS3'] = $_POST['course3'];
           }
          //REMEMBER TO SET ALL SESSION TO 0 AFTER REGISTER LECTURER
       } 
           header("location:lecturer_course.php");
      }  
       if($_POST['occupation'] != "lecturer"){
         header("location:index.php"); 
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
<script src="jquery.js"></script>
</head>
<body> 	 
<div class="w3-row w3-theme w3-card-4">
	<div class="w3-third">
		<div class="w3-bar w3-xlarge">
	    <span class="w3-bar-item"> <img src="image/logoifm3.jpg" alt="ifmlogo" class="w3-image"></span>	
        </div>
	</div>
	<div class="w3-twothird">
		<div class="w3-bar w3-xlarge w3-padding">
			<span class="w3-bar-item">Class Attendance System</span>
		</div>
	</div>
</div><!-- end first row -->

 <!-- Menu  -->
<div class="w3-bar w3-theme-b5 ">
<!--home btn -->
<span class="w3-bar-item w3-text-yellow w3-padding"><i class="material-icons ">warning</i> Lectures and Registrars are only required to register in the system.</span>
</div><!-- end Menu -->

<div class="w3-content">
  
     <form action="" class="w3-container" method="POST">
               <h4 class="w3-center">Registration Form</h4>

               <div class="row w3-section">
                 <div class="w3-col" style="width:10%;">
                 <i class="material-icons">person</i>
                 </div>
                 <div class="w3-rest">
                    <input type="text" class="w3-input" name="fname" placeholder="First Name" required>
                 </div>
               </div><!-- /row -->

                <div class="row w3-section">
                 <div class="w3-col" style="width:10%;">
                 <i class="material-icons">person</i>
                 </div>
                 <div class="w3-rest w3-section">
                    <input type="text" class="w3-input" name="lname" placeholder="Last Name" required>
                 </div>
               </div><!-- /row -->

               <div class="row w3-section">
                 <div class="w3-col" style="width:10%;">
                 <i class="material-icons">person</i>
                 </div>
                 <div class="w3-rest w3-section">
                    <input type="text" class="w3-input" name="uname" placeholder="User Name" required>
                 </div>
               </div><!-- /row -->

                <div class="row w3-section">
                 <div class="w3-col" style="width:10%;">
                 <i class="material-icons">business_center</i>
                 </div>
                 <div class="w3-rest w3-section">
                    <select name="occupation" id="selection" onchange="check_attr()" class="w3-select" >
                      <option value="" selected checked>Your Occupation</option>
                      <option value="lecturer">Lecturer</option>
                      <option value="registrar">Registrar</option>
                    </select>
                 </div>
               </div><!-- /row -->

                <div class="row">
                 <div class="w3-col" style="width:10%;">
                 <i class="material-icons">contact_mail</i>
                 </div>
                 <div class="w3-rest">
                    <input type="text" class="w3-input" name="email" placeholder="Email" required>
                 </div>
               </div><!-- /row -->

                <div class="row w3-section">
                 <div class="w3-col" style="width:10%;">
                 <i class="material-icons">contact_phone</i>
                 </div>
                 <div class="w3-rest">
                    <input type="text" class="w3-input" name="phone" placeholder="Phone number" >
                 </div>
               </div><!-- /row -->

                <div class="row w3-section">
                 <div class="w3-col" style="width:10%;">
                 <i class="material-icons">contact_phone</i>
                 </div>
                 <div class="w3-rest">
                    <input type="password" class="w3-input" name="password" placeholder="Enter your password" required>
                 </div>
               </div><!-- /row -->

 <div class="w3-padding w3-yellow w3-text-black w3-hide" id="course_container"><!--  selection courses -->   
          <h4 class="w3-center">select courses that you are teaching.</h4>
<div class="w3-row-padding">

               <div class="w3-third">
                 <i class="material-icons"></i>
                 <select name="course1" id="" class="w3-input">
                   <option value="" disabled selected>select course </option>
                    <?php  
                           $data= $crse->courseData();
                           $l = $crse->length_course();
                     for ($i=0; $i < $l; $i++) { 
                          
                          for ($y=0; $y < 3; $y++) { 
                            if($y==0){
                              echo '<option value='. $data[$i][$y] .'>';
                            }
                            if($y == 1){
                              echo $data[$i][$y];
                            }
                            if($y == 2){
                              echo  '</option>';
                            }
                     
                          }
                     }
                          
                    ?>
                 </select>
               </div>
               <div class="w3-third">
                 <i class="material-icons"></i>
                 <select name="course2" id="" class="w3-input">
                   <option value="" disabled selected >select course </option>
                   <?php  
                           $data= $crse->courseData();
                           $l = $crse->length_course();
                     for ($i=0; $i < $l; $i++) { 
                          
                          for ($y=0; $y < 3; $y++) { 
                            if($y==0){
                              echo '<option value='. $data[$i][$y] .'>';
                            }
                            if($y == 1){
                              echo $data[$i][$y];
                            }
                            if($y == 2){
                              echo  '</option>';
                            }
                     
                          }
                     }
                          
                    ?>
                 </select>
               </div>
               <div class="w3-third">
                 <i class="material-icons"></i>
                 <select name="course3" id="" class="w3-input">
                   <option value="" selected disabled>select course </option>
                   <?php  
                           $data= $crse->courseData();
                           $l = $crse->length_course();
                     for ($i=0; $i < $l; $i++) { 
                          
                          for ($y=0; $y < 3; $y++) { 
                            if($y==0){
                              echo '<option value='. $data[$i][$y] .'>';
                            }
                            if($y == 1){
                              echo $data[$i][$y];
                            }
                            if($y == 2){
                              echo  '</option>';
                            }
                     
                          }
                     }
                          
                    ?>
                 </select>
               </div>

</div><!-- /row -->

</div><!-- end selection courses -->    

               <div class="w3-margin-top">
                  <input type="submit" class="w3-button w3-border w3-round-xxlarge w3-right " value=" Save">
               </div>
               
            </form>
            <br>
</div>



<footer class="w3-container w3-theme w3-margin-top">

 <p class="w3-padding"> <i class="material-icons">copyright</i> Institute of finance management</p>
	
</footer><!-- end footer -->

  
<script type="text/javascript">
     function check_attr(){
     var v = document.getElementById('selection').value;
     var c = document.getElementById('course_container');
         if(v == 'lecturer'){
           c.className += " w3-show ";
        }else{
          c.className = c.className.replace("w3-show", " ");
        }
     }

</script>

</body>
</html>