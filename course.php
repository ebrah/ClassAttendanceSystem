<?php 
     /**
     *  dealing with course details
     */
     class Course 
     {
     	
     
     public $dbase;
     private $course_name ="";
     private $course_year ="";
     private $courseMessag= "";
     private $last_data = 0;


      public function __construct(){
             $this->dbase= new mysqli(DB_SERVER, DB_USERNAME, DB_PASS, DB_NAME);
             if($this->dbase->connect_error){
             	echo "Fail connect to database" .connect_error;
             	exit;
             }
         }//end db_construction

     public function assign_course($cnam, $cyear){
     	  $courseId ="";
          if($cnam == "" || $cyear == ""){
           $cnam == "" ? $this->courseMessag = "Course name required !" : $this->courseMessag = " course Year required !" ;
          }else{
          	//$cnam  = varidate_input($cnam);
          	//$cyear = varidate_input($cyear);
          	 //check whether course is available before insert details in courses
     	   $sql = "SELECT Cid FROM course WHERE Name = '$cnam' OR Year = '$cyear' ";
     	   $result = $this->dbase->query($sql);
     	   if($result->num_rows == 1){
     	   	  $row = $result->fetch_assoc();
     	   	  $courseId = $row['Cid'];
              $this->courseMessag = "The course you are trying to Enter is arleady exist.";

     	   }else{
     	   	//insert values on course table.
     	   	$stmt = $this->dbase->prepare("INSERT INTO course(Name, Year ) VALUES(?,?)");
     	   	$stmt->bind_param("si", $Nam, $Year);
     	   	$Nam = $cnam;
     	   	$Year = $cyear;
     	   	$stmt->execute();
     	   	$courseId = $this->dbase->insert_id; 
          $this->courseMessag = "successfuly course Entered.";
     	   }
     	  
          }

          return $courseId;

     }//end assign_course

     public function course_module($Cid, $Mid){
     	if($Cid == "" && $Mid == ""){
            $this->courseMessag ="Relationship fail created.";
          }else{
          	 //check whether course is available before insert details in courses
     	   $sql1 = "SELECT id FROM course_module WHERE Cid= '$Cid' AND Mid = '$Mid' ";
     	   $result = $this->dbase->query($sql1);
     	   if($result->num_rows == 1){
              $this->courseMessag = "The course you are trying to Enter is arleady exist.";
     	   }else{
     	   	//insert values on course table.
     	   	$tmt = $this->dbase->prepare("INSERT IGNORE INTO course_module (Cid, Mid) VALUES (?,?)");
     	   	$tmt->bind_param("ii", $cid, $mid);
     	   	$cid = $Cid;
     	   	$mid = $Mid;
     	   	$tmt->execute();
          $tmt->close();
          $this->courseMessag = "Course and Modules succeded entered.";
     	   }
     	   
          }
     }

        public function student_course($Sid, $Cid){ //realation ship course and students.
        if($Sid == "" && $Cid == ""){
            $this->courseMessag ="Relationship fail created.";
          }else{
             //check whether course is available before insert details in courses
           $sql1 = "SELECT id FROM Student_course WHERE Sid= '$Sid' AND Cid = '$Cid' ";
           $result = $this->dbase->query($sql1);
           if($result->num_rows == 1){
              $this->courseMessag = "The course you are trying to Enter is arleady exist.";
           }else{
            //insert values on course table.
            $tmt = $this->dbase->prepare("INSERT INTO Student_course(Sid, Cid) VALUES (?,?)");
            $tmt->bind_param("ii", $sid, $cid);
            $sid = $Sid;
            $cid = $Cid;
            $tmt->execute();
            $this->courseMessag = "Student record and course succeded recorded in the system.";
           }
           $tmt->close();
          }
     }
        public function lecture_course($lid, $cid){ //realationship btn lecturer and course.
        if($lid == "" && $cid == ""){
            $this->courseMessag ="Relationship fail created.";
          }else{
             //check whether course is available before insert details in courses
           $sql1 = "SELECT id FROM lecture_course WHERE Lid= '$lid' AND Cid = '$cid' ";
           $result = $this->dbase->query($sql1);
           if($result->num_rows == 1){
              $courseMessag = "The course you are trying to Enter is arleady exist.";
           }else{
            //insert values on course table.
            $tmt = $this->dbase->prepare("INSERT INTO lecture_course(Lid, Cid) VALUES (?,?)");
            $tmt->bind_param("ii", $LID, $CID);
            $LID = $lid;
            $CID = $cid;
            $tmt->execute();
            $tmt->close();
            $this->courseMessag = "Lecturer record and course were successfuly entered.";
           }
           
          }
     }

     public function course_err(){
     	return $this->courseMessag;
     }
public function courseData(){
	$quer = "SELECT Cid, Name, Year FROM course";
	$result= $this->dbase->query($quer);
	$large = $result->num_rows ;
    $this->last_data = $large;
    if($large>0){

        //output data of each row
        for ($i=0; $i < $large; $i++) { 
            $z = 0;
            $Row = $result->fetch_assoc();
            for ($y=0; $y < 3; $y++) { 
                
                if($z == 0){ $data[$i][$y] = $Row['Cid'];}
                if($z == 1){ $data[$i][$y]= $Row['Name'];}
                if($z == 2){$data[$i][$y]= $Row['Year'];}
               $z++;
            }
            
        }
       
	}
    

     return $data;
}
public function length_course(){
      return $this->last_data;
}

         //validate inputs
     public function varidate_input($data){
             $data = trim($data);
             $data = stripslashes($data);
             $data = htmlspecialchars($data);
             return $data;
      }

     //public function setCourseDetail(){}


         //close connection
      //   $this->dbase->close();

     }//end course

 
 ?>