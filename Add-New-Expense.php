<?php include 'header.php';?>
<?php
if ($user_type!="Admin") {
$query_access = "SELECT * FROM user_access WHERE user_no ='$user_no' AND access='Manage Expenses'";
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

$query = "SELECT * FROM wallet";
$result = mysqli_query($conn, $query);  
$row = mysqli_fetch_array($result);
$cash_balance=$row['cash_balance'];
$bank_balance=$row['bank_balance'];

if(isset($_POST['submit_type'])){
  $type_name=$_POST['type_name'];
  $sql1 = "INSERT INTO expense_type(name)
  VALUES ('$type_name')";
  if (mysqli_query($conn, $sql1)) {
   ?>
   <script type="text/javascript">
    alert("New Type Add Successfully.");
    window.location.href = "Add-New-Expense.php";
  </script>
  <?php
}
}

if(isset($_POST['submit'])){
  $expense_type=$_POST['expense_type'];
  $amount=$_POST['amount'];
  $expense_date=$_POST['expense_date'];
  $description=$_POST['description'];
  $pay_via=$_POST['pay_via'];

  if ($pay_via=="Cash") {
    if ($amount<=$cash_balance) {

     $sql1 = "INSERT INTO expense(type,description,date,pay_via,amount)
     VALUES ('$expense_type','$description','$expense_date','$pay_via','$amount')";
     if (mysqli_query($conn, $sql1)) {


       $sql2="UPDATE wallet SET cash_balance=$cash_balance-$amount";
       if (mysqli_query($conn,$sql2)) {
        $date=date('d-m-Y H:i:s');


        $sql3= "INSERT INTO transactions(amount,type,date,description)
        VALUES ('$amount','Cash','$date','Expense')";
        if (mysqli_query($conn,$sql3)) {

          ?>
          <script type="text/javascript">
            alert("New Expense Add Successfully.");
            window.location.href = "Add-New-Expense.php";
          </script>
          <?php

        }     


      }   


    }

  }
  else{
 ?>
 <script type="text/javascript">
  alert("Insufficient Balance In Cash.");
  window.location.href = "Add-New-Expense.php";
</script>
<?php
}

}

elseif ($pay_via=="Bank") {
    if ($amount<=$bank_balance) {

     $sql1 = "INSERT INTO expense(type,description,date,pay_via,amount)
     VALUES ('$expense_type','$description','$expense_date','$pay_via','$amount')";
     if (mysqli_query($conn, $sql1)) {


       $sql2="UPDATE wallet SET bank_balance=$bank_balance-$amount";
       if (mysqli_query($conn,$sql2)) {
        $date=date('d-m-Y H:i:s');


        $sql3= "INSERT INTO transactions(amount,type,date,description)
        VALUES ('$amount','Cash','$date','Expense')";
        if (mysqli_query($conn,$sql3)) {

          ?>
          <script type="text/javascript">
            alert("New Expense Add Successfully.");
            window.location.href = "Add-New-Expense.php";
          </script>
          <?php

        }     


      }   


    }

  }
  else{
 ?>
 <script type="text/javascript">
  alert("Insufficient Balance In Bank.");
  window.location.href = "Add-New-Expense.php";
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
              <h1>Add New Expense</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Expense</li>
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
                  <h3 class="card-title">Expense Detail</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="" method="POST">
                  <div class="card-body">

                   <div class="form-group">
                    <label for>Expense Type*</label>
                    <select class="form-control" name="expense_type" required>
                      <option value="">Please select type</option>
                      <?php
                      $query = "SELECT * FROM expense_type ORDER BY id DESC";
                      $result = mysqli_query($conn, $query);  
                      if ($result->num_rows > 0) {
                        while($row = mysqli_fetch_array($result))  
                        {
                          ?>
                          <option value="<?php echo $row['name'];?>"><?php echo $row['name'];?></option>
                        <?php } } ?>
                      </select>
                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#newsupplier">Add New</button>
                    </div>

                    <div class="form-group">
                      <label for="">Amount*</label>
                      <input type="" name="amount" class="form-control" required placeholder="Enter Amount">
                    </div>


                    <div class="form-group">
                      <label for>Description*</label>
                      <input type="text" required class="form-control" name="description" placeholder="Please enter expense description">               
                    </div>


                    <div class="form-group">
                      <label for>Expense Date*</label>
                      <input type="date" required class="form-control" name="expense_date" value="<?php echo date('Y-m-d');?>">               
                    </div>


                    <div class="form-group">
                      <label for>Pay Expense Amount Via*</label>
                      <select required class="form-control" name="pay_via">
                        <option value="Cash">From Cash Balance | Balance: <?php echo $cash_balance;?></option>
                        <option value="Bank">From Bank Balance | Balance: <?php echo $bank_balance;?></option>
                      </select>              
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





    <div id="newsupplier" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header bg-dark">
            <h4 class="modal-title">Add New Expense Type</h4>
          </div>
          <div class="modal-body">
           <form action="" method="POST">
            <div class="card-body">

              <div class="form-group">
                <label for>Type Name*</label>
                <input type="" required name="type_name" class="form-control" placeholder="Enter Type Name">
              </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
              <button type="submit" name="submit_type" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
  <?php include 'footer.php';?>

