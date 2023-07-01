<?php include 'header.php';?>

<?php

if ($user_type!="Admin") {
  ?>
<script type="text/javascript">window.location.href="index.php";</script>
<?php }
$employee_no=$_GET['employee_no'];

if (isset($_POST['delete'])) {
 $id=$_POST['id'];

 $query2="DELETE FROM user_access WHERE id='$id' AND user_no='$employee_no'";
 if(mysqli_query($conn, $query2)){ 
  ?>
  <script type="text/javascript">
    alert("A Record has been delete successfully.");
  </script>

  <?php
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
            <h1>Employee Access</h1>
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
                <h3 class="card-title">All Employee Access</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped" data-order='[[ 0, "desc" ]]'>
                  <thead>
                    <tr>
                      <th>Access Details</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query = "SELECT * FROM user_access WHERE user_no='$employee_no' ORDER BY id DESC";
                    $result = mysqli_query($conn, $query);  
                    if ($result->num_rows > 0) {
                      while($row = mysqli_fetch_array($result))  
                      {
                        ?>
                        <tr>
                          <td>This Employee Can <b><?php echo $row['access'];?></b></td>
                          <td>
                            <form action="" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
                              <input type="hidden" value="<?php echo $row['id'];?>" name="id">
                              <button type="submit" name="delete" class="btn bg-gradient-danger btn-sm">Delete</button>
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
