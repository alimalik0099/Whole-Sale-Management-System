<?php include 'header.php';?>
<?php

$query = "SELECT * FROM wallet";
$result = mysqli_query($conn, $query);  
$row = mysqli_fetch_array($result);
$cash_balance=$row['cash_balance'];
$bank_balance=$row['bank_balance'];

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
    window.location.href = "Add-New-Purchase.php";
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
    window.location.href = "Add-New-Purchase.php";
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
  $qty=$_POST['qty'];
  $pruchase_price=$_POST['pruchase_price'];
  $sale_price=$_POST['sale_price'];
  $purchase_date=$_POST['purchase_date'];
  $pay_via=$_POST['pay_via'];
  $pay_type=$_POST['pay_type'];
  if ($pay_type=="Pay Custom Amount") {
    $pay_amt=$_POST['custom_pay_amt'];
  }
  else{
       $pay_amt=$pruchase_price * $qty;
  }
  


  if ($pay_via=="Cash") {
    if ($pay_amt<=$cash_balance) {
  
  $sql1 = "INSERT INTO products(name,supplier,category,qty,purchase_price,sale_price,purchase_date)
  VALUES ('$p_name','$supplier','$category','$qty','$pruchase_price','$sale_price','$purchase_date')";
  if (mysqli_query($conn, $sql1)) {

    $sql2="UPDATE wallet SET cash_balance=$cash_balance-$pay_amt";
    if (mysqli_query($conn,$sql2)) {

      $date=date('d-m-Y H:i:s');

    $sql3= "INSERT INTO transactions(amount,type,date,description)
  VALUES ('$pay_amt','Cash','$date','Purchase a Product')";
  if (mysqli_query($conn,$sql3)) {

   ?>
   <script type="text/javascript">
    alert("New Purchase Add Successfully.");
    // window.location.href = "Add-New-Purchase.php";
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
    // window.location.href = "Add-New-Purchase.php";
  </script>
  <?php
    }
    
  }
  elseif ($pay_via=="Bank") {
    if ($pay_amt<=$bank_balance) {
  
  $sql1 = "INSERT INTO products(name,supplier,category,qty,purchase_price,sale_price,purchase_date)
  VALUES ('$p_name','$supplier','$category','$qty','$pruchase_price','$sale_price','$purchase_date')";
  if (mysqli_query($conn, $sql1)) {

    $sql2="UPDATE wallet SET bank_balance=$bank_balance-$pay_amt";
    if (mysqli_query($conn,$sql2)) {

      $date=date('d-m-Y H:i:s');

    $sql3= "INSERT INTO transactions(amount,type,date,description)
  VALUES ('$pay_amt','Bank','$date','Purchase a Product')";
  if (mysqli_query($conn,$sql3)) {

   ?>
   <script type="text/javascript">
    alert("New Purchase Add Successfully.");
    // window.location.href = "Add-New-Purchase.php";
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
    // window.location.href = "Add-New-Purchase.php";
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
              <h1>Add New Product Purchase</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Purchase Product</li>
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
                  <h3 class="card-title">Purchase Detail</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                
                <form action="" method="POST">
                  <div class="card-body">


                    <div class="form-group">
                      <label for>Product Name*</label>
                      <input type="" class="form-control" placeholder="Enter Product Name" name="p_name">               
                    </div>

                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-12 col-12">

                       <div class="form-group">
                        <label for>Supplier Name*</label>
                        <select class="form-control" name="supplier" required>
                          <option value="">Please select name</option>
                          <?php
                          $query = "SELECT * FROM suppliers ORDER BY id DESC";
                          $result = mysqli_query($conn, $query);  
                          if ($result->num_rows > 0) {
                            while($row = mysqli_fetch_array($result))  
                            {
                              ?>
                              <option value="<?php echo $row['id'];?>">Name: <?php echo $row['name'];?> | Business Name: <?php echo $row['business_name'];?></option>
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
                          <label for>Purchase Qty*</label>
                          <input type="number" required class="form-control" name="qty" placeholder="Enter Quantity" onkeyup="payable_fun()" id="purchase_qty">

                        </div>


                      <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                         <div class="form-group">
                          <label for>Purcahse Price Per Item*</label>
                          <input type="number" required class="form-control" name="pruchase_price" placeholder="Enter Purchase Price Per Item" id="purchase_price" onkeyup="payable_fun()">
                          <b id="payable_amt" style="background: green;color: white;padding: 3px;"></b>

                        </div>
                      </div>



                      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                         <div class="form-group">
                          <label for>Sale Price*</label>
                          <input type="number" required class="form-control" name="sale_price" placeholder="Enter Sale Price">

                        </div>
                      </div>

                    </div>


                    <div class="form-group">
                      <label for>Pay Type</label>
                    <select required class="form-control" name="pay_type" onchange="pay_typefun()" id="pay_type">
                        <option value="Pay Full Amount">Pay Full Amount</option>
                        <option value="Pay Custom Amount">Pay Custom Amount</option>
                      </select>              
                    </div>

                    <div class="form-group" id="custom_amt_id">
                    <label for>Custom Amount</label>
                    <input type="number" class="form-control" name="custom_pay_amt" placeholder="Enter Custom Pay Amount" id="custom_pay_amt">

                    </div>



                    <div class="form-group">
                      <label for>Purcahse Date*</label>
                      <input type="date" required class="form-control" name="purchase_date" value="<?php echo date('Y-m-d');?>">               
                    </div>



                    <div class="form-group">
                      <label for>Pay Purchase Amount Via*</label>
                      <select required class="form-control" name="pay_via">
                        <option value="Cash">From Cash Balance | Balance: <?php echo $cash_balance;?></option>
                        <option value="Bank">From Bank Balance | Balance: <?php echo $bank_balance;?></option>
                      </select>              
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



  <script type="text/javascript">
   
   document.getElementById('custom_amt_id').style.display='none';
    
    function payable_fun() {
      var purchase_qty=document.getElementById('purchase_qty').value;
      var purchase_price=document.getElementById('purchase_price').value;
      if (purchase_price!=0 || purchase_qty!=0 || purchase_price!="" || purchase_qty!="" ) {
      var payable_amt=purchase_qty * purchase_price;
      document.getElementById('payable_amt').innerHTML="Total Payable Amount "+payable_amt;
      document.getElementById('custom_pay_amt').value='';
    }
  }

  function pay_typefun() {
    var pay_type=document.getElementById('pay_type').value;
    if (pay_type=="Pay Custom Amount") {
    document.getElementById('custom_amt_id').style.display='block';
    document.getElementById('custom_pay_amt').value='';
    document.getElementById("custom_pay_amt").required = true;
    }
    else{
    document.getElementById('custom_amt_id').style.display='none';
      document.getElementById('custom_pay_amt').value='';
      document.getElementById("custom_pay_amt").required = false;
    }


  }
  </script>
  <?php include 'footer.php';?>

