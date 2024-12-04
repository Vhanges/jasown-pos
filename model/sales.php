<?php

Class Sales{

    public static function getSalesToday(){
        global $connection;

        $sql_command = "SELECT SUM(totalPayment) AS salesToday FROM orders WHERE DATE(orderDate) = CURDATE()";
        $stmt = $connection->prepare($sql_command);
        $stmt->execute();

        $result = $stmt->get_result();

        $sales = $result->fetch_assoc();
        
        //free up resources
        $result->free();
        $stmt->close();
        
        if(isset($sales['salesToday'])){
            return $sales['salesToday'];
        }else{
            return 0;
        }

    }

    public static function getGcash(){
        global $connection;

        $sql_command = "SELECT SUM(totalPayment) AS gcash FROM orders INNER JOIN orderdetails on orders.orderID = orderdetails.orderID WHERE paymentMethod = 'gcash'";
        $stmt = $connection->prepare($sql_command);
        $stmt->execute();

        $result = $stmt->get_result();

        $sales = $result->fetch_assoc();
        
        //free up resources
        $result->free();
        $stmt->close();

        if(isset($sales['gcash'])){
            return $sales['gcash'];
        }else{
            return 0;
        }
        

    }
    public static function getCash(){
        global $connection;

        $sql_command = "SELECT SUM(totalPayment) AS cash FROM orders INNER JOIN orderdetails on orders.orderID = orderdetails.orderID WHERE paymentMethod = 'cash'";
        $stmt = $connection->prepare($sql_command);
        $stmt->execute();

        $result = $stmt->get_result();

        $sales = $result->fetch_assoc();
        
        //free up resources
        $result->free();
        $stmt->close();
        
        if(isset($sales['cash'])){
            return $sales['cash'];
        }else{
            return 0;
        }


    }

    public static function getTotalSales(){
        global $connection;

        $sql_command = "SELECT SUM(totalPayment) AS totalSales FROM orders";
        $stmt = $connection->prepare($sql_command);
        $stmt->execute();

        $result = $stmt->get_result();

        $sales = $result->fetch_assoc();
        
        $data = $sales['totalSales'];
        //free up resources
        $result->free();
        $stmt->close();
        
        if(isset($data)){
            return $data;
        }else{
            return 0;
        }
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
        
        //free up resources
        $result->free();
        $stmt->close();
        
        return $sales;
        
    }

    

}