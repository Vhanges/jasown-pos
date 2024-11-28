<?php

require_once '../_init.php';

$productName = isset($_POST['product-name']) ? htmlspecialchars( $_POST['product-name']) : '';
$productCategory = isset($_POST['product-category']) ? htmlspecialchars( $_POST['product-category']) : '';
$productStocks = isset($_POST['product-stocks']) ? htmlspecialchars( $_POST['product-stocks']) : '';
$productPrice = isset($_POST['product-price']) ? htmlspecialchars( $_POST['product-price']) : '';

switch(getAction('action')){

    case 'add': 
            Product::setItem($productName, $productCategory, productStocks: $productStocks, productPrice: $productPrice);
            header('Location: ../admin/admin_add_item.php');
        break;
    default:
             header('Location: ../admin/admin_add_item.php');
        break;
 
}