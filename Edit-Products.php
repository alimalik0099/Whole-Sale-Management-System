<?php include 'header.php';?>
<?php 

if ($user_type!="Admin") {
$query_access = "SELECT * FROM user_access WHERE user_no ='$user_no' AND access='Manage Products'";
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
$id=$_GET['id'];
$query = "SELECT * FROM products WHERE id='$id'";
$result = mysqli_query($conn, $query);  
$row = mysqli_fetch_array($result);

?>
    <?php
    if(isset($_POST['submit_product'])){
      $p_name=$_POST['p_name'];
      $pruchase_price=$_POST['pruchase_price'];
      $sale_price=$_POST['sale_price'];

      $sql1 = "UPDATE products SET name='$p_name',purchase_price='$pruchase_price',sale_price='$sale_price' WHERE id='$id'";
      if (mysqli_query($conn, $sql1)) {
       ?>
       <script type="text/javascript">
        alert("Product Edit Successfully.");
        window.location.href = "Edit-Products.php?id="+<?php echo $id;?>;
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
                <h1>Update Products</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active">Products</li>
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
                    <h3 class="card-title">Product Detail</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                 <form action="" method="POST">
                  <div class="card-body">


                    <div class="form-group">
                      <label for>Product Name*</label>
                      <input type="" class="form-control" placeholder="Enter Product Name" name="p_name" value="<?php echo $row['name'];?>">               
                    </div>


                      <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                         <div class="form-group">
                          <label for>Purcahse Price*</label>
                          <input type="number" required class="form-control" name="pruchase_price" placeholder="Enter Purchase Price" value="<?php echo $row['purchase_price'];?>">

                        </div>
                      </div>



                      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                         <div class="form-group">
                          <label for>Sale Price*</label>
                          <input type="number" required class="form-control" name="sale_price" placeholder="Enter Sale Price" value="<?php echo $row['sale_price'];?>">

                        </div>
                      </div>

                    </div>

                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-center">
                    <button type="submit" name="submit_product" class="btn btn-primary">Update</button>
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

