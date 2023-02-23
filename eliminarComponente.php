<?php
include 'bbdd.php';
if (isset($_POST['eliminarComponente'])) {
    if ($_POST['boton'] == 1) {
        $resultado =  eliminarComponente($_POST['id']);
    }
    header('location: index.php');
}

?>