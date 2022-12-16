<?php
session_start();
if(isset($_SESSION["User_ID"])){
    //check if we have their shipping and billing details already
    header("location:getshippinginfo.php");
    exit();
}else{
    header("location:getshippinginfo.php");
    exit();
}
?>