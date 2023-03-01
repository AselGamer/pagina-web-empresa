
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
        <title>Informatikalmi | Eliminar </title>
    </head>
    <body>
        <div id="cabecera">
        <a href="index.php"><img src="images/logo.png" alt="logo" id="logo"/></a>
        </div>
        <div id="cuerpo">
            <div id="login">
            <form action="eliminarComponente.php" method="post">
                <label for="user" class="etiqueta">¿Estas seguro que quieres eliminar?</label>
                <label for="radio">Si</label>
                <input type="radio" name="boton" id="" value='1'>
                        
                <label for="radio">No</label>
                <input type="radio" name="boton" id="" value= '0'>

                <?php
                echo "<input name='id' value=".$_GET['id_componente']." type='hidden'>";
                ?>

                <div id='botonRegistro'><input name="eliminarComponente" type="submit" value="Eliminar"></div>
            </form>

            </div>
        </div>
        <div id="footer">
            <p>© 2023 Informatikalmi</p>
        </div>
    </body>
</html>