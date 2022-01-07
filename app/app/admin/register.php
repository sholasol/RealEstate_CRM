<?php 
include_once "../connect/connect.php";
if(isset($_POST['save'])){

		    $fn=  check_input($_POST['fname']);
        $ln=  check_input($_POST['lname']);
        //$ph=  check_input($_POST['phone']);
        $em=  check_input($_POST['email']);
        // $pw=  check_input($_POST['password']);
        // $ad=  check_input($_POST['address']);
        
        
        
        
        $dt= date('Y-m-d');
        $user = $uid;
        
        $q1=  dbConnect()->prepare("SELECT count(userID) AS no FROM users WHERE email='$em'");
        $q1->execute();
        $rr=$q1->fetch();
        $no=$rr['no'];
        
        if($no > 0){
        	$response['value'] = 0;
    			$response['message'] = "Oops, Sorry this user already exists";
    			echo json_encode($response);

        }else{

        	$in=dbConnect()->prepare("INSERT INTO users SET fname=:fn, lname=:ln, email=:em");
            $in->bindParam(':fn', $fn);
            $in->bindParam(':ln', $ln);
            $in->bindParam(':em', $em);
            //$in->bindParam(':pw', $pw);
            //$in->bindParam(':dt', $dt);
            if($in->execute()){
            	$response['value'] = 1;
      				$response['message'] = "Great, Your registration is successful";
      				echo json_encode($response);

             }else{
             	$response['value'] = 2;
      				$response['message'] = "Oops, registration failed";
      				echo json_encode($response);
             }


          }
}


function check_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>