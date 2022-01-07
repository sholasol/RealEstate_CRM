<?php
include 'nav.php';
if(isset($_GET['id'])){
    $cust = $_GET['id'];
    
    $deactivate=  dbConnect()->prepare("UPDATE customer SET status='Inactive' WHERE custID='$cust'");
$deactivate->execute();

if($deactivate->execute()){
                
                $inx= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='UserID with ID of $uid, Deativated user with Customer ID of $cust', created=now()");
                $inx->execute();
                    
                    echo"
                    <br><br><br><br><br><br><br><br><br>
                    <div style='width:100%;text-align:center;vertical-align:bottom'>
                            <div class='loader'></div>
                            <br>
                            <meta http-equiv='refresh' content='1;url=contact'>
                            <span class='itext' style='color: blueviolet;'>Deactivating Customer. Please Wait...</span>
                    </div><br><br><br><br><br><br><br><br>";
            }
    
    
    
    
    
}elseif(isset($_GET['ven'])){
    $ven = $_GET['ven'];
    
    
    $deactivate2=  dbConnect()->prepare("UPDATE vendor SET status='Inactive' WHERE id='$ven'");
$deactivate2->execute();

if($deactivate2->execute()){
                
                $inx2= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='UserID with ID of $uid, Deativated vendor with Vendor ID of $ven', created=now()");
                $inx2->execute();
                    
                    echo"
                    <br><br><br><br><br><br><br><br><br>
                    <div style='width:100%;text-align:center;vertical-align:bottom'>
                            <div class='loader'></div>
                            <br>
                            <meta http-equiv='refresh' content='1;url=vendor'>
                            <span class='itext' style='color: blueviolet;'>Deactivating Vendor. Please Wait...</span>
                    </div><br><br><br><br><br><br><br><br>";
            }
}



elseif(isset($_GET['emp'])){
    $emp = $_GET['emp'];
    
    
    $deactivate3=  dbConnect()->prepare("UPDATE users SET status='Inactive' WHERE userID='$emp'");
    $deactivate3->execute();
    
    $deactivate4=  dbConnect()->prepare("UPDATE employee SET status='Inactive' WHERE userID='$emp'");
    $deactivate4->execute();

if($deactivate3->execute()){
                
                $inx3= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity=' Deativated user with ID of $emp', created=now()");
                $inx3->execute();
                    
                    echo"
                    <br><br><br><br><br><br><br><br><br>
                    <div style='width:100%;text-align:center;vertical-align:bottom'>
                            <div class='loader'></div>
                            <br>
                            <meta http-equiv='refresh' content='1;url=employee'>
                            <span class='itext' style='color: blueviolet;'>Deactivating User. Please Wait...</span>
                    </div><br><br><br><br><br><br><br><br>";
            }
}


  


  


?>

