<?php include 'header.php';
if ($user_type!="Admin") {
$query_access = "SELECT * FROM user_access WHERE user_no ='$user_no' AND access='Manage Transaction History'";
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
            <h1>Transaction Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Transaction</li>
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
                <h3 class="card-title">All Transaction Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped" data-order='[[ 0, "desc" ]]'>
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Amount</th>
                      <th>Type</th>
                      <th>Date</th>
                      <th>Description</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query = "SELECT * FROM transactions ORDER BY id DESC";
                    $result = mysqli_query($conn, $query);  
                    if ($result->num_rows > 0) {
                      while($row = mysqli_fetch_array($result))  
                      {
                        ?>
                        <tr>
                          <td><?php echo $row['id'];?></td>
                          <td><?php echo $row['amount'];?></td>
                          <td><?php echo $row['type'];?></td>
                          <td><?php echo $row['date'];?></td>
                          <td><?php echo $row['description'];?></td>
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
