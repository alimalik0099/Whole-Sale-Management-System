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
if(isset($_POST['submit_supplier'])){
  $supplier_no=rand(0,100000);
  $supplier_name=$_POST['supplier_name'];
  $business_name=$_POST['business_name'];
  $phone_no=$_POST['phone_no'];

  $sql1 = "INSERT INTO suppliers(supplier_no,name,business_name,phone_no)
  VALUES ('$supplier_no','$supplier_name','$business_name','$phone_no')";
  if (mysqli_query($conn, $sql1)) {
   ?>
   <script type="text/javascript">
    alert("New User Add Successfully.");
    window.location.href = "Add-New-Products.php";
  </script>

  <?php
}
}
?>


<?php
if(isset($_POST['submit_category'])){
  $name=$_POST['name'];

  $sql1 = "INSERT INTO categories(name)
  VALUES ('$name')";
  if (mysqli_query($conn, $sql1)) {
   ?>
   <script type="text/javascript">
    alert("New Category Add Successfully.");
    window.location.href = "Add-New-Products.php";
  </script>
  <?php
}
}
?>


<?php
if(isset($_POST['submit_product'])){
  $p_name=$_POST['p_name'];
  $supplier=$_POST['supplier'];
  $category=$_POST['category'];
  $pruchase_price=$_POST['pruchase_price'];
  $sale_price=$_POST['sale_price'];
  $supplier=$_POST['supplier'];

  $sql1 = "INSERT INTO products(name,category,purchase_price,sale_price,stock,supplier)
  VALUES ('$p_name','$category','$pruchase_price','$sale_price','0','$supplier')";
  if (mysqli_query($conn, $sql1)) {

   ?>
   <script type="text/javascript">
    alert("New Product Add Successfully.");
    window.location.href = "Add-New-Products.php";
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
              <h1>Add New Product</h1>
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
                      <input type="" class="form-control" placeholder="Enter Product Name" required name="p_name">               
                    </div>

                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-12 col-12">

                       <div class="form-group">
                        <label for>Supplier Name</label>
                        <select class="form-control" name="supplier" required>
                          <option value="">Please select Supplier</option>
                          <?php
                          $query = "SELECT * FROM suppliers ORDER BY id DESC";
                          $result = mysqli_query($conn, $query);  
                          if ($result->num_rows > 0) {
                            while($row = mysqli_fetch_array($result))  
                            {
                              ?>
                              <option value="<?php echo $row['supplier_no'];?>">Name: <?php echo $row['name'];?> | Business Name: <?php echo $row['business_name'];?></option>
                            <?php } } ?>
                          </select>
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#newsupplier">Add New</button>
                        </div>
                      </div>


                      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                          <label for>Product Category*</label>
                          <select class="form-control" name="category" required>
                            <option value="">Please select name</option>
                            <?php
                            $query = "SELECT * FROM categories ORDER BY id DESC";
                            $result = mysqli_query($conn, $query);  
                            if ($result->num_rows > 0) {
                              while($row = mysqli_fetch_array($result))  
                              {
                                ?>
                                <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                              <?php } } ?>
                            </select>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#newcategory">Add New</button>
                          </div>

                        </div>
                      </div> 


                      <div class="form-group">
                          <label for>Cost Price Per Item</label>
                          <input type="number" required class="form-control" name="pruchase_price" placeholder="Enter Cost Price Per Item">

                        </div>
                         <div class="form-group">
                          <label for>Sell Price*</label>
                          <input type="number" required class="form-control" name="sale_price" placeholder="Enter Sell Price">
                        </div>

                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-center">
                    <button type="submit" name="submit_product" class="btn btn-primary" id="submit_btn">Submit</button>
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



    <div id="newsupplier" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header bg-dark">
            <h4 class="modal-title">Add New Supplier</h4>
          </div>
          <div class="modal-body">
           <form action="" method="POST">
            <div class="card-body">

              <div class="form-group">
                <label for>Supplier Name*</label>
                <input type="" required name="supplier_name" class="form-control" placeholder="Enter Full Name">
              </div>

              <div class="form-group">
                <label for="">Business Name*</label>
                <input type="" name="business_name" class="form-control" required placeholder="Enter Supplier Business Name">
              </div>

              <div class="form-group">
                <label for="">Phone No*</label>
                <input type="" name="phone_no" class="form-control" required placeholder="Enter Supplier Phone No*">
              </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
              <button type="submit" name="submit_supplier" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>





  <div id="newcategory" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header bg-dark">
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
              <button type="submit" name="submit_category" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>


  <?php include 'footer.php';?>

