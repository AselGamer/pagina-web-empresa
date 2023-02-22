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
                        for ($i=0; $i < 0; $i++) { 
                            
                        }

                        echo '<div class="producto">';
                        echo '<img src="images/prod1.png" alt="producto1">';
                        echo '<h3>Titulo</h3>';
                        echo '<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero vel et hic, ex dignissimos architecto aut necessitatibus repellat praesentium repudiandae delectus ipsam dolore ipsum, aliquam id numquam nostrum voluptate ad!</p>';
                        echo '<p>20€</p>';
                        echo '<a href="eliminar.php">Eliminar</a>';
                        echo '<a href="editar.php">Editar</a>';
                        echo '</div>';

                    ?>
                    
            </div>
        </div>
        <div id="footer">
            <p>© 2023 Informatikalmi</p>
        </div>
    </body>
</html>