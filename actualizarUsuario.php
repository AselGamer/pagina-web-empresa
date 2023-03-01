<?php
include_once 'bbdd.php';


$update = updateUser($_POST['user'], $_POST['password'], $_SESSION['id_usuario']);
if($update = true) {
    $_SESSION['user'] = $_POST['user'];
    header('Location: index.php');

} else {
    header('Location: usuario.php');
}







?>