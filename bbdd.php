<?php

function connectOCI() {
    $conex = oci_connect('informatikalmi', 'Almi12345', '192.168.0.133/ORCLCDB');

    if (!$conex) {
        echo "Fallo en la conexión: ".oci_error();
    }
    return $conex;
}

function getTipoComp() {
    $conex = connectOCI();
    $sql = 'SELECT * FROM Tipo_componente';
    $sentencia = oci_parse($conex, $sql);

    oci_define_by_name($sentencia, 'ID_TIPO_COMPONENTE', $id_tipo_com);
    oci_define_by_name($sentencia, 'NOMBRE', $nombre);

    oci_execute($sentencia);

    $tip = array();

    while(oci_fetch($sentencia))
    {
      $tipo_componente = array(
        'id_tipo_componente'=> oci_result($sentencia, 'ID_TIPO_COMPONENTE'),
        'nombre' => oci_result($sentencia, 'NOMBRE')
      );
      $tip[] = $tipo_componente;
    }
    oci_free_statement($sentencia);
    oci_close($conex);
    return $tip;
}

function login($user, $password) {
    $conex = connectOCI();
    $sql = 'SELECT id_usuario FROM Usuario WHERE USUARIO = :usuario AND PASSWORD = :password';
    $sentencia = oci_parse($conex, $sql);
    oci_bind_by_name($sentencia, ":usuario", $user);
    oci_bind_by_name($sentencia, ":password", $password);
    oci_define_by_name($sentencia, 'ID_USUARIO', $id_usuario);

    oci_execute($sentencia);

    oci_fetch($sentencia);

    oci_close($conex);

    return $id_usuario;
}

function esProveedor($id_usuario) {
  $conex = connectOCI();
  $sql = 'SELECT ID_PROVEEDOR FROM Usuario WHERE id_usuario = :id_usuario';
  $sentencia = oci_parse($conex, $sql);
  oci_bind_by_name($sentencia, ":id_usuario", $id_usuario);
  oci_define_by_name($sentencia, 'ID_PROVEEDOR', $id_proveedor);

  oci_execute($sentencia);

  oci_fetch($sentencia);

  oci_close($conex);

  return $id_proveedor;
}

function addProducto($descripcion, $precio, $stock, $nombre, $id_usuario, $tipo_comp, $imagen) 
{
    $conex = connectOCI();
    $sql = 'INSERT INTO Componente(descripcion, precio, nombre, id_usuario, id_tipo_componente, imagen, stock) VALUES (:descripcion, :precio, :nombre, :id_usuario, :tipo_comp, :imagen, :stock)';
    //$sql = "INSERT INTO Componente(descripcion, precio, nombre, id_usuario, id_tipo_componente, imagen) VALUES ('aa', 12, 'aa', 1, 1, 'aaa);";
    $sentencia = oci_parse($conex, $sql);

    oci_bind_by_name($sentencia, ":descripcion", $descripcion);
    oci_bind_by_name($sentencia, ":precio", $precio);
    oci_bind_by_name($sentencia, ":nombre", $nombre);
    oci_bind_by_name($sentencia, ":id_usuario", $id_usuario);
    oci_bind_by_name($sentencia, ":tipo_comp", $tipo_comp);
    oci_bind_by_name($sentencia, ":imagen", $imagen);
    oci_bind_by_name($sentencia, ":stock", $stock);

    $ejecuccion = oci_execute($sentencia);
    if(!$ejecuccion) {
        echo 'Error al ejecutar la sentencia '. oci_error();
    }
    
    oci_free_statement($sentencia);
    oci_close($conex);

    return $ejecuccion;
}

function getComponentes() {
    $conex = connectOCI();
    $sql = 'SELECT * FROM Componente';
    $sentencia = oci_parse($conex, $sql);

    oci_define_by_name($sentencia, 'ID_COMPONENTE', $id_componente);
    oci_define_by_name($sentencia, 'NOMBRE', $nombre);
    oci_define_by_name($sentencia, 'PRECIO', $precio);
    oci_define_by_name($sentencia, 'DESCRIPCION', $descripcion);
    oci_define_by_name($sentencia, 'ID_USUARIO', $id_usuario);
    oci_define_by_name($sentencia, 'ID_TIPO_COMPONENTE', $id_tipo_com);
    oci_define_by_name($sentencia, 'IMAGEN', $imagen);
    oci_define_by_name($sentencia, 'STOCK', $stock);

    oci_execute($sentencia);

    $tip = array();

    while(oci_fetch($sentencia))
    {
      $tipo_componente = array(
        'id_componente'=> oci_result($sentencia, 'ID_COMPONENTE'),
        'id_componente_tipo'=> oci_result($sentencia, 'ID_TIPO_COMPONENTE'),
        'nombre' => oci_result($sentencia, 'NOMBRE'),
        'descripcion' => oci_result($sentencia, 'DESCRIPCION'),
        'id_usuario' => oci_result($sentencia, 'NOMBRE'),
        'precio' => oci_result($sentencia, 'PRECIO'),
        'imagen' => oci_result($sentencia, 'IMAGEN'),
        'stock' => oci_result($sentencia, 'STOCK')
      );
      $tip[] = $tipo_componente;
    }
    oci_free_statement($sentencia);
    oci_close($conex);
    return $tip;
}

