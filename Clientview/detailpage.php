<?php
session_start();
include 'db.php';
include 'client_functions.php';
add_to_cart();
?>
<!DOCTYPE html>
<html lang="en">
<!-- bootstrap 5.2.3 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/>
<meta charset="utf-8"/>
<meta name= "viewport" content="width=device-width, initial-scale=1">
<head>
    <meta charset="utf-8">
      <title>Easy PC</title> 
</head>
<div class="container-fluid h-100 d-flex align-items-center justify-content-center">
    <body>
        <?php
    if(isset($_GET['product_details'])){
      $get_product_id = $_GET['product_details'];
      $stmt = "select * from `product` where Product_ID = $get_product_id";
      $results = mysqli_query($mysql, $stmt);

 while($product_list = mysqli_fetch_assoc($results)){
  $product_id = $product_list['Product_ID'];
  $category = $product_list['Category'];
  $name = $product_list['Product_name'];
  $description = $product_list['Product_description'];
  $image = $product_list['Product_image'];
  $price = $product_list['Retail_price'];
  $B_P = $product_list['Bulk_price'];
  $manufacturer = $product_list['Manufacturer'];
  if(isset($_SESSION["User_ID"])){
  echo "
  <div class='card mb-3 border-0' style='max-width: 1000px;'>
        <div class='row py-5 g-5'>
         <div class='col-6 col-lg-6'>
         <img src ='$image' class='m-1 w-100 sliderMainImage' data-bs-toggle='modal' data-bs-target='#imagemodal'>
     </div>
     <div class='col-6 col-lg-6'>
     <a  class='bi bi-arrow-left' value='back' name='back' href='ClientView.php?login=".$_SESSION["User_ID"]."{'>
     <label for='back'>Back</label>
     </a>
         <h2>$name</h2>
         <small class='text-muted'>$product_id</small>
         <h4 class= 'my-4'>
             $<span id='product_price'>$price</span>
         </h4>
         <div class='d-grid my-4'>
             <button class='btn btn-lg btn-dark text-info' type='button' id='detailpageCartbtn'>
             <a class='nav-link active' aria-current='page' href='clientview.php?add_cart=$product_id'>
                  Add to Cart</a>
             </button>
         </div>
         <div class='d-grid my-4'>
             <button class='btn btn-lg btn-warning' type='button' id='detailpageCartbtn'>
             <a class='nav-link active' aria-current='page' href='buy.php?buy=$product_id'>
                  Buy Now
                  </a>
             </button>
         </div>
         <div class='accordion'>
          <div class='accordion-item'>
          <h2 class='accordion-header'> 
            <button 
            class='accordion-button'
            type='button'
            data-bs-toggle='collapse'
            data-bs-target='#collapseOne'
            aria-expanded='true'
            aria-controls='collapseOne'>
                <strong>Descripton</strong>
            </button>
         </h2>
         <div id='collapseOne' class='accordion-collapse collapse show' aria-labelledby='headingOne'>
             <div class='accordion-body'>
             $description
             </div>
         </div>
       </div>
     </div>
  </div>
 </div>";
  }else{
    echo "
  <div class='card mb-3 border-0' style='max-width: 1000px;'>
        <div class='row py-5 g-5'>
         <div class='col-6 col-lg-6'>
         <img src ='$image' class='m-1 w-100 sliderMainImage' data-bs-toggle='modal' data-bs-target='#imagemodal'>
     </div>
     <div class='col-6 col-lg-6'>
     <a  class='bi bi-arrow-left' value='back' name='back' href='ClientView.php'{'>
     <label for='back'>Back</label>
     </a>
         <h2>$name</h2>
         <small class='text-muted'>$product_id</small>
         <h4 class= 'my-4'>
             $<span id='product_price'>$price</span>
         </h4>
         <div class='d-grid my-4'>
             <button class='btn btn-lg btn-dark text-info' type='button' id='detailpageCartbtn'>
             <a class='nav-link active' aria-current='page' href='clientview.php?add_cart=$product_id'>
                  Add to Cart</a>
             </button>
         </div>
         <div class='d-grid my-4'>
             <button class='btn btn-lg btn-warning' type='button' id='detailpageCartbtn'>
             <a class='nav-link active' aria-current='page' href='buy.php?buy=$product_id'>
                  Buy Now
                  </a>
             </button>
         </div>
         <div class='accordion'>
          <div class='accordion-item'>
          <h2 class='accordion-header'> 
            <button 
            class='accordion-button'
            type='button'
            data-bs-toggle='collapse'
            data-bs-target='#collapseOne'
            aria-expanded='true'
            aria-controls='collapseOne'>
                <strong>Descripton</strong>
            </button>
         </h2>
         <div id='collapseOne' class='accordion-collapse collapse show' aria-labelledby='headingOne'>
             <div class='accordion-body'>
             $description
             </div>
         </div>
       </div>
     </div>
  </div>
 </div>";
  }
}
 }
 ?>
 <h2 class="display-6 py-5 text-center">
    You May also Like This
 </h2>
</div>
</div>
<div class="row row-cols-2 row-cols-md-4 g-4 p-4">
 <?php
    global $mysql;
      $stmt = "select * from `product` order by rand() LIMIT 0,8";
      $more_like_this = mysqli_query($mysql, $stmt);
  while($suggestions = mysqli_fetch_assoc($more_like_this)){
    $pid = $suggestions['Product_ID'];
    $category = $suggestions['Category'];
    $name = $suggestions['Product_name'];
    $description = $suggestions['Product_description'];
    $image = $suggestions['Product_image'];
    $price = $suggestions['Retail_price'];
    $B_P = $suggestions['Bulk_price'];
    $manufacturer = $suggestions['Manufacturer'];
    echo"
    <div class='col'>
  <div class='container-fluid'>
  <div class='card'>
   <a class='nav-link active' aria-current='page' href='detailpage.php?product_details=$product_id'>
    <img src='$image' class='card-img-top' alt='$name'>
    <div class='card-body'>
      <h5 class='card-title'>$name</h5>
      <p class='card-text text-truncate'>$description</p>
      </a>
      <div class='row'>
      <div class='col'>
      <h4 class= 'my-4'>
             $<span id='price'>$price</span>
         </h4>
      </div>
      <div class='col'>
      <a class='btn btn-info btn-block my-4' href='clientview.php?add_cart=$pid'>Add to Cart</a>
      </div>
      </div>
    </div>
  </div>
 </div>
 </div>";
  }
  ?>
 </div>
 </body>
</div>
</html>