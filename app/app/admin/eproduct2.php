<?php 
include 'nav.php'; 


$id = $_GET['id'];
$y=  dbConnect()->prepare("SELECT * FROM estates WHERE id=:id ");
$y->bindParam(':id', $id);
$y->execute();
$ra=$y->fetch();


if(isset($_POST['save'])){
    
    if(empty($_POST['estate'])){
        $e="Please enter estate/product name "; 
        echo  " <script>alert('$e'); </script>"; 
    }
    if(empty($_POST['amount'])){
        $e="Please enter product price "; 
        echo  " <script>alert('$e'); </script>"; 
    }
    if(empty($_POST['location'])){
        $e="Please enter product location "; 
        echo  " <script>alert('$e'); </script>"; 
    }
    if(empty($_POST['desc'])){
        $e="Please enter product description "; 
        echo  " <script>alert('$e'); </script>"; 
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
        
        
        
        //processing estate images
        $countfiles = count($_FILES['file']['name']);
        
        
        if($countfiles > 2){
            
        
        
        //echo  " <script>alert('$countfiles');window.location='eproduct?id=$id' </script>";
        

        // Looping all files
        for($i=0;$i<$countfiles;$i++){

         $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');  
         $filename = $_FILES['file']['name'][$i];
         $imgExt = strtolower(pathinfo($filename, PATHINFO_EXTENSION)); // get image extension

         $target_path = "upload/".$filename;

         if(in_array($imgExt, $valid_extensions)){

            // Upload file
             if(move_uploaded_file($_FILES["file"]["tmp_name"][$i], $target_path)){ 
               $fl= dbConnect()->prepare("UPDATE estate_images SET image=:img, created=:crt WHERE estate_name=:est");
               $fl->bindParam(':est', $est);
               $fl->bindParam(':img', $target_path);
               $fl->bindParam(':crt', $dt);
               $fl->execute();

               $status = "Yes";
            }else{
                $status = "No";
                $msg= "Oops! Unable to process the image";

                echo  " <script>alert('$msg');window.location='eproduct?id=$id' </script>";
            }
         }else{
             $status = "No";
             $msg= "Oops! Invalid file type";

                echo  " <script>alert('$msg');window.location='eproduct?id=$id' </script>";
         }
        }
        
        if($status=="Yes"){
            
            
            
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
                echo  " <script>alert('$e'); </script>";
            }
            
            
            
            
            
        
        }
        
        
       
        }else{
            
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
                echo  " <script>alert('$e'); </script>";
            }
            
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
                                   <div class="col-md-12 mb-20">
                                        <label for="validationCustom01">Upload product Images</label>
                                        <input type="file" class="form-control" id="validationCustom02" name="file[]"  multiple>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div> 
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
                
            <!-- /Container -->
            <?php include 'foot.php'; ?>