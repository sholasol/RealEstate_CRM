<?php 
include 'head.php'; 

if(isset($_POST['login'])){
    
    if(empty($_POST['email']) && empty($_POST['password'])){
        $msg = "Email and password are empty";
        echo"<script>alert('$msg')</script> ";
    }
    elseif(empty($_POST['email'])){
        $msg = "Please enter your email address";
        echo"<script>alert('$msg')</script> ";
    }elseif(empty ($_POST['password'])){
        $msg = "Please enter your password";
        echo"<script>alert('$msg')</script> ";
    }else{
        $msg = "Welcome, you are doing well!";
        echo"<script>alert('$msg')</script> ";
    }
    
    
}
?>

    <!--Page Title-->
       <section class="page-title" style="background-image:url(images/background/16.jpg);">
           <div class="auto-container">
               <div class="inner-container clearfix">
                   <h1>Login</h1>
                   <ul class="bread-crumb clearfix">
                       <li><a href="index.html">Home</a></li>
                       <li>Login</li>
                   </ul>
               </div>
           </div>
       </section>
       <!--End Page Title-->


    <!--Login Section-->
    <section class="login-section">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="column col-md-3">
                </div>

                <div class="column col-md-6 col-sm-12 col-xs-12">
                    <h2>Sign In</h2>

                    <!-- Register Form -->
                    <div class="login-form register-form">
                        <!--Login Form-->
                        <form method="post" action="contact.html">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="text" name="username" placeholder="Your Email" required>
                            </div>

                            <div class="form-group">
                                <label>Enter Your Password</label>
                                <input type="email" name="email" placeholder="Password" required>
                            </div>

                            <div class="form-group text-right">
                                <button class="theme-btn btn-style-one" type="submit" name="submit-form">Sign In</button>
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