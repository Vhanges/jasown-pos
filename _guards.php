<?php

require_once '_init.php';

function Admin(){

    if (isset($_SESSION['user'])){
        
        if($_SESSION['user'] !== ADMIN)
        header("Location: ../access_denied.php"); 
    } else{
        header("Location: ../access_denied.php");
    }
    
}

function Cashier(){

    if (isset($_SESSION['user'])){
        
        if($_SESSION['user'] !== CASHIER)
        header("Location: ../access_denied.php"); 
    } else{
        header("Location: ../access_denied.php");
    }
    
}