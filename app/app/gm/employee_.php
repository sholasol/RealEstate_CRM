

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
			<h2 class="hk-pg-title font-weight-600">Employees Management </h2>
                    </div>
                    <div class="d-flex mb-0 flex-wrap">
                        <div class="btn-group btn-group-sm btn-group-rounded mb-15 mr-15" role="group">
                            <a href="" class="btn btn-outline-secondary">Vendors</a>
                            <a href="" class="btn btn-outline-secondary">Expenses</a>
                        </div>
                        <a href="aemployee" class="btn btn-sm btn-outline-secondary btn-rounded btn-wth-icon icon-wthot-bg mb-15"><span class="icon-label"><span class="feather-icon"><i data-feather="plus"></i></span> </span><span class="btn-text">New Employee</span></a>
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
                    <!--<div class="hk-row">
                        
                        
                        
                        
                            <div class="col-lg-8">
                                    <div class="card card-refresh">
                                            <div class="refresh-container">
                                                    <div class="loader-pendulums"></div>
                                            </div>
                                            <div class="card-header card-header-action">
                                                    <h6>Double Click Campaigning Stats</h6>
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
                                                                    <span class="d-10 bg-primary rounded-circle d-inline-block"></span><span>Click Rate</span>
                                                            </div>
                                                            <div class="hk-legend">
                                                                    <span class="d-10 bg-brown-light-5 rounded-circle d-inline-block"></span><span>Impressions</span>
                                                            </div>
                                                    </div>
                                                    <div id="area_chart" class="echart" style="height: 194px;"></div>
                                            </div>
                                    </div>
                            </div>
                            <div class="col-lg-4">
                                            <div class="card">
                                            <div class="card-header card-header-action">
                                                    <h6>Lead Stats</h6>
                                                    <div class="d-flex align-items-center card-action-wrap">
                                                            <div class="inline-block dropdown">
                                                                    <a class="dropdown-toggle no-caret" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="ion ion-ios-more"></i></a>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                            <a class="dropdown-item" href="#">Action</a>
                                                                            <a class="dropdown-item" href="#">Another action</a>
                                                                            <a class="dropdown-item" href="#">Something else here</a>
                                                                            <div class="dropdown-divider"></div>
                                                                            <a class="dropdown-item" href="#">Separated link</a>
                                                                    </div>
                                                            </div>
                                                    </div>
                                            </div>
                                            <div class="card-body">
                                                    <div class="hk-legend-wrap mb-20">
                                                            <div class="hk-legend">
                                                                    <span class="d-10 bg-brown rounded-circle d-inline-block"></span><span>Won Leads</span>
                                                            </div>
                                                            <div class="hk-legend">
                                                                    <span class="d-10 bg-brown-light-5 rounded-circle d-inline-block"></span><span>Lost Leads</span>
                                                            </div>
                                                    </div>
                                                    <div id="e_chart_4" class="echart" style="height:194px;"></div>
                                            </div>
                                    </div>
                            </div>
                    </div>-->
                    <div class="d-flex align-items-center justify-content-between mt-40 mb-20">
                            <h4>Employees</h4>
                            <button class="btn btn-sm btn-link">view all</button>
                    </div>
                    <div class="card">
                            <div class="card-body pa-0">
                                <div class="table-wrap">
                                        <table id="datable_1" class="table table-hover w-100 display pb-30">
                                            <thead>
                                                <tr>
                                                        <th>Logo</th>
                                                        <th>Project</th>
                                                        <th>Company</th>
                                                        <th>Update</th>
                                                        <th>Budget</th>
                                                        <th>Tasks</th>
                                                        <th class="w-20">Status</th>
                                                        <th>Deadline</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <tr>
                                                            <td><img class="img-fluid rounded" src="dist/img/logo1.jpg" alt="icon"></td>
                                                            <td>Branding</td>
                                                            <td>Pineapple Inc</td>
                                                            <td>13 Nov 2018</td>
                                                            <td><span class="badge badge-success">Completed</span></td>
                                                            <td><span class="d-flex align-items-center"><i class="zmdi zmdi-time-restore font-25 mr-10 text-light-40"></i><span>0</span></span></td>
                                                            <td>
                                                                    <div class="progress-wrap lb-side-left mnw-125p">
                                                                            <div class="progress-lb-wrap">
                                                                                    <label class="progress-label mnw-25p">95%</label>
                                                                                    <div class="progress progress-bar-xs">
                                                                                            <div class="progress-bar bg-success w-95" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                    </div>
                                                                            </div>
                                                                    </div>
                                                            </td>
                                                            <td>10 Nov 2018</td>
                                                    </tr>
                                                    <tr>
                                                            <td><img class="img-fluid rounded" src="dist/img/logo2.jpg" alt="icon"></td>
                                                            <td>Website</td>
                                                            <td>Gooole co.</td>
                                                            <td>30 Nov 2018</td>
                                                            <td><span class="badge badge-primary">In Process</span></td>
                                                            <td><span class="d-flex align-items-center"><i class="zmdi zmdi-time-restore font-25 mr-10 text-light-40"></i><span>3</span></span></td>
                                                            <td>
                                                                    <div class="progress-wrap lb-side-left mnw-125p">
                                                                            <div class="progress-lb-wrap">
                                                                                    <label class="progress-label mnw-25p">70%</label>
                                                                                    <div class="progress progress-bar-xs">
                                                                                            <div class="progress-bar bg-primary w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                    </div>
                                                                            </div>
                                                                    </div>
                                                            </td>
                                                            <td>13 Dec 2018</td>
                                                    </tr>
                                                    <tr>
                                                            <td><img class="img-fluid rounded" src="dist/img/logo3.jpg" alt="icon"></td>
                                                            <td>Collaterals</td>
                                                            <td>Big Energy</td>
                                                            <td>12 Nov 2018</td>
                                                            <td><span class="badge badge-danger">Behind</span></td>
                                                            <td><span class="d-flex align-items-center"><i class="zmdi zmdi-time-restore font-25 mr-10 text-light-40"></i><span>14</span></span></td>
                                                            <td>
                                                                    <div class="progress-wrap lb-side-left mnw-125p">
                                                                            <div class="progress-lb-wrap">
                                                                                    <label class="progress-label mnw-25p">35%</label>
                                                                                    <div class="progress progress-bar-xs">
                                                                                            <div class="progress-bar bg-danger w-35" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                    </div>
                                                                            </div>
                                                                    </div>
                                                            </td>
                                                            <td>21 Oct 2018</td>
                                                    </tr>
                                                    <tr>
                                                            <td><img class="img-fluid rounded" src="dist/img/logo4.jpg" alt="icon"></td>
                                                            <td>Branding, Print</td>
                                                            <td>Novotel</td>
                                                            <td>10 Nov 2018</td>
                                                            <td><span class="badge badge-primary">In process</span></td>
                                                            <td><span class="d-flex align-items-center"><i class="zmdi zmdi-time-restore font-25 mr-10 text-light-40"></i><span>6</span></span></td>
                                                            <td>
                                                                    <div class="progress-wrap lb-side-left mnw-125p">
                                                                            <div class="progress-lb-wrap">
                                                                                    <label class="progress-label mnw-25p">85%</label>
                                                                                    <div class="progress progress-bar-xs">
                                                                                            <div class="progress-bar bg-primary w-85" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                    </div>
                                                                            </div>
                                                                    </div>
                                                            </td>
                                                            <td>14 Nov 2018</td>
                                                    </tr>
                                                    <tr>
                                                            <td><img class="img-fluid rounded" src="dist/img/logo5.jpg" alt="icon"></td>
                                                            <td>Web Application</td>
                                                            <td>Folkswagan</td>
                                                            <td>12 Nov 2018</td>
                                                            <td><span class="badge badge-danger">Behind</span></td>
                                                            <td><span class="d-flex align-items-center"><i class="zmdi zmdi-time-restore font-25 mr-10 text-light-40"></i><span>9</span></span></td>
                                                            <td>
                                                                    <div class="progress-wrap lb-side-left">
                                                                            <div class="progress-lb-wrap">
                                                                                    <label class="progress-label mnw-25p">30%</label>
                                                                                    <div class="progress progress-bar-xs">
                                                                                            <div class="progress-bar bg-danger w-30" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                    </div>
                                                                            </div>
                                                                    </div>
                                                            </td>
                                                            <td>15 Oct 2018</td>
                                                    </tr>
                                            <tfoot>
                                                <tr>
                                                            <th>Logo</th>
                                                            <th>Project</th>
                                                            <th>Company</th>
                                                            <th>Update</th>
                                                            <th>Budget</th>
                                                            <th>Tasks</th>
                                                            <th class="w-20">Status</th>
                                                            <th>Deadline</th>
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