<?php
include 'db.php';
if(isset($_GET['erase'])){
    $get_product_id = $_GET['erase'];
    $qry = "delete from `cart` where Product_ID = $get_product_id";
    if($mysql->query($qry) === TRUE){
        header("location:viewcart.php?deleted=$get_product_id");
    }else{
        echo "error".$mysql->error;
    }
}
?>