<?php 
   //include_once "config.php";
    class User{

    	public $db ="";
    	private $dbMessg = "";
    	private $nameMssgErr = "";
    	private $emailErr = "";
    	private $dbMessgErr = "";
    	private $emptyName = ""; 
    	//user details
    	private $name ="";
    	private $occupation ="";
    	private $phone ="";
    	private $email ="";
      private $row_numbers =0;
      private $student_rows =0;

         public function __construct(){
             $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASS, DB_NAME);
             if($this->db->connect_error){
             	echo "Fail connect to database" .connect_error;
             	exit;
             }
         }//end db_construction


        //user registration
         public function reg_user($fname, $lname, $email,$phon, $occup, $uname, $pwd){
                  if(empty($fname)){
                     $emptyName = $fname;
                  }else{
                  	//$fname = varidate_input($fname);
                  	// if(!reg_match("/^[a-zA-Z ]*$/", $fname)){
                  	// 	$nameMssgErr = "only letter and white space allowed";
                  	// }
                  }

                   if(empty($lname)){
                     //  $emptyName += $lname;
                  }else{
                  	//$lname = varidate_input($lname);
                  }
                   if(empty($email)){
                   	 $emptyName += $email;

                  }else{
                  	//$email = varidate_input($email);
                      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                      $emailErr = "invalid email format";
                    }
                  }
                   if(empty($phon)){
                   	 $emptyName += $phon;

                  }else{
                  //	$phon = varidate_input($phon);
                  }


                  if(empty($occup)){
                     $emptyName += $occup;
                  }else{
                  //	$occup = varidate_input($occup);
                 
                  }
                   if(empty($uname)){
                      $emptyName += $uname;
                  }else{
                  	//$uname = varidate_input($uname);
                  }

                   if(empty($pwd)){
                       $emptyName += $pwd;
                  }else{
                  //	$pwd = varidate_input($pwd);
                  }
             if($occup == 'lecturer'){ //LE
                $sql = "INSERT IGNORE INTO LECTURER(Fname,Lname,Email,phone,Occupation,username, password) values(?,?,?,?,?,?,?)";
                $stmt = $this->db->prepare($sql);
                $stmt->bind_param("sssisss",$F,$L,$E, $P,$O,$U,$p);
                $F=$fname;
                $L=$lname;
                $E=$email;
                $P=$phon;
                $O=$occup;
                $U= $uname;
                $p= $pwd;
                $stmt->execute();
                $lID = $this->db->insert_id;
                $stmt->close();
                return $lID;

             }else{
              $sql = "INSERT IGNORE INTO REGISTRAR(Fname,Sname,Email,Occupation,Phone,username,password)values(?,?,?,?,?,?,?)";
              $stmt = $this->db->prepare($sql);
              $stmt->bind_param("ssssiss",$F,$L,$E, $O,$P,$U,$p);
               $F=$fname;
               $L=$lname;
               $E=$email;
               $O=$occup;
               $P=$phon;
               $U= $uname;
               $p= $pwd;
               $stmt->execute();
               $stmt->close();
               return 0;
             }

            }// edn user_register

              public function check_login($usr, $pwd){

              	  $ql1 = "SELECT DISTINCT id FROM REGISTRAR WHERE USERNAME = '$usr' AND PASSWORD = '$pwd' ";
              	  $ql2 = "SELECT DISTINCT Lid FROM lecturer WHERE username = '$usr' AND password = '$pwd' ";

              	  $result = $this->db->query($ql1);
              	  $user_data = $result->fetch_assoc();
              	  if($result->num_rows == 1){
              	  	//a person exist.
              	  	$_SESSION['Login'] = TRUE;
              	  	$_SESSION['uid'] = $user_data['id'];
              	  	return "registra";

              	  }else{

              	   $result = $this->db->query($ql2);
              	   $user_data = $result->fetch_assoc();
              	   if($result->num_rows == 1){
                  	$_SESSION['Login'] = TRUE;
              	  	$_SESSION['uid'] = $user_data['Lid'];
              	  	return "lecturer";
              	    }

              	  }
                   return FALSE;
              } //end login_check

public function get_session(){
	return $_SESSION['Login'];
}
public function get_usrID(){ return $_SESSION['uid'];}
public function user_logout(){
	$_SESSION['Login'] = FALSE;
    session_destroy(); //destroy all session .
}
                 
         //validate inputs

