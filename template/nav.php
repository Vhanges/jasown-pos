<?php 

require_once '../_init.php';


echo "
<nav class='navbar d-flex justify-content-between align-items-between navbar-expand-lg bg-white navbar-light shadow-sm navbar-custom nav-height p-3'>
    <div class='container-fluid d-flex justify-content-between align-items-center'>
        <div class='d-flex justify-content-center align-items-center'>
            <img src='../assets/GC KRIZ BAKERY.png' width='70' height='70' class='d-inline-block' alt='Logo'>
            <h3 class='ms-3'>GCKRIZ BAKERY</h3>
        </div>
        <a href='../controller/user_controller.php?action=logout' class='nav-links-item d-flex align-items-center p-3 bg-secondary text-white rounded shadow-sm'>
            <i class='bi bi-box-arrow-right me-2'></i>
            <span class='fw-bold'>Logout</span>
        </a>
    </div>
</nav>
";





