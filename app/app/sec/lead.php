<?php 
include 'dash_nav.php';

$dd=date('m');
$dat= date('F');
$yr=date('Y');
 //Leads                                       
$qq=  dbConnect()->prepare("SELECT count(id) AS count FROM lead WHERE YEAR(created)= Year(CURRENT_DATE()) ");
$qq->execute();
$ro=$qq->fetch();
$leads = $ro['count'];

//Contacted
$qc=  dbConnect()->prepare("SELECT count(id) AS count FROM lead WHERE YEAR(created)= Year(CURRENT_DATE()) AND (progress='Contacted' OR progress='Prospect') ");
$qc->execute();
$rc=$qc->fetch();
$contacted = $rc['count'];

//Negotiation
$qn=  dbConnect()->prepare("SELECT count(id) AS count FROM lead WHERE YEAR(created)= Year(CURRENT_DATE()) AND  progress='Negotiation' ");
$qn->execute();
$rn=$qn->fetch();
$negotiation = $rn['count'];

//Closed
$qs=  dbConnect()->prepare("SELECT count(id) AS count FROM lead WHERE YEAR(created)= Year(CURRENT_DATE()) AND  progress='Closed' ");
$qs->execute();
$rs=$qs->fetch();
$closed = $rs['count'];



if(isset($_POST['lead'])){
    
    if(empty($_POST['fname'])){
        $e="Please fill in key contact's first name"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['lname'])){
        $e="Please fill in key contact's last name"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['email'])){
        $e="Please fill in  email"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['phone'])){
        $e="Please fill in the phone number"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['progress'])){
        $e="Please select lead progress"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['address'])){
        $e="Please fill in  address"; 
        echo  " <script>alert('$e'); </script>";
    }
    
    else{
        $fn=  check_input($_POST['fname']);
        $ln=  check_input($_POST['lname']);
        $ph=  check_input($_POST['phone']);
        $em=  check_input($_POST['email']);
        $prog=  check_input($_POST['progress']);
        $rmk=  check_input($_POST['remark']);
        $ad=  check_input($_POST['address']);
        
        $dt= date('Y-m-d');
        $user = $uid;
        $bran= $branch;
        
        $q1=  dbConnect()->prepare("SELECT count(id) AS no FROM lead WHERE email='$em' OR phone='$ph'");
        $q1->execute();
        $rr=$q1->fetch();
        $no=$rr['no'];
        
        if($no < 1){
            
            $in=dbConnect()->prepare("INSERT INTO lead SET  fname=:fn, lname=:ln, phone=:ph, email=:em, progress=:prog, address=:add, created=:dt, createdby=:by, remark=:rmk, month=:mon, year=:yr ");
            $in->bindParam(':fn', $fn);
            $in->bindParam(':ln', $ln);
            $in->bindParam(':em', $em);
            $in->bindParam(':ph', $ph);
            $in->bindParam(':prog', $prog);
            $in->bindParam(':rmk', $rmk);
            $in->bindParam(':add', $ad);
            $in->bindParam(':dt', $dt);
            $in->bindParam(':by', $user);
            $in->bindParam(':mon', $dd);
            $in->bindParam(':yr', $yr);
            if($in->execute()){
                
                $inx= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Creation of new lead profile $fn, $ln  by userID with ID of $uid', created=now()");
                $inx->execute();
                
                echo"
                    <br><br><br><br><br><br><br><br><br>
                    <div style='width:100%;text-align:center;vertical-align:bottom'>
                            <div class='loader'></div>
                            <br>
                            <meta http-equiv='refresh' content='2;url=lead'>
                            <span class='itext' style='color: blueviolet;'>Creating Lead. Please Wait...</span>
                    </div><br><br><br><br><br><br><br><br>";
            }
            
        }
        else{
            $e="This customer already exists"; 
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
                <h2 class="hk-pg-title font-weight-600">Lead Manager <?php echo $dd.", ".$yr ?></h2>
            </div>
            <div class="d-flex mb-0 flex-wrap">
               <!-- <div class="btn-group btn-group-sm btn-group-rounded mb-15 mr-15" role="group">
                    <a href="schedule" class="btn btn-outline-secondary">Payment Schedule</a>
                    <a href="emp_sal" class="btn btn-outline-secondary">Employee Salary </a>
                </div>-->
                <?php
                  //echo"<a href='asorder' class='btn btn-sm btn-outline-secondary btn-rounded btn-wth-icon icon-wthot-bg mb-15'><span class='icon-label'><span class='feather-icon'><i data-feather='plus'></i></span> </span><span class='btn-text'>New Sale Order</span></a>";
                  echo"<a data-toggle='modal' data-target='#exampleModalLarge01' class='btn btn-sm btn-outline-secondary btn-rounded btn-wth-icon icon-wthot-bg mb-15'><span class='icon-label'><span class='feather-icon'><i data-feather='user'></i></span> </span><span class='btn-text'>New Lead</span></a>";
                ?>
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
                                            <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Lead YTD</span>
                                            <div class="d-flex align-items-center justify-content-between position-relative">
                                                    <div>
                                                        <span class="d-block display-5 font-weight-400 text-dark"><?php echo number_format($leads) ;?></span>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                            <div class="card card-sm">
                                    <div class="card-body">
                                            <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Engaged </span>
                                            <div class="d-flex align-items-center justify-content-between position-relative">
                                                    <div>
                                                            <span class="d-block">
                                                                    <span class="display-5 font-weight-400 text-dark"><span class="counter-anim"><?php echo number_format($contacted) ;?></span></span>
                                                            </span>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                            <div class="card card-sm">
                                    <div class="card-body">
                                            <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Negotiation</span>
                                            <div class="d-flex align-items-end justify-content-between">
                                                    <div>
                                                            <span class="d-block">
                                                                    <span class="display-5 font-weight-400 text-dark"><?php echo number_format($negotiation) ;?></span>
                                                                    
                                                            </span>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                            <div class="card card-sm">
                                    <div class="card-body">
                                            <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Converted</span>
                                            <div class="d-flex align-items-end justify-content-between">
                                                    <div>
                                                            <span class="d-block">
                                                                    <span class="display-5 font-weight-400 text-dark"><?php echo number_format($closed) ;?></span>
                                                            </span>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    </div>
            </div>
            <div class="hk-row">
                    <div class="col-lg-12">
                            <div class="card card-refresh">
                                    <div class="refresh-container">
                                            <div class="loader-pendulums"></div>
                                    </div>
                                    <div class="card-header card-header-action">
                                        <h6>Leads </h6>
                                            <div class="d-flex align-items-center card-action-wrap">
                                                    <a href="#" class="inline-block refresh mr-15">
                                                            <i class="ion ion-md-radio-button-off"></i>
                                                    </a>
                                                    <a href="#" class="inline-block full-screen">
                                                            <i class="ion ion-md-expand"></i>
                                                    </a>
                                            </div>
                                    </div>
                                    <div class="card-body">
                                            <div class="hk-legend-wrap mb-20">
                                                    <div class="hk-legend">
                                                            <span class="d-10 bg-primary rounded-circle d-inline-block"></span><span>Contacted</span>
                                                    </div>
                                                    <div class="hk-legend">
                                                            <span class="d-10 bg-brown-light-5 rounded-circle d-inline-block"></span><span>Negotiation</span>
                                                    </div>
                                                    <div class="hk-legend">
                                                            <span class="d-10 bg-brown-light-3 rounded-circle d-inline-block"></span><span>Closed</span>
                                                    </div>
                                            </div>
                                            <div id="area_chart" class="echart" style="height: 194px;"></div>
                                    </div>
                            </div>
                    </div>
            </div>
            
    <div class="d-flex align-items-center justify-content-between mt-40 mb-20">
            <h4>Recent Leads</h4>
    </div>
    <div class="card">
            <div class="card-body pa-0">
                <div class="table-wrap">
                            <div id="table-responsive">
                               <table id="datable_1" class="table table-hover w-100 display pb-30">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th> Phone</th>
                                        <th>Progress</th>
                                        <th>Created By</th>
                                        <th>Created</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        
                                        
                                        //$q=  dbConnect()->prepare("SELECT * FROM emp_pay WHERE month='$dd' AND year='$yr' AND branch='$branch'");
                                        $q=  dbConnect()->prepare("SELECT * FROM lead ORDER BY id DESC");
                                        $q->execute();
                                        $counter =0;
                                        while($ro=$q->fetch()){
                                            $id = $ro['id'];
                                            $crt = $ro['createdby'];
                                            //Getting the staff or partner that generate the lead
                                            $qy=  dbConnect()->prepare("SELECT * FROM users WHERE userID='$crt'");
                                            $qy->execute();
                                            $re=$qy->fetch();
                                            
                                            $creator = $re['fname']." ".$re['lname'];
                                        ?>
                                        <tr>
                                                <td><?php echo ++$counter; ?></td>
                                                <td><?php echo $ro['fname']." ".$ro['lname'] ?></td>
                                                <td>
                                                    <span class="badge badge-primary"> <?php echo $ro['email']; ?></span>
                                                </td>
                                                <td> <span class="badge badge-primary"> <?php echo $ro['phone']; ?></span></td>
                                                <td><span class="badge badge-success"> <?php echo $ro['progress']; ?></span></td>
                                                <td> <?php echo $creator; ?></td>
                                                <td><span class="badge badge-info"><?php echo $ro['created']; ?></span></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <div class="dropdown">
                                                            <button aria-expanded="false" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle btn-icon-dropdown" type="button"><span class="feather-icon"><i data-feather="book"></i></span> <span class="caret"></span></button>
                                                            <div role="menu" class="dropdown-menu">
                                                                <a class="dropdown-item" href="lview?id=<?php echo $id; ?>">Create Activity</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                        </tr>
                                        <?php } ?>
                                <tfoot>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th> Phone</th>
                                        <th>Progress</th>
                                        <th>Created By</th>
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

            <!-- Modal -->
                <div class="modal fade" id="exampleModalLarge01" tabindex="-1" role="dialog" aria-labelledby="exampleModalLarge01" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Create Lead</h5>
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
                                    <div class="form-group col-lg-6">
                                            <label for="gender">Progress</label>
                                            <select name="progress" class="form-control" >
                                                    <option value="">Please Select</option>
                                                    <option>Prospect</option>
                                                    <option>Contacted</option>
                                                    <option>Negotiation</option>
                                                    <option>Closed</option>
                                                </select>
                                            <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                        </div>
                                </div>
                                    <div class="row">
                                       <div class="form-group col-lg-12">
                                           <label for="email">Email</label>
                                           <div class="input-group">
                                               <div class="input-group-prepend">
                                                   <span class="input-group-text"><i class="icon icon-envelope"></i></span>
                                               </div>
                                               <input class="form-control" id="email" name="email"  type="email" required>
                                           </div>
                                           <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                       </div>
                                        <div class="form-group col-md-12">
                                           <label for="address">Remark</label>
                                           <div class="input-group">
                                               <div class="input-group-prepend">
                                                   <span class="input-group-text"><i class="icon icon-book-open"></i></span>
                                               </div>
                                               <input class="form-control" name="remark" id="remark"  type="text">
                                           </div>
                                           <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                       </div>
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
                                <button type="submit" name="lead" class="btn btn-primary">Save Details</button>
                            </div>
                        </div>
                       </form>
                    </div>
                </div>
                <!-- Modal -->
      

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
    <script>
                    /*Dashboard3 Init*/

            "use strict"; 
            $(document).ready(function() {
                    /*Toaster Alert*/
                    /*
                    $.toast({
                            heading: 'Oh snap!',
                            text: '<p>Change a few things and try submitting again.</p>',
                            position: 'bottom-right',
                            loaderBg:'#7a5449',
                            class: 'jq-toast-danger',
                            hideAfter: 3500, 
                            stack: 6,
                            showHideTransition: 'fade'
                    });
                    */
                    
                   
                    if($('#area_chart').length > 0) {
                            var data=[
                                //Querying sorder table
                                <?Php 
                                $b=  dbConnect()->prepare("SELECT progress, month, count(id) AS count FROM `lead` WHERE YEAR(created)= YEAR(CURRENT_DATE()) GROUP by progress, month");
                                $b->execute();
                                while($rr=$b->fetch()){
                                    $month =$rr['month'];
                                    $progr =$rr['progress'];
                                    //Contacted
                                    $qco=  dbConnect()->prepare("SELECT count(id) AS count FROM lead WHERE YEAR(created)= Year(CURRENT_DATE()) AND month='$month' AND (progress='Contacted' OR progress='Prospect') ");
                                    $qco->execute();
                                    $rco=$qco->fetch();
                                    $engage = $rco['count'];
                                    
                                    //Negotiation
                                    $qcc=  dbConnect()->prepare("SELECT count(id) AS count FROM lead WHERE YEAR(created)= Year(CURRENT_DATE()) AND month='$month' AND progress='Negotiation'  ");
                                    $qcc->execute();
                                    $rcc=$qcc->fetch();
                                    $nego = $rcc['count'];
                                    
                                    
                                    //Negotiation
                                    $qcs=  dbConnect()->prepare("SELECT count(id) AS count FROM lead WHERE YEAR(created)= Year(CURRENT_DATE()) AND month='$month' AND progress='Closed'  ");
                                    $qcs->execute();
                                    $rcs=$qcs->fetch();
                                    $close = $rcs['count'];
                                    
                                    if($month ==1){$month ="Jan";}
                                    elseif($month ==2){$month ="Feb";}
                                    elseif($month ==3){$month ="Mar";}
                                    elseif($month ==4){$month ="Apr";}
                                    elseif($month ==5){$month ="May";}
                                    elseif($month ==6){$month ="Jun";}
                                    elseif($month ==7){$month ="Jul";}
                                    elseif($month ==8){$month ="Aug";}
                                    elseif($month ==9){$month ="Sep";}
                                    elseif($month ==10){$month ="Oct";}
                                    elseif($month ==11){$month ="Nov";}
                                    elseif($month ==12){$month ="Dec";}
                                ?>
                                {
                                period: '<?php echo $month ?>',
                                Engaged: <?php echo $engage ?>,
                                Negotiation: <?php echo $nego ?>,
                                Converted: <?php echo $close ?>
                                }, <?php } ?>
                            ];
                           

                            var lineChart = Morris.Area({
                    element: 'area_chart',
                    data: data ,
                    xkey: 'period',
                    ykeys: ['Engaged', 'Negotiation', 'Converted'],
                    labels: ['Engaged', 'Negotiation', 'Converted'],
                    pointSize: 2,
                    lineWidth:2,
                            fillOpacity: 0.1,
                            pointStrokeColors:['#7a5449', '#d7cbc8', '#a58b84'],
                            behaveLikeLine: true,
                            grid: false,
                            hideHover: 'auto',
                            lineColors: ['#7a5449', '#d7cbc8', '#a58b84'],
                            resize: true,
                            redraw: true,
                            smooth: true,
                            gridTextColor:'#878787',
                            gridTextFamily:"Poppins",
                    parseTime: false
                });
                    }
                    var data = [],
                    totalPoints = 300;

                    /*Getting Random Data*/
                    function getRandomData() {

                            if (data.length > 0)
                                    data = data.slice(1);

                            // Do a random walk

                            while (data.length < totalPoints) {

                                    var prev = data.length > 0 ? data[data.length - 1] : 50,
                                            y = prev + Math.random() * 10 - 5;

                                    if (y < 0) {
                                            y = 0;
                                    } else if (y > 100) {
                                            y = 100;
                                    }

                                    data.push(y);
                            }

                            // Zip the generated y values with the x values

                            var res = [];
                            for (var i = 0; i < data.length; ++i) {
                                    res.push([i, data[i]])
                            }

                            return res;
                    }

                    

                    
            });
            
            

            /*****Resize function start*****/
            var echartResize;
            $(window).on("resize", function () {
                    /*E-Chart Resize*/
                    clearTimeout(echartResize);
                    echartResize = setTimeout(echartsConfig, 200);
            }).resize(); 
            /*****Resize function end*****/

            /*****Function Call start*****/
            echartsConfig();
            /*****Function Call end*****/
    </script>
	
</body>

</html>