<?php 

require "../utilities/_init.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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
      <div class="col-10 bg-secondary d-flex align-items-center justify-content-center">
        <!-- Second column content -->
        <p>Column 2 (80%)</p>
      </div>
    </div>
    </div>

    
</body>
</html>