<?php include 'header.php';?>
<?php
if ($user_type!="Admin") {
$query_access = "SELECT * FROM user_access WHERE user_no ='$user_no' AND access='Manage Ledgers'";
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

if(isset($_POST['submit'])){
  $user_type=$_POST['user_type'];
  $supplier=$_POST['supplier'];
  $customer=$_POST['customer'];
  $ledger_amount=$_POST['ledger_amount'];
  $adjustment_amount=$_POST['adjustment_amount'];
  $adjustment_via=$_POST['adjustment_via'];

  if ($supplier!="") {
    $user_no=$supplier;
  }
  if ($customer!="") {
    $user_no=$customer;
  }
  $date=date('Y-m-d');
  if ($user_type=="Supplier") {

  if ($ledger_amount<0) {
    
    $sql="UPDATE ledgers SET amount=amount+$adjustment_amount WHERE user_no='$user_no'";
    mysqli_query($conn,$sql);

    if ($adjustment_via=="Cash") {
    $sql1="UPDATE wallet SET cash_balance=cash_balance+$adjustment_amount";
    mysqli_query($conn,$sql1);

    $sql3= "INSERT INTO transactions(amount,type,date,description)
     VALUES ('$adjustment_amount','Cash','$date','Ledger Adjustment')";
     mysqli_query($conn,$sql3);

      ?>
      <script type="text/javascript">
        alert("Ledger Adjustment Successfully");
        window.location.href="";
      </script>  <?php

    }
    elseif ($adjustment_via=="Bank") {
      $sql1="UPDATE wallet SET bank_balance=bank_balance+$adjustment_amount";
    mysqli_query($conn,$sql1);

    $sql3= "INSERT INTO transactions(amount,type,date,description)
     VALUES ('$adjustment_amount','Bank','$date','Ledger Adjustment')";
     mysqli_query($conn,$sql3);

      ?>
      <script type="text/javascript">
        alert("Ledger Adjustment Successfully");
        window.location.href="";
      </script>  <?php

    }


    
  }
  elseif ($ledger_amount>0) {
    if ($adjustment_via=="Cash") {
      if ($adjustment_amount<=$cash_balance) {
    $sql="UPDATE ledgers SET amount=amount-$adjustment_amount WHERE user_no='$user_no'";
    mysqli_query($conn,$sql);

    $sql1="UPDATE wallet SET cash_balance=cash_balance-$adjustment_amount";
    mysqli_query($conn,$sql1);

    $sql3= "INSERT INTO transactions(amount,type,date,description)
     VALUES ('$adjustment_amount','Cash','$date','Ledger Adjustment')";
     mysqli_query($conn,$sql3);

     ?>
      <script type="text/javascript">
        alert("Ledger Adjustment Successfully");
        window.location.href="";
      </script>  <?php
  }
  else{
      ?>
      <script type="text/javascript">
        alert("Sorry! You have insufficient balance");
        window.location.href="";
      </script>  <?php
     }
  }
elseif($adjustment_via=="Bank"){
      if ($adjustment_amount<=$bank_balance) {
    $sql="UPDATE ledgers SET amount=amount-$adjustment_amount WHERE user_no='$user_no'";
    mysqli_query($conn,$sql);

    $sql1="UPDATE wallet SET bank_balance=bank_balance-$adjustment_amount";
    mysqli_query($conn,$sql1);

    $sql3= "INSERT INTO transactions(amount,type,date,description)
     VALUES ('$adjustment_amount','Bank','$date','Ledger Adjustment')";
     mysqli_query($conn,$sql3);

     ?>
      <script type="text/javascript">
        alert("Ledger Adjustment Successfully");
        window.location.href="";
      </script>  <?php
  }
  else{
      ?>
      <script type="text/javascript">
        alert("Sorry! You have insufficient balance");
        window.location.href="";
      </script>  <?php
     }
  }
}
}












if ($user_type=="Customer") {

  if ($ledger_amount<0) {
    
    $sql="UPDATE ledgers SET amount=amount+$adjustment_amount WHERE user_no='$user_no'";
    mysqli_query($conn,$sql);

    if ($adjustment_via=="Cash") {
    $sql1="UPDATE wallet SET cash_balance=cash_balance+$adjustment_amount";
    mysqli_query($conn,$sql1);

    $sql3= "INSERT INTO transactions(amount,type,date,description)
     VALUES ('$adjustment_amount','Cash','$date','Ledger Adjustment')";
     mysqli_query($conn,$sql3);

      ?>
      <script type="text/javascript">
        alert("Ledger Adjustment Successfully");
        window.location.href="";
      </script>  <?php

    }
    elseif ($adjustment_via=="Bank") {
      $sql1="UPDATE wallet SET bank_balance=bank_balance+$adjustment_amount";
    mysqli_query($conn,$sql1);

    $sql3= "INSERT INTO transactions(amount,type,date,description)
     VALUES ('$adjustment_amount','Bank','$date','Ledger Adjustment')";
     mysqli_query($conn,$sql3);

      ?>
      <script type="text/javascript">
        alert("Ledger Adjustment Successfully");
        window.location.href="";
      </script>  <?php

    }


    
  }
  elseif ($ledger_amount>0) {
    if ($adjustment_via=="Cash") {
      if ($adjustment_amount<=$cash_balance) {
    $sql="UPDATE ledgers SET amount=amount-$adjustment_amount WHERE user_no='$user_no'";
    mysqli_query($conn,$sql);

    $sql1="UPDATE wallet SET cash_balance=cash_balance-$adjustment_amount";
    mysqli_query($conn,$sql1);

    $sql3= "INSERT INTO transactions(amount,type,date,description)
     VALUES ('$adjustment_amount','Cash','$date','Ledger Adjustment')";
     mysqli_query($conn,$sql3);

     ?>
      <script type="text/javascript">
        alert("Ledger Adjustment Successfully");
        window.location.href="";
      </script>  <?php
  }
  else{
      ?>
      <script type="text/javascript">
        alert("Sorry! You have insufficient balance");
        window.location.href="";
      </script>  <?php
     }
  }
elseif($adjustment_via=="Bank"){
      if ($adjustment_amount<=$bank_balance) {
    $sql="UPDATE ledgers SET amount=amount-$adjustment_amount WHERE user_no='$user_no'";
    mysqli_query($conn,$sql);

    $sql1="UPDATE wallet SET bank_balance=bank_balance-$adjustment_amount";
    mysqli_query($conn,$sql1);

    $sql3= "INSERT INTO transactions(amount,type,date,description)
     VALUES ('$adjustment_amount','Bank','$date','Ledger Adjustment')";
     mysqli_query($conn,$sql3);

     ?>
      <script type="text/javascript">
        alert("Ledger Adjustment Successfully");
        window.location.href="";
      </script>  <?php
  }
  else{
      ?>
      <script type="text/javascript">
        alert("Sorry! You have insufficient balance");
        window.location.href="";
      </script>  <?php
     }
  }
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
              <h1>Ledger Adjustment</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Ledgers</li>
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
                  <h3 class="card-title">Ledger Detail</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="" method="POST">
                  <div class="card-body">

                    <div class="form-group">
                      <label for>Select Adjustment User*</label>
                      <select class="form-control" onchange="adjustment_user_change()" id="user_type" required name="user_type">
                        <option value="">Please select</option>
                        <option value="Supplier">Supplier</option>
                        <option value="Customer">Customer</option>
                      </select>
                    </div>


                    <div class="form-group" id="supplier_div">
                      <label for>Select Supplier*</label>
                      <select class="form-control" id="supplier" required name="supplier">
                       <option value="">Please select supplier</option>

                       <?php
                       $query = "SELECT * FROM suppliers ORDER BY id DESC";
                       $result = mysqli_query($conn, $query);  
                       if ($result->num_rows > 0) {
                         while($row = mysqli_fetch_array($result))  
                         {
                          ?>
                          <option value="<?php echo $row['supplier_no'];?>"><?php echo $row['name'];?></option>
                          <?php 
                        }
                      }
                      ?>
                    </select>
                  </div>




                  <div class="form-group" id="customer_div">
                    <label for>Select Customer*</label>
                    <select class="form-control" id="customer" required name="customer">
                     <option value="">Please select customer</option>

                     <?php
                     $query = "SELECT * FROM clients ORDER BY id DESC";
                     $result = mysqli_query($conn, $query);  
                     if ($result->num_rows > 0) {
                       while($row = mysqli_fetch_array($result))  
                       {
                        ?>
                        <option value="<?php echo $row['client_no'];?>"><?php echo $row['name'];?></option>
                        <?php 
                      }
                    }
                    ?>
                  </select>
                </div>


                <div class="form-group">
                  <label for>Ledger amount*</label>
                  <input type="" required id="ledger_amount" name="ledger_amount" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <label for>Adjustment amount*</label>
                  <input type="number" required id="adjustment_amount" name="adjustment_amount" class="form-control" placeholder="Please Enter Adjustment amount"  min="0" oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null">
                </div>

                <div class="form-group">
                  <label for>Adjustment Via*</label>
                  <select required class="form-control" name="adjustment_via">
                   <option value="Cash">From Cash Balance</option>
                   <option value="Bank">From Bank Balance</option>
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
<?php include 'footer.php';?>

<script type="text/javascript">
  document.getElementById('supplier_div').style.display="none";
  document.getElementById('customer_div').style.display="none";
  document.getElementById("customer").required = true;
  document.getElementById("supplier").required = true;

  function adjustment_user_change() {
   var user_type=document.getElementById('user_type').value;
   if (user_type!="") {
    if (user_type=="Supplier") {
      document.getElementById('supplier_div').style.display="block";
      document.getElementById('customer_div').style.display="none";
      document.getElementById("customer").required = false;
      document.getElementById("supplier").required = true;
    }
    if (user_type=="Customer") {
      document.getElementById('supplier_div').style.display="none";
      document.getElementById('customer_div').style.display="block";
      document.getElementById("customer").required = true;
      document.getElementById("supplier").required = false;
    }
  }
  else{
    document.getElementById('supplier_div').style.display="none";
    document.getElementById('customer_div').style.display="none";
    document.getElementById("customer").required = true;
    document.getElementById("supplier").required = true;
  }
}
</script>

<script type="text/javascript">
  $(document).on('change', '#supplier', function(){
    var user = $('#supplier').val();
    if (user!="") {


      $.ajax({
        type: "POST",
        url: "Adjustment-ajax.php",
        data: {
         user: user
       },
       success: function(dataResult) {
        var dataResult = JSON.parse(dataResult);
        var ledger_amount = dataResult.ledger_amount;
        $('#ledger_amount').val(ledger_amount);
      }
    });
    }
    else{
      $('#ledger_amount').val('');
    }

  });
</script>




<script type="text/javascript">
  $(document).on('change', '#customer', function(){
    var user_c = $('#customer').val();
    if (user_c!="") {
      $.ajax({
        type: "POST",
        url: "Adjustment-ajax.php",
        data: {
         user: user_c
       },
       success: function(dataResult) {
        var dataResult = JSON.parse(dataResult);
        var ledger_amount = dataResult.ledger_amount;
        $('#ledger_amount').val(ledger_amount);
      }
    });
    }
    else{
      $('#ledger_amount').val('');
    }

  });
</script>

<script type="text/javascript">
  
$(document).on('keyup', "#adjustment_amount" ,function() {


  var ledger_amount = $('#ledger_amount').val();
  var adjustment_amount = $('#adjustment_amount').val();
  if (ledger_amount<0) {
   var new_ledger_amt = ledger_amount.substring(1);
  }
  else{
    var new_ledger_amt = ledger_amount;
  }

  if (Number(adjustment_amount) > Number(new_ledger_amt)) { 
   alert('Please enter valid amount.');
   $('#adjustment_amount').val('');
  }
});  

</script>