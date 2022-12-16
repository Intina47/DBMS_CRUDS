<?php
include 'db.php';

function userExists($mysql, $uname){
  $sql = "SELECT * FROM user_loginview WHERE Email = ?;";
  $stmt = mysqli_stmt_init($mysql);
  if(!mysqli_stmt_prepare($stmt,$sql)){
     header("location:loginpage.php?error=unknown");
     exit();
  }
  mysqli_stmt_bind_param($stmt, "s", $uname);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  if($row = mysqli_fetch_assoc($result)){
     return $row;
  }else{
     $result = true;
  }
  mysqli_stmt_close($stmt);
}

function getAllproducts(){
  global $mysql;
    $stmt = "select * from `phone_view`";
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
          <a class='btn btn-info btn-block my-4'  href='clientview.php?add_cart=$product_id'>Add to Cart</a>
          </div>
          </div>
        </div>
      </div>
    </div>
    </div>";
    }
}

function getAllCoolers(){
  global $mysql;
    $stmt = "select * from `cooler_sview`";
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
          <a class='btn btn-info btn-block my-4'  href='clientview.php?add_cart=$product_id'>Add to Cart</a>
          </div>
          </div>
        </div>
      </div>
    </div>
    </div>";
    }
}

function getuserIP()
{
  if(!empty($_SERVER['HTTP_CLIENT_IP'])){
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }else{
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}
function add_to_cart(){
  if(isset($_GET['add_cart'])){
    global $mysql;
    $ip = getuserIP();
    $pid = $_GET['add_cart'];
    $stmt = "select * from `cart` where uiIP = '$ip' and Product_ID = $pid";
    $results = mysqli_query($mysql,$stmt);
    $rows = mysqli_num_rows($results);
    if($rows > 0){
      $qty = $rows['quantity'];
      $save_cart = "update `cart` set quantity=quantity+1 where uiIP = '$ip' and Product_ID = $pid";
      $results = mysqli_query($mysql,$save_cart);
      header("location:clientview.php?item=$qty");
      exit();
   }else{
    $qty = 0;
    ++$qty;
    $save_cart = "insert into `cart` (Product_ID, uiIP,quantity) values($pid,'$ip',$qty)";
    $results = mysqli_query($mysql,$save_cart);
   }
    
  }
}
function cart_item_count(){
  if(isset($_GET['add_cart'])){
    global $mysql;
    $ip = getuserIP();
    $stmt = "select * from `cart` where uiIP = '$ip'";
    $results = mysqli_query($mysql,$stmt);
    $rows = mysqli_num_rows($results);
   }else{
    global $mysql;
    $ip = getuserIP();
    $stmt = "select * from `cart` where uiIP = '$ip'";
    $results = mysqli_query($mysql,$stmt);
    $rows = mysqli_num_rows($results);
   }
    echo $rows;
}
function getAllCPUs(){
  global $mysql;
    $stmt = "select * from `cpu_sview`";
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
          <a class='btn btn-info btn-block my-4'  href='clientview.php?add_cart=$product_id'>Add to Cart</a>
          </div>
          </div>
        </div>
      </div>
    </div>
    </div>";
    }
}

function CheckAccess()
{
  //allowed IP. Change it to your static IP
  $allowedip = '127.0.0.1';
  $ip = $_SERVER['REMOTE_ADDR'];
  return ($ip == $allowedip);
  if($ip != $allowedip ){
    header("location:loginpage.php");
  }
}

function getAllRAMs(){
  global $mysql;
    $stmt = "select * from `ram_view`";
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
          <a class='btn btn-info btn-block my-4'  href='clientview.php?add_cart=$product_id'>Add to Cart</a>
          </div>
          </div>
        </div>
      </div>
    </div>
    </div>";
    }
}

function getAllGPUs(){
  global $mysql;
    $stmt = "select * from `gpu_view`";
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
          <a class='btn btn-info btn-block my-4'  href='clientview.php?add_cart=$product_id'>Add to Cart</a>
          </div>
          </div>
        </div>
      </div>
    </div>
    </div>";
    }
}

function getAllPSUs(){
  global $mysql;
    $stmt = "select * from `psu_view`";
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
          <a class='btn btn-info btn-block my-4'  href='clientview.php?add_cart=$product_id'>Add to Cart</a>
          </div>
          </div>
        </div>
      </div>
    </div>
    </div>";
    }
}

function getAllmotherbds(){
  global $mysql;
    $stmt = "select * from `mother_boardview`";
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
          <a class='btn btn-info btn-block my-4'  href='clientview.php?add_cart=$product_id'>Add to Cart</a>
          </div>
          </div>
        </div>
      </div>
    </div>
    </div>";
    }
}

function getAllStorage(){
  global $mysql;
    $stmt = "select * from `storage_view`";
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
          <a class='btn btn-info btn-block my-4'  href='clientview.php?add_cart=$product_id'>Add to Cart</a>
          </div>
          </div>
        </div>
      </div>
    </div>
    </div>";
    }
}

function getAllCases(){
  global $mysql;
    $stmt = "select * from `case_view`";
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
          <a class='btn btn-info btn-block my-4'  href='clientview.php?add_cart=$product_id'>Add to Cart</a>
          </div>
          </div>
        </div>
      </div>
    </div>
    </div>";
    }
}
?>