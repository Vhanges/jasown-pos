<?php

require_once '../_init.php';


if( getAction('action') == 'add'){

    $productName = htmlspecialchars( $_POST['product-name']);
    $productCategory = htmlspecialchars( $_POST['product-category']);
    $productQuantity = htmlspecialchars( $_POST['product-quantity']);
    $productPrice = htmlspecialchars( $_POST['product-price']);
    
    try{
        Product::setItem($productName, $productCategory, productQuantity: $productQuantity, productPrice: $productPrice);
        header('Location: ../model/product.php');
    } catch (Exception $e){
        
    }

}

