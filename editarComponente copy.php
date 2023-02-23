<?php
include_once 'bbdd.php';
session_start();
if(!isset($_SESSION['user']))
{
    header('Location: login.html');
}

$componentes = getIdComponentes($_GET['id_componente']);
?>


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
            <form action="editar.php" method="post" enctype="multipart/form-data">
                        <label for="nombre" class="etiqueta">Name:</label>
                        <?php
                        echo "<input type='text' id='nombre' name='nombre' value='".$componentes['nombre']."' class='entradaTexto'/>";
                        
                        ?>
                        
                       
                        <label for="precio" class="etiqueta">Price:</label>
                        <?php
                        echo "<input type='text' id='precio' name='precio' value='".$componentes['precio']."' class='entradaTexto'/>";
                        
                        ?>
                        <label for="descripcion" class="etiqueta">Description:</label>
                        <?php
                        echo "<textarea id='descripcion' name='descripcion' class='entradaTexto'>".$componentes['descripcion']."</textarea>";
                        
                        ?>
                        <label for="imagen" class="etiqueta">Image:</label>
                        <?php
                        echo "<input type='file' id='imagen' name='imagen' value='".$componentes['image']."' class='entradaTexto'/>";
                        
                        ?>
                        <label for="tipo_componente" class="etiqueta">Component type:</label>
                        <select name="tipo_componente" id="tipo_componente">
                            <?php
                            $tipoComps = getTipoComp();
                            $size = sizeof($tipoComps);
                            for($i = 0; $i < $size; $i++) {
                                if($tipoComps == $componentes['id_componente']) {
                                    
                                }
                                echo '<option value='.$tipoComps[$i]['idTipoComponente'].'>'.$tipoComps[$i]['nombre'].'</option>';
                            }
                            ?>
                        </select> 
                        <?php 
                        echo '<input type="hidden" id="id_usuario" name="id_usuario" value='.$_SESSION['id_usuario'].' class="entradaTexto"/>';
                        ?>
                         <div id="botonRegistro"><input type="submit" value="Edit" id="editar" class="entradaTexto"/></div>
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
        <div id="footer">
            <p>© 2023 Informatikalmi</p>
        </div>
    </body>
</html>