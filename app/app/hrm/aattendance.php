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
                        <h2 class="hk-pg-title font-weight-600 mb-10">Attendance</h2>
                    </div>
                </div>
                <!-- /Title -->
                

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
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
                        </section>  
                   </div>
                <!-- /Row -->
                </div>
            <!-- /Container -->
            <?php include 'foot2.php'; ?>