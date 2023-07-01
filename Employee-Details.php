<?php include 'header.php';?>

<?php

if ($user_type!="Admin") {
  ?>
<script type="text/javascript">window.location.href="index.php";</script>
<?php }
if (isset($_POST['delete'])) {
 $employee_no=$_POST['employee_no'];

 $query="DELETE FROM employee WHERE employee_no='$employee_no'";
 if(mysqli_query($conn, $query)){

  $query1="DELETE FROM login WHERE user_no='$employee_no'";
 if(mysqli_query($conn, $query1)){

   $query3="DELETE FROM user_access WHERE user_no='$employee_no'";
 if(mysqli_query($conn, $query3)){
?>
  <script type="text/javascript">
    alert("A Employee has been delete successfully.");
    window.location.href = "Employee-Details.php";
  </script>

  <?php
 }
}
 }
}
 ?>
<link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
   <?php include 'sidebar.php';?>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Employees Details</h1>
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
          <div class="col-12">


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Employee Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped" data-order='[[ 0, "desc" ]]'>
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Employee Name</th>
                      <th>Phone No</th>
                      <th>Email</th>
                      <th>Accesses</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query = "SELECT * FROM employee ORDER BY id DESC";
                    $result = mysqli_query($conn, $query);  
                    if ($result->num_rows > 0) {
                      while($row = mysqli_fetch_array($result))  
                      {
                        ?>
                        <tr>
                          <td><?php echo $row['id'];?></td>
                          <td><?php echo $row['name'];?></td>
                          <td><?php echo $row['phone_no'];?></td>
                          <td><?php echo $row['email'];?></td>
                          <td class="align-middle text-center">
                          <a href="Employee-Access.php?employee_no=<?php echo $row['employee_no'];?>"><button type="button" class="btn bg-gradient-primary btn-sm">View</button></a>
                        </td>
                          <td><a href="Edit-Employee.php?employee_no=<?php echo $row['employee_no'];?>"><button class="btn btn-warning btn-sm">Update</button></a>
                            <form action="" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this User');">
                              <input type="hidden" value="<?php echo $row['employee_no'];?>" name="employee_no">
                              <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                          </td>

                        </tr>
                        <?php 
                      }
                    }
                    ?>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <?php include 'footer.php';?>
