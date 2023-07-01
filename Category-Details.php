<?php include 'header.php';?>

<?php
if (isset($_POST['delete'])) {
 $id=$_POST['id'];

 $query="DELETE FROM categories WHERE id='$id'";
 if(mysqli_query($conn, $query)){
?>
  <script type="text/javascript">
    alert("A Category has been delete successfully.");
    window.location.href = "Category-Details.php";
  </script>

  <?php
 }

 }
 ?>

 <?php
if(isset($_POST['submit'])){
  $name=$_POST['name'];

  $sql1 = "INSERT INTO categories(name)
  VALUES ('$name')";
  if (mysqli_query($conn, $sql1)) {
   ?>
   <script type="text/javascript">
    alert("New Category Add Successfully.");
    window.location.href = "";
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
            <h1>Categories Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
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
                <button class="float-right btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Add New Category</button>
                <h3 class="card-title">All Categories Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped" data-order='[[ 0, "desc" ]]'>
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Category Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query = "SELECT * FROM categories ORDER BY id DESC";
                    $result = mysqli_query($conn, $query);  
                    if ($result->num_rows > 0) {
                      while($row = mysqli_fetch_array($result))  
                      {
                        ?>
                        <tr>
                          <td><?php echo $row['id'];?></td>
                          <td><?php echo $row['name'];?></td>
                          <td><a href="Edit-Category.php?id=<?php echo $row['id'];?>"><button class="btn btn-warning btn-sm">Update</button></a>
                            <form action="" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this Category');">
                              <input type="hidden" value="<?php echo $row['id'];?>" name="id">
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


    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
          <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Add New Category</h4>
        </div>
        <div class="modal-body">
          <form action="" method="POST">
                  <div class="card-body">

                    <div class="form-group">
                      <label for>Category Name*</label>
                      <input type="" required name="name" class="form-control" placeholder="Enter Category Name">
                    </div>
                    
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-center">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
    <?php include 'footer.php';?>
