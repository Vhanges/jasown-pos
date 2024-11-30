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

        //Mas maganda gamitin ang prepared statement compared to direct Query
        $stmt = $connection->prepare($sql_command);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);


        //free up resources
        $stmt->close();
        $result->free();
        

        
        
        return $data;
    }

    public static function addCategory($categoryName){
        global $connection;

        $sql_command = "INSERT INTO categories (categoryName) VALUES (?)";

        $stmt = $connection->prepare($sql_command);
        $stmt->bind_param("s", $categoryName);
        $stmt->execute();

        $stmt->close();
        

    }
    public static function updateCategory($categoryID, $categoryName){
        global $connection;

        $sql_command = "UPDATE categories SET categoryName = ? WHERE categoryID = ?";

        $stmt = $connection->prepare($sql_command);
        $stmt->bind_param("si", $categoryName, $categoryID);
        $stmt->execute();

        $stmt->close();
        

    }
    public static function deleteCategory($categoryID){
        global $connection;

        $sql_command = "DELETE FROM categories WHERE categoryID = '$categoryID'";

        $stmt = $connection->prepare($sql_command);
        $stmt->execute();

        $stmt->close();
        
    }

}