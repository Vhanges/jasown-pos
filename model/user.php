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
}