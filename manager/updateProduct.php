<!DOCTYPE html>
<html>

<head>
  <title> Edit Product Confirmation </title>
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

      $stmt = $mysql->prepare("CALL manager_update_product(:prod_id, :prod_name, :prod_category, :prod_image, :prod_description, :prod_key_words, :prod_manufacturer, :prod_retail_price, :prod_bulk_price);");
      $stmt->bindParam(":prod_id", $prod_id);
      $stmt->bindParam(":prod_name", $prod_name);
      $stmt->bindParam(":prod_category", $prod_category);
      $stmt->bindParam(":prod_image", $prod_image);
      $stmt->bindParam(":prod_description", $prod_description);
      $stmt->bindParam(":prod_key_words", $prod_key_words);
      $stmt->bindParam(":prod_manufacturer", $prod_manufacturer);
      $stmt->bindParam(":prod_retail_price", $prod_retail_price);
      $stmt->bindParam(":prod_bulk_price", $prod_bulk_price);

      $prod_id = $_GET["id"];
      $prod_name = $_GET["name"];
      $prod_category = $_GET["category"];
      $prod_image = $_GET["image"];
      $prod_description = $_GET["description"];
      $prod_key_words = $_GET["key-words"];
      $prod_manufacturer = $_GET["manufacturer"];
      $prod_retail_price = $_GET["retail-price"];
      $prod_bulk_price = $_GET["bulk-price"];


      $stmt->execute();
      echo "Updated Product with ID " . $prod_id . " to:<br>";
      echo "Name: " . $prod_name . "<br>";
      echo "Category: " . $prod_category . "<br>";
      echo "Image URL: " . $prod_image . "<br>";
      echo "Description: " . $prod_description . "<br>";
      echo "Manufacturer: " . $prod_manufacturer . "<br>";
      echo "Retail Price: £" . $prod_retail_price . "<br>";
      echo "Bulk Price: £" . $prod_bulk_price . "<br>";
    } else {
      echo "Error: No form submitted";
    }
    ?>
  </main>
</body>


</html