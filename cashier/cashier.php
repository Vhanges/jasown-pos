<?php 

require_once __DIR__.'/../_init.php';

$Products = new Product();

$Cart = new Cart();


$CartItems = $Cart->getAllItems();





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier</title>
    <?php cashier_css()?>
</head>
<body>
    <?php require "../template/nav.php";?>

    <div class="container-fluid full-vh-vw bg-light">
        <div class="row h-100"> 

            <div class="col-7 d-flex flex-column align-items-center justify-content-start border border-secondary bg-white border-secondary-subtle p-3 m-4 ">
                <h4 class="position-relative bottom-80">Products</h4>
                <hr>

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
                                    <td><?= $product["productStocks"]?></td>
                                    <td><?= $product["productPrice"]?></td>
                                    <td>
                                        <form action="../controller/cart_controller.php?action=add-item" method="POST">
                                            <input type="hidden" name="productID" value="<?= $product["productID"]?>">
                                            <input type="hidden" name="productName" value="<?= $product["productName"]?>">
                                            <input type="hidden" name="productCategory" value="<?= $product["categoryName"]?>">
                                            <input type="hidden" name="productPrice" value="<?= $product["productPrice"]?>">
                                            <input type="hidden" name="productQuantity" value="1">
                                            <button type="submit" name="submit" class="btn btn-primary">ADD</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                </table>
            </div>


            <div class="col-4 d-flex flex-column align-items-center justify-content-start border border-secondary bg-white border-secondary-subtle p-3 mt-4 mb-4">
                <h4 class="position-relative">Products</h4>
                <hr>

                <div style="max-height: 70vh; max-width: 100vw; overflow: auto;">
                    <table class="table table-responsive order-secondary-subtle bg-transparent">
                    
                        <tbody>
                            <!-- <pre>
    
                                <?php //var_dump($CartItems); ?>
                            </pre> -->
                            <?php foreach($CartItems as $cart): ?>
                            <tr class="align-middle">
                                
                                <td><?=$cart['productName']?></td>
                                <td>

                                <div class="d-flex align-items-center"> 
                                    
                                     <form action="../controller/cart_controller.php?action=subtract-quantity" method="POST"> 
                                        <input type="hidden" name="productID" value="<?= $cart['productID'] ?>"> 
                                        <button type="submit" class="btn btn-outline-secondary btn-sm mx-1" style="font-size: 0.75rem; line-height: 1;"> <i class="bi bi-dash"></i> </button> 
                                    </form>
                                     
                                       <span class="mx-2"><?= $cart['productQuantity'] ?></span> 
                                       
                                        <form action="../controller/cart_controller.php?action=add-quantity" method="POST"> 
                                            <input type="hidden" name="productID" value="<?= $cart['productID'] ?>"> 
                                            <button type="submit" class="btn btn-outline-secondary btn-sm mx-1" style="font-size: 0.75rem; line-height: 1;"> <i class="bi bi-plus"></i>
                                         </button> 
                                    </form>
                                 </div>
                                </td>
                                <td><p class="mx-2">₱ <?=$cart['productPrice'] * $cart['productQuantity']?></p></td>
                                <td>
                                    <form action="../controller/cart_controller.php?action=delete-item" method="POST">
                                        <input type="hidden" name="productID" value="<?= $cart['productID']?>">
                                        <button type="submit" class="btn btn-danger btn-sm px-3 mx-4">
                                            <i class="bi bi-x"></i>
                                        </button>
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