<?php

Class Sales{

    public static function getSalesToday(){
        global $connection;

        $sql_command = "SELECT SUM(totalPayment) AS salesToday FROM orders WHERE DATE(orderDate) = CURDATE()";
        $stmt = $connection->prepare($sql_command);
        $stmt->execute();

        $result = $stmt->get_result();

        $sales = $result->fetch_assoc();

        return $sales['salesToday'];

    }
    public static function getTotalSales(){
        global $connection;

        $sql_command = "SELECT SUM(totalPayment) AS totalSales FROM orders";
        $stmt = $connection->prepare($sql_command);
        $stmt->execute();

        $result = $stmt->get_result();

        $sales = $result->fetch_assoc();
        
        return $sales['totalSales'];
    }
    public static function getTransactionList(){
        global $connection;

        $sql_command = "
        SELECT * FROM orderDetails 
        INNER JOIN orders on orderDetails.orderID = orders.orderID
        INNER JOIN products on orderDetails.productID = products.productID
        INNER JOIN categories on orderDetails.categoryID = categories.categoryID
        ORDER BY orders.orderDate DESC
        ";
        $stmt = $connection->prepare($sql_command);
        $stmt->execute();

        $result = $stmt->get_result();
        $sales = $result->fetch_all(MYSQLI_ASSOC);

        return $sales;
        



    }

    

}