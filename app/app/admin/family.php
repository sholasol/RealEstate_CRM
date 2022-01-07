<?php 
include 'nav.php'; 
?>
<!-- Main Content -->
        <div class="hk-pg-wrapper">
			<!-- Container -->
            <div class="container mt-xl-50 mt-sm-30 mt-15">
                <!-- Title -->
                <div class="hk-pg-header align-items-top">
                    <div>
                        <h4 class="hk-pg-title font-weight-600 mb-10">Family Information</h4>
                    </div>
<!--                    <div class="d-flex mb-0 flex-wrap">
                       <div class="btn-group btn-group-sm btn-group-rounded mb-15 mr-15" role="group">
                           <a href="afamily" class="btn btn-outline-secondary">Create Family</a>
                        </div>
                    </div>-->
                </div>
                <!-- /Title -->
                

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                                 <div class="table-wrap">
                                            <div class="table-responsive">
                                                    <table id="datable_1" class="table table-hover w-100 display pb-30">
                                                            <thead>
                                                                    <tr>
                                                                            <th>S/N</th>
                                                                            <th>Project</th>
                                                                            <th>Name</th>
                                                                            <th>Baale</th>
                                                                            <th>Family Head</th>
                                                                            <th>Other Members</th>
                                                                            <th></th>
                                                                    </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                $q=  dbConnect()->prepare("SELECT * FROM family ");
                                                                $q->execute();
                                                                $counter =0;
                                                                while($ro=$q->fetch()){
                                                                    $pj=$ro['project'];
                                                                    $id=$ro['id'];
                                                                    $query= dbConnect()->prepare("SELECT project FROM project WHERE id='$pj'");
                                                                    $query->execute();
                                                                    $r = $query->fetch();
                                                                    $proj = $r['project'];
                                                                    
                                                                ?>
                                                                    <tr>
                                                                            <td><?php echo ++$counter; ?></td>
                                                                            <td><span class="badge badge-info"><?php echo $proj; ?></span></td>
                                                                            <td><?php echo $ro['family']; ?></td>
                                                                            <td><?php echo $ro['baale']; ?></td>
                                                                            <td><?php echo $ro['head']; ?></td>
                                                                            <td>
                                                                                <small><span class="badge badge-light"><?php echo $ro['secretary']." (Secretary)"; ?></span></small><br>
                                                                                <small><span class="badge badge-light"><?php echo $ro['member1']?></span></small><br>
                                                                                <small><span class="badge badge-light"><?php echo $ro['member2']?></span></small><br>
                                                                                <small><span class="badge badge-light"><?php echo $ro['member3']?></span></small>
                                                                                <td>
                                                                                    <div class="btn-group">
                                                                                        <div class="dropdown">
                                                                                            <button aria-expanded="false" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle btn-icon-dropdown" type="button"><span class="feather-icon"><i data-feather="home"></i></span> <span class="caret"></span></button>
                                                                                            <div role="menu" class="dropdown-menu">
                                                                                                <a class="dropdown-item" href="efamily?id=<?php echo $id; ?>">Edit Family</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </td>
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
