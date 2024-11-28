<?php

require_once '../_init.php';

$password = isset($_POST['password']) ? htmlspecialchars( $_POST['password']) : '';
$email = isset($_POST['email']) ? htmlspecialchars( $_POST['email']) : '';

switch(getAction('action')){
    case 'login':
            User::login($email, $password);
        break; 
    case 'logout':
            User::logout();
            header('Location: ../index.php');
        break;
    case 'redirect':
            User::redirect();
            header('Location: ../index.php');
        break;
    default :
            header('Location: ../index.php');
        break;
}