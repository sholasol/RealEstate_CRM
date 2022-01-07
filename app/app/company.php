<?php 
include 'nav.php'; 
if(isset($_POST['save'])){
    
    $e="Great This is Working "; 
    echo  " <script>alert('$e'); </script>";
}
?>
<!-- Main Content -->
        <div class="hk-pg-wrapper">
			<!-- Container -->
            <div class="container mt-xl-50 mt-sm-30 mt-15">
                <!-- Title -->
                <div class="hk-pg-header align-items-top">
                    <div>
                        <h2 class="hk-pg-title font-weight-600 mb-10">Company Setup</h2>
                        <p>Create New Company </p>
                    </div>
                    <div class="d-flex w-500p"></div>
                    <div class="d-flex w-200p">
                        <div class="d-flex mb-0 flex-wrap">
                            <button class="btn btn-sm btn-outline-secondary btn-rounded btn-wth-icon icon-wthot-bg mb-5"><span class="icon-label"><span class="feather-icon"><i data-feather="plus"></i></span> </span><span class="btn-text">new projects</span></button>
                        </div>
                    </div>
                </div>
                <!-- /Title -->
                

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <h5 class="hk-sec-title">Basic Company Information</h5>
                            <div class="row">
                                <div class="col-sm">
                                    <form class="needs-validation" method="post" novalidate>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-10">
                                                <label for="validationCustom01">Company Name</label>
                                                <input type="text" class="form-control" id="validationCustom01" name="company" placeholder="Company Name"  required>
                                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                            </div>
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom01">Company Email</label>
                                                <input type="text" class="form-control" id="validationCustom01" name="email" placeholder="Company email"  pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}"  title="email (format: username@email.xx or username@email.xxx )" required>
                                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Invalid email format </div>
                                            </div>
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom01">Company Phone</label>
                                                <input type="text" class="form-control" id="validationCustom01" name="phone" placeholder="Company Phone"  required>
                                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                            </div>
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom02">Fiscal Year Start</label>
                                                <input type="date" class="form-control" id="validationCustom02" name="start" placeholder="FiscaL Year Start"  required>
                                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                            </div>
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom02">Fiscal Year End</label>
                                                <input type="date" class="form-control" id="validationCustom02" name="end" placeholder="FiscaL Year End"  required>
                                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                            </div>
<!--                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustomUsername">Username</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                    </div>
                                                    <input type="text" class="form-control" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" required>
                                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                                </div>
                                            </div>-->
                                            <div class="col-md-12 mb-10">
                                                <label for="validationCustom01">Company Address</label>
                                                <input type="text" class="form-control" id="validationCustom01" name="address" placeholder="Company Address"  required>
                                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom03">City</label>
                                                <input type="text" class="form-control" id="validationCustom03" placeholder="City" required>
                                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                            </div>
                                            <div class="col-md-3 mb-10">
                                                <label for="validationCustom04">State</label>
                                                <input type="text" class="form-control" id="validationCustom04" placeholder="State" required>
                                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                            </div>
                                            <div class="col-md-3 mb-10">
                                                <label for="validationCustom05">Zip</label>
                                                <input type="text" class="form-control" id="validationCustom05" placeholder="Zip" required>
                                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check custom-control custom-checkbox">
                                                <input type="checkbox" class="form-check-input custom-control-input" id="invalidCheck" required>
                                                <label class="form-check-label custom-control-label" for="invalidCheck">
                                                    Agree to terms and conditions
                                                </label>
                                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit" name="save">Save Company</button>
                                    </form>
                                </div>
                            </div>
                        </section>  
                   </div>
                <!-- /Row -->
                </div>
            <!-- /Container -->
            <?php include 'foot.php'; ?>