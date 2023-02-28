<?php
include_once 'bbdd.php';
session_start();
if(!isset($_SESSION['user']))
{
    header('Location: login.html');
}

$ubicacionImgs = 'images/';

$ubicacionDeseada = 'images/' . $_POST['id_usuario'] . $_POST['nombre'] . basename($_FILES['imagen']['name']);

$temp = 'images/temp.png';


if ($_FILES['imagen']['size'] > 1000000) {
    header('Location: crearProducto.php?error=1');
}

// DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
// Check MIME Type by yourself.
$finfo = new finfo(FILEINFO_MIME_TYPE);
if (false === $ext = array_search(
    $finfo->file($_FILES['imagen']['tmp_name']),
    array(
        'jpg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
    ),
    true
)) {
    header('Location: crearProducto.php?error=2');
}

if (!empty($_FILES['imagen']['name'])) {
    move_uploaded_file($_FILES['imagen']['tmp_name'], $ubicacionDeseada);
} else {
    header('Location: crearProducto.php?error=3');
}

if(isset($_POST['editar'])) {
    $resultado = editarComponentes($_POST['id'], $_POST['descripcion'], $_POST['precio'], $_POST['nombre'], $_POST['tipo_componente'], $ubicacionDeseada, $_SESSION['user']);
    header('location: index.php');
}


?>