<?php 
include 'dash_nav.php';

if(isset($_GET['code'])) {
    $code = $_GET['code'];
}

$q2=  dbConnect()->prepare("SELECT * FROM consultants WHERE mycode='$code'");
$q2->execute();
$rw=$q2->fetch();





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
                <h2 class="hk-pg-title font-weight-600">Partners</h2>
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
    <div class="d-flex align-items-center justify-content-between mt-40 mb-20">
            <h4><?php echo $rw['fname'].' '.$rw['lname']?> Downline </h4>
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
                                        <th>Phone</th>
                                        <th> Email</th>
                                        <th>Location</th>
                                        <th>Bank</th>
                                        <th>Created</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                            $qq=  dbConnect()->prepare("SELECT * FROM consultants WHERE referral=? ");
                                            $qq->execute([$code]);
                                            $count = $qq->rowCount();
                                            $counter =0;
                                            while($ro=$qq->fetch()){
                                            
                                        ?>
                                        <tr>
                                                <td><?php echo ++$counter; ?></td>
                                                <td><?php echo $ro['fname'].' '.$ro['lname']; ?></td>
                                                <td>
                                                    <?php  echo $ro['phone']; ?>
                                                </td>
                                                <td><?php echo $ro['email']; ?></td>
                                                <td><span class="badge badge-primary"><?php echo $ro['city'];?></span></td>
                                                <td><span class="badge badge-success"><?php echo $ro['bank'].' : '.$ro['account'];?></span></td>
                                                <td><?php echo $ro['created']; ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <div class="dropdown">
                                                            <button aria-expanded="false" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle btn-icon-dropdown" type="button"><span class="feather-icon"><i data-feather="book"></i></span> <span class="caret"></span></button>
                                                            <div role="menu" class="dropdown-menu">
                                                                <a class="dropdown-item" href="downline?code=<?php  echo $ro['mycode']; ?>">View Downline</a>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                        </tr>
                                        
                                        <?php }   ?>
                                        
                                        
                            </table>
                                <?php  
                                

                                   if($count < 1){
                                   echo"<p style='color:crimson;'>There are no downline at this moment</p>"; 
                                   }
                               ?>
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
                                                <span class="input-group-text"><i data-feather="user"></i></span>
                                            </div>
                                            <input class="form-control" id="firstName" name="fname" type="text" required>
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="firstName"> Last Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i data-feather="user"></i></i></span>
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
                                                <span class="input-group-text"><i data-feather="phone"></i></span>
                                            </div>
                                        <input class="form-control" name="phone" type="text" required />
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                    <div class="col-md-6 mb-10">
                                       <label for="email">Email</label>
                                           <div class="input-group">
                                               <div class="input-group-prepend">
                                                   <span class="input-group-text"><i data-feather="file-text"></i></span>
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
                                                   <span class="input-group-text"><i data-feather="map"></i></span>
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