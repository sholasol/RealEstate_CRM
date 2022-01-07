

        <!--Horizontal Nav-->
        <?php 
        include 'dash_nav.php'; 
        //All request
        $db = dbConnect()->prepare("SELECT count(id) AS num, sum(fund) AS fund FROM `travel` WHERE userID='$user_id' ");
        $db->execute();
        $ro=$db->fetch();
        
        $all = $ro['num'];
        $fund = $ro['fund'];
        
        //Granted
        $db1 = dbConnect()->prepare("SELECT  sum(fund) AS fund FROM `travel` WHERE status='Approved' AND userID='$user_id'");
        $db1->execute();
        $rw=$db1->fetch();
        $granted = $rw['fund'];
        
        //Pending
        $db2 = dbConnect()->prepare("SELECT  sum(fund) AS fund FROM `travel` WHERE status='Pending' AND userID='$user_id'");
        $db2->execute();
        $rr=$db2->fetch();
        $pending = $rr['fund'];
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
			<h2 class="hk-pg-title font-weight-600">Travels </h2>
                    </div>
                    <div class="d-flex mb-0 flex-wrap">
                        <!--<div class="btn-group btn-group-sm btn-group-rounded mb-15 mr-15" role="group">
                            <a href="" class="btn btn-outline-secondary">Vendors</a>
                            <a href="" class="btn btn-outline-secondary">Expenses</a>
                        </div>-->
                        <a href="travelR" class="btn btn-sm btn-outline-secondary btn-rounded btn-wth-icon icon-wthot-bg mb-15"><span class="icon-label"><span class="feather-icon"><i data-feather="plus"></i></span> </span><span class="btn-text"> New Travel request</span></a>
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
                                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Requests Year till Date</span>
                                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                                            <div>
                                                                <span class="d-block display-5 font-weight-400 text-dark"><?php echo number_format($all); ?></span>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                    <div class="card card-sm">
                                            <div class="card-body">
                                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Total Cost</span>
                                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                                            <div>
                                                                    <span class="d-block">
                                                                            <span class="display-5 font-weight-400 text-dark">N<span class="counter-anim"><?php echo number_format($fund); ?></span></span>
                                                                    </span>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                    <div class="card card-sm">
                                            <div class="card-body">
                                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Granted</span>
                                                    <div class="d-flex align-items-end justify-content-between">
                                                            <div>
                                                                    <span class="d-block">
                                                                            <span class="display-5 font-weight-400 text-dark"><?php echo number_format($granted); ?></span>
                                                                            <small><i class="icon icon-check"></i></small>
                                                                    </span>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                    <div class="card card-sm">
                                            <div class="card-body">
                                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Pending</span>
                                                    <div class="d-flex align-items-end justify-content-between">
                                                            <div>
                                                                    <span class="d-block">
                                                                            <span class="display-5 font-weight-400 text-dark"><?php echo number_format($pending); ?></span>
                                                                    </span>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    </div>
                        
                    
                        
                    <div class="d-flex align-items-center justify-content-between mt-40 mb-20">
                            <h4>Travels</h4>
                    </div>
                    <div class="card">
                            <div class="card-body pa-0">
                                <div class="table-wrap"><br>
                                        <table id="datable_1" class="table table-hover w-100 display pb-30">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th><i class="icon icon-user"></i> Employee</th>
                                                    <th><i class="icon icon-location-pin"></i> Destination</th>
                                                    <th><i class="icon icon-calender"></i> Travel date</th>
                                                    <th><i class="icon icon-calender"></i> Return Date</th>
                                                    <th><i class="icon icon-list"></i> Purpose</th>
                                                    <th><i class="fa fa-clock-o"></i> Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $tr=  dbConnect()->prepare("SELECT * FROM travel WHERE userID='$user_id' AND branch='$branch'");
                                                $counter=0;
                                                $tr->execute();
                                                while($r=$tr->fetch())
                                                {
                                                    $usr= $r['userID'];
                                                    $id= $r['id'];
                                                    $q=  dbConnect()->prepare("SELECT fname, lname FROM users WHERE userID='$usr'");
                                                        $q->execute();
                                                        $rr=$q->fetch();
                                                        
                                                        $u_name=$rr['fname']." ".$rr['lname'];
                                                ?>
                                                <tr>
                                                        <td><?php echo ++$counter; ?></td>
                                                        <td><?php echo $u_name; ?></td>
                                                        <td><?php echo $r['destination']; ?></td>
                                                        <td><?php echo $r['travel_date']; ?></td>
                                                        <td><?php echo $r['return_date']; ?></td>
                                                        <td><?php echo $r['purpose']; ?></td>
                                                        <td><span class="badge badge-primary"><?php echo $r['status']; ?></span></td>
                                                </tr>
                                                <?php } ?>    
                                            <tfoot>
                                               <tr>
                                                    <th></th>
                                                    <th>Employee</th>
                                                    <th>Destination</th>
                                                    <th>Travel date</th>
                                                    <th>Return Date</th>
                                                    <th>Purpose</th>
                                                    <th>Status</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                </div>
                                
                                
                                
                            </div>
                    </div>		
		 </div>
                </div>
                <!-- /Row -->
            </div>
            <!-- /Container -->
			
            <?php include 'foot2.php'; ?>