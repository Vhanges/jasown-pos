<?php

require_once '../_init.php';

//Ternary Condition :>
$productID = isset($_POST['productID']) ? htmlspecialchars($_POST['productID']) : '';
$productName = isset($_POST['productName']) ? htmlspecialchars($_POST['productName']) : '';
$productCategory = isset($_POST['productCategory']) ? htmlspecialchars($_POST['productCategory']) : '';
$productCategoryID = isset($_POST['productCategoryID']) ? htmlspecialchars($_POST['productCategoryID']) : '';
$productPrice = isset($_POST['productPrice']) ? htmlspecialchars($_POST['productPrice']) : '';
$productQuantity = isset($_POST['productQuantity']) ? htmlspecialchars($_POST['productQuantity']) : '';
$paymentMethod = isset($_POST['paymentMethod']) ? htmlspecialchars($_POST['paymentMethod']) : '';

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
            $Cart->setOrder($paymentMethod);
            if (isset(Cart::$receipt)) {
                // Dynamically embed the receipt in the current page
                echo Cart::$receipt; // Assuming Cart::$receipt contains the pre-generated receipt HTML
        
                // Add a script to handle printing
                echo '<script>
                    function printReceipt() {
                        const receipt = document.getElementById("receipt");
                        receipt.style.display = "block";
                        window.print(); 
                        }
                        printReceipt(); 

                        window.onafterprint = function() {
                            window.location.href = "../cashier/cashier.php";
                        };
                    </script>';
            }
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