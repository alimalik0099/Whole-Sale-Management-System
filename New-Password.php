<?php
session_start();
include "db.php";
if(!isset($_SESSION['ForgetEmail']['ForgetEmail'])){
  $ForgetEmail=$_SESSION['ForgetEmail'];
}
if (!$ForgetEmail) {
  header('Location: index.php');
}?>
<?php
if(isset($_POST["submit"]))  {  
  
  $new_pass=$_POST['new_pass'];
  $con_pass=$_POST['con_pass'];

  if($new_pass==$con_pass){

  $query_user = "SELECT * FROM login WHERE email='$ForgetEmail'";
  $result_user = mysqli_query($conn, $query_user);  
  $row_user = mysqli_fetch_array($result_user);

  $user_no=$row_user['user_no'];

$base4=base64_encode($new_pass);
$md5=md5($new_pass);
$new_password=$base4.$md5.$base4;

  $query1="UPDATE login set password='$new_password' WHERE email='$ForgetEmail' AND user_no='$user_no'";
  if(mysqli_query($conn, $query1))  
  { 

  $query2="UPDATE employee set password='$new_password' WHERE email='$ForgetEmail' AND employee_no='$user_no'";
  if(mysqli_query($conn, $query2))  
  { 
     ?>
 <script type="text/javascript">
   alert('Your password has been change successfully\nNow you can login with your new password\nThank you.');
   window.location.href="index.php";
 </script>
 <?php
  }
  }
}
else{
 ?>
 <script type="text/javascript">
   alert('Please enter same passwords');
 </script>
 <?php 
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php 
$query_ltd = "SELECT * FROM settings";
$result_ltd = mysqli_query($conn, $query_ltd);  
$row_ltd = mysqli_fetch_array($result_ltd);
echo $row_ltd['project_name'];
?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b><?php echo $row_ltd['project_name']; ?></b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="new_pass" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Confirm Password" name="con_pass" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Change password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="index.php">Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src=".plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src=".plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src=".dist/js/adminlte.min.js"></script>
</body>
</html>
