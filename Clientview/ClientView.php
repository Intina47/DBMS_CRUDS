<?php
session_start();
include_once 'db.php';
include 'client_functions.php';
add_to_cart();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<!-- bootstrap 5.2.3 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<head>
    <meta charset="utf-8"/>
    <meta name= "viewport" content="width=device-width, initial-scale=1">
      <title>Easy PC</title>
  </head>
  <!-- This part is for Navbar -->
  <body>
    <div id="app">
    <!-- inside part -->
  <div class="collapse" id="navbarToggleExternalContent">
  <nav class="navbar navbar-expand-lg navbar-dark bg-white">
  <a class="navbar-brand text-dark" href="clientview.php">EasyPC</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
 aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
 <span class="navbar-toggler-icon"></span>
</button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-3 mt-lg-1">
      <?php
      if(isset($_GET["login"])){
          echo"
        <li class='nav-item active'>
        <a class='nav-link text-dark' href='user_profile.php?user_login=".$_SESSION["User_ID"]."'>Profile<span class='sr-only'></span></a>
      </li>
      <li class='nav-item'>
        <a class='nav-link text-dark' href='#'>Orders</a>
      </li>
      <li class='nav-item'>
      <a class='nav-link text-dark' href='logout.php'>LogOut</a>
    </li>
    <span class='navbar-text text-dark'>
      Hello ".$_SESSION["Second_name"].", Welcome
    </span>";
        }else{
          echo"
          <li class='nav-item'>
          <a class='nav-link text-dark' href='loginpage.php'>SignIn</a>
        </li>";      
        }
      ?>
    </ul>
  </div>
 </nav>
</div>
<!-- outside part -->
<nav class="navbar navbar-dark bg-dark">
        <button type="button" class="btn btn-link" style="font-size:30px;color:black" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="bi bi-list text-info"></span></button>
    <h2 class="position-fix" value="logo" name="logo" id="company-logo"><a class="nav-link active text-info" aria-current="page"
    href="ClientView.php">Easy PC</a></h2>
    <button type="button" class="btn btn-link" style="font-size:30px; color:white">
    <a class="bi bi-cart text-info" href="viewcart.php">
      <sup>
        <?php
        cart_item_count();
        ?>
      </sup>
      </a>
  </button>
</nav>
</div>


<!-- This part is the top part-->
<div class="bg-light container-fluid .g-col-4">
<h3><a class="nav-link active" aria-current="page"
    href="ClientView.php">All Products</a></h3>
<div class="row">
  <div class="col-xs-4">
<button class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" value="submit">
<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-filter-left p-2" viewBox="0 0 16 16">
<path d="M2 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
</svg>Filter</button>
<ul class="dropdown-menu">
  <!--phone id=301 -->
  <!--CPU id=302 -->
    <li><a class="dropdown-item" href="ClientView.php?id=301">Phones</a></li>
    <li><a class="dropdown-item" href="ClientView.php?id=302">CPU</a></li>
    <li><a class="dropdown-item" href="ClientView.php?id=303">GPU</a></li>
    <li><a class="dropdown-item" href="ClientView.php?id=304">PSU</a></li>
    <li><a class="dropdown-item" href="ClientView.php?id=305">RAM</a></li>
    <li><a class="dropdown-item" href="ClientView.php?id=306">Storage</a></li>
    <li><a class="dropdown-item" href="ClientView.php?id=307">Cooler</a></li>
    <li><a class="dropdown-item" href="ClientView.php?id=308">Mother Board</a></li>
    <li><a class="dropdown-item" href="ClientView.php?id=309">Case</a></li>
  </ul>
<!-- search bar -->
<div class="bg-light .g-col-4">
  <form class="d-flex" role="search" action="ClientView.php">
    <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="search_bar">
    <?php
    if(isset($_GET['search_product']))
    {
      echo "<button class='btn btn-outline-success' type='submit' value='cancel' name='clear_search'>Cancel</button>";
    }else{
      echo "<button class='btn btn-outline-success' type='submit' value='Search' name='search_product'>Search</button>";
    }
    ?>
  </form>
</div>
</div>
</div>
<!-- search bar -->
<!-- Main card -->
<div class="row row-cols-2 row-cols-md-4 g-4 p-4">

  <!-- fetch database products -->
