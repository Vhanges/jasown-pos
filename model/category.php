<?php
require_once __DIR__.'/../_init.php';
    

class Category{
    public $id;
    public $name; 

    public function __construct(){

    }

    public static function getAll(){
  
        global $connection;

        $sql_command = "SELECT * FROM categories";

        $stmt = $connection->prepare($sql_command);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);


        //free up resources
        $stmt->close();
        $result->free();
        $connection->close();

        
        
        return $data;
    }

}