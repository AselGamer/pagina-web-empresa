<?php
include_once 'bbdd.php';
session_start();
if(!isset($_SESSION['user']))
{
    header('Location: login.html');
}
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="css/compartido.css">
    <link rel="stylesheet" href="css/login.css">
    <head>
        <meta charset="UTF-8"/>
        <title>Informatikalmi | User </title>
    </head>
    <body>
    
        
        <div id="cabecera">
        <a href="index.php"><img src="images/logo.png" alt="logo" id="logo"/></a>
        </div>
        <div id="cuerpo">
            <div id="login">
            <form action="actualizarUsuario.php" method="post">
                        <label for="user" class="etiqueta">Nuevo nombre:</label>
                        <input type="text" id="nombreusuario" name="user" class="entradaTexto"/>
                        <label for="password" class="etiqueta">Nueva contraseña:</label>
                        <input type="password" id="contraseña" name="password" class="entradaTexto"/>
                        <div id="botonRegistro"><input type="submit" value="Cambiar" id="registrarse" class="entradaTexto"/></div>
            </form>
            </div>
        </div>
        <div class="producto" >
                    <form action="index.php" method="post" enctype="multipart/form-data">
                    <input type="button" onclick="history.back()" name="volver atrás" value="Volver atrás">
                    </form>
                </div>
        <div id="footer">
            <p>© 2023 Informatikalmi</p>
        </div>
    </body>
</html>