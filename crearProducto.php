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
        <title>Informatikalmi | Nuevo Producto</title>
    </head>
    <body>
        <div id="cabecera">
            <a href="index.php"><img src="images/logo.png" alt="logo" id="logo"/></a>
        </div>
        <div id="cuerpo">
            <div id="login">
            <form action="addProducto.php" method="post" enctype="multipart/form-data">
                        <label for="nombre" class="etiqueta">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" class="entradaTexto"/>
                        <label for="precio" class="etiqueta">Precio:</label>
                        <input type="text" id="precio" name="precio" class="entradaTexto"/>
                        <label for="precio" class="etiqueta">Stock:</label>
                        <input type="number" min="0" id="precio" inputmode="numeric" name="stock" class="entradaTexto"/>
                        <label for="descripcion" class="etiqueta">Descripcion:</label>
                        <textarea id="descripcion" name="descripcion" class="entradaTexto"></textarea>
                        <label for="imagen" class="etiqueta">Image:</label>
                        <input type="file" id="imagen" name="imagen" class="entradaTexto"/>
                        <label for="tipo_componente" class="etiqueta">Tipo de componente:</label>
                        <select name="tipo_componente" id="tipo_componente">
                        <?php
                            
                            $tipoComps = getTipoComp();
                            $size = sizeof($tipoComps);
                            for($i = 0; $i < $size; $i++) {
                                echo '<option value="'.$tipoComps[$i]['id_tipo_componente'].'">'.$tipoComps[$i]['nombre'].'</option>';
                            }
                            ?>
                        </select> 
                        <?php 
                        echo '<input type="hidden" id="id_usuario" name="id_usuario" value='.$_SESSION['id_usuario'].' class="entradaTexto"/>';
                        ?>
                        <div id="botonRegistro"><input type="submit" value="Añadir producto" id="registrarse" class="entradaTexto"/></div>
            </form>
            </div>
            <?php
            if($_GET['error'] == 1) {
                echo '<p>The image size is too large</p>';
            } elseif ($_GET['error'] == 2) {
                echo '<p>Invalid fiel type</p>';
            } elseif ($_GET['error'] == 3) {
                echo '<p>Image does not exist/no image uploaded</p>';
            } elseif ($_GET['error'] == 4) {
                echo '<p>The price is invalid</p>';
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