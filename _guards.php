<?php

require_once '_init.php';

function Admin(){

    if(!isset($_SESSION['user']) || $_SESSION['user'] !== ADMIN){
        header("Location: ../access_denied.php"); 
        exit();
    } 
}

function Cashier(){

    if(!isset($_SESSION['user']) || $_SESSION['user'] !== CASHIER){
        header("Location: ../access_denied.php"); 
        exit();
    } 
    
}