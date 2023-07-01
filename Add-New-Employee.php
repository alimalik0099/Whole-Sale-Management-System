<?php include 'header.php';?>
<?php
if ($user_type!="Admin") {
  ?>
<script type="text/javascript">window.location.href="index.php";</script>
<?php } 
if(isset($_POST['submit'])){
  $employee_no=rand(0,100000);
  $em_name=$_POST['em_name'];
  $phone_no=$_POST['phone_no'];
  $email=$_POST['email'];
  $password=$_POST['password'];

  $query_chck_email = mysqli_query($conn,"SELECT * FROM login WHERE email = '$email'") or die(mysqli_error($conn)); 

  if(mysqli_num_rows($query_chck_email)>0){
    ?>
    <script type="text/javascript">alert('Sorry! User Already Registered');</script>
    <?php
  }else{  

$base4=base64_encode($password);
$md5=md5($password);
$pass=$base4.$md5.$base4;


  $sql1 = "INSERT INTO employee(employee_no,name,phone_no,email,password)
  VALUES ('$employee_no','$em_name','$phone_no','$email','$pass')";
  if (mysqli_query($conn, $sql1)) {

    $sql2="INSERT INTO login(email,password,user_type,user_no) 
  VALUES('$email','$pass','User','$employee_no')";
   if(mysqli_query($conn,$sql2)){

   $pageno = array_unique($_POST['access']);
    foreach ($pageno as $access){

  $sql3="INSERT INTO user_access(user_no,access) 
  VALUES('$employee_no','$access')";
   if(mysqli_query($conn,$sql3)){
   ?>
   <script type="text/javascript">
    alert("New Employee Add Successfully.");
    window.location.href = "Add-New-Employee.php";
  </script>

  <?php

}
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
              <h1>Add New Employee</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Employee</li>
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
                  <h3 class="card-title">Employee Detail</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="" method="POST"  enctype="multipart/form-data">
                  <div class="card-body">

                    <div class="form-group">
                      <label for>Employee Name*</label>
                      <input type="" required name="em_name" class="form-control" placeholder="Enter Full Name">
                    </div>

                    <div class="form-group">
                      <label for="">Phone No*</label>
                      <input type="" name="phone_no" class="form-control" required placeholder="Enter Employee Phone No*">
                    </div>


                    <div class="form-group">
                      <label for="">Account Login Email*</label>
                      <input type="email" name="email" class="form-control" required placeholder="Enter Employee Email*">
                    </div>


                    <div class="form-group">
                      <label for="">Account Login Password*</label>
                      <input type="" name="password" class="form-control" required placeholder="Enter Employee Account Password*">
                    </div>

                    <div class="row input_fields_wrap" data-count="0">
                      <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                        <div class="form-group">
                            <label for>Employee Access*</label>
                            <select class="form-control" name="access[]" required>
                            <option value="">Please select access</option>
                            <option value="Manage Products">This Employee can manage products</option>

                            <option value="Manage Purchases">This Employee can manage purchases</option>

                            <option value="Manage Sales">This Employee can manage sales</option>

                            <option value="Manage Ledgers">This Employee can manage ledgers</option>

                            <option value="Manage Suppliers">This Employee can manage suppliers</option>

                            <option value="Manage Customers">This Employee can manage customers</option>

                            <option value="Manage Expenses">This Employee can manage expenses</option>

                            <option value="Manage Transaction History">This Employee can view transaction history</option>

                            </select>
                        </div>
                      </div>
                           <div class="col-lg-4 col-md-4 col-sm-12 col-12 text-center">
                              <div class="form-group">
                                 <label for>Add More Fields*</label><br>
                                 <button type="button" class="btn btn-primary btn-sm add_field_button">Add New Access</button>
                              </div>
                           </div>
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
      $(document).ready(function() {
var max_fields      = 10; //maximum input boxes allowed
var wrapper       = $(".input_fields_wrap"); //Fields wrapper
var add_button      = $(".add_field_button"); //Add button ID

var x = 1; //initlal text box count
$(add_button).click(function(e){ //on add input button click
e.preventDefault();
    if(x < max_fields){ //max input box allowed
        x++; //text box increment
        $(wrapper).append('<div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-3"><div class="col-lg-8 col-md-8 col-sm-12 col-12"><select class="form-control" name="access[]" required><option value="">Please select access</option><option value="Manage Products">This Employee can manage products</option><option value="Manage Purchases">This Employee can manage purchases</option><option value="Manage Sales">This Employee can manage sales</option><option value="Manage Ledgers">This Employee can manage ledgers</option><option value="Manage Suppliers">This Employee can manage suppliers</option><option value="Manage Customers">This Employee can manage customers</option><option value="Manage Expenses">This Employee can manage expenses</option><option value="Manage Transaction History">This Employee can view transaction history</option></select></div><button class="btn btn-outline-danger btn-sm text-center remove_field" type="button">Remove</button></div></div>'); 
    }
});

$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
    e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
    </script>

