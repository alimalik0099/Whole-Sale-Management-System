<?php
session_start();
include "db.php";
date_default_timezone_set("Europe/Gibraltar");


if(!isset($_SESSION['user_no']['user_no'])){
  $user_no=$_SESSION['user_no'];
  $user_type=$_SESSION['user_type'];
  if ($user_type=="User") {
  
  $query_user = "SELECT * FROM employee WHERE employee_no='$user_no'";
  $result_user = mysqli_query($conn, $query_user);  
  $row_user = mysqli_fetch_array($result_user);
  
  }

}
if (!$user_no) {
  ?>
    <script type="text/javascript">
    window.location.href = "login.php";
  </script>
  <?php
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    <?php 
$query_ltd = "SELECT * FROM settings";
$result_ltd = mysqli_query($conn, $query_ltd);  
$row_ltd = mysqli_fetch_array($result_ltd);
echo $row_ltd['project_name'];
?>
  </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <style type="text/css">
    th,td{
      text-align: center;
    }
  </style>
  <style type="text/css">
    input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
  </style>
</head>