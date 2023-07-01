<?php
include 'db.php';
$sale_no=$_GET['sale_no'];


$query1 = "SELECT * FROM settings";
$result1 = mysqli_query($conn, $query1);  
$row1 = mysqli_fetch_array($result1);

$query2 = "SELECT * FROM sale WHERE sale_no='$sale_no'";
$result2 = mysqli_query($conn, $query2);  
$row2 = mysqli_fetch_array($result2);
$customer=$row2['customer'];

$query3 = "SELECT * FROM clients WHERE client_no='$customer'";
$result3 = mysqli_query($conn, $query3);  
$row3 = mysqli_fetch_array($result3);

$query5 = "SELECT * FROM sale_details WHERE sale_no='$sale_no'"; 
$result5 = mysqli_query($conn, $query5);
$row5 = mysqli_num_rows($result5); 


require('fpdf/fpdf.php');
$pdf = new FPDF(); 
$pdf = new FPDF('L','mm',array(220,200));

$pdf->AddPage();
$pdf->SetFont('Arial','B',12);

$pdf->Cell(0,0,$row1["project_name"],0,1,'C'); 
$pdf->Cell(0,10,'Sale Recipt',0,1,'C'); 
$pdf->Line(5, 25, 215-0, 25);

$pdf->SetFont('Arial','B',5);
$pdf->Cell(30,20,'',0,0,'C');
$pdf->Cell(160,20,'',0,0,'C');
$pdf->Cell(10,15,'Invoice date: '. date('d-m-Y'),0,1,'C'); 

$pdf->SetFont('Arial','B',10);
$width_cell=array(10,30,20,30);
$pdf->SetFillColor(193,229,252); 



$pdf->Cell(30,10,'#',1,0,'C',true);
$pdf->Cell(30,10,'Customer',1,0,'C',true);
$pdf->Cell(30,10,'Sale Date',1,0,'C',true);
$pdf->Cell(30,10,'Total Products',1,0,'C',true);
$pdf->Cell(30,10,'Total Cost',1,0,'C',true);
$pdf->Cell(40,10,'Total Pay Amount',1,1,'C',true);



$pdf->SetFont('Arial','',10);
$pdf->Cell(30,10,'#'.$sale_no,1,0,'C',false);
$pdf->Cell(30,10,$row3['name'],1,0,'C',false);
$pdf->Cell(30,10,$row2['sale_date'],1,0,'C',false);
$pdf->Cell(30,10,$row5,1,0,'C',false);
$pdf->Cell(30,10,$row2['total_cost_price'],1,0,'C',false);
$pdf->Cell(40,10,$row2['total_payable'],1,1,'C',false);



$pdf->SetFont('Arial','B',10);
$width_cell=array(10,30,20,30);
$pdf->SetFillColor(193,229,252); 

$pdf->Cell(30,10,'',0,1,'C',false);

$pdf->Cell(30,10,'',0,0,'C',false);
$pdf->Cell(30,10,'',0,0,'C',false);
$pdf->Cell(30,10,'',0,0,'C',false);

$pdf->Cell(30,10,'Product Name',1,0,'C',true);
$pdf->Cell(30,10,'Sale Qty',1,0,'C',true);
$pdf->Cell(40,10,'Grass Amount',1,1,'C',true);


$query = "SELECT * FROM sale_details WHERE sale_no='$sale_no' ORDER BY id DESC";
$result = mysqli_query($conn, $query);  
if ($result->num_rows > 0) {
 while($row = mysqli_fetch_array($result)){ 

$product=$row['product'];
$query1 = "SELECT * FROM products WHERE id='$product'";
$result1 = mysqli_query($conn, $query1);  
$row1 = mysqli_fetch_array($result1);
 
$pdf->SetFont('Arial','',10);
$pdf->Cell(30,10,'',0,0,'C',false);
$pdf->Cell(30,10,'',0,0,'C',false);
$pdf->Cell(30,10,'',0,0,'C',false);

$pdf->Cell(30,10,$row1['name'],1,0,'C',true);
$pdf->Cell(30,10,$row['qty'],1,0,'C',true);
$pdf->Cell(40,10,$row['grass_amt'],1,1,'C',true);
}
}
$pdf->Output();

?>