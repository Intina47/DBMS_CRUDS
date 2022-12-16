<?php
include "db.php";
if(isset($_POST["submit"])){
  //insert one row  
    $address = $_POST['address'];
    $city = $_POST['city'];
    $postcode = $_POST['postcode'];
    $paymethod = $_POST['paymethod'];

    $stmt ="INSERT INTO `billingaddress`(Address,City,Postcode)
    VALUE('$address','$city','$postcode')";
    $results =mysqli_query($mysql,$stmt);
    $pay = "INSERT INTO `payment`(Method)
    VALUE('$paymethod')";
    $results2 =mysqli_query($mysql,$pay);
    if(!$results){
      echo "Sorry an Error occured updating your shipping address please try again\n";
        header("location:getshippinginfo.php?error=Error adding product");
    }else{
        header("location:getbillinginfo.php?billing=success");
  }
}else{
    echo "Sorry an error occured please try again";
  }

?>