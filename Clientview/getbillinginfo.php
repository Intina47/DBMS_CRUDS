<?php
include "db.php";
include 'client_functions.php';
?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <title> Update Billing details </title>
  <!-- Bootstrap CSS v5.2-->
  <!-- Source: -->
  <!-- https://getbootstrap.com/docs/5.2/getting-started/download/ -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

  <!-- Bootstrap Icons -->
  <!-- Source: -->
  <!-- https://icons.getbootstrap.com/ -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <main>
    <div class="row w-70 mx-auto">
        <div class="col">
      <h1>BIllING INFORMATION</h1>
      <form action="updatebilling.php" method="post" enctype="multipart/form-data">
        <div id="name-input" class="my-2">
          <label for="address" class="form-label">Address</label>
          <input type="text" name="address" id="address" placeholder="Billing Address" class="form-control" required>
        </div>
        <div id="category-input" class="my-2">
          <label for="city" class="form-label">City</label>
          <input type="text" name="city" id="city" class="form-control" placeholder="Edinbrugh" />
        </div>
        <div id="image-input-div" class="my-2">
          <label for="postcode" class="form-label">Postcode</label>
          <input type="text" name="postcode" id="postcode" class="form-control" placeholder="DD1 6FF" required>
        </div>
        <div id='paymethod' class='my-2'>
            <label for="paymethod" class="form-label">Payment Method</label>
        <select class="form-select" aria-label="paymethod">
            <option selected>Select your payment method</option>
            <option value="1">Paypal</option>
            <option value="2">Apple Pay</option>
            <option value="3">Google Pay</option>
            <option value="4">Bank Transfer</option>
        </select>
        </div>
        <div id="submit" class="my-2 text-center">
          <button type="submit" class="btn btn-success" name='submit' data-mdb-toggle='modal' data-mdb-target='#exampleModal'>Place Order</button>
        </div>
      </form>
</div>
<div class="col">
    <h3>Your Cart</h3>
    <?php
  global $mysql;
  $ip = getuserIP();
  $totalP=0;
  $stmt = "select * from `cart` where uiIP = '$ip'";
  $results = mysqli_query($mysql,$stmt);
    while ($row = mysqli_fetch_assoc($results)) {
        $product_id = $row['Product_ID'];
        $quantity = $row['quantity'];
        $products = "select * from `product` where Product_ID = '$product_id'";
        $our_result = mysqli_query($mysql, $products);
        while ($product_rows = mysqli_fetch_array($our_result)) {
            $price = array($product_rows['Retail_price']);
            $product_id = $product_rows['Product_ID'];
            $selliprice = $product_rows['Retail_price'];
            $name = $product_rows['Product_name'];
            $image = $product_rows['Product_image'];
            $description = $product_rows['Product_description'];
            $sellingP = array_sum($price);
            $totalP += $sellingP;

            echo "
            <div class='row'>
              <div class='col-sm-9'>
              <p class='mb-0'>$name</p>
              </div>
              <div class='col-sm-9'>
                <p class='text-muted mb-0'>$description</p>
              </div>
              <div class='col'>
              <p>$
              <span>$selliprice</span></p>
              </div>
</div>
              <hr>
            ";
        }
    }
    echo "
    <div class='row'>
    <div class='col-sm-9'>
              <p class='mb-0'>Total Price:</p>
              </div>
              <div class='col'>
              <p>$
              <span>$totalP</span></p>
              </div>
              </div>
              ";
    ?>
</div>
    </div>

  </main>
</body>
<?php
   if(isset($_GET["billing"])){
       if(($_GET["billing"] == "success")){
        echo "
        <h3 class='text-success' align='center'> Thank You! Your Order is being processed</h3>
        <h4 class='text-success' align='center'><button class='btn btn-success'><a class='nav-link active text-white' aria-current='page' href='clientview.php'>OK</a></button></h4>

        ";
       }
   }
   ?>

</html>