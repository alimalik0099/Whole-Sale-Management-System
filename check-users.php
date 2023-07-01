<?php
$ip=$_SERVER['REMOTE_ADDR'];
echo $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
if($query && $query['status'] == 'success') {
  $country=$query['country'];
  if ($country=="Gibraltar" OR $country=="Pakistan") {
  }
  else{
  	?>
  	<script type="text/javascript">
  		// window.location.href='http://sphynx5768.com/sorry.php';
  	</script>
  	<?php
  }
}

else{
?>
  	<script type="text/javascript">
  		// window.location.href='http://sphynx5768.com/sorry.php';
  	</script>
  	<?php
}
?>