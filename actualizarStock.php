<?php
include_once 'bbdd.php';
session_start();
if(!isset($_SESSION['user']))
{
    header('Location: login.html');
}


if($_POST['editar'] == 'Añadir'){
    if(!$_POST['nuevoStock'] == 0 ){
        $totalstock = $_POST['stockActual'] + $_POST['nuevoStock'];
        $nuevoStock = actualizarStock($_POST['idComponente'], $totalstock, $_SESSION['id_usuario']);
        VAR_DUMP(actualizarStock($_POST['idComponente'], $totalstock, $_SESSION['id_usuario']));
        //header('Location: index.php');  
        } else {
            echo "No se añade 1";
           // header('Location: editarStock.php?id_componente= '.$_POST['idComponente'].'&error=1');
        }
} else {
    $totalstock = $_POST['stockActual'] - $_POST['nuevoStock'];
    VAR_DUMP($totalstock);
    if($_POST['stockActual'] - $_POST['nuevoStock'] < 0 or $_POST['nuevoStock'] == 0 ){
        if($_POST['nuevoStock'] == 0){
       // header('Location: editarStock.php?id_componente= '.$_POST['idComponente'].'&error=1');
        echo "No se añade 2";
        } else {
        echo "No se añade 3";
       // header('Location: editarStock.php?id_componente= '.$_POST['idComponente'].'&error=2');    
        }
    } else {
        $nuevoStock = actualizarStock($_POST['idComponente'], $totalstock, $_SESSION['id_usuario']);
       // header('Location: index.php');  
    }
}








?>