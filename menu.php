<div id="cabecera">
            <a href="index.php"><img src="images/logo.png" alt="logo" id="logo"/></a>
            <ul>
                <li id="busqueda">
                    <!--Esto es de chat gpt-->
                    <div class="search-container">
                    <form action="index.php" method="post">
                      <input type="text" placeholder="Search..." name="filtro">
                      <button type="submit" name="buscar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </button>
                    </form>
                  </div></li>
                  <div id="sesion">
                    <?php
                    session_start();
                    if(!isset($_SESSION['user'])) {
                        echo '<li><a href="login.html" class="enlace">Iniciar Sesion</a></li>';
                    } else {
                        echo '<li><a href="editUsuario.php" class="enlace">'.$_SESSION['user'].'</a></li>';
                        echo '<li><a href="cerrarSesion.php" class="enlace">Cerrar Sesion</a></li>';
                        echo '<li><a href="crearProducto.php" class="enlace">Añadir Producto</a></li>';
                        
                    }
                    ?>
            </div>
            </ul>
        </div>