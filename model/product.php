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
        $connection->close();

        

    }

    public static function getAll(){
        
        global $connection;

        $sql_command = "
        SELECT
            products.productID,
            products.productName,
            categories.categoryName,
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
        $connection->close();

        return $data; 


    }
   


}
