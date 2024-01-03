<?php

include('../conexion.php');

session_start();

if (empty($_SESSION['entrar'])) {
    header('Location: ../index.php');
    die();
}



//datos desde el formulario
if (
    $_POST['tituloTattoo'] == "" ||
    $_POST['descripcionTattoo'] == "" ||
    $_POST['sesionesTattoo'] == "" ||
    $_POST['horasTattoo'] == "" ||
    $_POST['precioTattoo'] == ""
) {
    $menaje = array('mensaje' => 'Datos vacios');
    echo json_encode($menaje);
    die();
}




// DATOS
$tituloTattoo = htmlspecialchars($_POST['tituloTattoo']);
$descripcionTattoo = htmlspecialchars($_POST['descripcionTattoo']);
$sesionesTattoo = $_POST['sesionesTattoo'];
$horasTattoo = $_POST['horasTattoo'];
$precioTattoo = $_POST['precioTattoo'];
$categoriaTataje = $_POST['categoriaTatuaje'];
$en_cabecera = isset($_POST['checkbox']) ? 1 : 0; //si tiene el checkbox significa que va en la cabecera




// ENTRA SI ES PARA ACTUALIZAR DATOS
if (isset($_POST['id_tattoo'])) {

    $id = $_POST['id_tattoo'];

    // query editar datos
    $queryEditarDatos = mysqli_query($conn, "UPDATE datos_tattoo
    SET  nombre = '$tituloTattoo' , 
    detalle = '$descripcionTattoo', 
    sesiones = $sesionesTattoo, 
    horas_sesiones = $horasTattoo, 
    precio_aproximado = $precioTattoo, 
    en_cabecera = $en_cabecera, 
    fk_id_categoria_tatuaje = $categoriaTataje    
    WHERE id_datos_tattoo = '$id' ");

    while (mysqli_next_result($conn)) {;
    }

    //
} else { //ENTRA SI ES PARA INSERTAR UN NUEVO DATO



    // query ingresar datos
    $queryIngresarDatos = mysqli_query($conn, "INSERT INTO datos_tattoo  
    (nombre, detalle, sesiones, horas_sesiones, precio_aproximado, en_cabecera, fk_id_categoria_tatuaje) 
    VALUES ('$tituloTattoo' , '$descripcionTattoo' , $sesionesTattoo , 
    $horasTattoo , $precioTattoo , $en_cabecera , $categoriaTataje)");

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
        $queryInsertarImagen = mysqli_query($conn, "INSERT INTO imagenes_tatuajes (imagen, fk_id_datos_tattoo) VALUES ('$data', $id)");

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
