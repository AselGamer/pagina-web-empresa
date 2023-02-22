<?php
include_once 'bbdd.php';

$login = login($_POST['user'], $_POST['password']);

if($login) 
{
    header('Location: index.php');
    session_start();
    $_SESSION['user'] = $_POST['user'];
    $_SESSION['id_usuario'] = $login;
} else 
{
    header('Location: login.html');
}

?>