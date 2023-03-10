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
        <title>Informatikalmi | Main</title>
    </head>
    <body>
    <script src="animacion.js"></script>
    <script>
    AmagiLoader.show();
    setTimeout(() => {
    AmagiLoader.hide();
    }, 3000);
    </script>
        <?php 
        include_once 'menu.php';
        ?>
        <div id="cuerpo">
                    <?php
                    if($_SESSION['id_proveedor'] == NULL) 
                    {
                        $componentes = getComponentes();
                        $componentesTipo = getComponentes();
                    } else {
                        $componentes = getComponentesUsuario($_SESSION['id_usuario']);
                        $componentesTipo = getComponentesUsuario($_SESSION['id_usuario']);
                    }

                    if(isset($_POST['filtro']) && !$_POST['filtro']==null){
                        $busqueda = $_POST['filtro'];
                        $getBusqueda = getBusqueda($busqueda, $_SESSION['id_usuario']);
                        $tam = sizeof($getBusqueda);
                        echo '<h1>Productos</h1>';
                        echo '<a href="index.php" id="enlaceCategorias">Todos los productos</a>';
                        if($tam == 0) {
                            echo '<h2>Sin resultados</h2>';
                        }
                        echo '<div id="productos">';
                        
                        for ($i=0; $i < $tam; $i++) { 
                            echo '<div class="producto">';
                            echo '<img src="'.$getBusqueda[$i]['imagen'].'" alt="'.$getBusqueda[$i]['nombre'].'">';
                            echo '<h3>'.$getBusqueda[$i]['nombre'].'</h3>';
                            echo '<p>'.$getBusqueda[$i]['descripcion'].'</p>';
                            echo '<p>'.$getBusqueda[$i]['precio'].'???</p>';
                            echo '<p>Stock: '.$componentes[$i]['stock'].'</p>';
                            echo '<a href="eliminar.php?id_componente='.$getBusqueda[$i]['id_componente'].'">Borrar</a>';
                            echo '<a href="editarComponente.php?id_componente='.$getBusqueda[$i]['id_componente'].'">Editar</a>';
                            echo '<a href="editarStock.php?id_componente='.$componentes[$i]['id_componente'].'">Stock</a>';
                            echo '</div>';
                        }
                    }
                    

                    
                    if(!isset($_GET['categorias']) && $_POST['filtro']==null){  
                        echo '<h1>Productos</h1>';
                        echo '<a href="index.php?categorias" id="enlaceCategorias">Tipos de producto</a>';
                        echo '<div id="productos">';
                        

                        $tam = sizeof($componentes);
                        for ($i=0; $i < $tam; $i++) { 
                            echo '<div class="producto">';
                            echo '<img src="'.$componentes[$i]['imagen'].'" alt="'.$componentes[$i]['nombre'].'">';
                            echo '<h3>'.$componentes[$i]['nombre'].'</h3>';
                            echo '<p>'.$componentes[$i]['descripcion'].'</p>';
                            echo '<p>'.$componentes[$i]['precio'].'???</p>';
                            echo '<p>Stock: '.$componentes[$i]['stock'].'</p>';
                            echo '<a href="eliminarCompo.php?id_componente='.$componentes[$i]['id_componente'].'">Borrar</a>';
                            echo '<a href="editarComponente.php?id_componente='.$componentes[$i]['id_componente'].'">Editar</a>';
                            echo '<a href="editarStock.php?id_componente='.$componentes[$i]['id_componente'].'">Stock</a>';
                            echo '</div>';
                        }

                        if($tam == 0) {
                            echo '<h2>No tienes ningun producto</h2>';
                        }
                    }   
                    else if(isset($_GET['categorias']) && $_POST['filtro']==null) {
                        echo '<h1>Products</h1>';
                        echo '<a href="index.php" id="enlaceCategorias">Todos los productos</a>';
                        $tipoComponente = getTipoComp();
                        $tam = sizeof($tipoComponente);
                        for ($i=0; $i < $tam; $i++) { 
                            if($_SESSION['id_proveedor'] == NULL) 
                            {
                            $componentesTipo = getComponentesTipo( $tipoComponente[$i]['id_tipo_componente']);
                            } else {
                            $componentesTipo = getComponentesTipoUsuario($_SESSION['id_usuario'], $tipoComponente[$i]['id_tipo_componente']);
                            }
                            $tamComp = sizeof($componentesTipo);
                            if(!$tamComp == 0){
                                echo '<h2>'.$tipoComponente[$i]['nombre'].'</h2>';
                                echo '<div id="productos">';
                            for ($e=0; $e < $tamComp; $e++) {
                                echo '<div class="producto">';
                                echo '<img src="'.$componentesTipo[$e]['imagen'].'" alt="'.$componentesTipo[$e]['nombre'].'">';
                                echo '<h3>'.$componentesTipo[$e]['nombre'].'</h3>';
                                echo '<p>'.$componentesTipo[$e]['descripcion'].'</p>';
                                echo '<p>'.$componentesTipo[$e]['precio'].'???</p>';
                                echo '<p>Stock: '.$componentesTipo[$e]['stock'].'</p>';
                                echo '<a href="eliminarCompo.php?id_componente='.$componentesTipo[$e]['id_componente'].'">Borrar</a>';
                                echo '<a href="editarComponente.php?id_componente='.$componentesTipo[$e]['id_componente'].'">Editar</a>';
                                echo '<a href="editarStock.php?id_componente='.$componentesTipo[$e]['id_componente'].'">Stock</a>';
                                echo '</div>'; 
                                }
                                echo '</div>';
                            }
                        }
                    }
                    ?>
            </div>
        </div>
        <div id="footer">
            <p class="footerTexto">?? 2023 Informatikalmi</p>
        </div>
    </body>
</html>