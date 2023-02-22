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
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/compartido.css">
    <head>
        <meta charset="UTF-8"/>
        <title>Test</title>
    </head>
    <body>
        <?php 
        include_once 'menu.php';
        ?>
        <div id="cuerpo">
            <h1>Productos</h1>
            <a href="indexcategorias.html" id="enlaceCategorias">Ver Categorias</a>
            <div id="productos">
                    <?php
                    if($_SESSION['id_proveedor'] == NULL) 
                    {
                        $componentes = getComponentes();
                    } else {
                        $componentes = getComponentesUsuario($_SESSION['id_usuario']);
                    }
                        
                        $tam = sizeof($componentes);
                        for ($i=0; $i < $tam; $i++) { 
                            echo '<div class="producto">';
                            echo '<img src="'.$componentes[$i]['imagen'].'" alt="'.$componentes[$i]['nombre'].'">';
                            echo '<h3>'.$componentes[$i]['nombre'].'</h3>';
                            echo '<p>'.$componentes[$i]['descripcion'].'</p>';
                            echo '<p>'.$componentes[$i]['precio'].'€</p>';
                            echo '<a href="eliminar.php?id_componente='.$componentes[$i]['id_componente'].'">Eliminar</a>';
                            echo '<a href="editar.php?id_componente='.$componentes[$i]['id_componente'].'">Editar</a>';
                            echo '</div>';
                        }

                        if($tam == 0) {
                            echo '<h2>No tienes productos</h2>';
                        }

                    ?>
                    
            </div>
        </div>
        <div id="footer">
            <p>© 2023 Informatikalmi</p>
        </div>
    </body>
</html>