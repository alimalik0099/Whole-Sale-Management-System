<?php include 'header.php';?>
<?php 

if ($user_type!="Admin") {
$query_access = "SELECT * FROM user_access WHERE user_no ='$user_no' AND access='Manage Customers'";
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
$query = "SELECT * FROM clients WHERE id='$id'";
$result = mysqli_query($conn, $query);  
$row = mysqli_fetch_array($result);

?>
    <?php
    if(isset($_POST['submit'])){
      $client_name=$_POST['client_name'];
      $business_name=$_POST['business_name'];
      $phone_no=$_POST['phone_no'];

      $sql1 = "UPDATE clients SET name='$client_name',business_name='$business_name',phone_no='$phone_no' WHERE id='$id'";
      if (mysqli_query($conn, $sql1)) {
       ?>
       <script type="text/javascript">
        alert("User Edit Successfully.");
        window.location.href = "Edit-Client.php?id="+<?php echo $id;?>;
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
                <h1>Update Customer</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active">Customer</li>
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
                    <h3 class="card-title">Customer Detail</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form action="" method="POST">
                    <div class="card-body">

                      <div class="form-group">
                        <label for>Customer Name*</label>
                        <input type="" required name="client_name" class="form-control" placeholder="Enter Full Name" value="<?php echo $row['name'];?>">
                      </div>

                      <div class="form-group">
                        <label for="">Business Name*</label>
                        <input type="" name="business_name" class="form-control" required placeholder="Enter Client Business Name" value="<?php echo $row['business_name'];?>">
                      </div>

                      <div class="form-group">
                        <label for="">Phone No*</label>
                        <input type="" name="phone_no" class="form-control" required placeholder="Enter Client Phone No*" value="<?php echo $row['phone_no'];?>">
                      </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-center">
                      <button type="submit" name="submit" class="btn btn-primary">Update</button>
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

