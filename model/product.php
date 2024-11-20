<?php
require_once '../_init.php';

class Product{

    public function __construct(){
        global $connection;
    }

    public static function setItem($productName, $productCategory, $productQuantity, $productPrice){
       
        global $connection;

        $sql_command = "INSERT INTO products (productName, categoryID, quantity, price) VALUES (?, ?, ?, ?)";
        $stmt = $connection->prepare($sql_command);

        $stmt->bind_param(
            'ssid',
            $productName,
            $productCategory,
            $productQuantity,
            $productPrice
        );

        $stmt->execute();

        $stmt->close();
        $connection->close();

        header('Location: ../admin/admin_add_item.php');
        exit();

    }
   


}
