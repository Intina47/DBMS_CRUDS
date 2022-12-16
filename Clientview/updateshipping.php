<?php
include "db.php";
if(isset($_POST["submit"])){
  //insert one row  
    $address = $_POST['address'];
    $city = $_POST['city'];
    $postcode = $_POST['postcode'];
    $srequest = $_POST['srequest'];

    $stmt ="INSERT INTO `shippingaddress`(Address,City,Postcode,Special_Request)
    VALUE('$address','$city','$postcode','$srequest')";
    $results =mysqli_query($mysql,$stmt);
    if(!$results){
      echo "Sorry an Error occured updating your shipping address please try again\n";
        header("location:getshippinginfo.php?error=Error adding product");
    }else{
        header("location:getbillinginfo.php");
  }
}else{
    echo "Sorry an error occured please try again";
  }

?>