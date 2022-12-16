<?php
session_start();
include 'db.php';
include 'client_functions.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<!-- bootstrap 5.2.3 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
  <head>
    <meta charset="utf-8">
    <title>Cart</title>
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar bg-light border border-secondary">
  <div class="container-fluid">
    <!-- New Item button -->
    <?php 
  if(isset($_SESSION["User_ID"])){
          echo"
          <a class='navbar-brand'  href='clientview.php?login=".$_SESSION["User_ID"]."'>
          <span class='md-2 p-2'>EasyPC</span>
          <span class='md-2 p-2'>Continue Shopping</span>
        </a>
        <a class='nav-link active text-info' aria-current='page' href='checkout.php'>
        <span class='md-2 p-2'>CheckOut</span>
        </a>
          ";
        }else{
          echo"  
          <a class='navbar-brand'  href='clientview.php'>
          <span class='md-2 p-2'>EasyPC</span>
          <span class='md-2 p-2'>Continue Shopping</span>
        </a>
        <a class='nav-link active text-info' aria-current='page' href='checkout.php'>
        <span class='md-2 p-2'>CheckOut</span>
        </a>
        ";
        }
  ?>
  </div>
</nav>
<body>
  <?php
  global $mysql;
  $ip = getuserIP();
  $totalP=0;
  $stmt = "select * from `cart` where uiIP = '$ip'";
  $results = mysqli_query($mysql,$stmt);
  while($row =mysqli_fetch_assoc($results)){
    $product_id = $row['Product_ID'];
    $quantity=$row['quantity'];
    $products = "select * from `product` where Product_ID = '$product_id'";
    $our_result = mysqli_query($mysql,$products);
    while($product_rows = mysqli_fetch_array($our_result)){
      $price=array($product_rows['Retail_price']);
      $product_id = $product_rows['Product_ID'];
      $selliprice = $product_rows['Retail_price'];
      $name = $product_rows['Product_name'];
      $image = $product_rows['Product_image'];
      $sellingP = array_sum($price);
      $totalP += $sellingP;

        echo "
<div class='card mb-3'>
  <div class='row g-0'>
    <div class='col-md-3'>
      <img src='$image' class='img-fluid rounded-start' alt='...'>
    </div>
    <div class='col-md-9'>
      <div class='card-body'>
        <div class='row'>
        <h5 class='col-sm-3'>Product Name</h5>
        <h5 class='col-sm-2'>Price</h5>
        <h5 class='col-sm-2'>Quantity</h5>

      </div>
      <div class='row'>
        <p class='col-sm-3 p-2'>$name</p>
        <p class='col-sm-2 p-2'>$selliprice</p>
        <p class='col-sm-2 p-2'>$quantity</p>
      </div>
      <button type='button' class='btn btn-danger col-sm-2 m-2'><a class='nav-link active'  href='deleteincart.php?erase=$product_id'>Delete</a></button>
    </div>
  </div>
</div>
</div>
";
    }
  }
  echo"
    <p>Total Price:$totalP</p>
    ";
  ?>
 
</body>
