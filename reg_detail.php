<?php 
include 'head.php'; 

$code=$_GET['code'];
$cns= dbConnect()->prepare("SELECT * FROM consultants WHERE mycode=?");
$cns->execute([$code]);
$ro= $cns->fetch();


?>

    <!--Page Title-->
       <section class="page-title" style="background-image:url(images/background/16.jpg);">
           <div class="auto-container">
               <div class="inner-container clearfix">
                   <h1>Welcome, <?php echo $ro['fname'].' '.$ro['lname'] ?> <br> <small>Refer Code : <?php echo $ro['mycode']; ?></small></h1> 
                   <ul class="bread-crumb clearfix">
                       <li><a href="index">Home</a></li>
                       <li>Registration Detail</li>
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
                    <h2>Hi, <?php echo $ro['fname'].' '.$ro['lname'] ?></h2>

                    <!-- Register Form -->
                    <div class="login-form">
                        <!--Login Form-->
                        <form method="post" action="">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>First Name</label>
                                    <input type="text" name="fname"  value="<?php echo $ro['fname']; ?>" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Last Name</label>
                                    <input type="text" name="lname"  value="<?php echo $ro['lname']; ?>" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Phone</label>
                                    <input type="text" name="phone"  value="<?php echo $ro['phone']; ?>" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email Address</label>
                                    <input type="email" name="email"  value="<?php echo $ro['email']; ?>" readonly>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>City</label>
                                    <input type="text" name="city"  value="<?php echo $ro['city']; ?>" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Date of Birth</label>
                                    <input type="date"  name="dob"  value="<?php echo $ro['dob']; ?>" readonly>
                                </div>
                                 <div class="form-group col-md-6">
                                    <label>State of Origin</label>
                                    <input type="text" name="state" value="<?php echo $ro['state']; ?>" readonly>
                                </div>
                                 <div class="form-group col-md-6">
                                    <label>Country</label>
                                    <input type="text" name="country" value="<?php echo $ro['country']; ?>" readonly>
                                </div>
                                 <div class="form-group col-md-6">
                                    <label>Bank Name</label>
                                    <input type="text" name="bank" value="<?php echo $ro['bank']; ?>" readonly>
                                </div>
                                 
                                 <div class="form-group col-md-6">
                                    <label>Account Number</label>
                                    <input type="text" name="account" value="<?php echo $ro['account']; ?>" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Account Name</label>
                                    <input type="text" name="acc_name" value="<?php echo $ro['accname']; ?>" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>My Referral Code</label>
                                    <input type="text" name="refer" value="<?php echo $ro['mycode']; ?>" readonly>
                                </div>
                                <div class="form-group text-right">
                                    <button class="theme-btn btn-style-one btn-block" >Your Referral Code: <?php echo $ro['mycode']; ?></button>
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