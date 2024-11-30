<?php 

require "../_init.php";
      
Admin();

  

$Category = new Category();
$Products = new Product();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <!-- CSS Styling Links -->
    <?php admin_css()?>

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
        <h4>Add New category</h4>
        <hr>
        <form action="../controller/category_controller.php?action=<?=isset($_GET['category-id']) ? 'update-category' : 'add-category'?>&category-id=<?=isset($_GET['category-id']) ? $_GET['category-id'] : ''?>" method="POST" class="d-flex flex-column border p-2 border-secondary-subtle w-50">
 
              <div class="form-group mb-3">
                  <label for="category-name">Category Name</label>

                  <input 
                  type="hidden"
                  name="category-id"
                  value="<?=isset($_GET['category-id']) ? $_GET['category-id'] : ''?>">

                  <input 
                  type="text"
                  name="category-name"
                  class="form-control"  
                  id="category-name" 
                  value="<?=isset($_GET['category-name']) ? $_GET['category-name'] : ''?>"
                  required>
              </div>
                    <!-- <pre>
                    <?php
                     //var_dump($_GET["category-id"]);
                     //var_dump($_GET["category-name"]);
                    ?> 
                    </pre> -->

              <button type="submit" class="btn btnine-primary">Add category</button>
         
        </form>
        <!-- Third column -->
        <div class="col-5 d-flex flex-column align-items-center justify-content-start border border-secondary bg-white border-secondary-subtle p-3 m-4 ">
             
             <div class="d-flex justify-content-center align-items-center w-50 mb-2 border-bottom border-2 border-subtle" style="height: 70px">
                 <h4 class="mb-0 text-center">Category</h4>
             </div>
 
 
                 <table class="table table-responsive table-hover">
                     <thead class="table-dark align-middle ">
                         <tr>
                             <th scope="col">Category</th>
                             <th scope="col">Action</th>
                         </tr> 
                     </thead>
                         <tbody>
                             <?php foreach($Category->getAll() as $category) : ?>
               -outl                  <tr class="align-middle">
                                     <td><?= $category["categoryName"]?></td> 

                                     <td class="d-flex flex-row">

                                         <a href="?action=update-category&
                                         category-name=<?=$category["categoryName"]?>&
                                         category-id=<?=$category["categoryID"]?>" class="btn btn-primary">EDIT</a>

                                         <form action="../controller/category_controller.php?action=delete-category" method="POST" class="mx-2">
                                          <!-- <pre>
                                            <?php //var_dump($category["categoryName"])?>
                                          </pre> -->
                                             <input type="hidden" name="category-id" value="<?= $category["categoryID"]?>">
                                             <button type="submit" name="submit" class="btn btn-danger">DELETE</button>
                                         </form>
                                     </td>

                                 </tr>
                             <?php endforeach;?>
                         </tbody>
                 </table>
             </div>
      </div>
    </div>
    </div>

    
</body>
</html>