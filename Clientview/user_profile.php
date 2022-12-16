<?php
include 'db.php';
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>EasyPC</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>
<section style="background-color: 080808;">
  <div class="container py-5">
    <div class="row">
      <div class="col">
        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="ClientView.php?login=success">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Profile</li>
          </ol>
        </nav>
      </div>
    </div>
<?php

if(isset($_GET['user_login'])){
    $get_user_info = $_GET['user_login'];
    $stmt = "select * from `user_profileview` where User_ID = $get_user_info";
    $results = mysqli_query($mysql, $stmt);
    while($user = mysqli_fetch_assoc($results)){
        $id = $user['User_ID'];
        $first_name = $user['First_Name'];
        $second_name = $user['Second_Name'];
        $email = $user['Email'];
        echo "
        <div class='row'>
      <div class='col-lg-4'>
        <div class='card mb-4'>
          <div class='card-body text-center'>
            <img src='profilePicture.jpg' alt='avatar'
              class='rounded-circle img-fluid' style='width: 150px;'>
            <h5 class='my-3'>$first_name $second_name</h5>
            <p class='text-muted mb-1'>$id</p>
            <p class='text-muted mb-4'>Shipping Address</p>
            <div class='d-flex justify-content-center mb-2'>
              <button type='button' class='btn btn-outline-primary ms-1'><a class='nav-item active' href='logout.php'>SIGN OUT</a></button>
            </div>
          </div>
        </div>
      </div>
      <div class='col-lg-8'>
        <div class='card mb-4'>
          <div class='card-body'>
            <div class='row'>
              <div class='col-sm-3'>
                <p class='mb-0'>First Name</p>
              </div>
              <div class='col-sm-9'>
                <p class='text-muted mb-0'>$first_name</p>
              </div>
            </div>
            <hr>
            <div class='row'>
              <div class='col-sm-3'>
                <p class='mb-0'>Second Name</p>
              </div>
              <div class='col-sm-9'>
                <p class='text-muted mb-0'>$second_name</p>
              </div>
            </div>
            <hr>
            <div class='row'>
              <div class='col-sm-3'>
                <p class='mb-0'>Email</p>
              </div>
              <div class='col-sm-9'>
                <p class='text-muted mb-0'>$email</p>
              </div>
            </div>
            <hr>
            <div class='row'>
              <div class='col-sm-3'>
                <p class='mb-0'>Phone</p>
              </div>
              <div class='col-sm-9'>
                <p class='text-muted mb-0'>(097) 234-5678</p>
              </div>
            </div>
            <hr>
            <div class='row'>
              <div class='col-sm-3'>
                <p class='mb-0'>Mobile</p>
              </div>
              <div class='col-sm-9'>
                <p class='text-muted mb-0'>(098) 765-4321</p>
              </div>
            </div>
            <hr>
            <div class='row'>
              <div class='col-sm-3'>
                <p class='mb-0'>Address</p>
              </div>
              <div class='col-sm-9'>
                <p class='text-muted mb-0'>Bay Area, San Francisco, CA</p>
              </div>
            </div>
          </div>
        </div>
        ";
    }
}
?>
</section>
</html>