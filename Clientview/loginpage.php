<html lang = "en">
<head>
<title>SIGN IN </title>
<meta charset="utf-8">
<!-- add css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>
<div class="container-fluid">
<div class="bg-dark h-100 justify-content-center align-items-center">
<body class="bg-image p-5 text-center shadow-1-strong rounded mb-5 text-white" 
       style="background-image: url('easypc.jpg'">
<h1>SIGN IN</h1>
<form action="authenticate_login.php" method="post">
<p><br><input type="text" name="username" id="username" placeholder = "email" required/><br></p>
<p><br><input type="password" name="password" id="password" placeholder = "password" required />
<i class="bi bi-eye-slash" id="togglePassword"></i><br></p>
 <p><br> <button class="fpass" type="button">Forgot Password?</button><br></p>
 <p><br><input type="checkbox" name="remember" checked>
   <label for="remember">Remember me</label><br></p>
   <p><br><button type="submit" name="Login_btn" value="Login">LOGIN</button></p>
   <p>Don't have an Account?<a href="">Sign Up</a></p>

      <script>
const togglePassword = document
        .querySelector('#togglePassword');
const password = document.querySelector('#password');

togglePassword.addEventListener('click', () => {

const type = password
.getAttribute('type') === 'password' ?
'text' : 'password';

password.setAttribute('type', type);

this.classList.toggle('bi-eye');
});
</script>
</body>
<?php
   if(isset($_GET["error"])){
       if(($_GET["error"] == "wrongdetails")){
              echo "<p class='text-danger'>Incorrect Login Details, Try Again</p>";
       }
   }
   ?>
</div>
</div>
</html>
