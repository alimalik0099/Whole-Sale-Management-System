<?php include 'header.php';?>

<?php 

$query_blc = "SELECT * FROM wallet";
$result_blc = mysqli_query($conn, $query_blc); 
$row_blc = mysqli_fetch_array($result_blc);
$cash_balance=$row_blc['cash_balance'];
$bank_balance=$row_blc['bank_balance'];

if(isset($_POST['add_cash_balance'])){
  $amount=$_POST['amount'];

  $date=date('d-m-Y H:i:s');

  $sql2="UPDATE wallet SET cash_balance=$cash_balance+$amount";
    if (mysqli_query($conn,$sql2)) {

   $sql3= "INSERT INTO transactions(amount,type,date,description)
  VALUES ('$amount','Cash','$date','Add Balance Into Cash')";
  if (mysqli_query($conn,$sql3)) {   
       ?>
   <script type="text/javascript">
    alert("Add Successfully.");
    window.location.href = "index.php";
  </script>
  <?php
    }
}
}



if(isset($_POST['add_bank_balance'])){
  $amount=$_POST['amount'];

  $date=date('d-m-Y H:i:s');

  $sql2="UPDATE wallet SET bank_balance=$bank_balance+$amount";
    if (mysqli_query($conn,$sql2)) {

   $sql3= "INSERT INTO transactions(amount,type,date,description)
  VALUES ('$amount','Bank','$date','Add Balance Into Bank')";
  if (mysqli_query($conn,$sql3)) {   
       ?>
   <script type="text/javascript">
    alert("Add Successfully.");
    window.location.href = "index.php";
  </script>
  <?php
    }
}
}
?>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

<?php include 'sidebar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-bill"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Cash Balance</span>
                <span class="info-box-number">
                  <?php if ($result_blc->num_rows>0) {
 echo $row_blc['cash_balance']; } else{echo '0'; } ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-credit-card"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Bank Balance</span>
                <span class="info-box-number"> 
<?php echo $row_blc['bank_balance'];?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Sales</span>
                <span class="info-box-number"><?php
        $query = "SELECT * FROM sale"; 
        $result = mysqli_query($conn, $query);
        if ($result) 
        { 
          $row = mysqli_num_rows($result); 
          if ($row) 
          { 
           printf($row); 
         } 
         else{
          echo "0";
        }
      } ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-solid fa-store"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Products</span>
                <span class="info-box-number"><?php
        $query = "SELECT * FROM products"; 
        $result = mysqli_query($conn, $query);
        if ($result) 
        { 
          $row = mysqli_num_rows($result); 
          if ($row) 
          { 
           printf($row); 
         } 
         else{
          echo "0";
        }
      } ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <?php
                    if ($user_type=="Admin") { ?>
                  <div class="col-md-4">
                    <b>Add Balance Into Cash</b><hr>
                    <form class="text-center" method="POST" action="">
                      <input type="number" style="background-color: transparent;" placeholder="Enter Amount" name="amount" class="form-control" required><br>
                      <button class="btn btn-success" type="submit" name="add_cash_balance">Submit</button>
                    </form>
                  </div>


                  <div class="col-md-4">
                    <b>Add Balance Into Bank</b><hr>
                    <form class="text-center" method="POST" action="">
                      <input type="number" style="background-color: transparent;" placeholder="Enter Amount" name="amount" class="form-control" required><br>
                      <button class="btn btn-primary" type="submit" name="add_bank_balance">Submit</button>
                    </form>
                  </div> <?php } ?>
                  <!-- /.col -->
                  <?php
                  if ($user_type=="Admin") { ?>
                  <div class="col-md-4">
                  <?php } else{ ?><div class="col-md-12"> <?php } ?>
                    <p class="text-center">
                      <strong>Today</strong>
                    </p>


                    <div class="progress-group">
                      Today Sales
            <span class="float-right"><b><?php
            $today=date('Y-m-d');         
        $query = "SELECT * FROM sale WHERE sale_date='$today'"; 
        $result = mysqli_query($conn, $query);
        if ($result) 
        { 
          $row = mysqli_num_rows($result); 
          if ($row) 
          { 
          $print=printf($row); 
         } 
         else{
          echo $print=0;
        }
      } ?></b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: <?php printf($row);?>%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                       Today Expenses
            <span class="float-right"><b><?php
            $today=date('Y-m-d');         
