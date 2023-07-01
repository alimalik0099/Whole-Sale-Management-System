<?php 
include 'db.php';

$Query = "SELECT * FROM products";
$ExecQuery = mysqli_query($conn, $Query);
echo '<option value="">Please select products</option>';
while ($Result = MySQLi_fetch_array($ExecQuery)) {
	
    echo'<option value='.$Result['id'].'>'. $Result['name'].'</option>';
}
?>