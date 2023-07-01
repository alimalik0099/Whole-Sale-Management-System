<?php include 'header.php';
if ($user_type!="Admin") {

$query_access = "SELECT * FROM user_access WHERE user_no ='$user_no' AND access='Manage Purchases'";
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

<style>
    #hidden_col{
        display:none;
    }
</style>
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
            <h1>Purchase Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Purchase</li>
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
                <h3 class="card-title">All Purchase Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th id="hidden_col">ID</th>
                      <th>No#</th>
                      <th>Supplier</th>
                      <th>Total Products</th>
                      <th>Total Cost</th>
                      <th>Total Payable</th>
                      <th>Purchase Date</th>
                      <th>Purchase Via</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query = "SELECT * FROM purchase ORDER BY purchase_date DESC";
                    $result = mysqli_query($conn, $query);  
                    if ($result->num_rows > 0) {
                         $key=1;
                      while($row = mysqli_fetch_array($result))  
                      {
                        ?>
                        <tr>
                             <td id="hidden_col"><?php echo $key;?></td>
                          <td><?php echo $purchase_no=$row['purchase_no'];?></td>
                          <td>
                         <?php 
                         $supplier=$row['supplier'];
                         $query1 = "SELECT * FROM suppliers WHERE supplier_no='$supplier'";
                         $result1 = mysqli_query($conn, $query1);  
                         $row1 = mysqli_fetch_array($result1);
                         echo $row1['name'];                         
                       ?></td>
                     <td><?php $query5 = "SELECT * FROM purchase_details WHERE purchase_no='$purchase_no'"; 
                       $result5 = mysqli_query($conn, $query5);
                       if ($result5){ $row5 = mysqli_num_rows($result5); 
                       if ($row5){ printf($row5); } else{ echo "0"; } } ?></td>
                       <td><?php echo $row['total_cost_price'];?></td>
                       <td><?php echo $row['total_payable'];?></td>
                       <td><?php echo $row['purchase_date'];?></td>
                       <td><?php echo $row['purchase_via'];?></td>
                       <td><a href="Detail-Purchase.php?purchase_no=<?php echo $row['purchase_no'];?>"><button class="btn btn-primary btn-sm">Detail</button></a> 

                        <a target="blank" href="Purchase-Recipt.php?purchase_no=<?php echo $row['purchase_no'];?>"><button class="btn btn-dark btn-sm mt-1">Print</button></a></td>
                        </tr>
                        <?php 
                     $key++; }
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
 <script type="text/javascript">
      // var table = $('#example1').DataTable({order:[[0,"desc"]]});
      
      $('#exemple1').DataTable({
    "order": [[ 5, "desc" ]], //or asc 
    "columnDefs" : [{"targets":5, "type":"date-eu"}],
});
    </script>
    <?php include 'footer.php';?>
