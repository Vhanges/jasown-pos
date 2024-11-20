<?php 

require "../_init.php";

$category = Category::getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <!-- CSS Styling Links -->
    <?php main_links()?>

</head>
<body>
    <?php require "../template/nav.php";  ?>
    
    <div class="container-fluid full-vh-vw">
    <div class="row h-100">
      <div class="col-2 bg-light d-flex align-items-center justify-content-center">
        <!-- First column content -->
        <?php require "../template/side_nav.php"; ?>
      </div>
      <div class="col-10 d-flex flex-column align-items-center justify-content-center">
        <!-- Second column content -->
        <h4>Add New product</h4>
        <hr>
        <form action="../controller/product_controller.php?action=add" method="POST" class="d-flex flex-column border p-2 border-secondary-subtle w-50">
 
              <div class="form-group mb-3">
                  <label for="product-name">product Name</label>
                  <input 
                  type="text"
                  name="product-name" 
                  class="form-control" 
                  id="product-name" 
                  placeholder="Pandesal"
                  required>
              </div>

              <div class="form-group mb-3">
                <label for="product-category">Category</label>
                <select name="product-category" id="product-category" class="form-control" required>php
                    
                    <option value="">--Type of product--</option>
                   
                    <?php foreach($category as $categories) : ?>
                    <option value="<?= $categories['categoryID']?>"><?= $categories['categoryName']?></option>
                     <?php endforeach; ?>

                </select>
              </div>

              <div class="form-group mb-3">
                  <label for="product-quantity">Quantity</label>
                  <input 
                  type="number"
                  name="product-quantity" 
                  min="1"
                  max="99"
                  class="form-control" 
                  id="product-quantity"
                  required>
              </div>

              <div class="form-group mb-3">
                  <label for="product-price">Price</label>
                  <input 
                  type="number"
                  name="product-price" 
                  min="1"
                  max="99"
                  class="form-control" 
                  id="product-price"
                  required>
              </div>

              <button type="submit" class="btn btn-outline-primary">Add product</button>

        
              
        </form>
      </div>
    </div>
    </div>

    
</body>
</html>