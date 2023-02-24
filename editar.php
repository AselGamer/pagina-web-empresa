<?php
include 'bbdd.php';

if(isset($_POST['editar'])) {
    $resultado = editarComponentes($_POST['id'], $_POST['descripcion'], $_POST['precio'], $_POST['nombre'], $_POST['tipo_componente'], $_POST['imagen'] );
    header('location: index.php');
}


?>