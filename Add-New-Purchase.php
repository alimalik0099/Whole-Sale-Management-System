<?php include 'header.php';?>
<?php


if ($user_type!="Admin") {
$query_access = "SELECT * FROM user_access WHERE user_no ='$user_no' AND access='Manage Purchases'";
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

if (isset($_POST['save_purchase'])) {  

   $purchase_no=$_POST['order_no'];
   $supplier=$_POST['supplier'];
   $total_cost_price=$_POST['total_cost_price'];
   $total_payable=$_POST['pay_amount'];
   $purchase_date=date('Y-m-d');
   $purchase_via =$_POST['pay_via'];
   $products=$_POST['products'];

   if ($purchase_via=="Cash") {
     if ($total_payable<=$cash_balance) {
      $sql3="UPDATE wallet SET cash_balance=cash_balance-$total_payable";
      mysqli_query($conn,$sql3);
   
     $sql4= "INSERT INTO transactions(amount,type,date,description)
     VALUES ('$total_payable','Cash','$purchase_date','Purchasing')";
     mysqli_query($conn,$sql4);

     }
     else{
      ?>
      <script type="text/javascript">
         alert('Sorry! You have insufficient balance');
         window.location.href='';
      </script>
      <?php 
      $conn -> close();
     }
   }
   elseif($purchase_via=="Bank"){
      if ($total_payable<=$bank_balance) {
      $sql3="UPDATE wallet SET bank_balance=bank_balance-$total_payable";
      mysqli_query($conn,$sql3);

      $sql4= "INSERT INTO transactions(amount,type,date,description)
     VALUES ('$total_payable','Bank','$purchase_date','Purchasing')";
     mysqli_query($conn,$sql4);

     }
     else{
      ?>
      <script type="text/javascript">
         alert('Sorry! You have insufficient balance');
         window.location.href='';
      </script>
      <?php 
      $conn -> close();
     }

   }

  $sql = "INSERT INTO purchase(purchase_no,supplier, total_cost_price, total_payable, purchase_date, purchase_via)
  VALUES ('$purchase_no','$supplier','$total_cost_price','$total_payable','$purchase_date', '$purchase_via')";

  if (mysqli_query($conn,$sql)) {
   foreach ($products as $key => $prod) {
      $productId        = $prod["product_id"];
      $productQty       = $prod["qty"];
      $productCostPrice = $prod["cost_price"];
      $productGrassAmt  = $prod["price_g_amount"];

      $sqlPro =  "INSERT INTO purchase_details(purchase_no,product, qty, cost_price, grass_amt)
      VALUES ('$purchase_no','$productId','$productQty','$productCostPrice','$productGrassAmt')";
      mysqli_query($conn,$sqlPro);
      $sql1="UPDATE products SET stock=stock+$productQty WHERE id='$productId'";
      mysqli_query($conn,$sql1);

   }

   if ($total_payable<$total_cost_price) {
     $new_leger=$total_cost_price-$total_payable;
  }
  elseif($total_payable>$total_cost_price){
     $new_leger=$total_cost_price-$total_payable;
  }
  elseif($total_payable==$total_cost_price){
     $new_leger=0;
  }
   $sql2="UPDATE ledgers SET amount=amount+$new_leger WHERE user_no='$supplier'";
     mysqli_query($conn,$sql2);

      if (isset($_POST['print'])) {
       ?>
       <script type="text/javascript">
        alert('New Purchasing Succesffully.\nNow you are redirect to Purchase recipt page.');
         window.open('Purchase-Recipt.php?purchase_no=<?php echo $purchase_no;?>','_blank');
      </script>
      <?php

   }
   
   else{
       ?>
<script type="text/javascript">
   alert('New Purchasing Succesffully.');
   window.location.href="";
</script>
  <?php
   }
}

}

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
                     <h1>Add New Purchase</h1>
                  </div>
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Purchase Product</li>
                     </ol>
                  </div>
               </div>
            </div>
            <!-- /.container-fluid -->
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
                              <label for>Purchase Order No#</label>
                              <input type="number" readonly name="order_no" value="<?php echo rand(0,100000000);?>" class="form-control">
                           </div>


                           <div class="form-group">
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

                        <div class="row input_fields_wrap productlist" data-count="0">
                           <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                              <div class="form-group">
                                 <label for>Select Product*</label>
                                 <select class="form-control products" id="product_id_0" data-id="0" required name="products[0][product_id]">
                                    <option value="">Please select products</option>
                                 </select>
                              </div>
                           </div>

                           <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                              <div class="form-group">
                                 <label for>QTY*</label>
                                 <input type="number" id="qty_0" data-id="0" class="form-control qty" name="products[0][qty]" required step=".01">
                              </div>
                           </div>

                           <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                              <div class="form-group">
                                 <label for>Cost Price*</label>
                                 <input type="number" id="cost_price_0" data-id="0" class="form-control cost_price " readonly name="products[0][cost_price]">
                              </div>
                           </div>

                           <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                              <div class="form-group">
                                 <label for>G. Amount*</label>
                                 <input type="number" readonly class="form-control price_g_amount" id="price_g_amount_0" data-id="0" name="products[0][price_g_amount]">
                              </div>
                           </div>
                           <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                              <div class="form-group">
                                 <label for>Add More Fields*</label>
                                 <button type="button" class="add_field_button btn btn-primary btn-sm addproduct">Add Product</button>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                              <div class="form-group">
                                 <label for>Total Cost</label>
                                 <input type="number" id="total_cost_price" readonly class="form-control total_cost_price" name="total_cost_price">
                              </div>
                           </div>
                        </div>


                        <div class="row">
                          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                              <label for>Pay Amount</label>
                              <input type="number" placeholder="Please enter pay amount" required class="form-control" name="pay_amount">
                           </div>
                        </div>
                     </div>

                     <div class="form-group">
                        <label for>Pay Amount Via*</label>
                        <select required class="form-control" id="pay_via" name="pay_via">
                           <option value="Cash">From Cash Balance</option>
                           <option value="Bank">From Bank Balance</option>
                        </select>
                     </div>

                     <div class="form-group text-center">
                        <input type="checkbox" name="print" value="check"> Redirect to recipt after save
                     </div>

                     <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary" name="save_purchase">Save</button>

                     </div>
                  </form>
               </div>
            </div>
            <div class="col-md-6"></div>
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>


<?php include 'footer.php';?>

<script type="text/javascript">

   function getProduct(){
      var supplier = $('#supplier').val();
      if (supplier!="") {
         return $.ajax({
            type: "POST",
            url: "search-products.php",
            data: {
               supplier: supplier
            },
            success: function(html) {
               html
            }
         });
      }
   }

   async function addProductRow() {
      var supplier = $('#supplier').val();

      if(supplier == ''){
         alert('Please select supplier');
         return 0;
      }

      result = await getProduct();

      if (result != "error") {

         var addRow = $('.productlist');
         var i = parseInt(addRow.attr('data-count')) + 1;
         var tr = `<div class="col-lg-4 col-md-4 col-sm-12 col-12 newProd prod-${i}">
         <div class="form-group">
         <select class="form-control products" data-id="${i}" id="product_id_${i}" required name="products[${i}][product_id]">
         ${result}
         </select>
         </div>
         </div>

         <div class="col-lg-2 col-md-2 col-sm-12 col-12 newProd prod-${i}">
         <div class="form-group">
         <input type="number" data-id="${i}" class="form-control qty" id="qty_${i}" name="products[${i}][qty]" required step=".01">
         </div>
         </div>

         <div class="col-lg-2 col-md-2 col-sm-12 col-12 newProd prod-${i}">
         <div class="form-group">
         <input type="number" data-id="${i}" class="form-control cost_price" id="cost_price_${i}" readonly name="products[${i}][cost_price]">
         </div>
         </div>

         <div class="col-lg-2 col-md-2 col-sm-12 col-12 newProd prod-${i}">
         <div class="form-group">
         <input type="number" readonly class="form-control price_g_amount" id="price_g_amount_${i}" data-id="${i}" name="products[${i}][price_g_amount]">
         </div>
         </div>

         <div class="col-lg-2 col-md-2 col-sm-12 col-12 newProd prod-${i}">
         <div class="form-group">
         <button type="button" class="add_field_button btn btn-danger btn-sm removeproduct" data-loop="${i}">Remove Product</button>
         </div>
         </div>`;
         addRow.append(tr);
         addRow.attr('data-count', i);
      }
   }
   $(document).on('click', '.addproduct',function(e){
      addProductRow();
   });

   $(document).ready(function() {
      $("#supplier").change(function(){
         var supplier = $('#supplier').val();
         if (supplier!="") {
            $('.newProd').remove();
            $.ajax({
               type: "POST",
               url: "search-products.php",
               data: {
                supplier: supplier
             },
             success: function(html) {
               $(".products").html(html);
               $('.cost_price').val('');
               $('.qty').val('');
               $('.price_g_amount').val('');
               $('.total_cost_price').val('');
            }
            });
         }
         else{
            $('.cost_price').val('');
            $('.qty').val('');
            $('.price_g_amount').val('');
            $('.total_cost_price').val('');
            $(".products").val('');
            $(".products").html('<option value="">Pleace select product</option>');
            $('.newProd').remove();
         }
      });
   });

   $(document).on('change', '.products', function(){
      var supplier = $('#supplier').val();
      var products = $(this).val();
      var dataid = $(this).attr('data-id');
      if (supplier!="" || products!="") {
         $.ajax({
            type: "POST",
            url: "search-products-Details.php",
            data: {
             products: products
          },
          success: function(dataResult) {
            var dataResult = JSON.parse(dataResult);
            var sale_price = dataResult.sale_price;
            $('#cost_price_'+dataid).val(sale_price);
            $('#qty_'+dataid).val('');
            $('#price_g_amount_'+dataid).val('');
            sum('.price_g_amount','.total_cost_price');
         }
      });
      }
   });

   $(document).on('click', '.removeproduct', function(){
      var loop = $(this).attr('data-loop');
      $('.prod-'+loop).remove();
      sum('.price_g_amount','.total_cost_price');
   });

   $(document).on('keyup mouseup', ".qty" ,function() {
      var loop       = $(this).attr('data-id');
      var cost_price = $('#cost_price_'+loop).val();
      var qty        = $('#qty_'+loop).val();
      var t_amount   = Number(cost_price) * Number(qty);
      $('#price_g_amount_'+loop).val(t_amount);
      sum('.price_g_amount','.total_cost_price');
   });   

   function sum(sumClass,totalClass) {

      var sum = 0;
      $(sumClass).each(function(){
         sum += +$(this).val();
      });
      $(totalClass).val(sum);
   }

</script>

