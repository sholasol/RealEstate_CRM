<?php 
        include 'dash_nav.php'; 
        
        $cs=  dbConnect()->prepare("SELECT count(custID) AS cust FROM customer WHERE status='Active'");
        $cs->execute();
        $rq=$cs->fetch();
        
        $total_order=dbConnect()->prepare("SELECT distinct(order_no) AS no FROM sinvoice  ");
        $total_order->execute();
        $rr=$total_order->fetch();
        $num = $rr['no'];
        
        $rv = dbConnect()->prepare("SELECT sum(total) AS tot FROM sinvoice  ");
        $rv->execute();
        $rw=$rv->fetch();
        $tot = $rw['tot'];
        
        $rv2 = dbConnect()->prepare("SELECT sum(total) AS tot FROM sinvoice WHERE status='Pending' ");
        $rv2->execute();
        $rx=$rv2->fetch();
        $tot2 = $rx['tot'];
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
			<h2 class="hk-pg-title font-weight-600">Customers </h2>
                    </div>
                    <div class="d-flex mb-0 flex-wrap">
                        <div class="btn-group btn-group-sm btn-group-rounded mb-15 mr-15" role="group">
                            <a href="" class="btn btn-outline-secondary">Vendors</a>
                            <a href="" class="btn btn-outline-secondary">Expenses</a>
                        </div>
                        <a href="addContact" class="btn btn-sm btn-outline-secondary btn-rounded btn-wth-icon icon-wthot-bg mb-15"><span class="icon-label"><span class="feather-icon"><i data-feather="plus"></i></span> </span><span class="btn-text">New Contact</span></a>
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
                                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Customers</span>
                                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                                            <div>
                                                                 <span class="d-block display-5 font-weight-400 text-dark"><i class="fa fa-user"></i> <?php echo number_format($rq['cust']) ; ?> </span>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                    <div class="card card-sm">
                                            <div class="card-body">
                                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Orders</span>
                                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                                            <div>
                                                                    <span class="d-block">
                                                                        <span class="display-5 font-weight-400 text-dark"><i class="fa fa-list"></i><span class="counter-anim"><?php echo number_format($num); ?></span></span>
                                                                    </span>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                    <div class="card card-sm">
                                            <div class="card-body">
                                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Total Revenue</span>
                                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                                            <div>
                                                                    <span class="d-block">
                                                                        <span class="display-5 font-weight-400 text-dark"><span class="counter-anim"><?php echo number_format($tot, $decimal=2); ?></span></span>
                                                                    </span>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                    <div class="card card-sm">
                                            <div class="card-body">
                                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Outstanding Invoices</span>
                                                    <div class="d-flex align-items-end justify-content-between">
                                                            <div>
                                                                    <span class="d-block">
                                                                            <span class="display-5 font-weight-400 text-dark"><?php echo number_format($tot2, $decimal=2); ?></span>
                                                                    </span>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    </div>
                    
                    <div class="d-flex align-items-center justify-content-between mt-40 mb-20">
                            <h4>Customers</h4>
                    </div>
                    <div class="card">
                            <div class="card-body pa-0">
                                <div class="table-wrap">
                                    <table id="datable_1" class="table table-hover w-100 display pb-30"><br>
                                            <thead>
                                                <tr>
                                                        <th></th>
                                                        <th width="25%">Customer</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Address</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $epp=  dbConnect()->prepare("SELECT * FROM customer WHERE status='Active' AND branch='$branch' ORDER BY fname");
                                                    $counter=0;
                                                    $epp->execute();
                                                    while($ro=$epp->fetch()){
                                                        $st=$ro['status'];;
                                                        $id=$ro['custID'];
                                                        
                                                ?>
                                                    <tr>
                                                        <td><span class="badge badge-primary"><?php echo ++$counter;?></span></td>
                                                            <td><?php echo $ro['fname']." ".$ro['lname'];?></td>
                                                            <td><?php echo $ro['email'] ?></td>
                                                            <td><?php echo $ro['phone'] ?></td>
                                                            <td><?php echo $ro['address'] ?></td>
                                                            <td>
                                                                <?php
                                                                if($st=='Active'){echo"<span class='badge badge-success'>$st</span>";}
                                                                else{echo"<span class='badge badge-danger'>$st</span>";}
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <div class="dropdown">
                                                                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle btn-icon-dropdown" type="button"><span class="feather-icon"><i data-feather="user"></i></span> <span class="caret"></span></button>
                                                                        <div role="menu" class="dropdown-menu">
                                                                            <a class="dropdown-item" href="cust_view?id=<?php echo $id; ?>">View Customer</a>
                                                                            <?php
                                                                            if($role=='AccAdmin'){ echo"
                                                                            <a class='dropdown-item' href='edit_cust?id=$id'>Edit Customer</a>
                                                                            <a class='dropdown-item' href='deactivate.php?id=$id'>Deactivate</a>";
                                                                            } 
                                                                            
                                                                           ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                    </tr>
                                                    <?php } ?>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th width="25%">Customer</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Address</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
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