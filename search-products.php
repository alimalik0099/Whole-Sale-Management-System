<?php 
include 'db.php';

$supplier=$_POST['supplier'];

$Query = "SELECT * FROM products WHERE supplier='$supplier' ORDER BY name";
$ExecQuery = mysqli_query($conn, $Query);
echo '<option value="">Please select products</option>';
while ($Result = MySQLi_fetch_array($ExecQuery)) {
	
    echo'<option value='.$Result['id'].'>'. $Result['name'].'</option>';
}
?>