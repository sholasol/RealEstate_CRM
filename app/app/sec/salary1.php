

        <!--Horizontal Nav-->
        <?php include 'dash_nav.php'; ?>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <!--/Horizontal Nav-->
        <!-- Main Content -->
        <div class="hk-pg-wrapper">
			<!-- Container -->
            <div class="container mt-xl-50 mt-sm-30 mt-15">
                <!-- Title -->
                <div class="hk-pg-header">
                    <div>
			<h2 class="hk-pg-title font-weight-600">Salary & Pay Grade </h2>
                    </div>
                    <div class="d-flex mb-0 flex-wrap">
                        <!--<div class="btn-group btn-group-sm btn-group-rounded mb-15 mr-15" role="group">
                            <a href="" class="btn btn-outline-secondary">Vendors</a>
                            <a href="" class="btn btn-outline-secondary">Expenses</a>
                        </div>-->
                        <a href="asalary" class="btn btn-sm btn-outline-secondary btn-rounded btn-wth-icon icon-wthot-bg mb-15"><span class="icon-label"><span class="feather-icon"><i data-feather="plus"></i></span> </span><span class="btn-text">New Salary Grade</span></a>
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
                                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Revenue Year till Date</span>
                                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                                            <div>
                                                                    <span class="d-block display-5 font-weight-400 text-dark">12 New</span>
                                                            </div>
                                                            <div class="position-absolute r-0">
                                                                    <span id="pie_chart_1" class="d-flex easy-pie-chart" data-percent="86">
                                                                            <span class="percent head-font">86</span>
                                                                    </span>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                    <div class="card card-sm">
                                            <div class="card-body">
                                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Projects</span>
                                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                                            <div>
                                                                    <span class="d-block">
                                                                            <span class="display-5 font-weight-400 text-dark">$<span class="counter-anim">140,260</span></span>
                                                                    </span>
                                                            </div>
                                                            <div class="position-absolute r-0">
                                                                    <span id="pie_chart_2" class="d-flex easy-pie-chart" data-percent="75">
                                                                            <span class="percent head-font">75</span>
                                                                    </span>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                    <div class="card card-sm">
                                            <div class="card-body">
                                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Revenue this month</span>
                                                    <div class="d-flex align-items-end justify-content-between">
                                                            <div>
                                                                    <span class="d-block">
                                                                            <span class="display-5 font-weight-400 text-dark">$8,725</span>
                                                                            <small>excl tax</small>
                                                                    </span>
                                                            </div>
                                                            <div>
                                                                    <span class="text-success font-12 font-weight-600">+5%</span>
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
                                                                            <span class="display-5 font-weight-400 text-dark">18 invoices</span>
                                                                    </span>
                                                            </div>
                                                            <div>
                                                                    <span class="text-danger font-12 font-weight-600">-12%</span>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    </div>
                        
                        
                        
                   
                   
                        
                        
                        
                   <div class="hk-row">
                                <div class="col-lg-6">
                                                <div class="card">
                                                <div class="card-header card-header-action">
                                                        <h6>Budget</h6>
                                                </div>
                                                <div class="card-body">
                                                        <div class="hk-legend-wrap mb-20">
                                                                <div class="hk-legend">
                                                                        <span class="d-10 bg-brown-light-2 rounded-circle d-inline-block"></span><span>A1</span>
                                                                </div>
                                                                <div class="hk-legend">
                                                                        <span class="d-10 bg-primary rounded-circle d-inline-block"></span><span>A2</span>
                                                                </div>
                                                                <div class="hk-legend">
                                                                        <span class="d-10 bg-brown-light-3 rounded-circle d-inline-block"></span><span>A3</span>
                                                                </div>
                                                                <div class="hk-legend">
                                                                        <span class="d-10 bg-brown-light-4 rounded-circle d-inline-block"></span><span>A4</span>
                                                                </div>
                                                        </div>
                                                        <div id="e_chart_9" class="echart" style="height:287px;"></div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                                <div class="card">
                                                <div class="card-header card-header-action">
                                                        <h6>Risk</h6>
                                                        <div class="d-flex align-items-center card-action-wrap">
                                                                <div class="toggle toggle-sm toggle-simple toggle-light toggle-bg-primary risk-switch"></div>
                                                        </div>
                                                </div>
                                                <div class="card-body">
                                                        <div id="e_chart_10" class="echart" style="height:260px;"></div>
                                                        <div class="hk-legend-wrap mt-20 mb-5">
                                                                <div class="hk-legend">
                                                                        <span class="d-10 bg-brown-light-2 rounded-circle d-inline-block"></span><span>Net Search</span>
                                                                </div>
                                                                <div class="hk-legend">
                                                                        <span class="d-10 bg-primary rounded-circle d-inline-block"></span><span>Email Search</span>
                                                                </div>
                                                        </div>
                                                        <div class="hk-legend-wrap">
                                                                <div class="hk-legend">
                                                                        <span class="d-10 bg-brown-light-3 rounded-circle d-inline-block"></span><span>Direct Search</span>
                                                                </div>
                                                                <div class="hk-legend">
                                                                        <span class="d-10 bg-brown-light-4 rounded-circle d-inline-block"></span><span>Paid Search</span>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                        
                    <div class="d-flex align-items-center justify-content-between mt-40 mb-20">
                        <h4><i class="ion ion-ios-wallet"></i> Employee Salary Structured</h4>
                    </div>
                    <div class="card">
                            <div class="card-body pa-0">
                                <div class="table-wrap">
                                        <table id="datable_1" class="table table-hover w-100 display pb-30">
                                            <thead>
                                                <tr>
                                                        <th></th>
                                                        <th width="25%">Employee Name</th>
                                                        <th>Gross Pay</th>
                                                        <th width="25%">Salary Components</th>
                                                        <th width="20%">Deductions</th>
                                                        <th width="20%">Grade</th>
                                                        <th width="5%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $epp=  dbConnect()->prepare("SELECT userID, grade, job, sum(value) AS sum, count(component) as component FROM emp_salary GROUP BY userID");
                                                    $counter=0;
                                                    $epp->execute();
                                                    while($ro=$epp->fetch()){
                                                        $cm=$ro['component'];
                                                        $jub=$ro['job'];
                                                        $gr=$ro['grade'];
                                                        $id=$ro['userID'];
                                                        $sum=$ro['sum'];
                                                        
                                                        $q1=  dbConnect()->prepare("SELECT grade FROM grade WHERE id='$gr'");
                                                        $q1->execute();
                                                        $rr1=$q1->fetch();
                                                        $grad=$rr1['grade'];
                                                        
                                                        /*
                                                        $w=  dbConnect()->prepare("SELECT job FROM job WHERE id='$jub'");
                                                        $w->execute();
                                                        $ru=$w->execute();
                                                        $joob=$w['job'];
                                                        
                                                        */
                                                        
                                                        $q=  dbConnect()->prepare("SELECT fname, lname FROM users WHERE userID='$id'");
                                                        $q->execute();
                                                        $rr=$q->fetch();
                                                        
                                                        $u_name=$rr['fname']." ".$rr['lname'];
                                                ?>
                                                    <tr>
                                                            <td><?php echo ++$counter;?></td>
                                                            <td><?php echo $u_name;?></td>
                                                            <td><?php echo $sum ?></td>
                                                            <td>
                                                                <?php 
                                                                    $q1=  dbConnect()->prepare("SELECT  component FROM salaryComponent WHERE grade='$gr' AND job='$jub'");
                                                                    $q1->execute();
                                                                    while($rr=$q1->fetch()){
                                                                        $cp=$rr['component'];
                                                                        echo "<small>$cp</small>".", ";
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php 
                                                                    $q1=  dbConnect()->prepare("SELECT  deduction FROM emp_deduction WHERE grade='$gr'");
                                                                    $q1->execute();
                                                                    while($rr=$q1->fetch()){
                                                                        $cp=$rr['deduction'];
                                                                        echo "<small>$cp</small>".", ";
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td><?php echo $grad; ?></td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <div class="dropdown">
                                                                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle btn-icon-dropdown" type="button"><span class="feather-icon"><i data-feather="user"></i></span> <span class="caret"></span></button>
                                                                        <div role="menu" class="dropdown-menu">
                                                                            <a class="dropdown-item" href="emp_view?id=<?php echo $id; ?>">View Employee</a>
                                                                            <!--
                                                                            <a class="dropdown-item" href="esalary?id=<?php echo $id;?>">Set Salary</a>
                                                                            <a class="dropdown-item" href="edit_emp?id=<?php echo $id; ?>">Edit Employee</a>
                                                                            <a class="dropdown-item" href="#">Deactivate</a>-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                    </tr>
                                                    <?php } ?>
                                            <tfoot>
                                                <tr>
                                                        <th></th>
                                                        <th width="25%">Employee Name</th>
                                                        <th>Salary</th>
                                                        <th width="25%">Salary Components</th>
                                                        <th width="20%">Deductions</th>
                                                        <th width="20%">Grade</th>
                                                        <th width="5%">Action</th>
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