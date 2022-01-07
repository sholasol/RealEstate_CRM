<?php 
include 'nav.php'; 


$id = $_GET['id'];
$y=  dbConnect()->prepare("SELECT * FROM estates WHERE id=:id ");
$y->bindParam(':id', $id);
$y->execute();
$ra=$y->fetch();

$estate = $ra['estate_name'];


if(isset($_POST['save'])){
    
    if(empty($_POST['estate'])){
        $e="Please enter estate/product name "; 
        echo  " <script>alert('$e');window.location='eproduct?id=$id' </script>";  
    }
    if(empty($_POST['amount'])){
        $e="Please enter product price "; 
        echo  " <script>alert('$e');window.location='eproduct?id=$id' </script>"; 
    }
    if(empty($_POST['location'])){
        $e="Please enter product location "; 
        echo  " <script>alert('$e');window.location='eproduct?id=$id' </script>"; 
    }
    if(empty($_POST['desc'])){
        $e="Please enter product description "; 
        echo  " <script>alert('$e');window.location='eproduct?id=$id' </script>"; 
    }
    else{  
        $est = check_input($_POST["estate"]);
        $price = check_input($_POST["amount"]); 
        $loc = check_input($_POST["location"]);
        $desc = check_input($_POST["desc"]);
        $type = check_input($_POST["type"]);
        $f1 = check_input($_POST["f1"]);
        $f2 = check_input($_POST["f2"]);
        $f3 = check_input($_POST["f3"]);
        $f4 = check_input($_POST["f4"]);
        $f5 = check_input($_POST["f5"]);
        $f6 = check_input($_POST["f6"]);
        $dt= date('Y-m-d');
        $user = $uid;
        
        
        $in=  dbConnect()->prepare("UPDATE estates SET estate_name=:est, estate_description=:desc, price=:price, estate_location=:loc, 
                type=:type, feature1=:f1, feature2=:f2, feature3=:f3, feature4=:f4, feature5=:f5, feature6=:f6, added=:add WHERE id=:id ");
        $in->bindParam(':est', $est);
        $in->bindParam(':desc', $desc);
        $in->bindParam(':price', $price);
        $in->bindParam(':loc', $loc);
        $in->bindParam(':type', $type);
        $in->bindParam(':f1', $f1);
        $in->bindParam(':f2', $f2);
        $in->bindParam(':f3', $f3);
        $in->bindParam(':f4', $f4);
        $in->bindParam(':f5', $f5);
        $in->bindParam(':f6', $f6);
        $in->bindParam(':add', $dt);
        $in->bindParam(':id', $id);
            if($in->execute()){

                echo"
                        <br><br><br><br><br><br><br><br><br>
                        <div style='width:100%;text-align:center;vertical-align:bottom'>
                                <div class='loader'></div>
                                <br>
                                <meta http-equiv='refresh' content='1;url=product'>
                                <span class='itext' style='color: blueviolet;'>Processing. Please Wait!...</span>
                        </div><br><br><br><br><br><br><br><br>";

            }else{
                $e="Operation Failed"; 
                echo  " <script>alert('$msg');window.location='eproduct?id=$id' </script>";
            }
        
        }
        
        
   
    
    
}




if(isset($_POST['change'])){
    $im_id = $_POST['img'];
    
    $imm= dbConnect()->prepare("SELECT * FROM estate_images WHERE id='$im_id'");
    $imm->execute();
    $rw = $imm->fetch();
    $path = $rw['image'];
    
    //Upload media File
    $imgFile2 = $_FILES['uploaded_file']['name'];
    $tmp_dir2 = $_FILES['uploaded_file']['tmp_name'];
    $imgSize2 = $_FILES['uploaded_file']['size'];
    
    
    $upload_dir2 = 'upload/'; // upload directory

    $imgExt2 = strtolower(pathinfo($imgFile2,PATHINFO_EXTENSION)); // get image extension

    // valid image extensions
    $valid_extensions2 = array('jpeg', 'jpg', 'png', 'gif', 'JPEG'); // valid extensions

    // rename uploading image
    $proImage2 = rand(1000,1000000).".".$imgExt2;

    $media_file="upload/".$proImage2;

    // allow valid image file formats
    if(in_array($imgExt2, $valid_extensions2)){			
            // Check file size '500MB'
            if($imgSize2 < 500000000){
                
              unlink($path);

              move_uploaded_file($tmp_dir2,$upload_dir2.$proImage2);
              
              $img_upd = dbConnect()->prepare("UPDATE estate_images SET image='$media_file' WHERE id='$im_id'");
              if($img_upd->execute()){
                  $msg= "Property Image has been changed!";
                  echo  " <script>alert('$msg');window.location='product' </script>";
              }else{
                  $msg= "Oops! Operation failed";
                  echo  " <script>alert('$msg');window.location='eproduct?id=$id' </script>";
              }

            } 
    }else{
        $msg= "Oops! Invalid image format";
         echo  " <script>alert('$msg');window.location='eproduct?id=$id' </script>";
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
                <!-- Title -->
                <div class="hk-pg-header align-items-top">
                    <div>
                        <h4 class="hk-pg-title font-weight-600 mb-10">New Product</h4>
                    </div>
                </div>
                <!-- /Title -->
                
                
                <!-- Row -->
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                                
                        <div class="col-md-6 mb-20">
                            <!--<label for="validationCustom01">Tax</label>-->
                            <input type="text" class="form-control" id="validationCustom01"  name="estate" value="<?php echo $ra['estate_name']; ?>"  required>
                            <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                        </div>
                        <div class="col-md-6 mb-20">
                            <!--<label for="validationCustom01">Tax</label>-->
                            <input type="number" class="form-control" id="validationCustom02" name="amount" value="<?php echo $ra['price']; ?>"   required>
                            <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                        </div>
                        <div class="col-md-6 mb-20">
                             <select name="type" class="form-control" required>
                                    <option><?php echo $ra['type']; ?></option>
                                    <option>Duplex</option>
                                    <option>Terrace</option>
                                    <option>Bungalow</option>
                                    <option>Land</option>
                                </select>
                            <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                        </div>
                        <div class="col-md-6 mb-20">
                            <!--<label for="validationCustom01">Tax</label>-->
                            <input type="text" class="form-control" id="validationCustom04" name="location" value="<?php echo $ra['estate_location']; ?>"   required>
                            <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                        </div>
                        <div class="col-md-4 mb-20">
                            <input type="text" class="form-control" id="validationCustom04" name="f1" value="<?php echo $ra['feature1']; ?>" >
                            <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                        </div>
                        <div class="col-md-4 mb-20">
                            <input type="text" class="form-control" id="validationCustom04" name="f2" value="<?php echo $ra['feature2']; ?>">
                            <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                        </div>
                        <div class="col-md-4 mb-20">
                            <input type="text" class="form-control" id="validationCustom04" name="f3" value="<?php echo $ra['feature3']; ?>">
                            <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                        </div>
                        <div class="col-md-4 mb-20">
                            <input type="text" class="form-control" id="validationCustom04" name="f4" value="<?php echo $ra['feature4']; ?>">
                            <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                        </div>
                        <div class="col-md-4 mb-20">
                            <input type="text" class="form-control" id="validationCustom04" name="f5" value="<?php echo $ra['feature5']; ?>">
                            <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                        </div>
                        <div class="col-md-4 mb-20">
                            <input type="text" class="form-control" id="validationCustom04" name="f6" value="<?php echo $ra['feature6']; ?>">
                            <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <section class="hk-sec-wrapper">
                                <h5 class="hk-sec-title">Product description</h5>
                                <div class="row">
                                    <div class="col-sm mb-20">
                                        <div class="tinymce-wrap">
                                            <textarea name="desc"  class="tinymce"><?php echo $ra['estate_description']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-block" type="submit" name="save"> Update Product</button>
                            </section>
                        </div>
                        
                    </div>
                </form>
                <!-- /Row -->
                <hr style="background: #14c599">
                        <div class="col-md-12 col-sm-12">
                            <div class="breadcrumb-nav">
                                <div class="row"> 
                                    <?php
                                    /*
                                        $im= dbConnect()->prepare("SELECT * FROM estate_images WHERE estate_name='$estate'");
                                        $im->execute();
                                        $i=0;
                                        while($r=$im->fetch()){
                                            $i++;
                                            $i_id= $r['id'];
                                            $img= $r['image'];
                                            */
                                      ?>
<!--                                    <div class="col-md-2">
                                            <img src='<?php // echo $img; ?>'><br>
                                            <form method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="img" value="<?php echo $i_id; ?>"/>
                                                <input type="file" name="uploaded_file" class="form-control"/>
                                                <button type="submit" name="change" class="btn btn-success btn-block" ><small>Change</small></button>
                                            </form>
                                    </div>-->


                                        <?php // } ?>
                                </div>

                            </div>
                        </div>
                
            <!-- /Container -->
            <?php include 'foot.php'; ?>