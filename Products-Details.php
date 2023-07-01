<?php include 'header.php';?>

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
            <h1>Product Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Product</li>
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
                <h3 class="card-title">All Product Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped" data-order='[[ 0, "desc" ]]'>
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Product Name</th>
                      <th>Supplier</th>
                      <th>Category</th>
                      <th>Stock Quantity</th>
                      <th>Cost Price</th>
                      <th>Sell Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query = "SELECT * FROM products ORDER BY id DESC";
                    $result = mysqli_query($conn, $query);  
                    if ($result->num_rows > 0) {
                      while($row = mysqli_fetch_array($result))  
                        { $supplier=$row['supplier'];
                      ?>
                      <tr>
                        <td><?php echo $product_id=$row['id'];?></td>
                        <td><?php echo $row['name'];?></td>
                        <td>
                         <?php 
                         $query1 = "SELECT * FROM suppliers WHERE supplier_no='$supplier'";
                         $result1 = mysqli_query($conn, $query1);  
                         $row1 = mysqli_fetch_array($result1);
                         echo $row1['name'];
                         
                       ?></td>

                       <td><?php $category=$row['category'];
                      $query1 = "SELECT * FROM categories WHERE id='$category'";
                       $result1 = mysqli_query($conn, $query1); 
                       if($result1->num_rows>0){ 
                       $row1 = mysqli_fetch_array($result1);
                       echo $row1['name'];
                     }
                     ?></td>
                     <td><?php echo $row['stock'];?></td>
                     <td><?php echo $row['purchase_price'];?></td>
                     <td><?php echo $row['sale_price'];?></td>
                     
                     <td><a href="Edit-Products.php?id=<?php echo $row['id'];?>"><button class="btn btn-warning btn-sm">Update</button></a>
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
