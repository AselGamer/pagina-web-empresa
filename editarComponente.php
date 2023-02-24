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
                        <label for="nombre" class="etiqueta">Nombre:</label>
                        <?php
                        echo "<input type='text' id='nombre' name='nombre' value='".$componentes['nombre']."' class='entradaTexto'/>";
                        
                        ?>
                        
                       
                        <label for="precio" class="etiqueta">Precio:</label>
                        <?php
                        echo "<input type='text' id='precio' name='precio' value='".$componentes['precio']."' class='entradaTexto'/>";
                        
                        ?>
                        <label for="descripcion" class="etiqueta">Descripcion:</label>
                        <?php
                        echo "<textarea id='descripcion' name='descripcion' class='entradaTexto'>".$componentes['descripcion']."</textarea>";
                        
                        
                        ?>
                        <label for="imagen" class="etiqueta">Imagen:</label>
                        <?php
                        echo "<input type='file' id='imagen' name='imagen' value='".$componentes['image']."' class='entradaTexto'/>";
                        
                        ?>
                        <label for="tipo_componente" class="etiqueta">Tipo Componente:</label>
                        <select name="tipo_componente" id="tipo_componente">
                            <?php
                            
                            $tipoComps = getTipoComp();
                            $size = sizeof($tipoComps);
                            for($i = 0; $i < $size; $i++) {
                                if($componentes['id_componente_tipo'] == $tipoComps[$i]['idTipoComponente']) {
                                    
                                    echo '<option value="'.$tipoComps[$i]['idTipoComponente'].'" selected>'.$tipoComps[$i]['nombre'].'</option>';
                                    
                                } else {
                                    echo '<option value='.$tipoComps[$i]['idTipoComponente'].'>'.$tipoComps[$i]['nombre'].'</option>';
                                }
                            }
                            ?>
                        </select> 

                        <?php
                        echo "<input name='id' value=".$_GET['id_componente']." type='hidden'>";
                         ?>
                        <?php 
                        echo '<input type="hidden" id="id_usuario" name="id_usuario" value='.$_SESSION['id_usuario'].' class="entradaTexto"/>';
                        ?>
                      
                      
                      <?php
                        echo "<input type='submit' id='editar' name='editar' value='Editar' class='entradaTexto'/>";
                        
                        ?>
            
                        
                        
                        
                        
            </form>
            </div>
            <?php
            if($_GET['error'] == 1) {
                echo '<p>imagen muy grande</p>';
            } elseif ($_GET['error'] == 2) {
                echo '<p>Tipo de imagen invalido</p>';
            } elseif ($_GET['error'] == 3) {
                echo '<p>La imagen no existe/no se ha subido una imagen</p>';
            } elseif ($_GET['error'] == 4) {
                echo '<p>El precio no es valido</p>';
            }
            ?>
        </div>
        <div id="footer">
            <p>© 2023 Informatikalmi</p>
        </div>
    </body>
</html>