<?php 
include 'nav.php';

if(isset($_GET['id'])){
    $id =$_GET['id'];
}
//$d=$id;

$epp=  dbConnect()->prepare("SELECT * FROM lead WHERE id='$id' ");
$epp->execute();
$rw=$epp->fetch();

$crt = $rw['createdby'];
//Getting the staff or partner that generate the lead
$qy=  dbConnect()->prepare("SELECT * FROM users WHERE userID='$crt'");
$qy->execute();
$re=$qy->fetch();

$creator = $re['fname']." ".$re['lname'];


if(isset($_POST['lead'])){
    if(empty($_POST['progress'])){
        $e="Please select lead progress"; 
        echo  " <script>alert('$e'); </script>"; 
    }
    elseif(empty($_POST['remark'])){
        $e="Please enter activity detail"; 
        echo  " <script>alert('$e'); </script>"; 
    }else{
        $prg = check_input($_POST["progress"]);
        $rmk = check_input($_POST["remark"]);
        $dt= date('Y-m-d');
        $user = $uid;
        
        $q=  dbConnect()->prepare("INSERT INTO lead_activity SET lead=:lead, progress=:prg, activity=:act, created=:dt, createdby=:by ");
        $q->bindParam(':lead', $id);
        $q->bindParam(':prg', $prg);
        $q->bindParam(':act', $rmk);
        $q->bindParam(':dt', $dt);
        $q->bindParam(':by', $user);
        if($q->execute()){
            
            $upd=  dbConnect()->prepare("UPDATE lead SET progress='$prg' WHERE lead='$id'");
            $upd->execute();
            
            
            $in= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Creation of lead activity by userID $uid', created=now()");
            $in->execute();
            
            echo"
                    <br><br><br><br><br><br><br><br><br>
                    <div style='width:100%;text-align:center;vertical-align:bottom'>
                            <div class='loader'></div>
                            <br>
                            <meta http-equiv='refresh' content='1;url=lview?id=$id'>
                            <span class='itext' style='color: blueviolet;'>Processing. Please Wait!...</span>
                    </div><br><br><br><br><br><br><br><br>";
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
<!-- Main Content -->
        <div class="hk-pg-wrapper">
			<!-- Container -->
            <div class="container mt-xl-50 mt-sm-30 mt-15">
                
                
                
                
                
                
                <div class="profile-cover-wrap overlay-wrap">
                     <div class="profile-cover-img" style="background-image:url('../dist/img/trans-bg.jpg')"></div>
                        <div class="bg-overlay bg-trans-dark-60"></div>
                        <div class="container profile-cover-content py-50">
                                <div class="hk-row"> 
                                        <div class="col-lg-6">
                                                <div class="media align-items-center">
                                                        <div class="media-img-wrap  d-flex">
                                                                <div class="avatar">
                                                                        <img src="../dist/img/avatar12.jpg" alt="user" class="avatar-img rounded-circle">
                                                                </div>
                                                        </div>
                                                        <div class="media-body">
                                                                <div class="text-white text-capitalize display-6 mb-5 font-weight-400"><?php echo $rw['fname']." ".$rw['lname']; ?></div>
                                                                <div class="font-14 text-white"><span class="mr-5"><span class="font-weight-500 pr-5">Joined</span><span class="mr-5"><?php echo $rw['created'] ?></span></span><span></span></div>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="col-lg-6">
                                                <div class="button-list">
                                                        <a href="#" class="btn btn-dark btn-wth-icon icon-wthot-bg btn-rounded"><span class="btn-text"><?php echo $rw['phone']; ?></span><span class="icon-label"><i class="icon icon-phone"></i> </span></a>
                                                       <!-- <a href="#" class="btn btn-icon btn-icon-circle btn-indigo btn-icon-style-2"><span class="btn-icon-wrap"><i class="fa fa-facebook"></i></span></a>
                                                        <a href="#" class="btn btn-icon btn-icon-circle btn-sky btn-icon-style-2"><span class="btn-icon-wrap"><i class="fa fa-twitter"></i></span></a>
                                                        <a href="#" class="btn btn-icon btn-icon-circle btn-purple btn-icon-style-2"><span class="btn-icon-wrap"><i class="fa fa-instagram"></i></span></a>-->
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div><hr/>
                <!-- Title -->
                <div class="hk-pg-header align-items-top">
                    <div>
                        <!--<h4 class="hk-pg-title font-weight-600 mb-10">Summary</h4>-->
                       <?php echo"<a data-toggle='modal' data-target='#exampleModalLarge01' class='btn btn-sm btn-outline-secondary btn-rounded btn-wth-icon icon-wthot-bg mb-15'><span class='icon-label'><span class='feather-icon'><i data-feather='book'></i></span> </span><span class='btn-text'> New Activity</span></a>";?>
                    </div>
                </div>
                <!-- /Title -->
                

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-3">
                        <section class="hk-sec-wrapper">
                            <label>Name:</label> <span class="badge badge-primary"> <?php echo $rw['fname']." ".$rw['lname']; ?></span><br>
                            <label>Created:</label> <span class="badge badge-info"> <?php echo $rw['created'] ?></span><br>
                            <label>Status:</label> <span class="badge badge-success"> <?php echo $rw['progress'] ?></span><br>
                            <label>Remark:</label>  <?php echo $rw['remark'] ?>
                        </section>
                    </div>
                    <div class="col-xl-9">
                        <section class="hk-sec-wrapper">
                           <div class="table-wrap">
                                            <div class="table-responsive">
                                                    <table id="datable_1" class="table table-hover w-100 display pb-30">
                                                            <thead>
                                                                    <tr>
                                                                            <th>S/N</th>
                                                                            <th>Activity</th>
                                                                            <th>Progress</th>
                                                                            <th width="10%">Date</th>
                                                                    </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                $q=  dbConnect()->prepare("SELECT * FROM lead_activity WHERE lead='$id'");
                                                                $q->execute();
                                                                $counter =0;
                                                                while($ro=$q->fetch()){
                                                                    $id=$ro['id'];
                                                                    $prog = $ro['progress'];
                                                                ?>
                                                                    <tr>
                                                                            <td><?php echo ++$counter; ?></td>
                                                                            <td><?php echo $ro['activity']; ?></td>
                                                                            <td>
                                                                                <?php
                                                                                if($prog !=="Closed"){echo "<span class='badge badge-warning'>$prog</span>";}
                                                                                else{echo "<span class='badge badge-success'>$prog</span>"; }
                                                                                ?>
                                                                                
                                                                            </td>
                                                                            <td><span class="badge badge-info"><?php echo $ro['created']; ?></span></td>
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
            <!-- Modal -->
                <div class="modal fade" id="exampleModalLarge01" tabindex="-1" role="dialog" aria-labelledby="exampleModalLarge01" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Create Activity</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="needs-validation" method="post" novalidate>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="firstName"> Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-user"></i></span>
                                            </div>
                                            <input class="form-control" id="firstName" name="fname" type="text" value="<?php echo $rw['fname']." ".$rw['lname']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                            <label for="progress">Progress</label>
                                            <select name="progress" class="form-control" >
                                                    <option><?php echo $rw['progress'];?></option>
                                                    <option>Prospect</option>
                                                    <option>Contacted</option>
                                                    <option>Negotiation</option>
                                                    <option>Closed</option>
                                                </select>
                                            <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                        </div>
                                </div>
                                    <div class="row">
                                       <div class="form-group col-md-12">
                                           <label for="address">Activity Note</label>
                                           <div class="input-group">
                                               <div class="input-group-prepend">
                                                   <span class="input-group-text"><i class="icon icon-book-open"></i></span>
                                               </div>
                                               <input class="form-control" name="remark" id="remark"  type="text">
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
            <?php include 'foot.php'; ?>