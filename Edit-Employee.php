<?php include 'header.php';?>
<?php 

if ($user_type!="Admin") {
  ?>
<script type="text/javascript">window.location.href="index.php";</script>
<?php }

$employee_no=$_GET['employee_no'];
$query = "SELECT * FROM employee WHERE employee_no='$employee_no'";
$result = mysqli_query($conn, $query);  
$row = mysqli_fetch_array($result);

?>
    <?php
    if(isset($_POST['submit'])){
  $em_name=$_POST['em_name'];
  $phone_no=$_POST['phone_no'];
  $email=$_POST['email'];

      $sql1 = "UPDATE employee SET name='$em_name',phone_no='$phone_no',email='$email' WHERE employee_no='$employee_no'";
      if (mysqli_query($conn, $sql1)) {

      $sql2 = "UPDATE login SET email='$email'WHERE user_no='$employee_no'";
      if (mysqli_query($conn, $sql2)) {

       ?>
       <script type="text/javascript">
        alert("User Edit Successfully.");
        window.location.href = "Edit-Employee.php?employee_no="+<?php echo $employee_no;?>;
      </script>

      <?php


    }


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
                <h1>Update Employee</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active">Employee</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <!-- left column -->
              <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Employee Detail</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form action="" method="POST"  enctype="multipart/form-data">
                  <div class="card-body">

                    <div class="form-group">
                      <label for>Employee Name*</label>
                      <input type="" required name="em_name" class="form-control" placeholder="Enter Full Name" value="<?php echo $row['name'];?>">
                    </div>

                    <div class="form-group">
                      <label for="">Phone No*</label>
                      <input type="" name="phone_no" class="form-control" required placeholder="Enter Employee Phone No*" value="<?php echo $row['phone_no'];?>">
                    </div>


                    <div class="form-group">
                      <label for="">Account Login Email*</label>
                      <input type="email" name="email" class="form-control" required placeholder="Enter Employee Email*"  value="<?php echo $row['email'];?>">
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
      </div>
      <?php include 'footer.php';?>

