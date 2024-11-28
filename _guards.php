<?php

require_once '_init.php';

function AutorizedUser(){
    
    switch($_SESSION['user']){
        case ADMIN: 
            header("Location: ../admin/admin_admin_item.php");
            break;
        case CASHIER: 
            header("Location: ../cashier/cashier.php");
            break;
        default: 
            header("Location: ../access_denied.php");
            break;
    }
}
