<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <title> Edit Order </title>
  <!-- Bootstrap CSS v5.2-->
  <!-- Source: -->
  <!-- https://getbootstrap.com/docs/5.2/getting-started/download/ -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <main>

    <?php
    include "db.php";
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
      $ord_id = $_GET["id"];
      $stmt = $mysql->prepare("CALL manager_get_order(:ord_id)");
      $stmt->bindParam(":ord_id", $ord_id);
      $stmt->execute();
      $order = $stmt->fetch();
    } else {
      echo "Error";
    } ?>
    <div class="w-50 mx-auto">
      <h1>Edit Order</h1>
      <form action="updateOrder.php" method="get" id=" addProductForm">
        <div id="order-id-input">
          <input type="hidden" name="order-id" id="order-id" value=<?php echo '"' . $ord_id . '"' ?>>
        </div>
        <div id="shipping-id-input">
          <input type="hidden" name="shipping-id" id="shipping-id" value=<?php echo '"' . $order['ShippingAddress_ID']  . '"' ?>>
        </div>
        <div id="billing-id-input">
          <input type="hidden" name="billing-id" id="billing-id" value=<?php echo '"' . $order['BillingAddress_ID']  . '"' ?>>
        </div>
        <div id="payment-id-input">
          <input type="hidden" name="payment-id" id="payment-id" value=<?php echo '"' . $order['Payment_ID']  . '"' ?>>
        </div>
        <div id="user-id-input">
          <input type="hidden" name="user-id" id="user-id" value=<?php echo '"' . $order['User_ID']  . '"' ?>>
        </div>
        <h2>Customer Information</h2>
        <div id="first-name-input" class="my-2">
          <label for="first-name" class="form-label">First Name</label>
          <input type="text" name="first-name" id="first-name" placeholder="First Name" class="form-control" value=<?php echo '"' . $order['First_Name'] . '"'; ?>>
        </div>
        <div id="second-name-input" class="my-2">
          <label for="second-name" class="form-label">Second Name</label>
          <input type="text" name="second-name" id="second-name" placeholder="Second Name" class="form-control" value=<?php echo '"' . $order['Second_Name'] . '"'; ?>>
        </div>
        <div id="email-input" class="my-2">
          <label for="email" class="form-label">Email Address</label>
          <input type="text" name="email" id="email" placeholder="Email Address" class="form-control" value=<?php echo '"' . $order['Email'] . '"'; ?>>
        </div>
        <h2> Shipping Information </h2>
        <div id="shipping-address-input" class="my-2">
          <label for="shipping-address" class="form-label">Address</label>
          <input type="text" name="shipping-address" id="shipping-address" placeholder="Shipping Address" class="form-control" value=<?php echo '"' . $order['ShippingAddress'] . '"'; ?>>
        </div>
        <div id="shipping-city-input" class="my-2">
          <label for="shipping-city" class="form-label">City</label>
          <input type="text" name="shipping-city" id="shipping-city" placeholder="Shipping City" class="form-control" value=<?php echo '"' . $order['ShippingCity'] . '"'; ?>>
        </div>
        <div id="shipping-postcode-input" class="my-2">
          <label for="shipping-postcode" class="form-label">Postcode</label>
          <input type="text" name="shipping-postcode" id="shipping-postcode" placeholder="Postcode" class="form-control" value=<?php echo '"' . $order['ShippingPostcode'] . '"'; ?>>
        </div>
        <div id="special-request-input" class="my-2">
          <label for="special-request" class="form-label">Special Request(s)</label>
          <textarea name="special-request" id="special-request" rows="5" class="form-control" placeholder="Special Request(s)" value=<?php echo '"' . $order['Special_Request'] . '"'; ?>> </textarea>
        </div>
        <h2> Billing Information </h2>
        <div id="billing-address-input" class="my-2">
          <label for="billing-address" class="form-label">Address</label>
          <input type="text" name="billing-address" id="billing-address" placeholder="Billing Address" class="form-control" value=<?php echo '"' . $order['BillingAddress'] . '"'; ?>>
        </div>
        <div id="billing-city-input" class="my-2">
          <label for="billing-city" class="form-label">City</label>
          <input type="text" name="billing-city" id="billing-city" placeholder="Billing City" class="form-control" value=<?php echo '"' . $order['BillingCity'] . '"'; ?>>
        </div>
        <div id="billing-postcode-input" class="my-2">
          <label for="billing-postcode" class="form-label">Postcode</label>
          <input type="text" name="billing-postcode" id="billing-postcode" placeholder="Postcode" class="form-control" value=<?php echo '"' . $order['BillingPostcode'] . '"'; ?>>
        </div>
        <div id="payment-method" class="my-2">
          <label for="payment-method" class="form-label">Method</label>
          <input type="text" name="payment-method" id="payment-method" placeholder="Method" class="form-control" value=<?php echo '"' . $order['Method'] . '"'; ?>>
        </div>
        <div id="payment-amount" class="my-2">
          <label for="payment-amount" class="form-label">Amount</label>
          <input type="number" step=0.01 name="payment-amount" id="payment-amount" placeholder="Amount" class="form-control" value=<?php echo '"' . $order['Amount'] . '"'; ?>>
        </div>
        <div id="submit-input" class="my-2 text-center">
          <button type="submit" class="btn btn-success">Update Order</button>
        </div>
      </form>
    </div>

  </main>




  ?>
</body>