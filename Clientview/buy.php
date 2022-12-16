<?php
include 'db.php';
if(isset($_GET['buy'])){
    $get_puid = $_GET['buy'];
    $stmt = "select * from `product` where Product_ID = $get_puid";
    $results = mysqli_query($mysql, $stmt);
while($product_list = mysqli_fetch_assoc($results)){
  $product_id = $product_list['Product_ID'];
  $category = $product_list['Category'];
  $name = $product_list['Product_name'];
  $price = $product_list['Retail_price'];
  $B_P = $product_list['Bulk_price'];
  $manufacturer = $product_list['Manufacturer'];

  $sql = "INSERT INTO orders (product_ID) VALUES ('$product_id')";
  echo "<p>Thank you, Your $name order is being processed</p>";
}
}
?>