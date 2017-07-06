<?php
session_start();
  if($_SESSION['Login'] != TRUE){
    header("location:index.php");
   }

include "users.php";
include  "course.php";
include "Module.php";

if($_SESSION['Login'] != TRUE){
    header("location:index.php");
}
$reg = new User();
$course = new Course();
$module = new Module();
$reg->getUserDetails($_SESSION['uid']);
$courseId ="";
$moduleId = "";


  if($_SERVER['REQUEST_METHOD'] == 'POST'){
       
      if($_POST['course_name'] != "" && $_POST['course_year'] != ""){
           //echo "Course name = ". $_POST['course_name'] . " And " . " course year = " . $_POST['course_year'];
          $courseId = $course->assign_course($_POST['course_name'], $_POST['course_year']);
         // $courseId = $course->getCurrentId($_POST['course_name'], $_POST['course_year']); //fetch course id 
      }
      
      if($_POST['mod_code1'] != "" && $_POST['mod_name1'] != ""){
        $moduleId = $module->assign_Modules($_POST['mod_code1'], $_POST['mod_name1']);//insert value to modules   
        $course->course_module($courseId, $moduleId);//insert data to relationship      
      }

      if($_POST['mod_code2'] != "" && $_POST['mod_name2'] != ""){
        $moduleId=$module->assign_Modules($_POST['mod_code2'], $_POST['mod_name2']);//insert value to modules
        $course->course_module($courseId, $moduleId); //module owned by course.
      }

      if($_POST['mod_code3'] != "" && $_POST['mod_name3'] != ""){
        $moduleId=$module->assign_Modules($_POST['mod_code3'], $_POST['mod_name3']);//insert value to modules
        $course->course_module($courseId, $moduleId); //module owned by course.
      }

      if($_POST['mod_code4'] != "" && $_POST['mod_name4'] != ""){
        $moduleId = $module->assign_Modules($_POST['mod_code4'], $_POST['mod_name4']);//insert value to modules
        $course->course_module($courseId, $moduleId); //module owned by course.
      }

      if($_POST['mod_code5'] != "" && $_POST['mod_name5'] != ""){
        $moduleId=$module->assign_Modules($_POST['mod_code5'], $_POST['mod_name5']);//insert value to modules
        $course->course_module($courseId, $moduleId); //module owned by course.
      }

     if($_POST['mod_code6'] != "" && $_POST['mod_name6'] != ""){
        $moduleId=$module->assign_Modules($_POST['mod_code6'], $_POST['mod_name6']);//insert value to modules
        $course->course_module($courseId, $moduleId); //module owned by course.
      }    
    if($_POST['stReg'] != "" || $_POST['stFname'] != "" || $_POST['stLname'] != "" || $_POST['stCourse'] != ""){

        $studentId= $reg->register_student( $_POST['stFname'], $_POST['stLname'], $_POST['stReg']);
        $course->student_course($studentId,$_POST['stCourse']);
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

<a href="javascript:void(0)" onclick="myFunction()" class="w3-button w3-bar-item w3-hide-large w3-hover-white w3-hide-medium w3-right"><i class="material-icons w3-large">menu</i></a>

<!--home btn -->
<a href="" class="w3-bar-item w3-button w3-white w3-hover-white "><i class="material-icons w3-margin-right w3-large ">home</i>Home</a>
<!--end home btn -->

<!-- attendance btn -->
<a href="" class="w3-bar-item w3-button w3-hover-white w3-hide-small"> <i class="material-icons w3-margin-right w3-large">assignment</i>Attandance</a>
<!--end attendance btn -->

<!-- attendance btn -->
<a href="" class="w3-bar-item w3-hover-white w3-animate w3-zoom w3-hide-small"> <i class="material-icons w3-margin-right w3-large">assignment</i>  <?php echo $course->course_err(); ?> </a>
<!--end attendance btn -->

<!--logout btn -->
<a href="logout.php" class="w3-bar-item w3-button w3-hover-white w3-right w3-hide-small"> Logout <i class="material-icons w3-margin-left w3-large ">exit_to_app</i></a>
<!--end logout -->

</div><!-- end Menu -->

                            <!--         SMALL SIZED BAR  -->
<div class="w3-bar-block w3-theme-b5 w3-hide w3-hide-medium w3-hide-large " id="navigation">

<!-- attendance btn -->
<a href="" class="w3-bar-item  w3-hover-white "> <i class="material-icons w3-margin-right w3-large">assignment</i><?php echo $course->course_err(); ?></a>
<!--end attendance btn -->

<!--logout btn -->
<a href="logout.php" class="w3-button w3-hover-white w3-right w3-border w3-border-"> Logout <i class="material-icons w3-margin-left w3-large ">exit_to_app</i></a>
<!--end logout -->
</div><!-- end Menu -->
                             <!--         SMALL SIZED BAR  -->

 <div class="w3-container w3-margin-top ">
  
  
      <div class="w3-row">

        <div class="w3-col l3 ">

        <div class="w3-container w3-margin-bottom"><!--container profile -->
          <img src="image/avat-profile.jpg" alt="profile" style="width:100%;" class="w3-image">
          <div class="w3-container w3-card-2 w3-center">
            <h3><b> <?php echo $reg->getName();?></b></h3>
          </div>

        <div class="w3-container w3-text-blue w3-border">
          <p><i class="material-icons w3-margin-right">work</i> <?php echo $reg->getOccupation(); ?> </p>
          <p><i class="material-icons w3-margin-right">mail</i> <?php echo $reg->getEmail(); ?> </p>
          <p><i class="material-icons w3-margin-right">phone</i> <?php echo $reg->getPhone(); ?></p>
        </div>
        </div><!-- /container profile -->

     </div> <!--/col -->

    <div class="w3-col l9 ">
    <div class="w3-container">

       <div class="w3-bar"><!--bar -->
          <div class="w3-bar-item w3-button w3-hover-white tablink w3-theme w3-card-2" onclick="openNav(event,'student1');">Student</div>
          <div class="w3-bar-item w3-button w3-hover-white tablink " onclick="openNav(event,'course1');">Courses and Modules </div>
       </div> <!--end bar -->

       <!--  STUDENT FORM -->
       <div class="container-one w3-container w3-card-2 w3-padding w3-border w3-border-blue w3-text-blue" id="student1"><!-- container form -->
            <form action="" method="POST" class="w3-content">
               <h4 class="w3-center">Student registration</h4>
                   <div class="w3-section">
                   <input type="text" class="w3-input" name="stReg" placeholder="Student Registration number ">
               </div>
               <div class="w3-section">
                   <input type="text" class="w3-input" name="stFname" placeholder="First Name">
               </div>
               <div class="w3-section">
                   <input type="text" class="w3-input" name="stLname" placeholder="Last Name">
               </div>
              
               <div class="w3-section w3-mobile w3-green">
             

                   <select name="stCourse" id="" class="w3-select">
                   <option value="" disabled selected>course in which a student study </option>
                     <?php  
                           $data= $course->courseData();
                           $l = $course->length_course();
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

               <div>
                  <input type="submit" class="w3-button w3-border w3-round-xxlarge w3-right" value="Save">
               </div>
              
            
         </div><!-- /container form -->
          <!--  END STUDENT FORM -->

                       <!--  COURSE FORM -->
         <div class="container-one w3-container w3-card-2 w3-padding w3-border w3-border-blue w3-text-blue" id="course1" style="display: none;"><!-- container form -->
            
               <h4 class="w3-center">Enter course and it's modules.</h4>
                   <div class="w3-section">
                   <input type="text" class="w3-input" name="course_name" placeholder="Course Name">
               </div>
                <div class="w3-section w3-mobile" style="width:30%;">
                   <select name="course_year" id="" class="w3-select">
                   <option value="" disabled selected>Year of course</option>
                      <option value="1">year 1</option>
                      <option value="2">year 2</option>
                      <option value="3">year 3</option>
                   </select>
               </div>
               <!--modules -->
               <div class="w3-row-padding">
               <div class="w3-half"> <input type="text" class="w3-input" name="mod_code1" placeholder="Module code"> </div>
               <div class="w3-half"> <input type="text" class="w3-input" name="mod_name1" placeholder="Module name"> </div>
               </div>
               <div class="w3-row-padding">
               <div class="w3-half"> <input type="text" class="w3-input" name="mod_name2" placeholder="Module code"> </div>
               <div class="w3-half"> <input type="text" class="w3-input" name="mod_code2" placeholder="Module name"> </div>
               </div>
               <div class="w3-row-padding">
               <div class="w3-half"> <input type="text" class="w3-input" name="mod_code3" placeholder="Module code"> </div>
               <div class="w3-half"> <input type="text" class="w3-input" name="mod_name3" placeholder="Module name"> </div>
               </div>
               <div class="w3-row-padding">
               <div class="w3-half"> <input type="text" class="w3-input" name="mod_code4" placeholder="Module code"> </div>
               <div class="w3-half"> <input type="text" class="w3-input" name="mod_name4" placeholder="Module name"> </div>
               </div>
               <div class="w3-row-padding">
               <div class="w3-half"> <input type="text" class="w3-input" name="mod_code5" placeholder="Module code"> </div>
               <div class="w3-half"> <input type="text" class="w3-input" name="mod_name5" placeholder="Module name"> </div>
               </div>
               <div class="w3-row-padding w3-section">
               <div class="w3-half"> <input type="text" class="w3-input" name="mod_code6" placeholder="Module code"> </div>
               <div class="w3-half"> <input type="text" class="w3-input" name="mod_name6" placeholder="Module name"> </div>
               </div>
               <!-- /modules -->
              <div>
                  <button type="submit" class="w3-button w3-border w3-round-xxlarge w3-right">save</button>
              </div>
              
            </form>
         </div><!-- /container form -->
                        <!-- END COURSE FORM -->

       
      </div>  <!-- /container -->       
      </div><!--/threequarter -->
</div><!-- /container -->
          
     <div class="w3-main"><!--content main -->
     
     
          
     </div><!-- /content main -->

    </div><!-- /col -->
  </div><!-- /row -->

    
</div><!-- /container -->

   <!-- replace -->


<footer class="w3-container w3-theme w3-margin-top">
 <p class="w3-padding"> <i class="material-icons">copyright</i> Institute of finance management</p>
</footer><!-- end footer -->
  
<script type="text/javascript">

//navigation bar..
 function openNav(evt, action){
   var i, x, tablink;
   x = document.getElementsByClassName("container-one");

   for(i=0; i< x.length; i++){
      x[i].style.display = "none";
   }
   tablink = document.getElementsByClassName("tablink");

   for(i=0; i<x.length; i++){
      tablink[i].className = tablink[i].className.replace(" w3-theme w3-card-2", " ");
   }
  
   document.getElementById(action).style.display = "block";
   evt.currentTarget.className+= "w3-theme w3-card-2";

 }


function myFunction(){ //dealing with navigation bar
  var x = document.getElementById("navigation");
     if(x.className.indexOf("w3-show") == -1){
        x.className += " w3-show ";
      }else{
          x.className = x.className.replace(" w3-show ", " ");
      }
    
}//end myFunction

</script>

</body>
</html>