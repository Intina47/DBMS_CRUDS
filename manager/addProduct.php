<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <title> Add Product </title>
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
      <h1>Add Product</h1>
      <form action="insertProduct.php" type="get" id="addProductForm">
        <div id="name-input" class="my-2">
          <label for="name" class="form-label">Product Name</label>
          <input type="text" name="name" id="name" placeholder="Name" class="form-control">
        </div>
        <div id="category-input" class="my-2">
          <label for="category" class="form-label">Category</label>
          <input type="text" name="category" id="category" class="form-control" placeholder="Category" />
        </div>
        <div id="image-input-div" class="my-2">
          <label for="image" class="form-label">Product Image Link</label>
          <input type="text" name="image" id="image" class="form-control" placeholder="Image Link">
        </div>
        <div id="description-input" class="my-2">
          <label for="description" class="form-label">Product Description</label>
          <textarea name="description" id="description" rows="5" class="form-control" placeholder="Description"> </textarea>
        </div>
        <div id="manufacturer-input" class="my-2">
          <label for="manufacturer" class="form-label">Manufacturer</label>
          <input type="text" name="manufacturer" id="manufacturer" class="form-control" placeholder="Manufacturer">
        </div>
        <div id="retail-price-input" class="my-2">
          <label for="retail-price" class="form-label">Retail Price</label>
          <input type="number" name="retail-price" id="retail-price" class="form-control" placeholder="Retail Price" step=0.01>
        </div>
        <div id="bulk_price-input" class="my-2">
          <label for="bulk-price" class="form-label">Bulk Price</label>
          <input type="number" name="bulk-price" id="bulk-price" class="form-control" placeholder="Bulk Price" step=0.01>
        </div>
        <div id="submit-input" class="my-2 text-center">
          <button type="submit" class="btn btn-success">Add Product</button>
        </div>
      </form>
    </div>

  </main>
</body>

</html>