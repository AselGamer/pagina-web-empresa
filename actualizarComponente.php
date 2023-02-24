<?php
include_once 'bbdd.php';
session_start();
if(!isset($_SESSION['user']))
{
    header('Location: login.html');
}


$update = updateUser($_POST['user'], $_POST['password'], $_SESSION['id_usuario']);








?>