function getComponentesUsuario($id_usuario_proveedor) {
  $conex = connectOCI();
  $sql = 'SELECT * FROM Componente WHERE id_usuario = :id_usuario';
  $sentencia = oci_parse($conex, $sql);

  oci_bind_by_name($sentencia, ":id_usuario", $id_usuario_proveedor);
  oci_define_by_name($sentencia, 'ID_COMPONENTE', $id_componente);
  oci_define_by_name($sentencia, 'NOMBRE', $nombre);
  oci_define_by_name($sentencia, 'PRECIO', $precio);
  oci_define_by_name($sentencia, 'DESCRIPCION', $descripcion);
  oci_define_by_name($sentencia, 'ID_USUARIO', $id_usuario);
  oci_define_by_name($sentencia, 'ID_TIPO_COMPONENTE', $id_tipo_com);
  oci_define_by_name($sentencia, 'IMAGEN', $imagen);
  oci_define_by_name($sentencia, 'STOCK', $stock);

  oci_execute($sentencia);

  $tip = array();

  

  while(oci_fetch($sentencia))
  {
    $tipo_componente = array(
      'id_componente'=> oci_result($sentencia, 'ID_COMPONENTE'),
      'nombre' => oci_result($sentencia, 'NOMBRE'),
      'descripcion' => oci_result($sentencia, 'DESCRIPCION'),
      'id_usuario' => oci_result($sentencia, 'NOMBRE'),
      'precio' => oci_result($sentencia, 'PRECIO'),
      'imagen' => oci_result($sentencia, 'IMAGEN'),
      'stock' => oci_result($sentencia, 'STOCK')
    );
    $tip[] = $tipo_componente;
  }

  oci_free_statement($sentencia);
  oci_close($conex);
  return $tip;
}

function eliminarComponente($id_componente) {
  /*
  $conex = connectOCI();
  $sentencia = oci_parse($conex, "SELECT ID_COMPONENTE FROM Componente");
  oci_execute($sentencia);
  while ($row = oci_fetch_assoc($sentencia)) {
    echo $row['ID_COMPONENTE'];
    echo ' ';
  }*/


  echo $id_componente;
  $conex = connectOCI();
  //$sql = "DELETE FROM Componente WHERE ID_COMPONENTE = '$id_componente'";
  $sql = 'DELETE FROM Componente WHERE ID_COMPONENTE = :id_componente';
  $sentencia = oci_parse($conex, $sql);
  oci_bind_by_name($sentencia, ":id_componente", $id_componente);
  $ejecucion = oci_execute($sentencia);

  oci_close($conex);

  return $ejecucion;
}

function editarComponentes($id_componente, $descripcion, $precio, $nombre, $tipo_componente, $imagen, $idUsuario) {
  $conex = connectOCI();
  $sql = 'UPDATE Componente SET descripcion= :descripcion, precio= :precio, nombre= :nombre, id_tipo_componente= :tipo_componente, imagen= :imagen WHERE id_componente = :id_componente';
  $sentencia = oci_parse($conex, $sql);
  oci_bind_by_name($sentencia, ":id_componente", $id_componente);
  oci_bind_by_name($sentencia, ":nombre", $nombre);
  oci_bind_by_name($sentencia, ":descripcion", $descripcion);
  oci_bind_by_name($sentencia, ":precio", $precio);
  oci_bind_by_name($sentencia, ":tipo_componente", $tipo_componente);
  oci_bind_by_name($sentencia, ":imagen", $imagen);
  oci_bind_by_name($sentencia, ":idUsuario", $idUsuario);
  $ejecucion = oci_execute($sentencia);
  oci_free_statement($sentencia);
  oci_close($conex);
  return $ejecucion;
  

}

