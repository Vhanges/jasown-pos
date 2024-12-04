<?php 

require_once __DIR__.'/../_init.php';

Cashier();


//Instantiate the Classes to be used

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

            <!-- Product Table Container -->

            <div class="col-7 d-flex flex-column align-items-center justify-content-start border border-secondary bg-white border-secondary-subtle p-3 m-4 "> 
                <div class="d-flex justify-content-center align-items-center w-100 mb-2 border-bottom border-2 border-subtle" style="height: 70px">
                    <h4 class="mb-0 text-center">Products</h4>
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

                            <!-- 
                            Displays list of product to the table via iterating  using loop.
                            The data is fetched via the function getAll 
                            -->

                            <?php foreach($Products->getAllProducts() as $product) : ?>
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
                                            <input type="hidden" name="productCategoryID" value="<?= $product["categoryID"]?>">
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


            <!-- Cart Container -->
            <div class="col-4 d-flex flex-column align-items-center justify-content-start border border-secondary bg-white border-secondary-subtle px-1 py-3 mt-4 mb-4">
               
                <div class="d-flex justify-content-center align-content-center w-100 mb-2 border-bottom border-2 border-subtle">                    
                    <form action="../controller/cart_controller.php?action=clear" method="POST" class="col-12 d-flex justify-content-end align-items-center p-0">
                        <h4 class="mb-0" style="margin-right: 30%;">Cart</h4>
                        <button type="submit" class="btn btn-outline-primary m-3 align-self-end" style="width: auto; height: auto;">
                            Clear
                        </button>
                    </form>
                </div>

                

                <!-- Table Container -->
                <div style="height: 90vh; max-height: 90vh; max-width: 50vw; overflow: auto;">
                    <table class="table table-responsive order-secondary-subtle bg-transparent">
                    
                        <tbody>
                            
                            <!-- <pre>
                                <?php // var_dump($CartItems); ?>
                            </pre> -->

                                <!-- Display all the data in the session -->
                                <?php foreach($CartItems as $cart): ?>

                                <tr class="align-middle">
                                    
                                    <!-- Product Name -->
                                    <td style="font-size: small;">
                                        <span class="mx-2">
                                            <?=$cart['productName']?> (<?=$cart['productCategory']?>)
                                        </span>
                                    </td>
                                    
                                    
                                    <!-- Quantity -->
                                    <td style="font-size: small;">
                                        <div class="d-flex align-items-center"> 
                                            
                                        <!-- Reduce -->
                                            <form action="../controller/cart_controller.php?action=subtract-quantity" method="POST"> 
                                                <input type="hidden" name="productID" value="<?= $cart['productID'] ?>"> 
                                                <button type="submit" class="btn btn-outline-secondary btn-sm mx-1" style="font-size: 0.75rem; line-height: 1;"> <i class="bi bi-dash"></i> </button> 
                                            </form> 
                                        
                                        <!-- Customized Quantity -->
                                            <form action="../controller/cart_controller.php?action=update-quantity" method="POST" class="d-flex justify-content-center align-items-center p-0">
                                                <input type="hidden" name="productID" class="form-control text-center p-1" value="<?= $cart['productID'] ?>" style="font-size: small;">
                                                <input type="text" name="productQuantity" class="form-control text-center p-1" value="<?= $cart['productQuantity'] ?>" style="font-size: small;">
                                                <button type="submit" class="btn invisible p-0 m-0" style="width: auto; height: auto;"></button>
                                            </form>
                                            
                                        <!-- Add -->
                                            <form action="../controller/cart_controller.php?action=add-quantity" method="POST"> 
                                                    <input type="hidden" name="productID" value="<?= $cart['productID']?>"> 
                                                    <button type="submit" class="btn btn-outline-secondary btn-sm mx-1" style="font-size: 0.75rem; line-height: 1;"> <i class="bi bi-plus"></i>
                                                </button> 
                                            </form>
                                            
                                        </div>
                                    </td>

                                    <!-- Price -->
                                    <td style="font-size: small;">
                                        <span class="mx-3">
                                            ₱<?= $CartTotal = $cart['productPrice'] * $cart['productQuantity']?>
                                        </span>
                                    </td>
                                    
                                    <!-- Delete Action -->
                                    <td>
                                        <form action="../controller/cart_controller.php?action=delete-item" method="POST">
                                            <input type="hidden" name="productID" value="<?= $cart['productID']?>">
                                            <button type="submit" class="btn btn-danger btn-sm px-3 mx-4">
                                                <i class="bi bi-x"></i>
                                            </button>
                                        </form>
                                    </td>

                                </tr>

                                <?php endforeach;?>`
    
                        </tbody>
    
                    </table>

                </div> 
                

                <div class="wrapper col-12 mt-4">
                        
                    <!-- Total of Cart-->
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between align-content-center">
                            <h6 class="mx-3">Total: </h6>
                            <h6 class="mx-3">₱<?=$Cart->getCartTotal()?></h6>
                        </div>
                    </div>

                    
                    <!-- Displays Customers Change-->
                    <div class="row mt-2">
                        <div class="col-12 d-flex justify-content-between align-content-center">
                            <h6 class="mx-3">Change: </h6>
                            <h6 class="mx-3"><?=$Cart->getChange()?></h6>
                        </div>
                    </div>

                    <!-- Calculates Change -->
                    <div class="row mt-2">
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <form action="../controller/cart_controller.php?action=calculate-change" method="POST" class="col-12 d-flex align-items-center">
                                <input type="number" name="payment" class="form-control mx-2" min="1">
                                <button type="submit" class="btn btn-outline-primary" style="width: auto; height: auto;">
                                    Calculate
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Process Order-->
                    <div class="row mt-2">
                     <form action="../controller/cart_controller.php?action=process-order" method="POST" class="d-flex align-items-center">
                        <div class="col-12 d-flex justify-content-center align-content-between">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Checkout
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Order Confirmation</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">


                                         <!-- Total of Cart-->
                                        <div class="row mt-2">
                                            <div class="col-12 d-flex justify-content-between align-content-center">
                                                <h6 class="mx-3">Total: </h6>
                                                <h6 class="mx-3">₱<?=$Cart->getTotal()?></h6>
                                            </div>
                                        </div>

                                        <!-- Displays Customer Payment Method-->

                                        <div class="row mt-2">
                                            <div class="col-12 d-flex justify-content-between align-content-center">
                                                <h6 class="mx-3">Payment Method:</h6>
                                                <div class="btn-group" role="group" aria-label="Payment Method">
                                                    <input type="radio" class="btn-check" name="paymentMethod" id="cash" value="cash" autocomplete="off" required>
                                                    <label class="btn btn-outline-primary" for="cash">Cash</label>

                                                    <input type="radio" class="btn-check" name="paymentMethod" id="gcash" value="gcash" autocomplete="off" required>
                                                    <label class="btn btn-outline-primary" for="gcash">Gcash</label>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Displays Customer Payment-->

                                        <div class="row mt-2">
                                            <div class="col-12 d-flex justify-content-between align-content-center">
                                                <h6 class="mx-3">Payment: </h6>

                                                <!-- <pre>
                                                    <?php // var_dump($Cart->getPayment())?>
                                                </pre>   -->

                                                <h6 class="mx-3">₱<?=$Cart->getPayment()?></h6>
                                            </div>
                                        </div>

                                        <!-- Displays Customers Change-->
                                        <div class="row mt-2">
                                            <div class="col-12 d-flex justify-content-between align-content-center">
                                                <h6 class="mx-3">Change: </h6>
                                                <h6 class="mx-3"><?=$Cart->getChange()?></h6>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success ">PROCESS ORDER</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>




                    </div>




                </div>

            </div>

        </div>
    </div>
    
</body>

</html>