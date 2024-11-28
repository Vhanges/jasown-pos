<?php 

require "../_init.php";

// Admin();

$Sales = new Sales();

 

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
            <!-- First Row -->
             <div class="col-12  d-flex flex-row align-items-center justify-content-center">
             <div class="row mb-3" style="height: 30vh; flex-direction: row;">
                <div class="col-md-12 mb-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Today's Sales</h5>
                            <p class="card-text"><?= $Sales->getSalesToday();?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Total Sales</h5>
                            <p class="card-text"><?= $Sales->getTotalSales();?></p>
                        </div>
                    </div>
                </div>
            </div>
             </div>
        
            <!-- Second Row -->
            <div class="row" style="height: 70vh; width: 70vw;">
            <div class="col-12 d-flex flex-column align-items-center justify-content-start border border-secondary bg-white border-secondary-subtle p-3 m-4 ">
             
             <div class="d-flex justify-content-center align-items-center w-100 mb-2 border-bottom border-2 border-subtle" style="height: 70px">
                 <h4 class="mb-0 text-center">Transactions</h4>
             </div>
 
 
                 <table class="table table-responsive table-hover">
                     <thead class="table-dark align-middle ">
                         <tr>
                             <th scope="col">ID</th>
                             <th scope="col">Product</th>
                             <th scope="col">Category</th>
                             <th scope="col">Quantity</th>
                             <th scope="col">Price</th>
                         </tr>
                     </thead>
                         <tbody>
                             <?php foreach($Sales->getTransactionList() as $sales) : ?>
                                 <tr class="align-middle">
                                     <td><?= $sales["orderID"]?></td>
                                     <td><?= $sales["productName"]?></td>
                                     <td><?= $sales["categoryName"]?></td>
                                     <td><?= $sales["productStocks"]?></td>
                                     <td><?= $sales["productPrice"]?></td>
                                 </tr>
                             <?php endforeach;?>
                         </tbody>
                 </table>
             </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>