<?php 

require "../_init.php";

// Admin();

$Products = new Product();

$User = new User();
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
        <h4>Add New user</h4>
        <hr>
        <form action="../controller/user_controller.php?action=<?=isset($_GET['user-id']) ? 'update-user' : 'add-user'?>&user-id=<?=isset($_GET['user-id']) ? $_GET['user-id'] : ''?>" method="POST" class="d-flex flex-column border p-2 border-secondary-subtle w-50">
 
              <div class="form-group mb-3">
                  <label for="user-name">Account Name</label>

                  <input 
                  type="hidden"
                  name="user-id"
                  value="<?=isset($_GET['user-id']) ? $_GET['user-id'] : ''?>">

                  <input 
                  type="text"
                  name="user-name"
                  class="form-control"  
                  id="user-name" 
                  value="<?=isset($_GET['user-name']) ? $_GET['user-name'] : ''?>"
                  required>
              </div>

              <div class="form-group mb-3">
                <label for="product-user">Role</label>
                <select name="product-user" id="product-user" class="form-control" required>php
                    
                    <option value="">--Type of User--</option>
                   
                    <?php foreach($User->getAll() as $user) : ?>
                    <option value="<?= $user['userID']?>"><?= $user['roleDescription']?></option>
                    <?php endforeach; ?>

                </select>
              </div>

              <div class="form-group mb-3">
                  <label for="user-name">Email</label>

                  <input 
                  type="hidden"
                  name="user-id"
                  value="<?=isset($_GET['user-id']) ? $_GET['user-id'] : ''?>">

                  <input 
                  type="text"
                  name="user-name"
                  class="form-control"  
                  id="user-name" 
                  value="<?=isset($_GET['user-name']) ? $_GET['user-name'] : ''?>"
                  required>
              </div>

              <div class="form-group mb-3">
                  <label for="user-name">Password</label>

                  <input 
                  type="hidden"
                  name="user-id"
                  value="<?=isset($_GET['user-id']) ? $_GET['user-id'] : ''?>">

                  <input 
                  type="text"
                  name="user-name"
                  class="form-control"  
                  id="user-name" 
                  value="<?=isset($_GET['user-name']) ? $_GET['user-name'] : ''?>"
                  required>
              </div>


              <button type="submit" class="btn btn-outline-primary">Add user</button>
         
        </form>
        <!-- Third column -->
        <div class="col-10 d-flex flex-column align-items-center justify-content-start border border-secondary bg-white border-secondary-subtle p-3 m-4 ">
             
             <div class="d-flex justify-content-center align-items-center w-50 mb-2 border-bottom border-2 border-subtle" style="height: 70px">
                 <h4 class="mb-0 text-center">Accounts</h4>
             </div>
 
 
                 <table class="table table-responsive table-hover">
                     <thead class="table-dark align-middle ">
                         <tr>
                             <th scope="col">Role</th>
                             <th scope="col">Name</th>
                             <th scope="col">Email</th>
                             <th scope="col">Password</th>
                             <th scope="col">action</th>
                         </tr> 
                     </thead>
                         <tbody>
                             <?php foreach($User->getAll() as $user) : ?>
                                 <tr class="align-middle">
                                     <td><?= $user["roleDescription"]?></td> 
                                     <td><?= $user["name"]?></td> 
                                     <td><?= $user["email"]?></td> 
                                     <td><?= $user["password"]?></td> 

                                     <td class="d-flex flex-row">

                                                                                 <a href="?action=update-user&user-name=<?=$user["name"]?>&user-id=<?=$user["userID"]?>" class="btn btn-primary">EDIT</a>

                                         <form action="../controller/user_controller.php?action=delete-user" method="POST" class="mx-2">
                                          <!-- <pre>
                                            <?php //var_dump($user["name"])?>
                                          </pre> -->
                                             <input type="hidden" name="user-id" value="<?= $user["userID"]?>">
                                             <button type="submit" name="submit" class="btn btn-danger">DELETE</button>
                                         </form>
                                     </td>
                                         <a href="?action=update-user&user-name=<?=$user["name"]?>&user-id=<?=$user["userID"]?>" class="btn btn-primary">EDIT</a>

                                         <form action="../controller/user_controller.php?action=delete-user" method="POST" class="mx-2">
                                          <!-- <pre>
                                            <?php //var_dump($user["name"])?>
                                          </pre> -->
                                             <input type="hidden" name="user-id" value="<?= $user["userID"]?>">
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