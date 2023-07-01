<?php include 'header.php';?>
<?php
if(isset($_POST['submit_pro_name'])){
  $project_name=$_POST['project_name'];

$sql1 = "UPDATE settings SET project_name='$project_name'";
  if (mysqli_query($conn, $sql1)) {
   ?>
   <script type="text/javascript">
    alert("Update Successfully.");
    window.location.href = "Settings.php";
  </script>
  <?php
}
}
?>


<?php
if(isset($_POST['submit'])){
  $email=$_POST['email'];

$sql1 = "UPDATE login SET email='$email' WHERE user_no='$user_no'";
  if (mysqli_query($conn, $sql1)) {
   ?>
   <script type="text/javascript">
    alert("Update Successfully.");
    window.location.href = "Settings.php";
  </script>
  <?php
}
}
?>
<?php 
if(isset($_POST['change_btn'])){

$cur_pass=$_POST['cur_pass'];
$new_password=$_POST['new_password'];
$con_password=$_POST['con_password'];

$base4=base64_encode($cur_pass);
$md5=md5($cur_pass);
$current_pass=$base4.$md5.$base4;


$query_chck_pass = mysqli_query($conn,"SELECT * FROM login WHERE password='$current_pass' AND user_no='$user_no'") or die(mysqli_error($conn)); 

  if(mysqli_num_rows($query_chck_pass)>0){

    if($new_password==$con_password){

$base4=base64_encode($new_password);
$md5=md5($new_password);
$new_pass=$base4.$md5.$base4;

    $query1="UPDATE login set password='$new_pass' WHERE user_no='$user_no'";
    if(mysqli_query($conn, $query1)) {
      ?>
     <script type="text/javascript">
      alert('Your Password Detail Has Been Update Successfully.');
      window.location.href = "Settings.php";
    </script>
    <?php

   }


    }
    else{
      ?>
      <script>
            alert('Please Enter Same Passwords.');
        </script>
        <?php
    }



}
else{
?>
<script type="text/javascript">
  alert('Sorry! Current Password Is Inavalid.');
</script>
    <?php
} 

}
?>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include 'sidebar.php'; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Settings</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Settings</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      

<?php 
if ($user_type=="Admin") { ?>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- jquery validation -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Set Project Name</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="" method="POST">
                  <div class="card-body">

                    <div class="form-group">
                      <label for>Name*</label>
                      <input type="" required name="project_name" class="form-control" placeholder="Enter Name" value="<?php $query = "SELECT * FROM settings"; $result = mysqli_query($conn, $query); $row = mysqli_fetch_array($result); echo $row['project_name'];?>">
                    </div>
                    
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-center">
                    <button type="submit" name="submit_pro_name" class="btn btn-primary">Update</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">

            </div>
            <!--/.col (right) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section> <?php } ?>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- jquery validation -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Login Email</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="" method="POST">
                  <div class="card-body">

                    <div class="form-group">
                      <label for>Email*</label>
                      <input type="email" required name="email" class="form-control" placeholder="Enter Email" value="<?php $query = "SELECT * FROM login WHERE user_no='$user_no'"; $result = mysqli_query($conn, $query); $row = mysqli_fetch_array($result); echo $row['email'];?>">
                    </div>
                    
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-center">
                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">

            </div>
            <!--/.col (right) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->



      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- jquery validation -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Change Account Password</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="" method="POST">
                  <div class="card-body">

                    <div class="form-group">
                      <label for>Current Password*</label>
                      <input type="" required name="cur_pass" class="form-control" placeholder="Current Password">
                    </div>


                    <div class="form-group">
                      <label for>New Password*</label>
                      <input type="" required name="new_password" class="form-control" placeholder="New Password">
                    </div>


                    <div class="form-group">
                      <label for>Confirm Password*</label>
                      <input type="" required name="con_password" class="form-control" placeholder="Confirm Password">
                    </div>
                    
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-center">
                    <button type="submit" name="change_btn" class="btn btn-primary">Update</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">

            </div>
            <!--/.col (right) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
    </div>
    <?php include 'footer.php';?>

