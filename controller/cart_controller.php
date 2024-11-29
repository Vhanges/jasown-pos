<?php

require_once '../_init.php';

//Ternary Condition :>
$productID = isset($_POST['productID']) ? htmlspecialchars($_POST['productID']) : '';
$productName = isset($_POST['productName']) ? htmlspecialchars($_POST['productName']) : '';
$productCategory = isset($_POST['productCategory']) ? htmlspecialchars($_POST['productCategory']) : '';
$productCategoryID = isset($_POST['productCategoryID']) ? htmlspecialchars($_POST['productCategoryID']) : '';
$productPrice = isset($_POST['productPrice']) ? htmlspecialchars($_POST['productPrice']) : '';
$productQuantity = isset($_POST['productQuantity']) ? htmlspecialchars($_POST['productQuantity']) : '';

$payment = isset($_POST['payment']) ? htmlspecialchars($_POST['payment']) : '';

$Cart = new Cart();

switch(getAction('action')){
    case 'add-item':
            $Cart->setCartItem($productID, $productName, $productCategory, $productCategoryID, productQuantity: $productQuantity, productPrice: $productPrice);
            header("Location: ../cashier/cashier.php");
        break;
    case 'update-quantity':
            $Cart->setCartQuantity($productID, $productQuantity);
            header("Location: ../cashier/cashier.php");
        break;
    case 'add-quantity':
            $Cart->addCartQuantity($productID);
            header("Location: ../cashier/cashier.php");
        break;
    case 'subtract-quantity':
            $Cart->subCartQuantity($productID);
            header("Location: ../cashier/cashier.php");
        break;
    case 'delete-item':
            $Cart->unsetCartItem($productID);
            header("Location: ../cashier/cashier.php");
        break;
    case 'calculate-change':
            $Cart->setPayment($payment);
            header("Location: ../cashier/cashier.php");
        break;
    case 'process-order':
            $Cart->setOrder();
            header("Location: ../cashier/cashier.php");
        break;
    
    case 'display-items':
            $Cart->getAllItems();
            header("Location: ../cashier/cashier.php");
        break;
    case 'clear': 
            $Cart->clearAllItems();
            header("Location: ../cashier/cashier.php");
        break;
    default:
            header("Location: ../cashier/cashier.php");
        break;



}