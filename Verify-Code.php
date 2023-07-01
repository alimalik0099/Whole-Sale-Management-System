<?php
session_start();
include "db.php";
if(!isset($_SESSION['verification_code']['verification_code'])){
  $verification_code=$_SESSION['verification_code'];
  $ForgetEmail=$_SESSION['ForgetEmail'];
}
if (!$verification_code) {
  header('Location: index.php');
}?>
<?php
if(isset($_POST['submit'])){

  $input_code = mysqli_real_escape_string($conn,$_POST['input_code']);
  if ($input_code==$verification_code) {

    $_SESSION['ForgetEmail']=$ForgetEmail;
     header('Location: New-Password.php');
  }
  else{
    ?>
    <script type="text/javascript">alert('Sorry! Your given code is wrong.')</script>
    <?php
  }

  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>    <?php 
$query_ltd = "SELECT * FROM settings";
$result_ltd = mysqli_query($conn, $query_ltd);  
$row_ltd = mysqli_fetch_array($result_ltd);
echo $row_ltd['project_name'];
?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b><?php 
$query_ltd = "SELECT * FROM settings";
$result_ltd = mysqli_query($conn, $query_ltd);  
$row_ltd = mysqli_fetch_array($result_ltd);
echo $row_ltd['project_name'];
?></b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">A Verification Code has been sent to the email address provided. Please check your email and insert the Code below to reset your Password. Please Note: Email may take a few minutes to arrive and may be in your spam/junk folder.</p>
      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="" name="input_code" required class="form-control" placeholder="Enter Code">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope-open-text"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Next</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mt-3 mb-1">
        <a href="index.php">Login</a>
      </p>
    </div>
  </div>
</div>
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
