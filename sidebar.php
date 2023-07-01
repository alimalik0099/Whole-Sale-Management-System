<?php
$file_path=basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
?>
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
   
    
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo $row_ltd['project_name'];?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <?php if ($user_type=="User") { ?>
          <a href="#" class="d-block"><?php echo $row_user['name'];?></a>
        <?php } else{ ?> <a href="#" class='d-block'>Admin</a><?php } ?>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

      <?php if ($file_path=="Admin" OR $file_path=="index.php") {?>
          <li class="nav-item menu-open">
            <a href="index.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
        <?php } else{ ?>
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
        <?php } ?>

 <?php if ($user_type=="Admin") { ?>
 <?php if ($file_path=="Add-New-Products.php" OR $file_path=="Products-Details.php" OR $file_path=="Edit-Products.php"  ) { ?>
        <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
 <?php } else{ ?>
 <li class="nav-item">
            <a href="#" class="nav-link">
 <?php } ?>             
              <i class="nav-icon fas fa-solid fa-store"></i>
              <p>
                Products
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Add-New-Products.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Products</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Products-Details.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Details</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Category-Details.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>
            </ul>
          </li>
           <?php } else{  
$query_access = "SELECT * FROM user_access WHERE user_no ='$user_no' AND access='Manage Products'";
  $result_access = mysqli_query($conn, $query_access);  
  if($result_access->num_rows>0){ 

    if ($file_path=="Add-New-Products.php" OR $file_path=="Products-Details.php" OR $file_path=="Edit-Products.php"  ) { ?>
        <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
 <?php } else{ ?>
 <li class="nav-item">
            <a href="#" class="nav-link">
 <?php } ?>             
              <i class="nav-icon fas fa-solid fa-store"></i>
              <p>
                Products
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Add-New-Products.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Products</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Products-Details.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Details</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Category-Details.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>
            </ul>
          </li>

<?php } } ?>






 <?php if ($user_type=="Admin") { ?>
    <?php if ($file_path=="Add-New-Purchase.php" OR $file_path=="Purchase-Details.php" OR $file_path=="Purchase-Ledger.php" OR $file_path=="Detail-Purchase.php") { ?>
        <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
 <?php } else{ ?>
 <li class="nav-item">
            <a href="#" class="nav-link">
 <?php } ?>            
 
               <i class="nav-icon fas fa-solid fa-cart-arrow-down"></i> 
              <p>
                Purchase
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Add-New-Purchase.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Purchasing</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Purchase-Details.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Details</p>
                </a>
              </li>

            </ul>
          </li>  
          <?php } else{ 
$query_access = "SELECT * FROM user_access WHERE user_no ='$user_no' AND access='Manage Purchases'";
  $result_access = mysqli_query($conn, $query_access);  
  if($result_access->num_rows>0){ 

    if ($file_path=="Add-New-Purchase.php" OR $file_path=="Purchase-Details.php" OR $file_path=="Purchase-Ledger.php" OR $file_path=="Detail-Purchase.php") { ?>
        <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
 <?php } else{ ?>
 <li class="nav-item">
            <a href="#" class="nav-link">
 <?php } ?>            
 
               <i class="nav-icon fas fa-solid fa-cart-arrow-down"></i> 
              <p>
                Purchase
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Add-New-Purchase.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Purchasing</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Purchase-Details.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Details</p>
                </a>
              </li>

            </ul>
          </li>       
<?php }  } ?>      







 <?php if ($user_type=="Admin") { ?>
<?php if ($file_path=="Add-New-Sale.php" OR $file_path=="Sale-Details.php" OR $file_path=="Detail-Sale.php") { ?>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
  <?php } else{ ?> 
<li class="nav-item">
  <a href="#" class="nav-link">
 <?php }?>            
              <i class="nav-icon fas fa-receipt"></i>
              <p>
                Sales
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Add-New-Sale.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Sale</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Sale-Details.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Details</p>
                </a>
              </li>
            </ul>
          </li>
 <?php } else { 
 $query_access = "SELECT * FROM user_access WHERE user_no ='$user_no' AND access='Manage Sales'";
  $result_access = mysqli_query($conn, $query_access);  
  if($result_access->num_rows>0){ 

 if ($file_path=="Add-New-Sale.php" OR $file_path=="Sale-Details.php" OR $file_path=="Detail-Sale.php") { ?>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
  <?php } else{ ?> 
<li class="nav-item">
  <a href="#" class="nav-link">
 <?php }?>            
              <i class="nav-icon fas fa-receipt"></i>
              <p>
                Sales
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Add-New-Sale.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Sale</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Sale-Details.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Details</p>
                </a>
              </li>
            </ul>
          </li>
      <?php }  } ?>        



 <?php if ($user_type=="Admin") { ?>
<?php if ($file_path=="Supplier-ledger.php" OR $file_path=="Client-ledger.php" OR $file_path=="ledger-Adjustment.php") { ?>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
  <?php } else{ ?> 
<li class="nav-item">
  <a href="#" class="nav-link">
 <?php }?>            
              <i class="nav-icon fas fa-cash-register"></i>
              <p>
                Ledger
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="Supplier-ledger.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Supplier ledger</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Client-ledger.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer ledger</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="ledger-Adjustment.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ledger Adjustment</p>
                </a>
          </li>

            </ul>
          </li>

       <?php } else{ 
$query_access = "SELECT * FROM user_access WHERE user_no ='$user_no' AND access='Manage Ledgers'";
  $result_access = mysqli_query($conn, $query_access);  
  if($result_access->num_rows>0){ 


if ($file_path=="Supplier-ledger.php" OR $file_path=="Client-ledger.php" OR $file_path=="ledger-Adjustment.php") { ?>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
  <?php } else{ ?> 
<li class="nav-item">
  <a href="#" class="nav-link">
 <?php }?>            
              <i class="nav-icon fas fa-cash-register"></i>
              <p>
                Ledger
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="Supplier-ledger.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Supplier ledger</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Client-ledger.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer ledger</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="ledger-Adjustment.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ledger Adjustment</p>
                </a>
          </li>

            </ul>
          </li>

      <?php } } ?>   






 <?php if ($user_type=="Admin") { ?>
<?php if ($file_path=="Add-New-Supplier.php" OR $file_path=="Supplier-Details.php" OR $file_path=="Edit-Supplier.php") { ?>
           <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
            <?php } else{ ?>
<li class="nav-item">
            <a href="#" class="nav-link">
            <?php } ?>

              <i class="nav-icon fas fa-user-nurse"></i>
              <p>
                Suppliers
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Add-New-Supplier.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Supplier-Details.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Details</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } else{ 
    $query_access = "SELECT * FROM user_access WHERE user_no ='$user_no' AND access='Manage Suppliers'";
  $result_access = mysqli_query($conn, $query_access);  
  if($result_access->num_rows>0){ 

 if ($file_path=="Add-New-Supplier.php" OR $file_path=="Supplier-Details.php" OR $file_path=="Edit-Supplier.php") { ?>
           <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
            <?php } else{ ?>
<li class="nav-item">
            <a href="#" class="nav-link">
            <?php } ?>

              <i class="nav-icon fas fa-user-nurse"></i>
              <p>
                Suppliers
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Add-New-Supplier.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Supplier-Details.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Details</p>
                </a>
              </li>
            </ul>
          </li>
<?php } } ?> 


 <?php if ($user_type=="Admin") { ?>
<?php if ($file_path=="Add-New-Client.php" OR $file_path=="Client-Details.php" OR $file_path=="Edit-Client.php" OR $file_path=="Client-Ledgers.php") { ?>
           <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
   <?php } else{ ?>
   <li class="nav-item">
            <a href="#" class="nav-link">
    <?php } ?>          
             <i class="nav-icon fas fa-user-shield"></i>
              <p>
                Customers
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Add-New-Client.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Client-Details.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Details</p>
                </a>
              </li>
            </ul>
          </li>
   <?php } else{
   $query_access = "SELECT * FROM user_access WHERE user_no ='$user_no' AND access='Manage Customers'";
  $result_access = mysqli_query($conn, $query_access);  
  if($result_access->num_rows>0){ 


if ($file_path=="Add-New-Client.php" OR $file_path=="Client-Details.php" OR $file_path=="Edit-Client.php" OR $file_path=="Client-Ledgers.php") { ?>
           <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
   <?php } else{ ?>
   <li class="nav-item">
            <a href="#" class="nav-link">
    <?php } ?>          
             <i class="nav-icon fas fa-user-shield"></i>
              <p>
                Customers
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Add-New-Client.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Client-Details.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Details</p>
                </a>
              </li>
            </ul>
          </li>

       <?php } } ?>        


