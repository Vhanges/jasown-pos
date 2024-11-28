<?php

require_once '../_init.php';

$productID = isset($_POST['product-id']) ? htmlspecialchars( $_POST['product-id']) : '';
$productName = isset($_POST['product-name']) ? htmlspecialchars( $_POST['product-name']) : '';
$productCategory = isset($_POST['product-category']) ? htmlspecialchars( $_POST['product-category']) : '';
$productStocks = isset($_POST['product-stock']) ? htmlspecialchars( $_POST['product-stock']) : '';
$productPrice = isset($_POST['product-price']) ? htmlspecialchars( $_POST['product-price']) : '';


switch(getAction('action')){

    case 'add': 
            Product::setItem($productName, $productCategory, productStocks: $productStocks, productPrice: $productPrice);
            header('Location: ../admin/admin_add_item.php');
        break;
    case 'update-stock': 
            Product::setStock($productID, productStocks: $productStocks);
            header('Location: ../admin/admin_inventory.php');
        break;
    case 'update-price': 
            Product::setPrice($productID, productPrice: $productPrice);
            header('Location: ../admin/admin_inventory.php');
        break;
    case 'delete-product': 
            Product::deleteProduct($productID);
            header('Location: ../admin/admin_inventory.php');
        break;
    default:
             header('Location: ../admin/admin_inventory.php');
        break;
 
}