<?php
include_once 'bbdd.php';

//var_dump($_POST);

//$ubicacionDeseada = 'images/' . $_POST['id_usuario'] . $_POST['nombre'] . basename($_FILES['imagen']['name']);


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



if(!is_numeric($_POST['precio'])) {
    header('Location: crearProducto.php?error=4');
}

$exec = addProducto($_POST['descripcion'], floatval($_POST['precio']), $_POST['stock'], $_POST['nombre'], intval($_POST['id_usuario']), intval($_POST['tipo_componente']), basename($_FILES['imagen']['name']));


$ubicacionDeseada = 'images/' . $exec . basename($_FILES['imagen']['name']);

var_dump($ubicacionDeseada);

if (!empty($_FILES['imagen']['name'])) {
    move_uploaded_file($_FILES['imagen']['tmp_name'], $ubicacionDeseada);
} else {
    header('Location: crearProducto.php?error=3');
}




if($exec > 0) {
    //header('Location: index.php');
} else {
    //header('Location: crearProducto.php');
}



?>