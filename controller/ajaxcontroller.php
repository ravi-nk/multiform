<?php 
if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include_once '../database/database.php';

 if ($_POST['req_type'] == 'datasubmit') {
   // print_r($_POST);die;
   
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $pwd = $_POST['pwd'];
  $file = $_POST['file'];
 
  // $filename = $file->getClientOriginalName();
  // $file->move('/uploads/',$file);
  $pdf = $file;
 
  $email = $_POST['email'];
  $gender = $_POST['gender'];
  
 // $sql = 'insert into multifrom ("firstname","lastname","password","pdf","email","gender") values("$fname","$lname","$pwd","$pdf","$email","$gender")';
 // mysqli_query($con,$sql);
 $response = $db->insertData("userdata", array("first_name" => $fname, "last_name" => $lname,"password" => $pwd,"pdf" => $pdf,"email" => $email,"gender"=>$gender));
            // $response['status'] = 1;
			
			 echo json_encode($response);

 }
    ?>