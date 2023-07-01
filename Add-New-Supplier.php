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
if(isset($_POST['submit'])){
  $supplier_no=rand(0,100000);
  $supplier_name=$_POST['supplier_name'];
  $business_name=$_POST['business_name'];
  $phone_no=$_POST['phone_no'];

  $sql1 = "INSERT INTO suppliers(supplier_no,name,business_name,phone_no)
  VALUES ('$supplier_no','$supplier_name','$business_name','$phone_no')";
  if (mysqli_query($conn, $sql1)) {

  $sql2 = "INSERT INTO ledgers(ledger_type,ledger_user,user_no,amount)
  VALUES ('Purchase','Supplier','$supplier_no',0)";
  if (mysqli_query($conn, $sql2)) {  
   ?>
   <script type="text/javascript">
    alert("New User Add Successfully.");
    window.location.href = "Add-New-Supplier.php";
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
              <h1>Add New Supplier</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Supplier</li>
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
                  <h3 class="card-title">Supplier Detail</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
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
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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

