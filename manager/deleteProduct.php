<!DOCTYPE html>
<html>

<head>
  <title>Delete Product</title>
  <meta charset="utf-8">

  <!-- Bootstrap CSS v5.2-->
  <!-- Source: -->
  <!-- https://getbootstrap.com/docs/5.2/getting-started/download/ -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>

<body>

  <?php
  include "db.php";
  if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $stmt = $mysql->prepare("CALL manager_delete_product(:prod_id);");
    $stmt->bindParam(":prod_id", $prod_id);

    $prod_id = $_GET["id"];

    $stmt->execute();
    echo "Deleted product with id: " . $prod_id;
  } else {
    echo "Error: No form submitted";
  }
  ?>
</body>

</html>