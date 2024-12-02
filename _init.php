<?php

require_once '_config.php'; 
require_once '_helper.php'; 
require_once '_guards.php';

require_once(__DIR__ . '/model/cart.php');
require_once(__DIR__ . '/model/product.php');
require_once(__DIR__ . '/model/category.php');
require_once(__DIR__ . '/model/user.php');
require_once(__DIR__ . '/model/sales.php');



// MySQLi error reporting to throw exceptions
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


session_start();


    try{

        //Initialize database connection
        $connection = new mysqli
        (
            DB_HOST,
            DB_USERNAME,
            DB_PASSWORD,
            DB_DATABASE
        );

        //Returns the connection handle
        return $connection;

    } catch (Exception $e){

            /*
            Shows how the content is displayed in the browser, 
            to ensure that it only shown as plain text.
            */ 
            header('Content-type: text/plain');
            
            //Terminates the rest of the code
            die("
            Error: May problim sa imong database
            Reason: {$e->getMessage()} 
            Note:
                - Try to open config.php and check if the MySQL is configured correctly.
                - Make sure that the MySQL server is running.
            ");
        }
        



function login_css(){
    echo '
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    ';
};
function login_script(){
    echo '
    <script src="js/bootstrap.bundle.min.js"></script>
    ';
};


function admin_css(){
    echo '
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    ';
};
function cashier_css(){
    echo '
    <link rel="stylesheet" href="../css/cashier.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    ';
};

