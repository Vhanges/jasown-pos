<?php

require_once __DIR__.'/../_init.php';

class Product{


    public static function setItem($productName, $productCategory, $productStocks, $productPrice){
       
        global $connection;

        $sql_command = "
        INSERT INTO 
            products(productName, categoryID, productStocks, productPrice) 
        VALUES (?, ?, ?, ?)";
        $stmt = $connection->prepare($sql_command);

        $stmt->bind_param(
            'ssid',
            $productName,
            $productCategory,
            $productStocks,
            $productPrice
        );

        $stmt->execute();

        $stmt->close();
        

        

    }

    public static function getAllInventory(){
        
        global $connection;

        $sql_command = "
        SELECT
            products.productID,
            products.productName,
            categories.categoryName,
            products.categoryID,
            products.productStocks, 
            products.productPrice
        FROM products
        INNER JOIN
            categories
        ON
            products.categoryID = categories.categoryID";
            
        $stmt = $connection->prepare($sql_command);
        $stmt->execute();

        $result = $stmt->get_result();
        
        $data = $result->fetch_all(MYSQLI_ASSOC);

        //free up resources
        $result->free();
        $stmt->close();
        

        return $data; 

    }
    public static function getAllProducts(){
        
        global $connection;

        $sql_command = "
        SELECT
            products.productID,
            products.productName,
            categories.categoryName,
            products.categoryID,
            products.productStocks, 
            products.productPrice
        FROM products
        INNER JOIN
            categories
        ON
            products.categoryID = categories.categoryID WHERE products.productStocks > 1";
            
        $stmt = $connection->prepare($sql_command);
        $stmt->execute();

        $result = $stmt->get_result();
        
        $data = $result->fetch_all(MYSQLI_ASSOC);

        //free up resources
        $result->free();
        $stmt->close();
        

        return $data; 

    }
    

    public static function setStock($productID, $productStocks){

        global $connection;
        
        $sql_command = "UPDATE products SET productStocks = ? WHERE productID = '$productID'";
        $stmt = $connection->prepare($sql_command);
        $stmt->bind_param("i", $productStocks);
        $stmt->execute();

        //free up resources
        $stmt->close();
        
        
    }

    public static function setPrice($productID, $productPrice){
        global $connection;
        
        $sql_command = "UPDATE products SET productPrice = ? WHERE productID = '$productID'";
        $stmt = $connection->prepare($sql_command);
        $stmt->bind_param("d", $productPrice);
        $stmt->execute();

        //free up resources
        $stmt->close();
        
    }

    public static function deleteProduct($productID){

        global $connection;
        
        $sql_command = "DELETE FROM products WHERE productID = '$productID'";
        $stmt = $connection->prepare($sql_command);
        $stmt->execute();

        //free up resources
        $stmt->close();
        
    }

   


}
