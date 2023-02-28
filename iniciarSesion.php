<?php
include_once 'bbdd.php';

$login = login($_POST['user'], $_POST['password']);

if($login) 
{
    session_start();
    $_SESSION['user'] = $_POST['user'];
    $_SESSION['id_usuario'] = $login;
    $_SESSION['id_proveedor'] = esProveedor($login);
    var_dump($login);
    header('Location: index.php');
} else 
{   
    header('Location: login.html');
}

?>