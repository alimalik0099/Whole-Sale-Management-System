<?php
include "db.php";
session_start();



if(isset($_POST['login'])){


   $email = mysqli_real_escape_string($conn,$_POST['email']);
   $loginPassword = mysqli_real_escape_string($conn,$_POST['password']);
   
   $base4=base64_encode($loginPassword);
   $md5=md5($loginPassword);
   $logn_pass=$base4.$md5.$base4;


   $query_Admin = mysqli_query($conn,"SELECT * FROM login WHERE email ='$email' AND binary password='$logn_pass'") or die(mysqli_error($query_Admin)); 
   if(mysqli_num_rows($query_Admin)>0){
    

    $query = "SELECT * FROM login WHERE email ='$email' AND binary password='$logn_pass'";
    $result = mysqli_query($conn, $query);  
    $row = mysqli_fetch_array($result);
    $user_type=$row['user_type'];
    $user_no=$row['user_no'];
      
      $_SESSION['user_type']= $user_type;
      $_SESSION['user_no']= $user_no;  
      ?>
      <script type="text/javascript">
        window.location.href = "index.php";
      </script>
      <?php
}
else{
  ?>
  <script type="text/javascript">
    alert('Please Enter Correct Details.');
    window.location.href = "login.php";
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
  <title>    <?php 
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
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b><?php echo $row_ltd['project_name'];?></b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" required name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" required name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button class="btn btn-primary btn-block" type="submit" name="login">Submit</button><br>
            <span>Login Email: admin@admin.com</span><br>
          <span>Login Password: 123</span>
          </div>
          <!-- /.col -->
          
        </div>
      </form>
      <p class="mb-1 mt-2">
        <a href="forgot-password.php">I forgot my password</a>
      </p>



    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