<?php if ($user_type=="Admin") { ?>
<?php if ($file_path=="Add-New-Employee.php" OR $file_path=="Employee-Details.php" OR $file_path=="Edit-Employee.php" OR $file_path=="Employee-Access.php") { ?>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
    <?php } else{ ?> 
    <li class="nav-item">
            <a href="#" class="nav-link">
     <?php }?>          
              <i class="nav-icon fas fa-users"></i>
              <p>
                Employees
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Add-New-Employee.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Employee-Details.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Details</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } ?>




<?php if ($user_type=="Admin") { ?>
<?php if ($file_path=="Add-New-Expense.php" OR $file_path=="Expenses-Details.php" OR $file_path=="Expenses-Types.php") { ?>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
             <?php } else { ?> 
             <li class="nav-item">
            <a href="#" class="nav-link">
             <?php } ?> 
             <i class="nav-icon fas fa-solid fa-file"></i>
              <p>
                Expenses
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Add-New-Expense.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Expenses-Details.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Details</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Expenses-Types.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Expense Types</p>
                </a>
              </li>
            </ul>
          </li>

<?php } else{ 
$query_access = "SELECT * FROM user_access WHERE user_no ='$user_no' AND access='Manage Expenses'";
  $result_access = mysqli_query($conn, $query_access);  
  if($result_access->num_rows>0){ 


if ($file_path=="Add-New-Expense.php" OR $file_path=="Expenses-Details.php" OR $file_path=="Expenses-Types.php") { ?>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
             <?php } else { ?> 
             <li class="nav-item">
            <a href="#" class="nav-link">
             <?php } ?> 
             <i class="nav-icon fas fa-solid fa-file"></i>
              <p>
                Expenses
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Add-New-Expense.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Expenses-Details.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Details</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Expenses-Types.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Expense Types</p>
                </a>
              </li>
            </ul>
          </li>

       <?php } } ?>




