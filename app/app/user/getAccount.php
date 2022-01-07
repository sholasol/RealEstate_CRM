<?php
include_once "connect/connect.php";

$bnk = $_POST['cust'];   // customer id

//$sql = "SELECT address FROM customer WHERE custID=".$pid;

//$result = mysqli_query($con,$sql);

$sql=  dbConnect()->prepare("SELECT bank, account, account_name,balance FROM bank WHERE bank='$bnk'");
$sql->execute();

$users_arr = array();

while( $row = $sql->fetch() ){
    $bank = $row['bank'];
    $account = $row['account'];
    $balance= $row['balance'];

    $users_arr[] = array("account" => $account, "bank" => $bank,  "balance" => $balance);
}

// encoding array to json format
echo json_encode($users_arr);
