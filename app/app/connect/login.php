<?php
include_once 'connect.php';
session_start();
if(isset($_POST['login'])){
    $em=$_POST['email'];
    if(empty($_POST['email'])){
	 header("Location:../../index?err=" . urlencode("Please fill in your email!")); 
    }
    
    elseif ((!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $em))){
        header("Location:../../index?err=" . urlencode("You have entered invalid email!"));  
       }
 
    $pwd = check_input($_POST["password"]);
    if(empty($_POST['password'])){
	header("Location:../index?err=" . urlencode("Password is required!"));  
	}
    else{
        $email = check_input($_POST["email"]);
        $pwd = check_input($_POST["password"]);
        $sts = "Active";
        $que= dbConnect()->prepare("SELECT * FROM users WHERE email=:email AND status=:status");
        $que->bindParam(':email', $email);
        $que->bindParam(':status', $sts);
        $que->execute();
        if($row=$que->fetch()){
            $role= $row['role'];
            $phash=$row['password'];
            $password = password_verify($pwd, $phash);
            
            if($password){
                $_SESSION['loggedin'] = true;
                $_SESSION["email"] = $row['email']; // setting session
                $_SESSION["id"] = $row['userID'];
                $uid= $row['userID'];
                $nm= $row['fname']." ".$row['lname'];
                
                $in= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='User $nm logged in', created=now()");
                $in->execute();
                 if($role=="Accountant"){
                     
                            echo"
                    <br><br><br><br><br><br><br><br><br>
                    <div style='width:100%;text-align:center;vertical-align:bottom'>
                            <div class='loader'></div>
                            <br>
                            <meta http-equiv='refresh' content='2;url=../index'>
                            <span class='itext' style='color: dimgray;'>Logging in...$nm</span>
                    </div>";
                           // echo  " <script>location.href='../index'</script>";
                       }
                    
                       
                    elseif($role=="HRAdmin"){
                     
                            echo"
                    <br><br><br><br><br><br><br><br><br>
                    <div style='width:100%;text-align:center;vertical-align:bottom'>
                            <div class='loader'></div>
                            <br>
                            <meta http-equiv='refresh' content='2;url=../hrm/index'>
                            <span class='itext' style='color: dimgray;'>Logging in...$nm</span>
                    </div>";
                           // echo  " <script>location.href='../index'</script>";
                       }
                       
                       
                    elseif($role=="HRUser"){
                     
                            echo"
                    <br><br><br><br><br><br><br><br><br>
                    <div style='width:100%;text-align:center;vertical-align:bottom'>
                            <div class='loader'></div>
                            <br>
                            <meta http-equiv='refresh' content='2;url=../hrm/index2'>
                            <span class='itext' style='color: dimgray;'>Logging in...$nm</span>
                    </div>";
                           // echo  " <script>location.href='../index'</script>";
                       }
                       
                       elseif($role=="Admin"){
                     
                            echo"
                            <br><br><br><br><br><br><br><br><br>
                            <div style='width:100%;text-align:center;vertical-align:bottom'>
                                    <div class='loader'></div>
                                    <br>
                                    <meta http-equiv='refresh' content='2;url=../admin/index'>
                                    <span class='itext' style='color: dimgray;'>Logging in...$nm</span>
                            </div>";
                                   // echo  " <script>location.href='../index'</script>";
                       }
                       //Operation Manager
                       elseif($role=="Operation Manager"){
                     
                            echo"
                            <br><br><br><br><br><br><br><br><br>
                            <div style='width:100%;text-align:center;vertical-align:bottom'>
                                    <div class='loader'></div>
                                    <br>
                                    <meta http-equiv='refresh' content='2;url=../operation/index'>
                                    <span class='itext' style='color: dimgray;'>Logging in...$nm</span>
                            </div>";
                                   // echo  " <script>location.href='../index'</script>";
                       }
                       //General Manager
                       elseif($role=="General Manager"){
                     
                            echo"
                            <br><br><br><br><br><br><br><br><br>
                            <div style='width:100%;text-align:center;vertical-align:bottom'>
                                    <div class='loader'></div>
                                    <br>
                                    <meta http-equiv='refresh' content='2;url=../gm/index'>
                                    <span class='itext' style='color: dimgray;'>Logging in...$nm</span>
                            </div>";
                                   // echo  " <script>location.href='../gm/test'</script>";
                       }
                       //Secretary
                        elseif($role=="Secretary"){
                     
                            echo"
                            <br><br><br><br><br><br><br><br><br>
                            <div style='width:100%;text-align:center;vertical-align:bottom'>
                                    <div class='loader'></div>
                                    <br>
                                    <meta http-equiv='refresh' content='2;url=../sec/index'>
                                    <span class='itext' style='color: dimgray;'>Logging in...$nm</span>
                            </div>";
                                   // echo  " <script>location.href='../index'</script>";
                       }
                       
                      // System User 
                    elseif($role=="User"){
                     
                            echo"
                            <br><br><br><br><br><br><br><br><br>
                            <div style='width:100%;text-align:center;vertical-align:bottom'>
                                    <div class='loader'></div>
                                    <br>
                                    <meta http-equiv='refresh' content='2;url=../user/index'>
                                    <span class='itext' style='color: dimgray;'>Logging in...$nm</span>
                            </div>";
                                   // echo  " <script>location.href='../index'</script>";
                       }
                       
                 else{  
                     echo"
                    <br><br><br><br><br><br><br><br><br>
                    <div style='width:100%;text-align:center;vertical-align:bottom'>
                            <div class='loader'></div>
                            <br>
                            <meta http-equiv='refresh' content='1;url=../../index'>
                            <span class='itext' style='color: crimson;'>This user is inactive or does not exists...</span>
                    </div>";
                   }
            }else{  
                echo"
               <br><br><br><br><br><br><br><br><br>
               <div style='width:100%;text-align:center;vertical-align:bottom'>
                       <div class='loader'></div>
                       <br>
                       <meta http-equiv='refresh' content='1;url=../../index'>
                       <span class='itext' style='color: crimson;'>Incorrect Password...try again</span>
               </div>";
              }
        }
        else{
                echo"
                    <br><br><br><br><br><br><br><br><br>
                    <div style='width:100%;text-align:center;vertical-align:bottom'>
                            <div class='loader'></div>
                            <br>
                            <meta http-equiv='refresh' content='1;url=../../index'>
                            <span class='itext' style='color: crimson;'>This user is inactive or does not exists...</span>
                    </div>";
            // header("Location:../../index?err=" . urlencode("This email does not exists!"));
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

<!DOCTYPE html>
<html>
<head>

<style>
.loader {
    border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid blueviolet;
  border-right: 16px solid lightgray;
  border-bottom: 16px solid blueviolet;
  border-left: 16px solid lightgray;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
  margin:auto;
  
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
</head>
<body>



</body>
</html>