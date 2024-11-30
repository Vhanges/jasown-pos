<?php

require_once '../_init.php';

$password = isset($_POST['password']) ? htmlspecialchars( $_POST['password']) : '';
$email = isset($_POST['email']) ? htmlspecialchars( $_POST['email']) : '';

$userID = isset($_POST['user-id']) ? htmlspecialchars($_POST['user-id']) : '';
$userName = isset($_POST['user-name']) ? htmlspecialchars($_POST['user-name']) : '';
$userRole = isset($_POST['user-role']) ? htmlspecialchars($_POST['user-role']) : '';
$userEmail = isset($_POST['user-email']) ? htmlspecialchars($_POST['user-email']) : '';
$userPassword = isset($_POST['user-password']) ? htmlspecialchars($_POST['user-password']) : '';


// var_dump($userID);
// var_dump($userName);
// var_dump($userRole);
// var_dump($userEmail);
// var_dump($userPassword);
switch(getAction('action')){
    case 'login':
            User::login($email, $password);
        break; 
    case 'logout':
            User::logout();
            header('Location: ../index.php');
        break;
    case 'add-user':
            User::addAccount($userRole, $userName, $userEmail, $userPassword);
            header('Location: ../admin/admin_accounts.php');
        break;
    case 'update-user':
            User::updateAccount($userID, $userRole, $userName, $userEmail, $userPassword);
            header('Location: ../admin/admin_accounts.php');
        break;
    case 'delete-user':
            User::deleteAccount($userID);
            header('Location: ../admin/admin_accounts.php');
        break;
    case 'redirect':
            User::redirect();
        break;
    default :
            header('Location: ../admin/admin_accounts.php');
        break;
}