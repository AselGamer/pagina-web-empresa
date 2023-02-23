<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="css/compartido.css">
    <link rel="stylesheet" href="css/login.css">
    <head>
        <meta charset="UTF-8"/>
        <title>Test</title>
    </head>
    <body>
        <div id="cabecera">
            <img src="images/logo.png" alt="logo" id="logo"/>
        </div>
        <div id="cuerpo">
            <div id="login">
            <form action="updateUser.php" method="post">
                        <label for="user" class="etiqueta">New Username:</label>
                        <input type="text" id="nombreusuario" name="user" class="entradaTexto"/>
                        <label for="password" class="etiqueta">New Password:</label>
                        <input type="password" id="contraseña" name="password" class="entradaTexto"/>
                        <div id="botonRegistro"><input type="submit" value="Change" id="registrarse" class="entradaTexto"/></div>
            </form>
            </div>
        </div>
        <div id="footer">
            <p>© 2023 Informatikalmi</p>
        </div>
    </body>
</html>