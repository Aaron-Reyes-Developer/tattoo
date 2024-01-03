<?php

///////////////////////// TODA LA LOGICA DE INSERTAR EL PRODUCTO ESTA AQUI

session_start();

if (empty($_SESSION['entrar'])) {
    header('Location: ../../index.php');
    die();
}


include('../../conexion.php');


$respuesta = array('mensaje' => 'entra');

//datos desde el formulario
if (
    $_POST['nombre'] == "" ||
    $_POST['detalle'] == "" ||
    $_POST['precio'] == "" ||
    $_POST['categoria'] == ""
) {
    $menaje = array('mensaje' => 'Datos vacios');
    echo json_encode($menaje);
    die();
}


// DATOS
$nombre = $_POST['nombre'];
$descripcion = $_POST['detalle'];
$precio = $_POST['precio'];
$categoriaProducto = $_POST['categoria'];



// ENTRA SI ES PARA ACTUALIZAR DATOS
if (isset($_POST['id_producto'])) {

    $id = $_POST['id_producto'];

    // query editar datos
    $queryEditarDatos = mysqli_query($conn, "UPDATE productos
    SET  nombre = '$nombre' , 
    descripcion = '$descripcion', 
    precio = $precio, 
    fecha = current_timestamp(), 
    fk_id_categoria_producto = $categoriaProducto    
    WHERE id_producto = '$id' ");

    while (mysqli_next_result($conn)) {;
    }


    //
} else {

    // ENTRA SI ES PARA INSERTAR UN NUEVO DATO

    // query ingresar datos
    $queryIngresarDatos = mysqli_query($conn, "INSERT INTO productos  
    (nombre, descripcion, precio, fk_id_categoria_producto) 
    VALUES ('$nombre' , '$descripcion' , $precio ,  $categoriaProducto)");

    while (mysqli_next_result($conn)) {;
    }

    // sacamos la id del registro
    $id = mysqli_insert_id($conn);
}





// INSERTAMOS LAS IMAGENES EN LA TABLA IMAGENES TATUAJES (si es que existe)
if ($_FILES['imagenes']['size'] > [0]) {

    $correcto = false;

    foreach ($_FILES['imagenes']['tmp_name'] as $key => $tmp_name) {

        $nombre_imagen = $_FILES['imagenes']['name'][$key];
        $nombre_temporal = $_FILES['imagenes']['tmp_name'][$key];
        $size = $_FILES['imagenes']['size'][$key];


        // leer el contenedio del archivo
        $data = file_get_contents($nombre_temporal);


        // Escapar el contenido para prevenir inyecciones de SQL (si es necesario)
        $data = $conn->real_escape_string($data);


        // Insertarlo en la base de datos
        $queryInsertarImagen = mysqli_query($conn, "INSERT INTO imagenes_producto (imagen, fk_id_productos) VALUES ('$data', $id)");

        if ($queryInsertarImagen) {
            $correcto = true;
        }
    }


    //
} else {
    $correcto = true;
}



$correcto = true;


if ($correcto) {
    echo json_encode(array("mensaje" => "ok"));
} else {
    echo json_encode(array("mensaje" => "nop"));
}
