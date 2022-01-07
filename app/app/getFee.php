<?php
include_once "../connect/connect.php";

$fee = $_POST['fee'];   // customer id

//$sql = "SELECT address FROM customer WHERE custID=".$pid;

//$result = mysqli_query($con,$sql);



//$sql=  dbConnect()->prepare("SELECT * FROM fees, statutory WHERE fees.id = statutory.fee AND statutory.fee='$fee' ");
$sql=  dbConnect()->prepare("SELECT * FROM statutory WHERE fees='$fee' ");
$sql->execute();

$users_arr = array();

while( $row = $sql->fetch() ){
    $amount = $row['amount'];
    $project = $row['project'];

    $users_arr[] = array("amt" => $amount, "project" => $project);
}

// encoding array to json format
echo json_encode($users_arr);
?>