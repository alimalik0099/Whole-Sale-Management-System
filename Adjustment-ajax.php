<?php 
include 'db.php';

$user=$_POST['user'];

$Query = "SELECT * FROM ledgers WHERE user_no='$user'";
$ExecQuery = mysqli_query($conn,$Query);
$row=mysqli_fetch_assoc($ExecQuery); 
$amount=$row['amount'];
echo json_encode(array("ledger_amount"=>"$amount"));
