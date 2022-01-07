<?php 
include 'nav.php'; 
if(isset($_POST['save'])){
    
    if(empty($_POST['item'])){
        $e="Please enter item name"; 
        echo  " <script>alert('$e'); </script>"; 
    }
    elseif(empty($_POST['qty'])){
        $e="Please fill in the quantity"; 
        echo  " <script>alert('$e'); </script>"; 
    }
    elseif(empty($_POST['amt'])){
        $e="Please specify the amount"; 
        echo  " <script>alert('$e'); </script>"; 
    }
     elseif(empty($_POST['type'])){
        $e="Please select the expense type"; 
        echo  " <script>alert('$e'); </script>"; 
    }
    else{  
        $item = check_input($_POST["item"]);
        $qty = check_input($_POST["qty"]);
        $amt = check_input($_POST["amt"]);
        $note = check_input($_POST["note"]);
        $type = check_input($_POST["type"]);
        $dt= date('Y-m-d');
        $user = $uid;
        $total=$amt * $qty;
        
        
        
        $q=  dbConnect()->prepare("INSERT INTO expense SET item=:item, qty=:qty, amount=:amt, type=:type, total=:total, note=:note, created=:dt, createdby=:by ");
        $q->bindParam(':item', $item);
        $q->bindParam(':qty', $qty);
        $q->bindParam(':amt', $amt);
        $q->bindParam(':type', $type);
        $q->bindParam(':total', $total);
        $q->bindParam(':note', $note);
        $q->bindParam(':dt', $dt);
        $q->bindParam(':by', $user);
        if($q->execute()){
            //recording users' activities
            $in= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Request for expense on ($item) by userID $uid', created=now()");
            $in->execute();
            
            echo"
                    <br><br><br><br><br><br><br><br><br>
                    <div style='width:100%;text-align:center;vertical-align:bottom'>
                            <div class='loader'></div>
                            <br>
                            <meta http-equiv='refresh' content='1;url=expense'>
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
                        <h4 class="hk-pg-title font-weight-600 mb-10">Expenses</h4>
                    </div>
                </div>
                <!-- /Title -->
                

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-3">
                       <form class="needs-validation" method="post" novalidate>
                            <div class="form-row">
                                <div class="col-md-12 mb-20">
                                    <input type="text" class="form-control" id="validationCustom01" name="item" placeholder="Item name"  required>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <input type="number" class="form-control" id="validationCustom01" name="amt" placeholder="Unit Price"  required>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <input type="number" class="form-control" id="validationCustom01" name="qty" placeholder="Quantity"  required>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                               <div class="col-md-12 mb-20">
                                    <select name="type" class="form-control custom-select d-block w-100" id="country" required>
                                        <option value="">Select Type...</option>
                                        <?php
                                        $gd=  dbConnect()->prepare("SELECT * FROM expense_type ORDER BY type");
                                        $gd->execute();
                                        while($r=$gd->fetch()){
                                        ?>
                                        <option><?php echo $r['type']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                
                                <div class="col-md-12 mb-20">
                                    <label for="validationCustom02">Add Note</label>
                                    <textarea class="form-control" id="validationCustom02" name="note"> </textarea>
                                </div>
                            <button class="btn btn-primary btn-block" type="submit" name="save">Add</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-xl-9">
                        <section class="hk-sec-wrapper">
                                 <div class="table-wrap">
                                            <div class="table-responsive">
                                                    <table class="table table-sm table-hover mb-0">
                                                            <thead>
                                                                    <tr>
                                                                            <th></th>
                                                                            <th>Item</th>
                                                                            <th>Unit Price</th>
                                                                            <th>Qty</th>
                                                                            <th>Total</th>
                                                                    </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                $q=  dbConnect()->prepare("SELECT * FROM expense WHERE createdby='$uid'");
                                                                $q->execute();
                                                                $counter =0;
                                                                while($ro=$q->fetch()){
                                                                    
                                                                ?>
                                                                    <tr>
                                                                            <td><?php echo ++$counter; ?></td>
                                                                            <td><?php echo $ro['item']; ?></td>
                                                                            <td><?php echo $ro['qty']; ?></td>
                                                                            <td><?php echo number_format($ro['amount']); ?></td>
                                                                            <td><?php echo number_format($ro['total']); ?></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                    </table>
                                            </div>
                                    </div>
                        </section>  
                   </div>
                <!-- /Row -->
                </div>
            <!-- /Container -->
            <?php include 'foot.php'; ?>