public function varidate_input($data){
             $data = trim($data);
             $data = stripslashes($data);
             $data = htmlspecialchars($data);
             return $data;
}

public function getUserDetails($usrID){
      $sql = "select distinct Fname, Sname, Email, Occupation, Phone FROM REGISTRAR WHERE id = '$usrID' ";
     

      $result = $this->db->query($sql);
      if($result->num_rows == 1){
      	$usrData = $result->fetch_assoc();
      	//fill user details to instance variables
      	$this->name = $usrData['Fname'] . " " .$usrData['Sname'];
      	$this->email = $usrData['Email'];
      	$this->occupation = $usrData['Occupation'];
      	$this->phone = $usrData['Phone'];
      }

}//end //getUserDetails
public function getLectureDetail($id){
   $sql1 = "select distinct Fname, Lname, Email, Occupation, Phone FROM lecturer WHERE Lid = '$id'";
   
         $result = $this->db->query($sql1);

         if($result->num_rows == 1){
         $Data = $result->fetch_assoc();
        //fill user details to instance variables
         $this->name = $Data['Fname'] . " " .$Data['Lname'];
         $this->email = $Data['Email'];
         $this->occupation = $Data['Occupation'];
         $this->phone = $Data['Phone'];
        }
 
}

public function getName(){
   return $this->name;
}
public function getOccupation(){
   return $this->occupation;
}
public function getPhone(){
   return $this->phone;
}
public function getEmail(){
	return $this->email;
}
  public function setAll_to_null(){
    $this->name ="";
    $this->occupation ="";
    $this->phone ="";
    $this->email ="";
  }
  public function register_student($fname,$lname,$courseID){

    $sql = "INSERT INTO student(Fname, Lname, RegNo) values(?,?,?)";
    $stm = $this->db->prepare($sql);
    $stm->bind_param("sss", $fn, $ln, $r);
    $fn = $fname;
    $ln = $lname;
    $r =  $courseID;
    $stm->execute();

    $std = $this->db->insert_id;//retrive student id
    return $std; 
         
  }//end register_students

  public function courseR($LID){

    $sel = "select distinct course.Cid, course.name, course.year from course, lecture_course, lecturer where course.Cid = lecture_course.Cid and lecture_course.Lid = '$LID'";

  $result= $this->db->query($sel);
  $large = $result->num_rows;
  $this->row_numbers = $large;

    if($large > 0 ){  
    
        //output data of each row
        for ($i=0; $i < $large; $i++) { 
            $z = 0;
            $Row = $result->fetch_assoc();
            for ($y=0; $y<3; $y++) { 
                
                if($z == 0){ $module[$i][$y] = $Row['Cid'];}
                if($z == 1){ $module[$i][$y]= $Row['name'];}
                if($z == 2){ $module[$i][$y]= $Row['year'];}
               $z++;
            }
            
        }
         return $module;  
        
  }

  }//end course R.

  public function returnSize(){
    return $this->row_numbers;
  }
  public function moduleR($lectId){

    $sel = "select module.name from module, lecture_module where module.Mid = lecture_module.Mid and lecture_module.Lid = 
            '$lectId'";

  $result= $this->db->query($sel);
  $large = $result->num_rows ;
  //$this->selected_data = $large;

    if($large > 0 ){  
  
            
            for ($y=0; $y<$large; $y++) { 
                $Row = $result->fetch_assoc();
                $module[$y]= $Row['name']; 
           
            }
            
         return $module;  
        
  }

  }//end moudule R

  //restrve student

  public function retrieve_students($cID){

    $q = "select distinct  Student.Fname, Student.Lname ,Student.RegNo from Student, Student_course, course  where student.Sid = Student_course.Sid and Student_course.Cid = '$cID'";
     $result = $this->db->query($q);
     $r = $result->num_rows;
     $this->student_rows = $r;
     if($r > 0){
        for ($i=0; $i < $r; $i++) { 
          # code...
          $put = $result->fetch_assoc();
          for ($y=0; $y < 3; $y++) { 
            # code...
            if($y==0){  $data[$i][$y] = $put['Fname'];}
            if($y==1){  $data[$i][$y] = $put['Lname'];}
            if($y==2){  $data[$i][$y] = $put['RegNo'];}
            
          }
        }
        return $data;
     }

  } //end retrieve_student
      
public function students_r(){
  return $this->student_rows;
}
    //close database connection 
   // $this->db->close();
  }//end class
 ?>  
