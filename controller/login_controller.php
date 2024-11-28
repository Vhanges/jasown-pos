<?php

require_once '../_init.php';

$email = isset($_POST['email']) ? htmlspecialchars( $_POST['email']) : '';
$password = isset($_POST['password']) ? htmlspecialchars( $_POST['password']) : '';

if(isset($_POST['email']) || isset($_POST['password'])){
    User::login($email, $password);
}