<?php if ($user_type=="Admin") { ?>
<?php if ($file_path=="Transactions.php") { ?>
          <li class="nav-item menu-open">
            <a href="Transactions.php" class="nav-link active">
<?php } else{ ?> 
<li class="nav-item">
            <a href="Transactions.php" class="nav-link">
<?php } ?>             
            <i class="nav-icon fas fa-file-invoice-dollar"></i>
              <p>
                Transactions History
              </p>
            </a>
          </li>
  <?php } else{ $query_access = "SELECT * FROM user_access WHERE user_no ='$user_no' AND access='Manage Transaction History'";
  $result_access = mysqli_query($conn, $query_access);  
  if($result_access->num_rows>0){ 


 if ($file_path=="Transactions.php") { ?>
          <li class="nav-item menu-open">
            <a href="Transactions.php" class="nav-link active">
<?php } else{ ?> 
<li class="nav-item">
            <a href="Transactions.php" class="nav-link">
<?php } ?>             
            <i class="nav-icon fas fa-file-invoice-dollar"></i>
              <p>
                Transactions History
              </p>
            </a>
          </li>
      <?php }  } ?>       


<?php if ($file_path=="Settings.php") { ?>
          <li class="nav-item menu-open">
            <a href="Settings.php" class="nav-link active">
            <?php } else { ?> 
<li class="nav-item">
<a href="Settings.php" class="nav-link">
            <?php } ?>
            <i class="nav-icon fas fa-cog"></i>
              <p>
                Settings
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="Logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>




        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
