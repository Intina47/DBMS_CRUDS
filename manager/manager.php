<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Manager Page</title>
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
  <meta charset="utf-8">
</head>

<?php
include "db.php";
$stmt = $mysql->prepare("CALL manager_get_overview()");
$stmt->execute();
$result = $stmt->fetchAll();
$overviewData = $result[0];

// Checks to see if there is a search term provided
if (isset($_GET["search"]) && $_GET["search"] != ''){
  // Checks to see if the user pressed the clear button last time the form was submitted
  // If they did the search term should be blank regardless of what was in the input when the form was submitted
  if (isset($_GET["clear"]) && $_GET["clear"] == true){
    $searched = false;
    $search_term = "";
  } else{
    $searched = true;
    $search_term = $_GET["search"];
  }
} else {
  $searched = false;
  $search_term = "";
}
?>

<body>
  <header class="d-flex justify-content-between align-items-center py-2">
    <button type="button" class="btn btn-light">
      <i class="bi bi-plus-lg"></i>
      <a href="addProduct.php" class="link-unstyled">Add Product</a>
    </button>
    <form class="d-flex" role="search" action="manager.php">
      <input class="form-control me-2" type="search" placeholder="Search Products" aria-label="Search" name="search" id="search" value=<?php echo $search_term ?>>
      <?php  
        // Checks to see if a search term was given 
        if ($searched){
          echo "<button class='btn btn-outline-danger mx-1' type='submit' id='clear' name='clear' onclick='this.value = true' value=false>Clear</button>";
        }
      ?>
      <button class="btn btn-outline-success mx-1" type="submit" id="search">Search</button>
    </form>
  </header>
  <main>
    <div id="overview" class="container-fluid">
      <div class="row">
        <div class="col overview-container text-center bg-secondary rounded">
          <span class="overview-title" id="sales-title">Total Sales<br></span>
          <span class="overview-data" id="sales-data">£<?php echo $overviewData["TotalSales"] ?></span>
        </div>
        <div class="col overview-container text-center bg-secondary rounded">
          <span class="overview-title" id="expenses-title">Total Expenses <br></span>
          <span class="overview-data" id="expenses-data">£<?php echo $overviewData["TotalExpenses"] ?></span>
        </div>
        <div class="col overview-container text-center bg-secondary rounded">
          <span class="overview-title" id="users-title">Total Users <br></span>
          <span class="overview-data" id="users-data"><?php echo $overviewData["TotalUsers"] ?></span>
        </div>
        <div class="col overview-container text-center bg-secondary rounded">
          <span class="overview-title" id="orders-title">Total Orders <br></span>
          <span class="overview-data" id="overview-data"><?php echo $overviewData["TotalOrders"] ?></span>
        </div>
      </div>
    </div>
    <div id="management" class="container-fluid">
      <hr>
      <div class="btn-group" role="group" id="management-buttons">
        <input type="radio" name="management-btn-group" id="products-toggle" class="btn-check" autocomplete="off" checked onclick="toggleDisplay()">
        <label for="products-toggle" class="btn btn-outline-secondary">Products</label>

        <input type="radio" name="management-btn-group" id="orders-toggle" class="btn-check" autocomplete="off" onclick="toggleDisplay()">
        <label for="orders-toggle" class="btn btn-outline-secondary">Orders</label>
      </div>
      <hr>
      <div class="container-fluid" id="products-container">
        <?php
        $stmt = $mysql->prepare("CALL manager_get_products_overview(:term)");

        $stmt->bindParam(':term', $search_term);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ($result as $row) {
          // Checks if there is a description for the product, if not, it will display "No description available"
          if (empty($row['product_description'])) {
            $description = "No description available";
          } else {
            $description = $row['product_description'];
          };

          // Checks if there is an image for the product, if not, it will display a placeholder image
          if (empty($row['product_image'])) {
            $product_image = "<img class='placeholder rounded' width='150' height='150' />";
          } else {
            $product_image = "<img class='product-image mw-100' src='" . $row['product_image'] . "' />";
          };

          // Checks if there are any in stock, if not, it will display 0
          if (empty($row['product_quantity'])) {
            $product_quantity = 0;
          } else {
            $product_quantity = $row['product_quantity'];
          };

          echo "<div class='row mx-auto my-2 container-fluid' product-id=" . $row['Product_ID'] . ">
            <div class='col-sm-3 col-lg-2'>" . $product_image . "</div>
            <div class='col-sm-8 col-lg-9 row '> 
              <div class='col-4'> 
                <strong class='text-center'> Product Name </strong> <br> " . $row['product_name'] . "
              </div>
              <div class='col-5'> 
                <strong> Description </strong> <br> " . $description . "
              </div>
              <div class='col-2 text-center'>
                <strong> Retail Price </strong> <br> 
                £" . $row['retail_price'] . " <br> 
                <strong> Bulk Price </strong> <br> 
                £" . $row['bulk_price'] . "
              </div>
              <div class='col-1 text-center'>
                <strong> Quantity </strong> <br> " . $product_quantity . "
              </div>
            </div>
            <div class='col-1 btn-group-vertical'> 
            <a href='editProduct.php?id=" . $row['Product_ID'] . "' class='link-unstyled'>
              <button type='submit' class='btn btn-success' >Edit</button> </a>
            <br>
            <a href='deleteProduct.php?id=" . $row['Product_ID'] . "' class='link-unstyled'>
              <button type='submit' class='btn btn-danger ' >Delete</button>
            </a>
            </div>
            <hr>
          </div>";
        }
        ?>
      </div>
      <div class="container-fluid" id="orders-container" style='display:none'>
        <?php
        $stmt = $mysql->prepare("CALL manager_get_orders_overview()");
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ($result as $row) {
          echo "<div class='row mx-auto py-2 container' order-id='" . $row['Order_ID'] . "'>
              <div class='row col-12'> Order No.: " . $row['Order_ID'] . "</div>
              <div class='row container-fluid'> 
                <div class='col-4'> 
                  <strong> Customer Information </strong> <br>
                  " . $row['First_Name'] . " " . $row['Second_Name'] . "<br>
                  " . $row['Email'] . "<br>
                </div>
                <div class='col-4'>
                  <strong> Shipping Details </strong> <br>
                  " . $row['ShippingAddress'] . "<br>
                  " . $row['ShippingCity'] . "<br>
                  " . $row['ShippingPostcode'] . "<br>
                </div>
                <div class='col-2'>
                  <strong> Order Details </strong> <br>
                  <em>Order Placed: </em><br>
                  " . $row['Date'] . "<br>
                  <em>Cost: </em><br>
                  £" . $row['Amount'] . "
                </div>
                <div class='col-2 btn-group-vertical my-auto'>
                <a href='editOrder.php?id=" . $row['Order_ID'] . "' class='link-unstyled'>
                  <button type='submit' class='btn btn-success'>View/Edit Details</button>
                </a> <br>
                <a href='deleteOrder.php?id=" . $row['Order_ID'] . "' class='link-unstyled'>
                  <button type='submit' class='btn btn-danger'>Delete</button>
                </a>
                </div>
              </div>
            <hr>
          </div>";
        }
        ?>
      </div>
    </div>
  </main>

  <script>
    // Toggles the display of the products and orders depending on which is checked
    function toggleDisplay() {
      if (document.getElementById("products-toggle").checked) {
        document.getElementById("products-container").style.display = "block";
        document.getElementById("orders-container").style.display = "none";
      } else {
        document.getElementById("products-container").style.display = "none";
        document.getElementById("orders-container").style.display = "block";
      }
    }

    function deleteProduct(productID) {
      console.log(productID);
    }
  </script>

</body>

</html>