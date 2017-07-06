<?php 
session_start();
   if($_SESSION['Login'] != TRUE){
    header("location:index.php");
   }
 include "config.php";
 include "users.php";

   $lectur = new User();


   $_SESSION['modOne'] ="";
   
   $lectur->getLectureDetail($lectur->get_usrID());

   $lectureCourse = $lectur->courseR($lectur->get_usrID());
   
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
<a href="" class="w3-bar-item w3-white w3-button w3-hover-white "><i class="material-icons w3-margin-right w3-large ">home</i>Home</a>
<!--end home btn -->

<!-- attendance btn -->
<a href="" class="w3-bar-item w3-button w3-hover-white w3-hide-small"> <i class="material-icons w3-margin-right w3-large">assignment</i>Attandance</a>
<!--end attendance btn -->

<!--logout btn -->
<a href="logout.php" class="w3-bar-item w3-button w3-hover-white w3-right w3-hide-small"> Logout <i class="material-icons w3-margin-left w3-large ">exit_to_app</i></a>
<!--end logout -->

</div><!-- end Menu -->

                            <!--         SMALL SIZED BAR  -->
<div class="w3-bar-block w3-theme-b5 w3-hide w3-hide-large w3-hide-medium " id="navigation">

<!-- attendance btn -->
<a href="" class="w3-bar-item  w3-button w3-hover-white "> <i class="material-icons w3-margin-right w3-large">assignment</i>Attandance</a>
<!--end attendance btn -->

<!--logout btn -->
<a href="logout.php" class="w3-button w3-hover-white w3-right w3-border w3-border-"> Logout <i class="material-icons w3-margin-left w3-large ">exit_to_app</i></a>
<!--end logout -->
</div><!-- end Menu -->
                             <!--         SMALL SIZED BAR  -->



<div class="w3-container w3-margin-top ">
	
	
      <div class="w3-row">

        <div class="w3-col l3 ">

        <div class="w3-margin-bottom "> <!-- profile main -->
        <div class="w3-container"><!--container profile -->
          <img src="image/avat-profile.jpg" alt="profile" style="width:100%;" class="w3-image">
          <div class="w3-container w3-card-2 w3-center">
            <h4><b> <?php echo $lectur->getName(); ?></b></h4>
          </div>
        
        <div class="w3-container w3-text-blue w3-border">
          <p><i class="material-icons w3-margin-right">work</i> <?php echo $lectur->getOccupation();?></p>
          <p><i class="material-icons w3-margin-right">mail</i><?php echo $lectur->getEmail(); ?></p>
          <p><i class="material-icons w3-margin-right">phone</i><?php echo $lectur->getPhone(); ?></p>
        </div>
        </div><!-- /container profile -->

      </div> <!-- /profile main -->
     </div> <!--/col -->

    <div class="w3-col l9 ">
          
     <div class="w3-main"><!--content main -->
     <div class="w3-center"><p class="w3-text-blue"><b>Course and modules </b></p></div>
            <!-- GRIDS CARDS  -->
       <div class="w3-row-padding">
        <!-- one item -->
        <?php 
            $course_name = "";
            $Course_id = "";
            $course_year = "";

        for ($i=0; $i < $lectur->returnSize(); $i++) { 
          # code...
            for ($y=0; $y <4 ; $y++) { 
                if($y == 0){
                  $Course_id =$lectureCourse[$i][$y];
                }
                  if($y==1){
                    $course_name =$lectureCourse[$i][$y];
                  }
                  
                  if($y==2){
                    $course_year=$lectureCourse[$i][$y];
                  }
                 
            }

            echo '<div class="w3-third w3-center">
                     <div class="w3-container w3-blue">
                        <i class="material-icons w3-jumbo w3-text-center">school</i>
                        <p>';
             echo $course_name;
             echo '<span class="w3-tag w3-yellow w3-margin-left">';
              echo 'year '.$course_year;
              echo '</span></p>
                     </div><div class="w3-container w3-theme-b6 w3-card-4">
                             <h3></h3>
                            </div><div class="w3-container w3-bottombar">
                     <ul class="w3-ul">';
                      $mod = $lectur->moduleR($_SESSION['uid']);
                      //var_dump($mod);
                      if($mod != ""){
                               $z=0;
                             foreach($mod as $d) {
                                 $modz[$z] = $d;
                        echo ' <li>
                              <i class="material-icons w3-large w3-margin-right ">local_library</i>
                              <a href="attendance.php?mod='.$Course_id.'" class="w3-button w3-border w3-border-blue "> '. 
                              $d .'</a>
                        </li>';
                          $z++;
                      }
                        $_SESSION['modOne'] = $modz;
                      } //end if

                       echo '
                      </ul>
                    </div>
                   </div>';
}
 ?>
                    
                   <!-- end one item -->   
       </div>
           <!-- GRIDS CARDS -->
     </div><!-- /content main -->
    </div><!-- /col -->
  </div><!-- /row -->

		
</div><!-- /container -->


<div class="w3-container w3-theme w3-margin-top"><!-- footer -->

 <p class="w3-padding"> <i class="material-icons ">copyright</i> Institute of finance management</p>
	
</div><!-- end footer -->

<script type="text/javascript">

function myFunction(){
  var x = document.getElementById("navigation");
     if(x.className.indexOf("w3-show") == -1){
        x.className += " w3-show ";
      }else{
          x.className = x.className.replace(" w3-show ", " ");
      }
    
}

</script>

</body>
</html>