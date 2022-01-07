<?php 
include 'head.php'; 

function random_num2($size) {
    $length = $size;
    $key = '';
    $keys = range(0, 5);

        for ($i = 0; $i < $length; $i++) {
                $key .= $keys[array_rand($keys)];
        }
        return  $key;
}
$code= random_num2(5);
$mycode = "KERAE".$code;

if(isset($_POST['submit'])){
    
    if(empty($_POST['fname'])){
        $msg = "Your first name is required";
        echo"<script>alert('$msg')</script> ";
    }
    elseif(empty($_POST['lname'])){
        $msg = "Your last name is required";
        echo"<script>alert('$msg')</script> ";
    }
    
    elseif(empty($_POST['email'])){
        $msg = "Email is required";
        echo"<script>alert('$msg')</script> ";
    }
    elseif(empty($_POST['phone'])){
        $msg = "Please enter your contact number";
        echo"<script>alert('$msg')</script> ";
    }
    elseif(empty ($_POST['city'])){
        $msg = "Please enter the city of your residence";
        echo"<script>alert('$msg')</script> ";
    }
    elseif(empty ($_POST['dob'])){
        $msg = "Please enter your date of birth";
        echo"<script>alert('$msg')</script> ";
    }
    
    
    else{
        $fn = check_input($_POST['fname']);
        $ln = check_input($_POST['lname']);
        $ph = check_input($_POST['phone']);
        $em = check_input($_POST['email']);
        $city = check_input($_POST['city']);
        $dob = check_input($_POST['dob']);
        $state = check_input($_POST['state']);
        $country = check_input($_POST['country']);
        $bnk = check_input($_POST['bank']);
        $acc = check_input($_POST['account']);
        $accName = check_input($_POST['acc_name']);
        $refer = check_input($_POST['refer']);
        
        $chk_exist =dbConnect()->prepare("SELECT count(id) AS id FROM consultants WHERE email=?");
        $chk_exist->execute([$em]);
        $rw = $chk_exist->fetch();
        $no = $rw['id'];
        
        if($no > 0){
            $msg = "Oops! user record with this email already exists.";
            echo"<script>alert('$msg')</script> ";
        }else{
            $db = dbConnect()->prepare("INSERT INTO consultants SET fname=?, lname=?, phone=?, email=?,
                bank=?, account=?, accname=?, dob=?, city=?, origin=?,country=?, referral=?, mycode=?");
              if($db->execute([$fn, $ln, $ph, $em, $bnk, $acc, $accName, $dob, $city, $state, $country, $refer, $mycode])){
                  $msg = "Thank you, $fn for subscribing to Kerae Homes!";
                  echo"<script>alert('$msg'); window.location='reg_detail?code=$mycode'</script> ";
              }
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

    <!--Page Title-->
       <section class="page-title" style="background-image:url(images/background/16.jpg);">
           <div class="auto-container">
               <div class="inner-container clearfix">
                   <h1>Realtor Subscription</h1>
                   <ul class="bread-crumb clearfix">
                       <li><a href="index">Home</a></li>
                       <li>Registration form</li>
                   </ul>
               </div>
           </div>
       </section>
       <!--End Page Title-->


    <!--Login Section-->
    <section class="login-section">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="column col-md-2">
                </div>

                <div class="column col-md-8 col-sm-12 col-xs-12">
                    <h2>Register</h2>

                    <!-- Register Form -->
                    <div class="login-form">
                        <!--Login Form-->
                        <form method="post" action="">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>First Name</label>
                                    <input type="text" name="fname"  required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Last Name</label>
                                    <input type="text" name="lname"  required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Phone</label>
                                    <input type="text" name="phone"  required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email Address</label>
                                    <input type="email" name="email"  required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>City</label>
                                    <input type="text" name="city"  required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Date of Birth</label>
                                    <input type="date"  name="dob"  required>
                                </div>
                                 <div class="form-group col-md-6">
                                    <label>State of Origin</label>
                                    <input type="text" name="state"  >
                                </div>
                                 <div class="form-group col-md-6">
                                    <label>Country</label>
                                    <input type="text" name="country"  >
                                </div>
                                 <div class="form-group col-md-6">
                                    <label>Bank Name</label>
                                    <input type="text" name="bank"  >
                                </div>
                                 
                                 <div class="form-group col-md-6">
                                    <label>Account Number</label>
                                    <input type="text" name="account" maxlength="11" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Account Name</label>
                                    <input type="text" name="acc_name" >
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Referral Code</label>
                                    <input type="text" name="refer" >
                                </div>
                                <div class="form-group text-right">
                                    <button class="theme-btn btn-style-one" type="submit" name="submit">Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--End Register Form -->
                </div>
            </div>
        </div>
    </section>
    <!--End Login Section-->

   <?php include 'foot.php'; ?>