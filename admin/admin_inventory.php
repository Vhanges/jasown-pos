<?php 

require "../_init.php";

// Admin();

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
        <div class="col-12 d-flex flex-column align-items-center justify-content-start border border-secondary bg-white border-secondary-subtle p-3 m-4 ">
             
             <div class="d-flex justify-content-center align-items-center w-100 mb-2 border-bottom border-2 border-subtle" style="height: 70px">
                 <h4 class="mb-0 text-center">Inventory</h4>
             </div>
 
 
                 <table class="table table-responsive table-hover">
                     <thead class="table-dark align-middle ">
                         <tr>
                             <th scope="col">Product</th>
                             <th scope="col">Category</th>
                             <th scope="col">Stocks</th>
                             <th scope="col">Price</th>
                             <th scope="col">Action</th>
                         </tr>
                     </thead>
                         <tbody>
                             <?php foreach($Products->getAll() as $product) : ?>
                                 <tr class="align-middle">
                                     <td><?= $product["productName"]?></td>

                                     <td><?= $product["categoryName"]?></td>
                                     
                                        <!-- Stocks -->
                                    <td style="font-size: small;">
                                        <div class="d-flex align-items-center"> 
                                            
                                        <!-- Reduce -->
                                            <form action="../controller/product_controller.php?action=subtract-quantity" method="POST"> 
                                                <input type="hidden" name="productID" value="<?= $cart['productID'] ?>"> 
                                                <button type="submit" class="btn btn-outline-secondary btn-sm mx-1" style="font-size: 0.75rem; line-height: 1;"> <i class="bi bi-dash"></i> </button> 
                                            </form> 
                                        
                                        <!-- Customized Quantity -->
                                            <form action="../controller/product_controller.php?action=update-quantity" method="POST" class="d-flex justify-content-center align-items-center p-0">
                                                <input type="hidden" name="productID" class="form-control text-center p-1" value="<?= $cart['productID'] ?>" style="font-size: small;">
                                                <input type="text" name="productQuantity" class="form-control text-center p-1" value="<?= $cart['productQuantity'] ?>" style="font-size: small;">
                                                <button type="submit" class="btn invisible p-0 m-0" style="width: auto; height: auto;"></button>
                                            </form>
                                            
                                        <!-- Add -->
                                            <form action="../controller/product_controller.php?action=add-quantity" method="POST"> 
                                                    <input type="hidden" name="productID" value="<?= $cart['productID']?>"> 
                                                    <button type="submit" class="btn btn-outline-secondary btn-sm mx-1" style="font-size: 0.75rem; line-height: 1;"> <i class="bi bi-plus"></i>
                                                </button> 
                                            </form>
                                            
                                        </div>
                                    </td>

                                     <td>
                                     <form action="../controller/product_controller.php?action=update-quantity" method="POST" class="d-flex justify-content-center align-items-center p-0">
                                                <input type="hidden" name="productID" class="form-control text-center p-1" value="<?= $product['productID'] ?>" style="font-size: small;">
                                                <input type="text" name="productQuantity" class="form-control text-center p-1" value="<?= $product["productPrice"]?>" style="font-size: small;">
                                                <button type="submit" class="btn invisible p-0 m-0" style="width: auto; height: auto;"></button>
                                            </form>
                                            
                                    </td>

                                     <td>
                                         <form action="../controller/product_controller.php?action=add-item" method="POST">
                                             <input type="hidden" name="productID" value="<?= $product["productID"]?>">
                                             <input type="hidden" name="productName" value="<?= $product["productName"]?>">
                                             <input type="hidden" name="productCategory" value="<?= $product["categoryName"]?>">
                                             <input type="hidden" name="productCategoryID" value="<?= $product["categoryID"]?>">
                                             <input type="hidden" name="productPrice" value="<?= $product["productPrice"]?>">
                                             
                                             
                                             <input type="hidden" name="productQuantity" value="1">
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