<?php

require_once __DIR__.'/../_init.php';

Class User{



    public static function login($email, $password){

        global $connection ;

        //Remove the previous session 
        $_SESSION['user'] = "";

        //Fetch the specific row of the user based on email
        $sql_command = "SELECT * FROM users INNER JOIN roles on users.roleID = roles.roleID WHERE email = '$email'";
        $stmt = $connection->prepare($sql_command);
        $stmt->execute();

        $result = $stmt->get_result();

        // fetch_assoc, isang row lang kinukuha nya 
        $user = $result->fetch_assoc();

        if(!isset($user['email'])){
            header("Location: ../index.php");
        }
        
        if(isset($user)){

               
            
                    //Evaluates if the given password is correct
                if($password === $user['password']){
                    //Initialize Session 
                    self::setSession($user['roleDescription']);
                    //Redirect to their own page
                    self::getPage($user['roleDescription']);
                    
                }else{
                    header("Location: ../index.php");
                }

        }

        //free up resources
        $result->free();
        $stmt->close();
        

    }

    public static function logout(){
        unset($_SESSION['user']);
    }

    public static function redirect(){

        if(isset($_SESSION['user'])){

            if($_SESSION['user'] == ADMIN){
                header("Location: ../admin/admin_add_item.php");
            } 
            if($_SESSION['user'] == CASHIER){
                header("Location: ../cashier/cashier.php");
            }

        }else{
            header("Location: ../index.php");
        }

    }



    //To initialize the session of the logged in user
    public static function setSession($role){
        $_SESSION['user'] = $role;
    }



    //Para Ma-direct yung user sa specified pages para sa kanila
    public static function getPage($role){

        if($role === ADMIN){
            header("Location: ../admin/admin_add_item.php");
        }

        if($role === CASHIER){
            header("Location: ../cashier/cashier.php");
        }
        
    }

    public static function getAll(){
        
        global $connection;

        $sql_command = "SELECT * FROM users INNER JOIN roles on users.roleID = roles.roleID";
        $stmt = $connection->prepare($sql_command);
        $stmt->execute();

        $result = $stmt->get_result();

        $data = $result->fetch_all(MYSQLI_ASSOC);

        //free up resources
        $result->free();
        $stmt->close();

        return $data;

    }

    public static function getAllRoles(){
        
        global $connection;

        $sql_command = "SELECT * FROM roles";
        $stmt = $connection->prepare($sql_command);
        $stmt->execute();

        $result = $stmt->get_result();

        $data = $result->fetch_all(MYSQLI_ASSOC);

        //free up resources
        $result->free();
        $stmt->close();

        return $data;

    }


    public static function addAccount($roleID, $name, $email, $password){
        global $connection;

        $sql_command = "INSERT INTO users (roleID, name, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $connection->prepare($sql_command);
        $stmt->bind_param("isss", $roleID, $name, $email, $password);
        $stmt->execute();

        //free up resources
        $stmt->close();

    }
    public static function updateAccount($userID, $roleID, $name, $email, $password){
        global $connection;

        $sql_command = "UPDATE users SET roleID = ?, name = ?, email = ?, password = ? WHERE userID = ?";
        $stmt = $connection->prepare($sql_command);
        $stmt->bind_param("isssi", $roleID, $name, $email, $password, $userID);
        $stmt->execute();

        //free up resources
        $stmt->close();

    }

    public static function deleteAccount($userID){
        global $connection;

        $sql_command = "DELETE FROM users WHERE userID = '$userID'";
        $stmt = $connection->prepare($sql_command);

        $stmt->execute();

        //free up resources
        $stmt->close();

    }
}