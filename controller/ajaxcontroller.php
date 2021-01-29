<?php 
if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include_once '../database/database.php';

 // if ($_POST['req_type'] == 'datasubmit') {
	 // print_r($_FILES);
	
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $pwd = $_POST['pwd'];
  $file = $_FILES['file'];

  $filename = $_FILES['file']['name'];
           $ftemppath = $_FILES['file']['tmp_name'];
            $sourcepath = $db->rootpath . 'uploads' . $db->slash ;
            if ($filename = $db->fileUpload($ftemppath, $sourcepath, $fname, pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION))) {
                $img = 'uploads/' . $filename;
				
            }
  // $file->move('/uploads/',$file);
  $pdf = $filename;
 
  $email = $_POST['email'];
  $gender = $_POST['gender'];
  
 // $sql = 'insert into multifrom ("firstname","lastname","password","pdf","email","gender") values("$fname","$lname","$pwd","$pdf","$email","$gender")';
 // mysqli_query($con,$sql);
 $response = $db->insertData("userdata", array("first_name" => $fname, "last_name" => $lname,"password" => $pwd,"pdf" => $pdf,"email" => $email,"gender"=>$gender));
            // $response['status'] = 1;
			
			 echo json_encode($response);

 // }
    ?>