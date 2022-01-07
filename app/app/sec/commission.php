<?php 
include 'dash_nav.php';

$cns= dbConnect()->prepare("SELECT * FROM consultants ");
$cns->execute();
$num=$cns->rowCount();

$dd=date('m');
$dat= date('F');
$yr=date('Y');
                                        
$qq=  dbConnect()->prepare("SELECT sum(amount) AS amount, sum(consultAmt) AS consAmt, sum(qty) AS plots, sum(paid) AS paid, sum(balance) AS bal FROM sorder WHERE consultant !='' AND branch='$branch' AND YEAR(created)= Year(CURRENT_DATE()) ");
$qq->execute();
$ro=$qq->fetch();
$consAmt = $ro['consAmt'];
$sales = $ro['amount'];
$paid = $ro['paid'];
$bal = $ro['bal'];
$plots = $ro['plots'];



if(isset($_POST['consult'])){
    
    
    if(empty($_POST['fname'])){
        $e="Please fill in key contact's first name"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['lname'])){
        $e="Please fill in key contact's last name"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['phone'])){
        $e="Please fill in the phone number"; 
        echo  " <script>alert('$e'); </script>";
    }
    
    else{
        $fn=  check_input($_POST['fname']);
        $ln=  check_input($_POST['lname']);
        $ph=  check_input($_POST['phone']);
        $em=  check_input($_POST['email']);
        $add=  check_input($_POST['address']);
        $dt= date('Y-m-d');
        $user = $uid;
        
        $q1=  dbConnect()->prepare("SELECT count(id) AS no FROM consultants WHERE email='$em' and phone='$ph'");
        $q1->execute();
        $rr=$q1->fetch();
        $no=$rr['no'];
        
        if($no < 1){
            
            $inn=dbConnect()->prepare("INSERT INTO consultants SET  fname=:fn, lname=:ln, phone=:ph, email=:em, address=:add, created=:dt, createdby=:by ");
            $inn->bindParam(':fn', $fn);
            $inn->bindParam(':ln', $ln);
            $inn->bindParam(':em', $em);
            $inn->bindParam(':add', $add);
            $inn->bindParam(':ph', $ph);
            $inn->bindParam(':dt', $dt);
            $inn->bindParam(':by', $user);
            if($inn->execute()){
                
                    $inx= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Creation of new consultant profile $fn, $ln  by userID with ID of $uid', created=now()");
                    $inx->execute();
                    
                    $e="Consultant has been successfully created"; 
                    echo  " <script>alert('$e'); </script>";
                
            }
            
            
        }
        else{
            $e="This Consultant already exists"; 
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
<div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
<!--/Horizontal Nav-->
<!-- Main Content -->
<div class="hk-pg-wrapper">
                <!-- Container -->
    <div class="container mt-xl-50 mt-sm-30 mt-15">
        <!-- Title -->
        <div class="hk-pg-header">
            <div>
                <h2 class="hk-pg-title font-weight-600">Partners Transactions</h2>
            </div>
            <div class="d-flex mb-0 flex-wrap">
                <div class="btn-group btn-group-sm btn-group-rounded mb-15 mr-15" role="group">
                    <a href="consultant" class="btn btn-outline-secondary">
                        <span class="icon-label"><span class="feather-icon"><i data-feather="book"></i></span> </span><span class="btn-text">View Partners</span>
                    </a>
                    <a data-toggle='modal' data-target='#exampleModalLarge00' class="btn btn-outline-secondary"> 
                        <span class="icon-label"><span class="feather-icon"><i data-feather="user"></i></span> </span><span class="btn-text">Create Partner</span> 
                    </a>
                </div>
            </div>
        </div>
        <!-- /Title -->

        <!-- Row -->
        <div class="row">
            <div class="col-xl-12">
                <div class="hk-row">
                    <div class="col-lg-3 col-sm-6">
                            <div class="card card-sm">
                                    <div class="card-body">
                                            <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Total Partner</span>
                                            <div class="d-flex align-items-center justify-content-between position-relative">
                                                    <div>
                                                        <span class="d-block display-5 font-weight-400 text-dark"><?php echo number_format($num) ;?></span>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                            <div class="card card-sm">
                                    <div class="card-body">
                                            <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Sales by Partners </span>
                                            <div class="d-flex align-items-center justify-content-between position-relative">
                                                    <div>
                                                            <span class="d-block">
                                                                    <span class="display-5 font-weight-400 text-dark">=N=<span class="counter-anim"><?php echo number_format($paid) ;?></span></span>
                                                            </span>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                            <div class="card card-sm">
                                    <div class="card-body">
                                            <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Commission Paid</span>
                                            <div class="d-flex align-items-end justify-content-between">
                                                    <div>
                                                            <span class="d-block">
                                                                    <span class="display-5 font-weight-400 text-dark">=N= <?php echo number_format($consAmt) ;?></span>
                                                                    
                                                            </span>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                            <div class="card card-sm">
                                    <div class="card-body">
                                            <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Total Plot Sold</span>
                                            <div class="d-flex align-items-end justify-content-between">
                                                    <div>
                                                            <span class="d-block">
                                                                    <span class="display-5 font-weight-400 text-dark"><?php echo number_format($plots) ;?></span>
                                                            </span>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    </div>
            </div>
            
            
    <div class="d-flex align-items-center justify-content-between mt-40 mb-20">
            <h4>Recent Transaction </h4>
    </div>
    <div class="card">
            <div class="card-body pa-0">
                <div class="table-wrap">
                            <div id="table-responsive">
                               <table id="datable_1" class="table table-hover w-100 display pb-30">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Partner</th>
                                        <th>Product</th>
                                        <th> Plots</th>
                                        <th>Total Due</th>
                                        <th>Amount Paid</th>
                                        <th>Balance Due</th>
                                        <th>Created</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        
                                        
                                        //$q=  dbConnect()->prepare("SELECT * FROM emp_pay WHERE month='$dd' AND year='$yr' AND branch='$branch'");
                                        $q=  dbConnect()->prepare("SELECT sum(amount) AS amount,sum(balance)  AS balance, custID  AS cust,consultant, item, qty, paid, balance, created, code, order_no, kfn, kln FROM sorder WHERE consultant !='' AND branch='$branch' GROUP BY code ORDER BY id DESC");
                                        $q->execute();
                                        $counter =0;
                                        while($ro=$q->fetch()){
                                            $u=$ro['cust'];
                                            $consultant=$ro['consultant'];
                                            $cd=$ro['code'];
                                            $order=$ro['order_no'];
                                            $bl=$ro['balance'];
                                            
                                            $empN = dbConnect()->prepare("SELECT * FROM consultants WHERE id='$consultant'");
                                            $empN->execute();
                                            $x= $empN->fetch();
                                            $custName=$x['fname']." ".$x['lname'];
                                            $phn = $x['phone'];
                                        ?>
                                        <tr>
                                                <td><?php echo ++$counter; ?></td>
                                                <td><a class="dropdown-item" href="sview?order=<?php echo $order; ?>"><?php echo $custName; ?><br><small><?php echo $phn;?></small></a></td>
                                                <td>
                                                    <?php echo $ro['item']; ?>
                                                </td>
                                                <td><?php echo number_format($ro['qty'])." Plots"; ?></td>
                                                <td><span class="badge badge-primary"><?php echo number_format($ro['amount']); ?></span></td>
                                                <td><span class="badge badge-success"><?php echo number_format($ro['paid']); ?></span></td>
                                                <td><span class="badge badge-orange"><?php if($bl > 0){echo number_format($ro['balance']);}else{echo"<span class='badge badge-success'>Fully Paid</span>";} ?></span></td>
                                                <td><?php echo $ro['created']; ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <div class="dropdown">
                                                            <button aria-expanded="false" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle btn-icon-dropdown" type="button"><span class="feather-icon"><i data-feather="book"></i></span> <span class="caret"></span></button>
                                                            <div role="menu" class="dropdown-menu">
                                                                <a class="dropdown-item" href="sview?order=<?php echo $order; ?>">View Sale</a>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                        </tr>
                                        <?php } ?>
                                <tfoot>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Partner</th>
                                        <th>Product</th>
                                        <th> Plots</th>
                                        <th>Total Due</th>
                                        <th>Amount Paid</th>
                                        <th>Balance Due</th>
                                        <th>Created</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                            </div>
                    </div>
            </div>
    </div>		
 </div>
</div>
<!-- /Row -->
</div>
<!-- /Container -->

<!-- Footer -->
<div class="hk-footer-wrap container">
<footer class="footer">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <p>Powered by<a href="" class="text-dark">Hybridsoft</a> © <?php echo date('Y'); ?></p>
        </div>
        <div class="col-md-6 col-sm-12">
            <p class="d-inline-block">Follow us</p>
            <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-facebook"></i></span></a>
            <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-twitter"></i></span></a>
            <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-google-plus"></i></span></a>
        </div>
                    </div>
                </footer>
            </div>
            <!-- /Footer -->
        </div>
        <!-- /Main Content -->

    </div>
    <!-- /HK Wrapper -->
     <!-- Modal -->
                <div class="modal fade" id="exampleModalLarge00" tabindex="-1" role="dialog" aria-labelledby="exampleModalLarge00" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Consultant</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="needs-validation" method="post" novalidate>
                            <div class="modal-body">
                               <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="firstName"> First Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-user"></i></span>
                                            </div>
                                            <input class="form-control" id="firstName" name="fname" type="text" required>
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="firstName"> Last Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-user"></i></span>
                                            </div>
                                            <input class="form-control" id="firstName" name="lname" type="text" required>
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6 mb-10">
                                        <label for="phone">Phone</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-phone"></i></span>
                                            </div>
                                        <input class="form-control" name="phone" type="text" required />
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                    <div class="col-md-6 mb-10">
                                       <label for="email">Email</label>
                                           <div class="input-group">
                                               <div class="input-group-prepend">
                                                   <span class="input-group-text"><i class="icon icon-envelope"></i></span>
                                               </div>
                                               <input class="form-control" id="email" name="email"  type="email" required>
                                           </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                </div>
                                    <div class="row">
                                       <div class="form-group col-lg-12">
                                           <label for="address">Address</label>
                                           <div class="input-group">
                                               <div class="input-group-prepend">
                                                   <span class="input-group-text"><i class="icon icon-location-pin"></i></span>
                                               </div>
                                               <input class="form-control" name="address" id="address"  type="text" required>
                                           </div>
                                           <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                       </div>
                                   </div> 
                             <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="consult" class="btn btn-primary">Save Consultant</button>
                            </div>
                        </div>
                       </form>
                    </div>
                </div>
                </div>
                <!-- Modal -->
     <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Slimscroll JavaScript -->
    <script src="../dist/js/jquery.slimscroll.js"></script>

    <!-- Fancy Dropdown JS -->
    <script src="../dist/js/dropdown-bootstrap-extended.js"></script>

    <!-- FeatherIcons JavaScript -->
    <script src="../dist/js/feather.min.js"></script>

    <!-- Toggles JavaScript -->
    <script src="../vendors/jquery-toggles/toggles.min.js"></script>
    <script src="../dist/js/toggle-data.js"></script>
	
	<!-- Toastr JS -->
    <script src="../vendors/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
    
	<!-- Counter Animation JavaScript -->
	<script src="../vendors/waypoints/lib/jquery.waypoints.min.js"></script>
	<script src="../vendors/jquery.counterup/jquery.counterup.min.js"></script>
	
	<!-- Morris Charts JavaScript -->
    <script src="../vendors/raphael/raphael.min.js"></script>
    <script src="../vendors/morris.js/morris.min.js"></script>
	
	<!-- Easy pie chart JS -->
    <script src="../vendors/easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
	
	<!-- Flot Charts JavaScript -->
    <script src="../vendors/flot/excanvas.min.js"></script>
    <script src="../vendors/flot/jquery.flot.js"></script>
    <script src="../vendors/flot/jquery.flot.pie.js"></script>
    <script src="../vendors/flot/jquery.flot.resize.js"></script>
    <script src="../vendors/flot/jquery.flot.time.js"></script>
    <script src="../vendors/flot/jquery.flot.stack.js"></script>
    <script src="../vendors/flot/jquery.flot.crosshair.js"></script>
    <script src="../vendors/jquery.flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    
    <!-- Data Table JavaScript -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../vendors/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../dist/js/dataTables-data.js"></script>
	
	<!-- EChartJS JavaScript -->
    <script src="../vendors/echarts/dist/echarts-en.min.js"></script>
    <!-- Init JavaScript -->
    <script src="../dist/js/init.js"></script>
    <script src="../dist/js/dashboard2-data.js"></script>
    
</body>

</html>