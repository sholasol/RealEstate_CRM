<?php
include 'nav.php'; 

if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    $sql=  dbConnect()->prepare("UPDATE expense SET status='Decline', notify='Yes' WHERE id='$id'");
    if($sql->execute()){
        echo"
                    <br><br><br><br><br><br><br><br><br>
                    <div style='width:100%;text-align:center;vertical-align:bottom'>
                            <div class='loader'></div>
                            <br>
                            <meta http-equiv='refresh' content='1;url=expense'>
                            <span class='itext' style='color: blueviolet;'>Declining Expense. Please Wait!...</span>
                    </div><br><br><br><br><br><br><br><br>";
    }
    
}

if(isset($_GET['pay'])){
    $py = $_GET['pay'];
    
    $sql=  dbConnect()->prepare("UPDATE expense SET status='Paid', notify='Yes' WHERE id='$py'");
    if($sql->execute()){
        echo"
                    <br><br><br><br><br><br><br><br><br>
                    <div style='width:100%;text-align:center;vertical-align:bottom'>
                            <div class='loader'></div>
                            <br>
                            <meta http-equiv='refresh' content='1;url=expense'>
                            <span class='itext' style='color: blueviolet;'>Processing. Please Wait!...</span>
                    </div><br><br><br><br><br><br><br><br>";
    }
    
}


