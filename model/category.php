<?php
require_once '../_init.php';

class Category{
    public $id;
    public $name; 

    public function __construct($category){
        $this->id = $category['id'];
        $this->name = $category['name'];
    }

    public static function getAll(){
  
        global $connection;

        $stmt = $connection->prepare('SELECT * FROM categories');
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return $data;
    }

}