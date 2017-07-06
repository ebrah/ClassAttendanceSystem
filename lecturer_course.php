<?php 
session_start();
  if($_SESSION['Login'] != TRUE){
    header("location:index.php");
   }
     include "Module.php";

     $mod = new Module();

     if($_SERVER['REQUEST_METHOD'] == 'POST'){
          if($_POST['cmodule'] != ""){
             foreach($_POST['cmodule'] as $module) {
              $mod->lecture_module($_SESSION['lecture_id'],$module);
            }
          } 
          header("location:index.php"); 
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
<p class="w3-xlarge w3-"><b>Select modules in diffent courses</b></p>
</div><!-- end Menu -->

<div class="w3-content">
            
            <div class="w3-row-padding">
             <form action="" method="POST">
              <div class="w3-third w3-padding">
              <p><?php 
                    if($_SESSION['CORS1'] != 0){
                      echo $mod->find_modcode($_SESSION['CORS1']);
                    }
               ?></p>
              <ul class="w3-ul w3-yellow">
                  <?php 
                      if($_SESSION['CORS1'] != 0){
                        $modules = $mod->find_modules($_SESSION['CORS1']);
                        $size = $mod->result_row();
                        for ($i=0; $i < $size; $i++) { 
                             echo '<li> <input name ="cmodule[]" type="checkbox" value="';
                           for ($y=0; $y < 3; $y++) { 
                             if($y==0){
                                 echo $modules[$i][$y] .'"> <span class="w3-margin-right">';
                             }
                             if($y==1){
                              echo $modules[$i][$y];
                             }
                             if($y==2){
                              echo  $modules[$i][$y] .'</span></li>';                
                            }

                           }
                        }
                      }
                   ?>
                 
                </ul>
              </div>
                <div class="w3-third w3-padding">
             <p><?php 
                    if($_SESSION['CORS2'] != 0){
                      echo $mod->find_modcode($_SESSION['CORS1']);
                    }
               ?></p>
              <ul class="w3-ul w3-yellow">
                   <?php 
                      if($_SESSION['CORS2'] != 0){
                        $modules = $mod->find_modules($_SESSION['CORS2']);
                        $size = $mod->result_row();
                        for ($i=0; $i < $size; $i++) { 
                           echo '<li> <input name ="cmodule[]" type="checkbox" value="';
                           for ($y=0; $y < 3 ; $y++) { 
                             if($y==0){
                              echo $modules[$i][$y] .'"> <span class="w3-margin-right">';
                             }
                             if($y==1){
                              echo $modules[$i][$y];
                             }
                             if($y==2){
                              echo ' ' . $modules[$i][$y] .'</span></li>';                
                            }

                           }
                        }
                      }
                   ?>
                  
                </ul>
              </div>

               <?php $modules = $mod->find_modules($_SESSION['CORS3']);
                     print_r($modules);
                ?>
              <div class="w3-third w3-padding">
              <p><?php 
                    if($_SESSION['CORS3'] != 0){
                      echo $mod->find_modcode($_SESSION['CORS3']);
                    }
               ?></p>
              
              <ul class="w3-ul w3-yellow">
                  <?php 
                      if($_SESSION['CORS3'] != 0){
                        $modules = $mod->find_modules($_SESSION['CORS3']);
                        $size = $mod->result_row();
                        for ($i=0; $i < $size; $i++) { 
                           echo '<li> <input name ="cmodule[]" ';
                           for ($y=0; $y < 3 ; $y++) { 
                             if($y==0){
                              echo 'type="checkbox" value="'.$modules[$i][$y] .'"> <span class="w3-margin-right">';
                             }
                             if($y==1){
                              echo $modules[$i][$y];
                             }
                             if($y==2){
                              echo ' ' . $modules[$i][$y] .'</span></li>';                
                            }

                           }
                        }
                      }
                   ?>
                 
                </ul>
              </div>
               <div class=" w3-section">
                 <input type="submit" class="w3-button w3-border w3-round-xxlarge w3-right" value="Save">
               </div>
             </form>

         </div>
</div>



<footer class="w3-container w3-theme w3-margin-top">

 <p class="w3-padding"> <i class="material-icons">copyright</i> Institute of finance management</p>
	
</footer><!-- end footer -->


  
<script type="text/javascript">

</script>

</body>
</html