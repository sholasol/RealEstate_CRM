<?php 
include 'nav.php'; 
if(isset($_POST['save'])){
    
    if(empty($_POST['company'])){
        $e="Please fill in the account name"; 
        echo  " <script>alert('$e'); </script>"; 
    }
    elseif(empty($_POST['account'])){
        $e="Please fill in the account number"; 
        echo  " <script>alert('$e'); </script>"; 
    }
    elseif(empty($_POST['bank'])){
        $e="Please fill in the bank name"; 
        echo  " <script>alert('$e'); </script>"; 
    }
    else{  
        $com = check_input($_POST["company"]);
        $acc = check_input($_POST["account"]);
        $bank = check_input($_POST["bank"]);
        $routing = check_input($_POST["routing"]);
        $code = check_input($_POST["code"]);
        $bal = check_input($_POST["bal"]);;
        $dt= date('Y-m-d');
        $user = $uid;
        
        $q=  dbConnect()->prepare("INSERT INTO bank SET bank=:bank, account=:acc, account_name=:nm, routing=:rt, code=:code, obalance=:bal, balance=:baln, created=:dt, createdby=:by, compID=:comp ");
        $q->bindParam(':bank', $bank);
        $q->bindParam(':acc', $acc);
        $q->bindParam(':nm', $com);
        $q->bindParam(':rt', $routing);
        $q->bindParam(':code', $code);
        $q->bindParam(':bal', $bal);
        $q->bindParam(':baln', $bal);
        $q->bindParam(':dt', $dt);
        $q->bindParam(':by', $user);
        $q->bindParam(':comp', $comp);
        if($q->execute()){
            $in= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Creation of bank account by userID $uid', created=now()");
            $in->execute();
            
            echo"
                    <br><br><br><br><br><br><br><br><br>
                    <div style='width:100%;text-align:center;vertical-align:bottom'>
                            <div class='loader'></div>
                            <br>
                            <meta http-equiv='refresh' content='1;url=account'>
                            <span class='itext' style='color: blueviolet;'>Processing. Please Wait!...</span>
                    </div><br><br><br><br><br><br><br><br>";
            
        }else{
            $e="Operation Failed"; 
            echo  " <script>alert('$e'); </script>";
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
<!-- Main Content -->
        <div class="hk-pg-wrapper">
			<!-- Container -->
            <div class="container mt-xl-50 mt-sm-30 mt-15">
                <!-- Title -->
                <div class="hk-pg-header align-items-top">
                    <div>
                        <h2 class="hk-pg-title font-weight-600 mb-10">New Bank Account</h2>
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
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom01">Account Name</label>
                                                <input type="text" class="form-control" id="validationCustom01" name="company" placeholder="Customer Name"  required>
                                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                            </div>
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom01"> Opening Balance</label>
                                                <input type="number" class="form-control" id="validationCustom01" name="bal" placeholder=" Opening Balance"   required>
                                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> error </div>
                                            </div>
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom01"> Account Number</label>
                                                <input type="text" class="form-control" id="validationCustom01" name="account" placeholder=" Account Number"   required>
                                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Invalid email format </div>
                                            </div>
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom01">Bank Name</label>
                                                <select class="form-control select2" name="bank" required>
                                                <option value="">Select Bank</option>
                                                <optgroup label="Banks">
                                                    <option>Access Bank</option>
                                                    <option>Bank PHB</option>
                                                    <option>Fidelity Bank</option>
                                                    <option>First Bank</option>
                                                    <option>Guarantees Trust Bank</option>
                                                    <option>Providus Bank</option>
                                                    <option>EcoBank</option>
                                                    <option>Polaris Bank</option>
                                                    <option>Sterling Bank</option>
                                                    <option>Stanbic IBTC Bank</option>
                                                    <option>Unity Bank</option>
                                                    <option>Wema Bank</option>
                                                    <option>Zenith Bank</option>
                                                    
                                                </optgroup>
                                                </select>
                                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                            </div>
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom02">Account Code</label>
                                                <input type="text" class="form-control" id="validationCustom02" name="code" placeholder="Account Code" />
                                            </div>
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom02">Routing Number</label>
                                                <input type="text" class="form-control" id="validationCustom02" name="routing" placeholder="Routing umber"/>
                                            </div>
                                        <button class="btn btn-primary" type="submit" name="save">Create Account</button>
                                    </form>
                                </div>
                            </div>
                        </section>  
                   </div>
                <!-- /Row -->
                </div>
            <!-- /Container -->
            <?php include 'foot.php'; ?>