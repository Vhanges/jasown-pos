<?php

class Cart{

    public static function setCartItem($productID, $productName, $productCategory, $productQuantity, $productPrice){
    
        if(isset($_SESSION['cart'])){

    
            $newItem = [
                'productID' => $productID,
                'productName' => $productName,
                'productCategory' => $productCategory,
                'productQuantity' => $productQuantity,
                'productPrice' => $productPrice
            ];
            //Checks if the sesssion array already contains the specfic product ID
            if(isset($_SESSION['cart'][$productID])){
                $_SESSION['cart'][$productID]['productQuantity'] += 1;
            }
            else{
            //Add new cart item in the session
            $_SESSION['cart'][$productID] = $newItem;
            }

                
        }



    }
    public static function setCartQuantity($productID, $productQuantity){
        
        //Sets new cart quantity in the session
        if(isset($_SESSION['cart'][$productID])){
            $_SESSION['cart'][$productID]['productQuantity'] = $productQuantity;
        }
    }

    public static function addCartQuantity($productID){
        
        //Sets new cart quantity in the session
        if(isset($_SESSION['cart'][$productID])){
            $_SESSION['cart'][$productID]['productQuantity'] += 1;
        }
        
    }

    
    public static function subCartQuantity($productID){
        
        //Sets new cart quantity in the session
        if(isset($_SESSION['cart'][$productID])){
            $_SESSION['cart'][$productID]['productQuantity'] -= 1;
        }
    }

    public static function unsetCartItem($productID){

        //Deletes new cart item in the session
        if(isset($_SESSION['cart'][$productID])){
            unset($_SESSION['cart'][$productID]);
        }

    }

    public static function getAllItems(){
        if(!isset($_SESSION['cart'])){
            return $_SESSION['cart'] = [];

        }
        else{
        return $_SESSION['cart'];
        }
    }

    public static function clearAllItems(){
        $_SESSION['cart'] = [];
    }
}