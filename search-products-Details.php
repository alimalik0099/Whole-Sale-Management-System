<?php 
include 'db.php';

$products=$_POST['products'];

$Query = "SELECT * FROM products WHERE id='$products'";
$ExecQuery = mysqli_query($conn,$Query);
$row=mysqli_fetch_assoc($ExecQuery); 
$sale_price=$row['purchase_price'];
 echo json_encode(array("sale_price"=>"$sale_price"));