function getIdComponente($id_componente) {
  $conex = connectOCI();
  $sql = 'SELECT * FROM Componente WHERE id_componente = :componente';
  $sentencia = oci_parse($conex, $sql);
  oci_bind_by_name($sentencia, ":componente", $id_componente);
  oci_define_by_name($sentencia, 'ID_COMPONENTE', $id_componente);
  oci_define_by_name($sentencia, 'NOMBRE', $nombre);
  oci_define_by_name($sentencia, 'PRECIO', $precio);
  oci_define_by_name($sentencia, 'DESCRIPCION', $descripcion);
  oci_define_by_name($sentencia, 'ID_USUARIO', $id_usuario);
  oci_define_by_name($sentencia, 'ID_TIPO_COMPONENTE', $id_tipo_com);
  oci_define_by_name($sentencia, 'IMAGEN', $imagen);
  oci_define_by_name($sentencia, 'STOCK', $stock);

  oci_execute($sentencia);


  oci_fetch($sentencia);
  
    $tipo_componente = array(
      'id_componente'=> oci_result($sentencia, 'ID_COMPONENTE'),
      'id_componente_tipo'=> oci_result($sentencia, 'ID_TIPO_COMPONENTE'),
      'nombre' => oci_result($sentencia, 'NOMBRE'),
      'descripcion' => oci_result($sentencia, 'DESCRIPCION'),
      'id_usuario' => oci_result($sentencia, 'ID_USUARIO'),
      'precio' => oci_result($sentencia, 'PRECIO'),
      'imagen' => oci_result($sentencia, 'IMAGEN'),
      'stock' => oci_result($sentencia, 'STOCK')
    );

  
  oci_free_statement($sentencia);
  oci_close($conex);
  return $tipo_componente;
}

function updateUser($user, $password, $id){
  $conex = connectOCI();
  $sql = 'UPDATE Usuario SET usuario= :usuario, password= :password WHERE id_usuario= :id_usuario';
  $sentencia = oci_parse($conex, $sql);
  oci_bind_by_name($sentencia, ":usuario", $user);
  oci_bind_by_name($sentencia, ':password', $password);
  oci_bind_by_name($sentencia, ':id_usuario', $id);
  $ejecucion = oci_execute($sentencia);
  oci_close($conex);
  return $ejecucion;

}


function getBusqueda($busqueda, $userid){
  $conex = connectOCI();
  $sql = "SELECT componente.* FROM Componente 
  INNER JOIN tipo_componente ON tipo_componente.id_tipo_componente=componente.id_tipo_componente 
  WHERE componente.id_usuario= :id_usuario AND LOWER(componente.nombre) LIKE LOWER('%' || :busqueda || '%') 
  OR LOWER(componente.descripcion) LIKE LOWER('%' || :busqueda || '%') 
  OR LOWER(tipo_componente.nombre) LIKE LOWER('%' || :busqueda || '%')";
  $sentencia = oci_parse($conex, $sql);
  oci_bind_by_name($sentencia, ":busqueda", $busqueda);
  oci_bind_by_name($sentencia, ":id_usuario", $userid);
  oci_define_by_name($sentencia, 'ID_COMPONENTE', $id_componente);
  oci_define_by_name($sentencia, 'NOMBRE', $nombre);
  oci_define_by_name($sentencia, 'PRECIO', $precio);
  oci_define_by_name($sentencia, 'DESCRIPCION', $descripcion);
  oci_define_by_name($sentencia, 'ID_USUARIO', $id_usuario);
  oci_define_by_name($sentencia, 'ID_TIPO_COMPONENTE', $id_tipo_com);
  oci_define_by_name($sentencia, 'IMAGEN', $imagen);
  
  oci_execute($sentencia);

  

  $tip = array();

  while(oci_fetch($sentencia)) {
    
  $busqueda_componente = array(
    'id_componente'=> oci_result($sentencia, 'ID_COMPONENTE'),
    'id_componente_tipo'=> oci_result($sentencia, 'ID_TIPO_COMPONENTE'),
    'nombre' => oci_result($sentencia, 'NOMBRE'),
    'descripcion' => oci_result($sentencia, 'DESCRIPCION'),
    'id_usuario' => oci_result($sentencia, 'NOMBRE'),
    'precio' => oci_result($sentencia, 'PRECIO'),
    'imagen' => oci_result($sentencia, 'IMAGEN')
  );
  
  $tip[] = $busqueda_componente;
}
  

  oci_free_statement($sentencia);
  oci_close($conex);
  return $tip;
}

function getComponenteTipos($idUsuario){
  $conex = connectOCI();
  $sql = 'BEGIN componente_tipo(:idusuario); END;';
  $sentencia = oci_parse($conex, $sql);
  oci_bind_by_name($sentencia, ":id_usuario", $idUsuario);
  
  

  oci_free_statement($sentencia);
  oci_close($conex);
  return $tip;
}

