<!DOCTYPE html>
<html>

<head>
  <title> Edit Order Confirmation </title>
  <meta charset="utf-8">
  <!-- Bootstrap CSS v5.2-->
  <!-- Source: -->
  <!-- https://getbootstrap.com/docs/5.2/getting-started/download/ -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>

<body>
  <main>
    <?php
    include "db.php";
    // Since the submit button is a button  and not an input, checking for $_GET["submit"] will not work so this is an alternative
    // Source: https://stackoverflow.com/questions/7711466/checking-if-form-has-been-submitted-php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
      $stmt = $mysql->prepare("CALL manager_update_order(:ord_id, :shipping_id, :billing_id, :payment_id, :u_id, :u_first_name, :u_second_name, :u_email, :ship_address, :ship_city, :ship_postcode, :ship_special_request, :bill_address, :bill_city, :bill_postcode, :pay_method, :pay_amount)");
      $stmt->bindParam(":ord_id", $ord_id);
      $stmt->bindParam(":shipping_id", $ship_id);
      $stmt->bindParam(":billing_id", $bill_id);
      $stmt->bindParam(":payment_id", $pay_id);
      $stmt->bindParam(":u_id", $user_id);
      $stmt->bindParam(":u_first_name", $first_name);
      $stmt->bindParam(":u_second_name", $second_name);
      $stmt->bindParam(":u_email", $email);
      $stmt->bindParam(":ship_address", $ship_address);
      $stmt->bindParam(":ship_city", $ship_city);
      $stmt->bindParam(":ship_postcode", $ship_postcode);
      $stmt->bindParam(":ship_special_request", $ship_special_request);
      $stmt->bindParam(":bill_address", $bill_address);
      $stmt->bindParam(":bill_city", $bill_city);
      $stmt->bindParam(":bill_postcode", $bill_postcode);
      $stmt->bindParam(":pay_method", $pay_method);
      $stmt->bindParam(":pay_amount", $pay_amount);

      $ord_id = $_GET["order-id"];
      $ship_id = $_GET["shipping-id"];
      $bill_id = $_GET["billing-id"];
      $pay_id = $_GET["payment-id"];
      $user_id = $_GET["user-id"];
      $first_name = $_GET["first-name"];
      $second_name = $_GET["second-name"];
      $email = $_GET["email"];
      $ship_address = $_GET["shipping-address"];
      $ship_city = $_GET["shipping-city"];
      $ship_postcode = $_GET["shipping-postcode"];
      $ship_special_request = $_GET["special-request"];
      $bill_address = $_GET["billing-address"];
      $bill_city = $_GET["billing-city"];
      $bill_postcode = $_GET["billing-postcode"];
      $pay_method = $_GET["payment-method"];
      $pay_amount = $_GET["payment-amount"];

      $stmt->execute();

      echo "Updated Order with ID " . $ord_id . " to: <br>";
      echo "<h2> Customer Info </h2>";
      echo "First Name: " . $first_name . "<br>";
      echo "Second Name: " . $second_name . "<br>";
      echo "Email: " . $email . "<br>";
      echo "<h2> Shipping Info </h2>";
      echo "Address: " . $ship_address . "<br>";
      echo "City: " . $ship_city . "<br>";
      echo "Postcode: " . $ship_postcode . "<br>";
      echo "Special Request: " . $ship_special_request . "<br>";
      echo "<h2> Billing Info </h2>";
      echo "Address: " . $bill_address . "<br>";
      echo "City: " . $bill_city . "<br>";
      echo "Postcode: " . $bill_postcode . "<br>";
      echo "<h2> Payment Info </h2>";
      echo "Payment Method: " . $pay_method . "<br>";
      echo "Payment Amount: " . $pay_amount . "<br>";
    } else {
      echo "Error: No form submitted";
    }
    ?>

  </main>
</body>