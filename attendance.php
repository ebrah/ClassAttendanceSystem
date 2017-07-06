<?php 
   session_start();
   include "config.php";
   include "users.php";
   if(!$_SESSION['Login']){
       header("location:index.php");
   }
   $usr = new User();
   $usr->getLectureDetail($usr->get_usrID());
   $students=$usr->retrieve_students($_GET['mod']);//RETRIVE STUDENTS..
   $std_r = $usr->students_r();

 // echo $_GET['mod'];
   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      if(!empty($_POST['Stud'])){
        function fetch_dat(){
          $put = "";
          foreach ($_POST['Stud'] as $s) {
           
           $put .=" <tr><td>" . $s . "</td></tr>";
           }
           return $put;
        }
      

        require_once "tcpdf/tcpdf.php";
        ob_start();
        $obj_tcp = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $obj_tcp->SetCreator(PDF_CREATOR);
        $obj_tcp->SetTitle("PRESENT STUDENTS");
        $obj_tcp->SetHeaderData('','',PDF_HEADER_TITLE,PDF_HEADER_STRING);
        $obj_tcp->SetHeaderFont(Array(PDF_FONT_NAME_MAIN,'', PDF_FONT_SIZE_MAIN));
        $obj_tcp->SetFooterFont(Array(PDF_FONT_NAME_DATA,'', PDF_FONT_SIZE_DATA));
        $obj_tcp->SetDefaultMonospacedFont('helvetica');
        $obj_tcp->SetFooterMargin(PDF_MARGIN_FOOTER);
        $obj_tcp->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
        $obj_tcp->SetPrintHeader(false);
        $obj_tcp->SetPrintFooter(false);
        $obj_tcp->SetAutoPageBreak(TRUE, 10);
        $obj_tcp->SetFont('helvetica', ' ', 12);

        $content = ' ';
        $content .='<table class="w3-table w3-border">
               <tr> <th> <b> PRESENT STUDENTS </b> </th> </tr>
               <tr>
                 <th> Names</th>
 
                 </tr>';

          $content .= fetch_dat();
          $content .= '</table>';
          $obj_tcp->addPage();
          $obj_tcp->writeHTML($content);
          $obj_tcp->Output("sample.pdf","I");
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
<a href="home.php" class="w3-bar-item w3-button w3-hover-white "><i class="material-icons w3-margin-right w3-large ">home</i>Home</a>
<!--end home btn -->

<!-- attendance btn -->
<a href="" class="w3-bar-item w3-white w3-button w3-hover-white w3-hide-small"> <i class="material-icons w3-margin-right w3-large">assignment</i>Attandance</a>
<!--end attendance btn -->

<!--logout btn -->
<a href="logout.php" class="w3-bar-item w3-button w3-hover-white w3-right w3-hide-small"> Logout <i class="material-icons w3-margin-left w3-large ">exit_to_app</i></a>
<!--end logout -->

</div><!-- end Menu -->

                            <!--         SMALL SIZED BAR  -->
<div class="w3-bar-block w3-theme-b5 w3-hide w3-hide-medium w3-hide-large" id="navigation">

<!-- attendance btn -->
<a href="" class="w3-bar-item w3-white w3-button w3-hover-white "> <i class="material-icons w3-margin-right w3-large">assignment</i>Attandance</a>
<!--end attendance btn -->

<!--logout btn -->
<a href="logout.php" class="w3-button w3-hover-white w3-right w3-border w3-border-">Logout <i class="material-icons w3-margin-left w3-large ">exit_to_app</i></a>
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
            <h3><b> <?php echo $usr->getName(); ?></b></h3>
          </div>
        
        <div class="w3-container w3-text-blue w3-border">
          <p><i class="material-icons w3-margin-right">work</i> <?php echo $usr->getOccupation(); ?></p>
          <p><i class="material-icons w3-margin-right">mail</i><?php echo $usr->getEmail(); ?></p>
          <p><i class="material-icons w3-margin-right">phone</i><?php echo $usr->getPhone(); ?></p>
        </div>
        </div><!-- /container profile -->

      </div> <!-- /profile main -->
     </div> <!--/col -->

    <div class="w3-col l9 ">
          
     <div class="w3-main"><!--content main -->
    
    <div class="w3-white">
            <form action="" method="POST">
            <div class="w3-container  w3-table-theme ">
               <p id="date" name="Stud[]" ></p>
               <p name="Stud[]">Module Code: 07877, Module Name: Software Engineering.</p>
            </div>
             <div class="w3-container w3-thead-theme w3-center">
               <p><b>Students Names and Registration number</b></p>
             </div>
                 
                  <?php 
                       $fname;
                       $lname;
                       $regno;

                      echo '<ul class="w3-ul"> ';
                      for ($i=0; $i < $std_r; $i++) { 
                        # code...
                          
                        for ($y=0; $y < 3 ; $y++) { 
                          # code...          
                            if($y==0){ $fname = $students[$i][$y];} 
                            if($y==1){ $lname = $students[$i][$y];} 
                            if($y==2){ $regno= $students[$i][$y];} 
                        }
                        echo '<li><p> <i class="material-icons w3-margin-right">person</i> <b>'. $fname ."  ". $lname ." </b><i> ". $regno .' </i><input type="checkbox"  class="w3-padding" value="'. $fname ."         ". $lname."          " .  $regno .'" name="Stud[]"> </p></li>' ;

                      }
                        echo '</ul>';
                   ?>
                  
                  <div class="w3-container w3-thead-theme">
                        <input type="submit" class="w3-button w3-right w3-round-xxlarge w3-table-theme w3-hover-white" value="Print">
                  </div>
              
                  </form>

<!-- 
                   <tr>
                     <td> <i class="material-icons">person</i></td>
                      <td>MABAGALA N. MAKENE</td>
                      <td> <input type="checkbox" class="w3-check"> </td>
                   </tr>
                   <tr>
                     <td> <i class="material-icons">person</i></td>
                      <td>UPENDO A. LEMA</td>
                      <td> <input type="checkbox" class="w3-check"> </td>
                   </tr>
                   <tr>
                     <td> <i class="material-icons">person</i></td>
                      <td>MAGESA </td>
                      <td> <input type="checkbox" class="w3-check"> </td>
                   </tr>
                   <tr>
                      <td> <i class="material-icons">person</i></td>
                      <td>DEOGRATIUS S. STEMBELA</td>
                      <td> <input type="checkbox" class="w3-check"> </td>
                   </tr>
                   <tr>
                     <td> <i class="material-icons">person</i></td>
                      <td>MABAGALA N. MAKENE</td>
                      <td> <input type="checkbox" class="w3-check"> </td>
                   </tr>
                   <tr>
                     <td> <i class="material-icons">person</i></td>
                      <td>UPENDO A. LEMA</td>
                      <td> <input type="checkbox" class="w3-check"> </td>
                   </tr>
                   <tr>
                     <td> <i class="material-icons">person</i></td>
                      <td>MAGESA </td>
                      <td> <input type="checkbox" class="w3-check"> </td>
                   </tr>
                </tbody>
               </table> -->
            <!-- <div class="w3-container w3-padding ">
               <button class="w3-button w3-round-xxlarge w3-table-theme w3-hover-white">Save</button>
               <button  class="">Save and Print</button>
            </div>
         </div>    -->

     </div><!-- /content main -->
    </div><!-- /col -->
  </div><!-- /row -->
    
</div><!-- /container -->

		<!--Right colmn -->
		<div class="w3-threequarter ">
         
	   </div><!-- /right colmn -->
</div><!-- /container -->

<footer class="w3-container w3-theme w3-margin-top">
  <p class="w3-padding"> <i class="material-icons">copyright</i> Institute of finance management</p>
</footer><!-- end footer -->

<script>
  
function myFunction(){//dealing with navigation
  var x = document.getElementById("navigation");
     if(x.className.indexOf("w3-show") == -1){
        x.className += " w3-show ";
      }else{
          x.className = x.className.replace(" w3-show ", " ");
      }
    
}//end myFunction

var d = new Date();
document.getElementById('date').innerHTML =  d;
</script>
</body>
</html>