<?php 
include 'nav.php'; 
if(isset($_POST['save'])){
    
    
}
function check_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<!-- Main Content -->
        <div class="hk-pg-wrapper">
			<!-- Container -->
            <div class="container mt-xl-50 mt-sm-30 mt-15">
                <!-- Title -->
                <div class="hk-pg-header align-items-top">
                    <div>
                        <h4 class="hk-pg-title font-weight-600 mb-10"><i class="fa fa-money"></i>  Existing Loan</h4>
                    </div>
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
                                                    <th></th>
                                                    <th>Employee</th>
                                                    <th>Loan Amount</th>
                                                    <th>Tenor</th>
                                                    <th>Purpose</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $s=dbConnect()->prepare("SELECT * FROM loan WHERE status='Approved' ");
                                                $counter=0;
                                                $s->execute();
                                                while($r=$s->fetch()){
                                                    $id=$r['userID'];
                                                    $sts=$r['status'];
                                                    
                                                    $us = dbConnect()->prepare("SELECT * FROM users WHERE userID='$id'");
                                                    $us->execute();
                                                    $ur=$us->fetch();
                                                    $nm=$ur['fname']." ".$ur['lname'];
                                                ?>
                                                    <tr>
                                                            <td><?php echo ++$counter; ?></td>
                                                            <td><?php echo $nm ;?></td>
                                                            <td><span class="badge badge-primary"><?php echo number_format($r['amount']) ;?></span></td>
                                                            <td><?php echo $r['term']." month(s)" ;?></td>
                                                            <td><?php echo $r['purpose'] ;?></td>
                                                            <td>
                                                                <?php 
                                                                if($sts =="Active"){echo"<span class='badge badge-warning'>Pending</span>";}
                                                                elseif($sts =="Approved"){echo"<span class='badge badge-success'>Approved</span>";}
                                                                elseif($sts =="Declined"){echo"<span class='badge badge-danger'>Declined</span>";}
                                                                ?>
                                                            </td>
                                                            <td>
                                                                 <div class="btn-group">
                                                                    <div class="dropdown">
                                                                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle btn-icon-dropdown" type="button"><span class="feather-icon"><i data-feather="user"></i></span> <span class="caret"></span></button>
                                                                        <div role="menu" class="dropdown-menu">
                                                                            <a class="dropdown-item" href="emp_view?id=<?php echo $id; ?>">View Employee</a>
                                                                            <?php
                                                                            if($role=='Admin'){ echo"
                                                                            <a class='dropdown-item' href='#esalary?id= $id'>Approve</a>
                                                                            <a class='dropdown-item' href='#dedC?id=$id'>Declines</a>";
                                                                            }        
                                                                           ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                    </tr>
                                                <?php }?>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th>Employee</th>
                                                    <th>Loan Amount</th>
                                                    <th>Tenor</th>
                                                    <th>Purpose</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
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
            <?php include 'foot.php'; ?>