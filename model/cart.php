<?php

class Cart{

    private static $total = 0;

    public static function setCartItem($productID, $productName, $productCategory, $productCategoryID, $productQuantity, $productPrice){
        
        if(isset($_SESSION['cart'])){

    
            $newItem = [
                'productID' => $productID,
                'productName' => $productName,
                'productCategory' => $productCategory,
                'productCategoryID' => $productCategoryID,
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
        //Returns item when cart is filled
        if(isset($_SESSION['cart'])){
            return $_SESSION['cart'];

        }
        else{
            return $_SESSION['cart'] = [];
        }


    }

    public static function clearAllItems(){
        $_SESSION['cart'] = [];
        $_SESSION['payment'] = 0;
    }

    public static function getCartTotal(){
        //Calculates the total of the cart
        if(isset($_SESSION['cart'])){
            
            foreach($_SESSION['cart'] as $cart){
                self::$total += $cart['productPrice'] * $cart['productQuantity'];
            }

            return self::$total;
        }
    }

    public static function setPayment($payment){
        $_SESSION['payment'] = $payment;
    }
    

    public static function getPayment(){
        //Fetch payment from session
        if(isset($_SESSION['payment'])){
            return $_SESSION['payment'];
        }else{
            return 0;
        }
    }

    public static function getChange(){
        
        
        if(isset($_SESSION['payment'])){

            if($_SESSION['payment'] > self::$total ){

                $change = $_SESSION['payment'] - self::$total;

                return "₱". $change;

            }else if ($_SESSION['payment'] < self::$total){
                return "Insufficient Payment";
            }    

        }else{
            return 0;
        }

    }

    public static function setOrder(){

        if(isset($_SESSION['cart'])){

            //fetch the connection variable from init file
            global $connection;

            //Fetch the Cart Total
            $totalPayment = self::getCartTotal();

            //Insert order record to order table
            $sql_command = "INSERT INTO orders (orderDate, totalPayment) VALUES (NOW(), ?)";
            $stmt = $connection->prepare($sql_command);

            //d means double
            $stmt->bind_param("d", $totalPayment);
            $stmt->execute();


            //fetch the latest orderID inserted. Para magamit sa next query
            $orderID = $connection->insert_id;

            //insert the detailed record of the transaction
            $sql_command = "INSERT INTO orderDetails (orderID, productID, categoryID, quantity) VALUES (?, ?, ?, ?)";
            $stmt = $connection->prepare($sql_command);

            $items = self::getAllItems();

            
            //Iterates the binding of values based on the number of value in the Cart Session
            foreach($items as $item){

                $productID = $item['productID'];
                $productCategoryID = $item['productCategoryID'];    
                $productQuantity = $item['productQuantity'];    

                //i means int and s means string
                $stmt->bind_param("iiii",$orderID, $productID, $productCategoryID, $productQuantity);
                $stmt->execute();
            }

            
            $sql_command = "UPDATE products SET productStocks = productStocks - ? WHERE productID = ?";
            $stmt = $connection->prepare($sql_command);

            //Deducts the Stocks based on bought quantity 
            foreach($items as $item){
                $productID = $item['productID'];
                $productQuantity = $item['productQuantity'];

                $stmt->bind_param("ii", $productQuantity, $productID);
                $stmt->execute();
            }

            //freeeeee
            $stmt->close();
            

            //Clear the Cart and texts

            self::clearAllItems();


        }

    }
}