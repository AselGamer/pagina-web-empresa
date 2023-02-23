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
            <form action="eliminarComponente.php" method="post">
                <label for="user" class="etiqueta">Estas seguro que quieres eliminar?</label>
                <label for="radio">Si</label>
                <input type="radio" name="boton" id="" value='1'>
                        
                <label for="radio">No</label>
                <input type="radio" name="boton" id="" value= '0'>

                <?php
                echo "<input name='id' value=".$_GET['id_componente']." type='hidden'>";
                ?>


                <input name="eliminarComponente" type="submit" value="Enviar">
            </form>

            </div>
        </div>
        <div id="footer">
            <p>© 2023 Informatikalmi</p>
        </div>
    </body>
</html>