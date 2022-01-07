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
                        <h2 class="hk-pg-title font-weight-600 mb-10">New Chart of Account</h2>
                    </div>
                </div>
                <!-- /Title -->
                

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-sm">
                                    <form class="needs-validation" method="post" novalidate>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-10">
                                                <label for="validationCustom01">Account Name</label>
                                                <input type="text" class="form-control" id="validationCustom01" name="company" placeholder="Customer Name"  required>
                                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                            </div>
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom01"> Account Number</label>
                                                <input type="text" class="form-control" id="validationCustom01" name="account" placeholder=" Account Number"   required>
                                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Invalid email format </div>
                                            </div>
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom01">Bank Name</label>
                                                <select class="form-control select2" name="bank" required>
                                                <option>Select</option>
                                                <optgroup label="Alaskan/Hawaiian Time Zone">
                                                    <option value="AK">Alaska</option>
                                                    <option value="HI">Hawaii</option>
                                                </optgroup>
                                                </select>
                                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                            </div>
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom02">Account Code</label>
                                                <input type="text" class="form-control" id="validationCustom02" name="start" placeholder="FiscaL Year Start"  required>
                                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                            </div>
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom02">Routing Number</label>
                                                <input type="text" class="form-control" id="validationCustom02" name="end" placeholder="FiscaL Year End"  required>
                                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
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