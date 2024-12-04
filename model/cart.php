<?php

class Cart{

    private static $total = 0;
    public static $receipt;

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

    public static function getTotal(){
        return self::$total;
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

    public static function setOrder($paymentMethod){

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
            $sql_command = "INSERT INTO orderDetails (orderID, productID, categoryID, quantity, paymentMethod) VALUES (?, ?, ?, ?, ?)";
            $stmt = $connection->prepare($sql_command);

            $items = self::getAllItems();

            
            //Iterates the binding of values based on the number of value in the Cart Session
            foreach($items as $item){

                $productID = $item['productID'];
                $productCategoryID = $item['productCategoryID'];    
                $productQuantity = $item['productQuantity'];    

                //i means int and s means string
                $stmt->bind_param("iiiis",$orderID, $productID, $productCategoryID, $productQuantity, $paymentMethod);
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


            // Generate receipt HTML
            $receiptHTML = '<div id="receipt" style="display: none; font-family: Arial, sans-serif; padding: 20px; border: 1px solid #ccc; width: 300px; margin: 0 auto;">';
            $receiptHTML .= '<h1 style="text-align: center; margin: 0; font-size: 1.5em;">GCKrizBakery</h1>';
            $receiptHTML .= '<p style="text-align: center; margin: 5px 0; font-size: 0.9em;">The Sweetest Corner in Town</p>';
            $receiptHTML .= '<hr style="margin: 10px 0;">';

            $receiptHTML .= '<p style="margin: 5px 0;"><strong>Order ID:</strong> ' . $orderID . '</p>';
            $receiptHTML .= '<p style="margin: 5px 0;"><strong>Date:</strong> ' . date('Y-m-d') . '</p>';

            $receiptHTML .= '<table style="width: 100%; border-collapse: collapse; margin-top: 10px;">';
            $receiptHTML .= '<thead>';
            $receiptHTML .= '<tr>';
            $receiptHTML .= '<th style="text-align: left; border-bottom: 1px solid #ccc; padding: 5px;">Item</th>';
            $receiptHTML .= '<th style="text-align: center; border-bottom: 1px solid #ccc; padding: 5px;">Qty</th>';
            $receiptHTML .= '<th style="text-align: right; border-bottom: 1px solid #ccc; padding: 5px;">Price</th>';
            $receiptHTML .= '</tr>';
            $receiptHTML .= '</thead>';
            $receiptHTML .= '<tbody>';

            foreach ($items as $item) {
                $itemTotal = $item['productPrice'] * $item['productQuantity'];
                $receiptHTML .= '<tr>';
                $receiptHTML .= '<td style="padding: 5px; font-size: 0.9em;">' . $item['productName'] . '</td>';
                $receiptHTML .= '<td style="text-align: center; padding: 5px; font-size: 0.9em;">' . $item['productQuantity'] . '</td>';
                $receiptHTML .= '<td style="text-align: right; padding: 5px; font-size: 0.9em;">₱' . number_format($itemTotal, 2) . '</td>';
                $receiptHTML .= '</tr>';
            }

            $receiptHTML .= '</tbody>';
            $receiptHTML .= '</table>';

            $receiptHTML .= '<hr style="margin: 10px 0;">';
            $receiptHTML .= '<p style="margin: 5px 0; font-size: 0.9em;"><strong>Total:</strong> ₱' . number_format($totalPayment, 2) . '</p>';
            $receiptHTML .= '<p style="margin: 5px 0; font-size: 0.9em;"><strong>Payment Method:</strong> ' . ucfirst($paymentMethod) . '</p>';
            $receiptHTML .= '<hr style="margin: 10px 0;">';

            $receiptHTML .= '<p style="text-align: center; font-size: 0.9em;">Thank you for your purchase!</p>';
            $receiptHTML .= '<p style="text-align: center; font-size: 0.8em; color: #555;">Visit us again soon!</p>';
            $receiptHTML .= '</div>';


            //Clear the Cart and texts

            self::clearAllItems();

            self::$receipt = $receiptHTML;




        }

    }
}