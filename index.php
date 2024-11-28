<?php 

require_once '_guards.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gckriz Bakery</title>
    <?php login_css();?>
</head>
<body>

<section class="h-100vh gradient-form" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-6">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <img src="assets/GC KRIZ BAKERY.png"
                    style="width: 185px;" alt="logo">
                  <h4 class="mt-1 mb-5 pb-1">Gckriz Bakery</h4>
                </div>

                <form action="../controller/user_controller.php?action=login" method="POST">

                  <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example11">Email</label>
                    <input type="email" name="email" id="form2Example11" class="form-control" placeholder="Email" required/>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example22">Password</label>
                    <input type="password" name="password" id="form2Example22" class="form-control" required/>
                  </div>

                  <div class="text-center pt-1 pb-1">
                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary fa-lg w-100 " type="submit">
                      Login
                    </button>
                  </div>
                 

                </form>

              </div>
         
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>