<?php
//sort products into categories
if(isset($_GET['id'])){
  $get_filter_instruction = $_GET['id'];
  {
    if($get_filter_instruction == 301){
      getAllproducts();
    }elseif($get_filter_instruction == 302){
      getAllCPUs();
    }elseif($get_filter_instruction == 303){
      getAllGPUs();
    }elseif($get_filter_instruction == 304){
      getAllPSUs();
    }elseif($get_filter_instruction == 305){
      getAllRAMs();
    }elseif($get_filter_instruction == 306){
      getAllStorage();
    }elseif($get_filter_instruction == 307){
      getAllCoolers();
    }elseif($get_filter_instruction == 308){
      getAllmotherbds();
    }elseif($get_filter_instruction == 309){
      getAllCases();
    }
  }
//search for products
}else if(isset($_GET['search_product']))
{
  $users_search = $_GET['search_bar'];
  if($users_search == "")
  {
    echo "<h2 class='text-center text-danger'>Sorry you submitted an Empty Search, Try again</h2>";
  }else{
  $search_query="SELECT * FROM `product` where key_words like '%$users_search%' or Product_name like '%$users_search%' ";
  $results = mysqli_query($mysql,$search_query);
  $rows = mysqli_num_rows($results);
  if($rows == 0){
    echo "<h2 class='text-center text-danger'>Sorry no results Found!</h2>";
  }
  while($product_list = mysqli_fetch_assoc($results)){
    $product_id = $product_list['Product_ID'];
    $category = $product_list['Category'];
    $name = $product_list['Product_name'];
    $description = $product_list['Product_description'];
    $image = $product_list['Product_image'];
    $price = $product_list['Retail_price'];
    $B_P = $product_list['Bulk_price'];
    $manufacturer = $product_list['Manufacturer'];
    echo "
    <div class='col'>
    <div class='container-fluid'>
    <div class='card'>
     <a class='nav-link active' ria-current='page' id='card_details' href='detailpage.php?product_details=$product_id'>
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
        <a class='btn btn-info btn-block my-4' href='clientview.php?add_cart=$product_id'>Add to Cart</a>
        </div>
        </div>
      </div>
    </div>
  </div>
  </div>";
  }
}
}
//display products to user if logged in
else{
$stmt= "SELECT * FROM `product` order by rand() LIMIT 0,28";
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
  <div clas='card-columns'>
  <div class='col'>
  <div class='container-fluid'>
  <div class='card'>
   <a class='nav-link active' ria-current='page' id='card_details' href='detailpage.php?product_details=$product_id'>
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
      <a class='btn btn-info btn-block my-4 d-none d-lg-block'  href='clientview.php?add_cart=$product_id&login=".$_SESSION["User_ID"]."'>Add to Cart</a>
      </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>";
//dislay all products to user by default if user is not logged in
}else{
  echo "
  <div clas='card-columns'>
  <div class='col'>
  <div class='container-fluid'>
  <div class='card'>
   <a class='nav-link active' ria-current='page' id='card_details' href='detailpage.php?product_details=$product_id'>
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
      <a class='btn btn-info btn-block my-4 d-none d-lg-block'  href='clientview.php?add_cart=$product_id'>Add to Cart</a>
      </div>
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
</div>
</div>
</body>
<footer>
<div class="container">
      <footer class="py-4">
          <div class="col-md-offset-4 col-lg-offset-4col-xl-offset-4" align="center">
            <form>
              <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                <label for="newsletter1" class="visually-hidden">ENTER YOUR EMAIL</label>
                <input id="newsletter1" type="text" class="form-control" placeholder="ENTER YOUR EMAIL">
                <button class="btn btn-primary" type="button">Subscribe</button>
              </div>
            </form>
          </div>

        <div class="justify-content-between py-2 my-3 border-top">
          <p class="text-center" align="center">COPYRIGHT &copy; 2022 EASYPC.COM<br>ALL RIGHTS RESERVED</p>
        </div>
      </footer>
    </div>
</footer>
</html>
<!-- "Z:\DatabaseGUI\Webpage\Clientview\product_images" -->