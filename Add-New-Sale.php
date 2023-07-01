<?php include 'header.php';?>



<?php

if ($user_type!="Admin") {

   $query_access = "SELECT * FROM user_access WHERE user_no ='$user_no' AND access='Manage Sales'";
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

   $sale_no=$_POST['order_no'];
   $customer=$_POST['customer'];
   $total_cost_price=$_POST['total_cost_price'];
   $total_payable=$_POST['pay_amount'];
   $purchase_date=date('Y-m-d');
   $purchase_via =$_POST['pay_via'];
   $products=$_POST['products'];

   if ($purchase_via=="Cash") {
      $sql3="UPDATE wallet SET cash_balance=cash_balance+$total_payable";
      mysqli_query($conn,$sql3);

      $sql4= "INSERT INTO transactions(amount,type,date,description)
      VALUES ('$total_payable','Cash','$purchase_date','Sale')";
      mysqli_query($conn,$sql4);

   }
   elseif($purchase_via=="Bank"){
      $sql3="UPDATE wallet SET bank_balance=bank_balance+$total_payable";
      mysqli_query($conn,$sql3);

      $sql4= "INSERT INTO transactions(amount,type,date,description)
      VALUES ('$total_payable','Bank','$purchase_date','Sale')";
      mysqli_query($conn,$sql4);

   }

   $sql = "INSERT INTO sale(sale_no,customer, total_cost_price, total_payable, sale_date, sale_via)
   VALUES ('$sale_no','$customer','$total_cost_price','$total_payable','$purchase_date', '$purchase_via')";

   if (mysqli_query($conn,$sql)) {
      foreach ($products as $key => $prod) {
         $productId        = $prod["product_id"];
         $productQty       = $prod["qty"];
         $productCostPrice = $prod["cost_price"];
         $productGrassAmt  = $prod["price_g_amount"];

         $sqlPro =  "INSERT INTO sale_details(sale_no,product,qty,sale_price, grass_amt)
         VALUES ('$sale_no','$productId','$productQty','$productCostPrice','$productGrassAmt')";
         mysqli_query($conn,$sqlPro);

         if (!isset($_POST['effect_stock'])) {
          $sql1="UPDATE products SET stock=stock-$productQty WHERE id='$productId'";
          mysqli_query($conn,$sql1);

       }
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
    $sql2="UPDATE ledgers SET amount=amount-$new_leger WHERE user_no='$customer'";
    mysqli_query($conn,$sql2);
    if ($_POST['print']) {
       ?>
       <script type="text/javascript">
        alert('New Sale Succesffully.\nNow you are redirect to sale recipt page.');
         window.open('Sale-Recipt.php?sale_no=<?php echo $sale_no;?>','_blank');
      </script>
      <?php

   }
   else{ 
      ?>
      <script type="text/javascript">
         alert('New Sale Succesffully.');
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
                     <h1>Add New Sale</h1>
                  </div>
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Sale Product</li>
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
                           <h3 class="card-title">Sale Detail</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="" method="POST">
                           <div class="card-body">

                             <div class="form-group">
                              <label for>Sale Order No#</label>
                              <input type="number" readonly name="order_no" value="<?php echo rand(0,100000000);?>" class="form-control">
                           </div>


                           <div class="form-group">
                              <label for>Select Customer*</label>
                              <select class="form-control" required name="customer">
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

                        <div class="row input_fields_wrap productlist" data-count="0">
                           <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                              <div class="form-group">
                                 <label for>Select Product*</label>
                                 <select class="form-control products" id="product_id_0" data-id="0" required name="products[0][product_id]">

                                   <option value="">Please select products</option>
                                   <?php
                                   $Query = "SELECT * FROM products";
                                   $ExecQuery = mysqli_query($conn, $Query);
                                   while ($Result = MySQLi_fetch_array($ExecQuery)) { ?>
                                      <option value="<?php echo $Result['id'];?>"><?php echo $Result['name'];?></option>
                                   <?php } ?>
                                </select>
                             </div>
                          </div>

                          <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                           <div class="form-group">
                              <label for>Available Qty*</label>
                              <input type="number" id="avail_qty_0" data-id="0" class="form-control avail_qty " readonly name="products[0][avail_qty]">
                           </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                           <div class="form-group">
                              <label for>QTY*</label>
                              <input type="number" step=".01" id="qty_0" data-id="0" class="form-control qty" name="products[0][qty]" required>
                           </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                           <div class="form-group">
                              <label for>Sale Price*</label>
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
                              <label for>Total Sale Amount</label>
                              <input type="number" id="total_cost_price" readonly class="form-control total_cost_price" name="total_cost_price">
                           </div>
                        </div>
                     </div>


                     <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                       <div class="form-group">
                        <label for>Total Qty</label>
                        <input type="number" readonly class="form-control t_qty" required class="form-control">
                     </div>
                  </div>
               </div>


               <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                 <div class="form-group">
                  <label for>Pay Amount</label>
                  <input type="number" placeholder="Please enter customer pay amount" required class="form-control" name="pay_amount">
               </div>
            </div>
         </div>

         <div class="form-group">
            <label for>Accept Sale Amount Via*</label>
            <select required class="form-control" id="pay_via" name="pay_via">
               <option value="Cash">In Cash</option>
               <option value="Bank">In Bank</option>
            </select>
         </div>

         <div class="form-group">
            <input type="checkbox" value="tick" name="effect_stock"> When you checked, does not affect on stock
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
      return $.ajax({
         type: "POST",
         url: "search-products-sale.php",
         success: function(html) {
            html
         }
      });
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
         var tr = `<div class="col-lg-2 col-md-2 col-sm-12 col-12 newProd prod-${i}">
         <div class="form-group">
         <select class="form-control products" data-id="${i}" id="product_id_${i}" required name="products[${i}][product_id]">
         ${result}
         </select>
         </div>
         </div>

         <div class="col-lg-2 col-md-2 col-sm-12 col-12 newProd prod-${i}">
         <div class="form-group">
         <input type="number" data-id="${i}" class="form-control avail_qty" id="avail_qty_${i}" readonly name="products[${i}][avail_qty]">
         </div>
         </div>


         <div class="col-lg-2 col-md-2 col-sm-12 col-12 newProd prod-${i}">
         <div class="form-group">
         <input type="number" data-id="${i}" class="form-control qty" id="qty_${i}" name="products[${i}][qty]" step=".01" required>
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


   $(document).on('change', '.products', function(){
      var supplier = $('#supplier').val();
      var products = $(this).val();
      var dataid = $(this).attr('data-id');
      if (supplier!="" || products!="") {
         $.ajax({
            type: "POST",
            url: "search-products-Details-Sale.php",
            data: {
              products: products
           },
           success: function(dataResult) {
            var dataResult = JSON.parse(dataResult);
            var sale_price = dataResult.sale_price;
            var available_qty = dataResult.available_stock;
            $('#avail_qty_'+dataid).val(available_qty);

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
      sum('.qty','.t_qty');
   });

   $(document).on('keyup mouseup', ".qty" ,function() {
      var loop       = $(this).attr('data-id');
      var available_qtys= $('#avail_qty_'+loop).val();
      var cost_price = $('#cost_price_'+loop).val();
      var qty        = $('#qty_'+loop).val();

    
      var t_amount   = Number(cost_price) * Number(qty);
      $('#price_g_amount_'+loop).val(t_amount);
      sum('.price_g_amount','.total_cost_price');
      sum('.qty','.t_qty');
   
});   

   function sum(sumClass,totalClass) {

      var sum = 0;
      $(sumClass).each(function(){
         sum += +$(this).val();
      });
      $(totalClass).val(sum);
   }

</script>

