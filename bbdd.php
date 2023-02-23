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
        'idTipoComponente'=> oci_result($sentencia, 'ID_TIPO_COMPONENTE'),
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

function addProducto($descripcion, $precio, $nombre, $id_usuario, $tipo_comp, $imagen) 
{
    $conex = connectOCI();
    $sql = 'INSERT INTO Componente(descripcion, precio, nombre, id_usuario, id_tipo_componente, imagen) VALUES (:descripcion, :precio, :nombre, :id_usuario, :tipo_comp, :imagen)';
    //$sql = "INSERT INTO Componente(descripcion, precio, nombre, id_usuario, id_tipo_componente, imagen) VALUES ('aa', 12, 'aa', 1, 1, 'aaa);";
    $sentencia = oci_parse($conex, $sql);

    oci_bind_by_name($sentencia, ":descripcion", $descripcion);
    oci_bind_by_name($sentencia, ":precio", $precio);
    oci_bind_by_name($sentencia, ":nombre", $nombre);
    oci_bind_by_name($sentencia, ":id_usuario", $id_usuario);
    oci_bind_by_name($sentencia, ":tipo_comp", $tipo_comp);
    oci_bind_by_name($sentencia, ":imagen", $imagen);

    $ejecuccion = oci_execute($sentencia);

    if(!$ejecuccion) {
        echo 'Error al ejecutar la sentencia '. oci_error();
    }

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
        'imagen' => oci_result($sentencia, 'IMAGEN')
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

  oci_execute($sentencia);

  $tip = array();

  

  while(oci_fetch($sentencia))
  {
    $tipo_componente = array(
      'id_componente'=> oci_result($sentencia, 'ID_TIPO_COMPONENTE'),
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

function editarComponentes($id_componente) {
  $conex = connectOCI();
  $sql = 'UPDATE Componente SET nombre= :nombre, descripcion= :descripcion, id_usuario= :id_usuario, precio= :precio, imagen= :imagen WHERE id_usuario= :id_usuario';
  $sentencia = oci_parse($conex, $sql);
  oci_bind_by_name($sentencia, ":nombre", $nombre);
  oci_bind_by_name($sentencia, ":descripcion", $descripcion);
  oci_bind_by_name($sentencia, ":id_usuario", $id_usuario);
  oci_bind_by_name($sentencia, ":precio", $precio);
  oci_bind_by_name($sentencia, ":imagen", $imagen);
  $ejecucion = oci_execute($sentencia);
  oci_close($conex);
  return $ejecucion;
  

}

function getIdComponentes($id_componente) {
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

  oci_execute($sentencia);


  oci_fetch($sentencia);
  
    $tipo_componente = array(
      'id_componente'=> oci_result($sentencia, 'ID_COMPONENTE'),
      'id_componente_tipo'=> oci_result($sentencia, 'ID_TIPO_COMPONENTE'),
      'nombre' => oci_result($sentencia, 'NOMBRE'),
      'descripcion' => oci_result($sentencia, 'DESCRIPCION'),
      'id_usuario' => oci_result($sentencia, 'NOMBRE'),
      'precio' => oci_result($sentencia, 'PRECIO'),
      'imagen' => oci_result($sentencia, 'IMAGEN')
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

?>