$query = "SELECT sum(amount) as amt FROM expense WHERE date='$today'";
$result = mysqli_query($conn, $query);  
$row = mysqli_fetch_array($result);
echo $today_amt=$row['amt'];
 ?></b></span>

 <?php
            $today=date('Y-m-d');         
        $query3 = "SELECT * FROM expense WHERE date='$today'"; 
        $result3 = mysqli_query($conn, $query3);
        if ($result3) 
        { 
          $row3 = mysqli_num_rows($result3); 
      } ?>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: <?php printf($row3);?>%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      Today Purchasing
                      <span class="float-right"><b><?php
            $today=date('Y-m-d');         
        $query = "SELECT * FROM purchase WHERE purchase_date='$today'"; 
        $result = mysqli_query($conn, $query);
        if ($result) 
        { 
          $row = mysqli_num_rows($result); 
          if ($row) 
          { 
          $print=printf($row); 
         } 
         else{
          echo $print=0;
        }
      } ?></b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: <?php printf($row);?>%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> </span>
                      <h5 class="description-header">
<?php
$query = "SELECT sum(total_payable) as amt FROM sale";
$result = mysqli_query($conn, $query);  
$row = mysqli_fetch_array($result);
if ($row['amt']!=0) {
echo $row['amt'];
}
else{
  echo 0;
}
 ?>
                      </h5>
                      <span class="description-text">TOTAL SALE AMOUNT</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-warning"><i class="fas fa-caret-up"></i></span>
                      <h5 class="description-header">
<?php
$query = "SELECT sum(total_payable) as amt FROM purchase";
$result = mysqli_query($conn, $query);  
$row = mysqli_fetch_array($result);
if ($row['amt']!=0) {
echo $row['amt'];
}
else{
  echo 0;
}
 ?></h5>
                      <span class="description-text">TOTAL PURCHASE AMOUNT</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 col-6">
                    <div class="description-block">
                      <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i></span>
                      <h5 class="description-header"><?php
$query = "SELECT sum(amount) as amt FROM expense";
$result = mysqli_query($conn, $query);  
$row = mysqli_fetch_array($result);
if ($row['amt']!=0) {
echo $row['amt'];
}
else{
  echo 0;
}
 ?></h5>
                      <span class="description-text">TOTAL EXPENSE AMOUNT</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->

 <?php 
if ($user_type!="Admin") { 
$query_access = "SELECT * FROM user_access WHERE user_no ='$user_no' AND access='Manage Transaction History'";
  $result_access = mysqli_query($conn, $query_access);  
  if($result_access->num_rows>0){

  ?>       
        <div class="row">
          <!-- Left col -->
          <div class="col-md-12">
    
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Recent Transactions</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Amount</th>
                      <th>Type</th>
                      <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                    $query = "SELECT * FROM transactions ORDER BY id DESC LIMIT 5";
                    $result = mysqli_query($conn, $query);  
                    if ($result->num_rows > 0) {
                      while($row = mysqli_fetch_array($result))  
                      {
                        ?>
                    <tr>
                      <td><a href="#"><?php echo $row['id'];?></a></td>
                      <td><?php echo $row['amount'];?></td>
                      <td>
                        <div class="sparkbar" data-color="#00a65a" data-height="20"><?php echo $row['type'];?></div>
                      </td>
                      <td>
                        <?php 
                        if ($row['description']=="Expense") { ?>
                        <span class="badge badge-danger">Expense</span>
                      <?php } elseif ($row['description']=="Purchasing") {?>
                        <span class="badge badge-danger">Purchasing</span>
                      <?php
                      } elseif ($row['description']=="Add Balance Into Bank") {?>
                        <span class="badge badge-success">Add Balance Into Bank</span>
                      <?php } elseif($row['description']=="Add Balance Into Cash"){ ?><span class="badge badge-success">Add Balance Into Cash</span><?php } elseif($row['description']=="Sale"){ ?><span class="badge badge-warning">Sale a Product</span><?php } elseif($row['description']=="Ledger Adjustment"){ ?><span class="badge badge-secondary">Ledger Adjustment</span><?php }?>
                      </td>
                    </tr>
                  <?php } } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="Transactions.php" class="btn btn-sm btn-info float-right">View All Transactions</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-4">
  
          </div>
          <!-- /.col -->
        </div>
      <?php } } ?>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
<?php include 'footer.php';?>