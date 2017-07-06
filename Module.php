<?php 
     include "config.php";
  /**
  * 
  */
  class Module 
  {
  	  public $dbase = "";
  	  private $module_name ="";
  	  private $module_code ="";
  	  private $moduleMessg = "";
      private $selected_data = 0;

  	     public function __construct(){
             $this->dbase= new mysqli(DB_SERVER, DB_USERNAME, DB_PASS, DB_NAME);
             if($this->dbase->connect_error){
             	echo "Fail connect to database" .connect_error;
             	exit;
             }
         }//end db_construction

         public function assign_Modules($modCod, $modName){
         	$moduleId = "";
           if($modCod == "" || $modName == ""){
             $modCod == "" ? $this->moduleMessg = "You didn't enter the module code" : $this->moduleMessg ="You didn't enter the Module name" ;
           }else{
           	//$modCod =varidate_input($modCod);
           	//$modName = varidate_input($modName);
           	
           	$sql = "SELECT Mid FROM module WHERE Name = '$modName' OR Moduel_code = '$modCod' ";
     	    $result = $this->dbase->query($sql);
         	   if($result->num_rows == 1){
         	   	     $row = $result->fetch_assoc();
         	   	     $moduleId = $row['Mid'];
                     $this->moduleMessg ="The moudule you trying to Enter is already exist.";
         	   }else{
     	   	//insert values on course table.
         	   	//$sql1 = "INSERT INTO module values( Name= '$modName' , Moduel_code = '$modCod')";
         	   	$tmt = $this->dbase->prepare("INSERT INTO module(Name, Moduel_code) VALUES(?,?)");
         	   	$tmt->bind_param("ss", $nam, $cod);
         	   	$nam = $modName;
         	   	$cod = $modCod;
         	   	$tmt->execute(); 

         	    $moduleId = $this->dbase->insert_id;		
     	     }   
     	   }
     	   return $moduleId;
         } //end assign_Modules()

public function module_err(){
	return $this->moduleMessg;
}

public function find_modules($courseId){
  $sel = "select module.Mid, module.name, module.Moduel_code from module,course,course_module where module.Mid = course_module.Mid and course.Cid = course_module.Cid and course.Cid = $courseId";
  $result= $this->dbase->query($sel);
  $large = $result->num_rows ;
  $this->selected_data = $large;

    if($large > 0 ){  
    
        //output data of each row
        for ($i=0; $i < $large; $i++) { 
            $z = 0;
            $Row = $result->fetch_assoc();
            for ($y=0; $y<3; $y++) { 
                
                if($z == 0){ $module[$i][$y] = $Row['Mid'];}
                if($z == 1){ $module[$i][$y]= $Row['name'];}
                if($z == 2){ $module[$i][$y]= $Row['Moduel_code'];}
               $z++;
            }
            
        }
         return $module;  
        
  }
     
}

public function result_row(){
  return $this->selected_data; //return size of selected data..
}

public function find_modcode($coursId){
  $q = "SELECT Name FROM course WHERE course.Cid = '$coursId'";
  $result = $this->dbase->query($q);
  $data = $result->fetch_assoc();
  return $data['Name'];
}
        
         //validate inputs
         public function varidate_input($data){
             $data = trim($data);
             $data = stripslashes($data);
             $data = htmlspecialchars($data);
             return $data;
         }
public function lecture_module($lid, $mid){ //realationship btn lecturer and course.
        if($lid == "" && $mid == ""){
            $this->moduleMessg ="Relationship fail created.";
          }else{
             //check whether course is available before insert details in courses
           $sql = "SELECT id FROM lecture_module WHERE Lid= '$lid' AND Mid = '$mid' ";
           $result = $this->dbase->query($sql1);
           if($result->num_rows == 1){
              $this->moduleMessg = "The course you are trying to Enter is arleady exist.";
           }else{
            //insert values on course table.
            $tmt = $this->dbase->prepare("INSERT INTO lecture_module(Lid, Mid) VALUES (?,?)");
            $tmt->bind_param("ii", $LiD, $MiD);
            $LiD = $lid;
            $MiD = $mid;
            $tmt->execute();
           }
           $tmt->close();
          }
     }


    
    //close database connection 
        // $this->dbase->close();
  }//end class


 ?>