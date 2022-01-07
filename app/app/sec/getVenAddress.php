<?php
include_once "../connect/connect.php";

$cus = $_POST['ven'];   // customer id

//$sql = "SELECT address FROM customer WHERE custID=".$pid;

//$result = mysqli_query($con,$sql);

$sql=  dbConnect()->prepare("SELECT address FROM vendor WHERE id='$cus'");
$sql->execute();

$users_arr = array();

while( $row = $sql->fetch() ){
    $address = $row['address'];
    $email = $row['email'];

    $users_arr[] = array("address" => $address);
}

// encoding array to json format
echo json_encode($users_arr);
?>