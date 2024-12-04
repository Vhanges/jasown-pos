<?php 

require "../_init.php";

Admin();

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
        <div class="col-12 d-flex flex-column align-items-center justify-content-start border border-secondary bg-white border-secondary-subtle p-3 m-4 " style="max-height: 80vh; overflow: auto; ">
             
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
                             <?php foreach($Products->getAllInventory() as $product) : ?>
                                 <tr class="align-middle">
                                     <td><?= $product["productName"]?></td>

                                     <td><?= $product["categoryName"]?></td>

                                        <!-- Stocks -->
                                    <td style="font-size: small;">
                                        <div class="d-flex align-items-center"> 
                                            
                                      
                                        <!-- Customized Quantity -->
                                            <form action="../controller/product_controller.php?action=update-stock" method="POST" class="d-flex justify-content-center align-items-center p-0">
                                                <input type="hidden" name="product-id" class="form-control text-center p-1" value="<?= $product['productID'] ?>" style="font-size: small;">
                                                <input type="number" min="0" name="product-stock" class="form-control text-center p-1" value="<?= $product['productStocks'] ?>" style="font-size: small;">
                                                <button type="submit" class="btn invisible p-0 m-0" style="width: auto; height: auto;"></button>
                                            </form>
                                            
                                      
                                            
                                        </div>
                                    </td>

                                     <td>
                                     <form action="../controller/product_controller.php?action=update-price" method="POST" class="d-flex justify-content-center align-items-center p-0">
                                                <input type="hidden" name="product-id" class="form-control text-center p-1" value="<?= $product['productID'] ?>" style="font-size: small;">
                                                <input type="number" min="0" name="product-price" class="form-control text-center p-1" value="<?= $product["productPrice"]?>" style="font-size: small;">
                                                <button type="submit" class="btn invisible p-0 m-0" style="width: auto; height: auto;"></button>
                                            </form>
                                            
                                    </td>

                                     <td>
                                         <form action="../controller/product_controller.php?action=delete-product" method="POST">
                                             <input type="hidden" name="product-id" value="<?= $product["productID"]?>">
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