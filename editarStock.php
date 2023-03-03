<?php
include_once 'bbdd.php';

session_start();
if(!isset($_SESSION['user']))
{
    header('Location: login.html');
}
if(esProveedor($_SESSION['id_usuario']) != NULL) {
    $componentes = componenteProvedor($_GET['id_componente'], $_SESSION['id_usuario']);
    if($componentes['id_componente'] == false) {
        header('Location: index.php');
    }
} else {
    $componentes = getIdComponente($_GET['id_componente']);
}
?>


<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="css/compartido.css">
    <link rel="stylesheet" href="css/login.css">
    <head>
        <meta charset="UTF-8"/>
        <title>Informatikalmi | Edit </title>
    </head>
    <body>
        <div id="cabecera">
            <a href="index.php"><img src="images/logo.png" alt="logo" id="logo"/></a>
        </div>
        <div id="cuerpo">
            <div id="login">
            <form action="actualizarStock.php" method="post" enctype="multipart/form-data">
                        <label for="nombre" class="etiqueta">Stock actual:</label>
                        <?php
                        echo "<input type='text' id='nombre' name='stockActual' value='".$componentes['stock']."' class='entradaTexto' readonly/>";
                        ?>
                        <label for="nombre" class="etiqueta">Stock a editar:</label>
                        <?php
                        echo "<input type='number' id='nombre' name='nuevoStock' inputmode='numeric' min='0' value='0' class='entradaTexto'/>";
                        ?>
                        <?php
                        echo "<input name='idComponente' value=".$_GET['id_componente']." type='hidden'>";
                         ?>
                        <?php 
                        echo '<input type="hidden" id="id_usuario" name="id_usuario" value='.$componentes['id_usuario'].' class="entradaTexto"/>';
                        ?>
                        <?php
                        echo "<div id='botonRegistro'><input type='submit' id='añadir' name='editar' value='Añadir' class='entradaTexto'/></div>";
                        echo "<div id='botonRegistro'><input type='submit' id='borrar' name='editar' value='Quitar' class='entradaTexto'/></div>";
                        ?>
                        
                        
                        
                        
                    </form>
                </div>
                <?php
                        if($_GET['error'] == 1) {
                            echo '<div><p>El numero debe ser mayor a 0</p></div>';
                        } elseif ($_GET['error'] == 2) {
                            echo '<div><p>El stock no puede ser inferior a 0</div>';
                        } 
                        ?>
            </div>
            <div class="producto" >
                    <form action="index.php" method="post" enctype="multipart/form-data">
                    <input type="button" class="volver" onclick="history.back()" name="volver atrás" value="Volver atrás">
                    </form>
                </div>
        <div id="footer">
            <p>© 2023 Informatikalmi</p>
        </div>
    </body>
</html>