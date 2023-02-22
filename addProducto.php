<?php
include_once 'bbdd.php';

//var_dump($_POST);


$ubicacionImgs = 'images/';

$ubicacionDeseada = 'images/' . basename($_FILES['imagen']['name']);

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

if(!is_numeric($_POST['precio'])) {
    header('Location: crearProducto.php?error=4');
}


$exec = addProducto($_POST['descripcion'], floatval($_POST['precio']), $_POST['nombre'], intval($_POST['id_usuario']), intval($_POST['tipo_componente']), $ubicacionDeseada);



if($exec) {
    header('Location: index.php');
} else {
    header('Location: crearProducto.php');
}

?>