function getComponentesTipo($id_usuario_proveedor, $tipo) {
  $conex = connectOCI();
  $sql = 'SELECT * FROM Componente WHERE id_usuario = :id_usuario AND id_tipo_componente= :tipo_componente';
  $sentencia = oci_parse($conex, $sql);

  oci_bind_by_name($sentencia, ":id_usuario", $id_usuario_proveedor);
  oci_bind_by_name($sentencia, ":tipo_componente", $tipo);
  oci_define_by_name($sentencia, 'ID_COMPONENTE', $id_componente);
  oci_define_by_name($sentencia, 'NOMBRE', $nombre);
  oci_define_by_name($sentencia, 'PRECIO', $precio);
  oci_define_by_name($sentencia, 'DESCRIPCION', $descripcion);
  oci_define_by_name($sentencia, 'ID_USUARIO', $id_usuario);
  oci_define_by_name($sentencia, 'ID_TIPO_COMPONENTE', $id_tipo_com);
  oci_define_by_name($sentencia, 'IMAGEN', $imagen);

  oci_execute($sentencia);

  $tip = array();

  

  while(oci_fetch($sentencia))
  {
    $tipo_componente = array(
      'id_componente'=> oci_result($sentencia, 'ID_COMPONENTE'),
      'id_tipo_componente'=> oci_result($sentencia, 'ID_TIPO_COMPONENTE'),
      'nombre' => oci_result($sentencia, 'NOMBRE'),
      'descripcion' => oci_result($sentencia, 'DESCRIPCION'),
      'id_usuario' => oci_result($sentencia, 'NOMBRE'),
      'precio' => oci_result($sentencia, 'PRECIO'),
      'imagen' => oci_result($sentencia, 'IMAGEN')
    );
    $tip[] = $tipo_componente;
  }

  oci_free_statement($sentencia);
  oci_close($conex);
  return $tip;
}


function actualizarStock($idComp, $Stock, $idUsu){
  $conex = connectOCI();
  $sql = 'UPDATE Componente SET stock= :stock WHERE id_componente= :id_componente AND id_usuario = :id_usuario';
  $sentencia = oci_parse($conex, $sql);
  oci_bind_by_name($sentencia, ":stock", $Stock);
  oci_bind_by_name($sentencia, ':id_componente', $idComp);
  oci_bind_by_name($sentencia, ':id_usuario', $idUsu);
  $ejecucion = oci_execute($sentencia);
  oci_free_statement($sentencia);
  oci_close($conex);
  return $ejecucion;
  
}

function componenteProvedor($idComp, $idUsu){
  $conex = connectOCI();
  $sql = 'SELECT * FROM Componente WHERE id_componente= :idComponente AND componente.id_usuario = :id_usuario';
  $sentencia = oci_parse($conex, $sql);
  oci_bind_by_name($sentencia, ":idComponente", $idComp);
  oci_bind_by_name($sentencia, ":id_usuario", $idUsu);
  oci_define_by_name($sentencia, 'ID_COMPONENTE', $id_componente);
  oci_define_by_name($sentencia, 'NOMBRE', $nombre);
  oci_define_by_name($sentencia, 'PRECIO', $precio);
  oci_define_by_name($sentencia, 'DESCRIPCION', $descripcion);
  oci_define_by_name($sentencia, 'ID_USUARIO', $id_usuario);
  oci_define_by_name($sentencia, 'ID_TIPO_COMPONENTE', $id_tipo_com);
  oci_define_by_name($sentencia, 'IMAGEN', $imagen);
  oci_define_by_name($sentencia, 'STOCK', $stock);

  oci_execute($sentencia);


  oci_fetch($sentencia);
  
    $tipo_componente = array(
      'id_componente'=> oci_result($sentencia, 'ID_COMPONENTE'),
      'id_componente_tipo'=> oci_result($sentencia, 'ID_TIPO_COMPONENTE'),
      'nombre' => oci_result($sentencia, 'NOMBRE'),
      'descripcion' => oci_result($sentencia, 'DESCRIPCION'),
      'id_usuario' => oci_result($sentencia, 'ID_USUARIO'),
      'precio' => oci_result($sentencia, 'PRECIO'),
      'imagen' => oci_result($sentencia, 'IMAGEN'),
      'stock' => oci_result($sentencia, 'STOCK')
    );

  
  oci_free_statement($sentencia);
  oci_close($conex);
  return $tipo_componente;
}


?>
