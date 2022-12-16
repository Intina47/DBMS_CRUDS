<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <title> Update Shipping details </title>
  <!-- Bootstrap CSS v5.2-->
  <!-- Source: -->
  <!-- https://getbootstrap.com/docs/5.2/getting-started/download/ -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

  <!-- Bootstrap Icons -->
  <!-- Source: -->
  <!-- https://icons.getbootstrap.com/ -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <main>
    <div class="w-50 mx-auto">
      <h1>SHIPPING INFORMATION</h1>
      <form action="updateshipping.php" method="post" enctype="multipart/form-data">
        <div id="name-input" class="my-2">
          <label for="address" class="form-label">Address</label>
          <input type="text" name="address" id="address" placeholder="Shipping Address" class="form-control" required>
        </div>
        <div id="category-input" class="my-2">
          <label for="city" class="form-label">City</label>
          <input type="text" name="city" id="city" class="form-control" placeholder="Edinbrugh" />
        </div>
        <div id="image-input-div" class="my-2">
          <label for="postcode" class="form-label">Postcode</label>
          <input type="text" name="postcode" id="postcode" class="form-control" placeholder="DD1 6FF" required>
        </div>
        <div id="description-input" class="my-2">
          <label for="srequest" class="form-label">Special Request</label>
          <textarea name="srequest" id="srequest" rows="5" class="form-control" placeholder="leave it at the door"> </textarea>
        </div>
        <div id="submit" class="my-2 text-center">
          <button type="submit" class="btn btn-success" name='submit'>Continue</button>
        </div>
      </form>
    </div>

  </main>
</body>

</html>