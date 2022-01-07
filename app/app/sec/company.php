<?php 
include 'nav.php'; 
$q1=  dbConnect()->prepare("SELECT * FROM company");
$q1->execute();
$no = $q1->rowCount();
$r=$q1->fetch();
?>
<!-- Main Content -->
        <div class="hk-pg-wrapper">
			<!-- Container -->
            <div class="container mt-xl-50 mt-sm-30 mt-15">
                <!-- Title -->
                <div class="hk-pg-header align-items-top">
                    <div>
                        <h2 class="hk-pg-title font-weight-600 mb-10">Company Detail</h2>
                    </div>
                    <div class="btn-group btn-group-sm btn-group-rounded mb-15 mr-15" role="group">
                               <?php if($no < 1){echo"<a href='acompany' class='btn btn-outline-secondary'>Set Company</a> ";}?>  
                                <!--<a href="ecompany" class="btn btn-outline-secondary">Edit Company</a>-->
                        </div>
                </div>
                <!-- /Title -->
                

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="card">
                                            <h6 class="card-header border-0">
                                                    <i class="ion ion-md-clipboard font-21 mr-10"></i>Company
                                            </h6>
                                            <div class="card-body pa-0">
                                                <div class="table-wrap">
                                                    <div class="table-responsive">
                                                        <table class="table table-sm mb-0">
                                                            <tbody>
                                                                <tr>
                                                                    <th class="w-40" scope="row">Name</th>
                                                                    <th class="w-60" scope="row"><?php echo $r['name']; ?></th>
                                                                </tr>
                                                                <tr>
                                                                    <td class="w-40">Phone</td>
                                                                    <td class="w-60"><?php echo $r['phone']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="w-40">Email</td>
                                                                    <td class="w-60"><?php echo $r['email']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="w-40">State</td>
                                                                    <td class="w-60"><?php echo $r['state']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="w-40">ZIP</td>
                                                                    <td class="w-60"><?php echo $r['zip']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="w-40">Address</td>
                                                                    <td class="w-60 text-success"><?php echo $r['address']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="w-40">Company Logo</td>
                                                                    <td class="w-60 text-success">
                                                                        <img src="<?php echo $r['logo']; ?>" >
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </section>  
                   </div>
                <!-- /Row -->
                </div>
            <!-- /Container -->
            <?php include 'foot.php'; ?>