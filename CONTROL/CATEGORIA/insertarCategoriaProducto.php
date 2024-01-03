<?php

///////////////////////// TODA LA LOGICA DE INSERTAR LA CATEGORIA ESTA AQUI

session_start();

if (empty($_SESSION['entrar'])) {
    header('Location: ../../index.php');
    die();
}


include('../../conexion.php');
$respuesta = array('mensaje' => 'Estamos dentro', 'id' => 0);


// verificar si no vinene vacios los datos
if ($_POST['categoriaProducto'] == "") {
    $respuesta['mensaje'] = "Datos vacios";
    echo json_encode($respuesta);
    die();
}

// declarar los datos
$nombreCategoriaProducto = htmlspecialchars($_POST['categoriaProducto']);

// insertar los datos a la bd
$queryInsertar = mysqli_query($conn, "INSERT INTO categoria_producto (nombre) VALUES ('$nombreCategoriaProducto') ");
while (mysqli_next_result($conn)) {;
}


// consulta para enviar el id a el front
$queryConsulta = mysqli_query($conn, "SELECT * FROM categoria_producto WHERE nombre = '$nombreCategoriaProducto' ");
$recorrerConsulta = mysqli_fetch_array($queryConsulta);

// enviar la respuesta al front
if ($queryConsulta && $queryInsertar) {
    $respuesta['mensaje'] = "ok";
    $respuesta['id'] = $recorrerConsulta['id_categoria_producto'];
} else {
    $respuesta['mensaje'] = "Error BD";
}



echo json_encode($respuesta);
