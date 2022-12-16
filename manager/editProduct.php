<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <title> Edit Product </title>
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
      $prod_id = $_GET["id"];
      $stmt = $mysql->prepare("CALL manager_get_product(:prod_id)");
      $stmt->bindParam(":prod_id", $prod_id);
      $stmt->execute();
      $product = $stmt->fetch();
    } else {
      echo "Error";
    } ?>
    <div class="w-50 mx-auto">
      <h1>Edit Product</h1>
      <form action="updateProduct.php" method="get" id=" addProductForm">
        <div id="id-input">
          <input type="hidden" name="id" id="id" value=<?php echo '"' . $prod_id . '"' ?>>
        </div>
        <div id="name-input" class="my-2">
          <label for="name" class="form-label">Product Name</label>
          <input type="text" name="name" id="name" placeholder="Name" class="form-control" value=<?php echo '"' . $product["product_name"] . '"'; ?>>
        </div>
        <div id="category-input" class="my-2">
          <label for="category" class="form-label">Category</label>
          <input type="text" name="category" id="category" class="form-control" placeholder="Category" value=<?php echo '"' . $product["Category"] . '"'; ?> />
        </div>
        <div id="image-input-div" class="my-2">
          <label for="image" class="form-label">Product Image Link</label>
          <input type="text" name="image" id="image" class="form-control" placeholder="Image Link" value=<?php echo '"' . $product["product_image"] . '"'; ?>>
        </div>
        <div id="description-input" class="my-2">
          <label for="description" class="form-label">Product Description</label>
          <textarea name="description" id="description" rows="5" class="form-control" placeholder="Description"><?php echo $product["product_description"]; ?> </textarea>
        </div>
        <div id="keywords-input" class="my-2">
          <label for="keywords" class="form-label">Keywords</label>
          <textarea name="keywords" id="keywords" rows="5" class="form-control" placeholder="Keywords"><?php echo $product["key_words"]; ?> </textarea>
        </div>
        <div id="manufacturer-input" class="my-2">
          <label for="manufacturer" class="form-label">Manufacturer</label>
          <input type="text" name="manufacturer" id="manufacturer" class="form-control" placeholder="Manufacturer" value=<?php echo '"' . $product["manufacturer"] . '"'; ?>>
        </div>
        <div id="retail-price-input" class="my-2">
          <label for="retail-price" class="form-label">Retail Price</label>
          <input type="number" name="retail-price" id="retail-price" class="form-control" placeholder="Retail Price" step=0.01 value=<?php echo $product["retail_price"]; ?>>
        </div>
        <div id="bulk_price-input" class="my-2">
          <label for="bulk-price" class="form-label">Bulk Price</label>
          <input type="number" name="bulk-price" id="bulk-price" class="form-control" placeholder="Bulk Price" step=0.01 value=<?php echo $product["bulk_price"]; ?>>
        </div>
        <div id="submit-input" class="my-2 text-center">
          <button type="submit" class="btn btn-success">Update Product</button>
        </div>
      </form>
    </div>

  </main>




  ?>
</body>