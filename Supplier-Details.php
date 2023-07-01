<?php include 'header.php';?>

<?php

if ($user_type!="Admin") {
$query_access = "SELECT * FROM user_access WHERE user_no ='$user_no' AND access='Manage Suppliers'";
  $result_access = mysqli_query($conn, $query_access);  
  if($result_access->num_rows>0){
    }
    else{
      ?>
    <script type="text/javascript">
      window.location.href="index.php";
    </script>
      <?php
    }
}
if (isset($_POST['delete'])) {
 $id=$_POST['id'];

 $query="DELETE FROM suppliers WHERE id='$id'";
 if(mysqli_query($conn, $query)){
?>
  <script type="text/javascript">
    alert("A User has been delete successfully.");
    window.location.href = "Supplier-Details.php";
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
            <h1>Supplier Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Suppliers</li>
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
                <h3 class="card-title">All Supplier Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped" data-order='[[ 0, "desc" ]]'>
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Supplier Name</th>
                      <th>Business Name</th>
                      <th>Phone No</th>
                      <th>Products</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query = "SELECT * FROM suppliers ORDER BY id DESC";
                    $result = mysqli_query($conn, $query);  
                    if ($result->num_rows > 0) {
                      while($row = mysqli_fetch_array($result))  
                      {
                        ?>
                        <tr>
                          <td><?php echo $row['id'];?></td>
                          <td><?php echo $row['name'];?></td>
                          <td><?php echo $row['business_name'];?></td>
                          <td><?php echo $row['phone_no'];?></td>
                          <td><a href="Supplier-Products.php?user_no=<?php echo $row['supplier_no'];?>"><button class="btn btn-dark btn-sm">View Its Products</button></a></td>
                          <td><a href="Edit-Supplier.php?id=<?php echo $row['id'];?>"><button class="btn btn-warning btn-sm">Update</button></a>
                            <form action="" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this User');">
                              <input type="hidden" value="<?php echo $row['id'];?>" name="id">
                            <!--   <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button> -->
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
