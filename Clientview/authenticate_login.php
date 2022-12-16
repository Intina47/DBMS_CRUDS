<?php
   include("db.php");
   include("client_functions.php");

   if(isset($_SESSION["loggedin"]) === TRUE){
    header("location:ClientView.php?signin=true");
    exit();
}else if($_SERVER["REQUEST_METHOD"] == "POST") {
      $myusername = mysqli_real_escape_string($mysql,$_POST['username']);
      $mypassword = mysqli_real_escape_string($mysql,$_POST['password']);
      $userin =  userExists($mysql, $myusername);
      if($userin === false){
         header("location:loginpage.php?error=wrongdetails");
         exit();
      }
      $passauth = $userin['Password'];
      $auth = password_verify($mypassword,$passauth);
      if($mypassword == $passauth){
         $auth = true;
      }
      if($auth === false){
         header("location:loginpage.php?error=wrongdetails");
         exit();
      }else if ($auth === true){
         session_start();
          $_SESSION["loggedin"] = TRUE;
          $_SESSION["User_ID"] = $userin['User_ID'];
          $_SESSION["Email"] = $userin["Email"];
          $_SESSION["First_name"]= $userin['First_Name'];
          $_SESSION["Second_name"]= $userin['Second_Name'];
         header("location:Clientview.php?login=success");
         exit();
      }
   }else{
      echo "<p>error</p>";
      //header("location:user_profile.php");
   }
   ?>