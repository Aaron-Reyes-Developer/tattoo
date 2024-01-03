<?php

include('../conexion.php');

session_start();

if (empty($_SESSION['entrar'])) {
    header('Location: ../index.php');
    die();
}



$mensaje = array('mensaje' => 'entrado');

// DETECTAR SI LOS DATOS VIENEN VACIOS
if (
    $_POST['tituloTattoo'] == '' ||
    $_POST['descripcionTattoo'] == '' ||
    $_POST['sesionesTattoo'] == '' ||
    $_POST['horasTattoo'] == '' ||
    $_POST['precioTattoo'] == ''
) {

    $mensaje['mensaje'] = 'Datos vacios';
    echo json_encode($mensaje);
    die();
}


// OBTENER DATOS
$id_tattoo = $_POST['id'];
$titulo = htmlspecialchars($_POST['tituloTattoo']);
$descripcionTattoo = nl2br(htmlspecialchars($_POST['descripcionTattoo']));
$sesionesTattoo = $_POST['sesionesTattoo'];
$horasTattoo = $_POST['horasTattoo'];
$precioTattoo = $_POST['precioTattoo'];
$categoriaTatuaje = $_POST['categoriaTatuaje'];
$cheked = $_POST['cheked'];

if (isset($_FILES['imagen'])) {

    // datos imagen
    $imagenSinFiltro = $_FILES['imagen'];
    $sizeImagen = $imagenSinFiltro['size'];
    $nombreImagen = $imagenSinFiltro['name'];
    $rutaTemporalImagen = $imagenSinFiltro['tmp_name'];
    $datosImagen = file_get_contents($rutaTemporalImagen);
    $imagenBd = $conn->real_escape_string($datosImagen);
    $imagenKb = $sizeImagen / 1000;

    if ($imagenKb >= 1000) {
        $mensaje['mensaje'] = 'Imagen Pesada';
        echo json_encode($mensaje);
        die();
    }




    $queryInsertarDatos = mysqli_query($conn, "UPDATE `datos_tattoo` 
    SET `imagen` = '$imagenBd',
    `peso_imagen` = '$imagenKb' ,
    `nombre` = '$titulo', 
    `detalle` = '$descripcionTattoo', 
    `sesiones` = '$sesionesTattoo', 
    `horas_sesiones` = '$horasTattoo', 
    `precio_aproximado` = '$precioTattoo', 
    `en_cabecera` = '$cheked', 
    `fecha_tattoo` = current_timestamp(),
    `fk_id_categoria_tatuaje` = $categoriaTatuaje
    WHERE `datos_tattoo`.`id_datos_tattoo` = $id_tattoo ");

    if ($queryInsertarDatos) {
        $mensaje['mensaje'] = 'Editados Correctamente';
    } else {
        $mensaje['mensaje'] = 'Algo salio mal';
    }
} else {


    // si no se edita la imagen
    $queryInsertarDatos = mysqli_query($conn, "UPDATE `datos_tattoo` 
    SET `nombre` = '$titulo', 
    `detalle` = '$descripcionTattoo', 
    `sesiones` = '$sesionesTattoo', 
    `horas_sesiones` = '$horasTattoo', 
    `precio_aproximado` = '$precioTattoo', 
    `en_cabecera` = '$cheked', 
    `fecha_tattoo` = current_timestamp(),
    `fk_id_categoria_tatuaje` = $categoriaTatuaje
    WHERE `datos_tattoo`.`id_datos_tattoo` = $id_tattoo   ");


    if ($queryInsertarDatos) {
        $mensaje['mensaje'] = 'Editados Correctamente';
    } else {
        $mensaje['mensaje'] = 'Algo salio mal';
    }
}


echo json_encode($mensaje);
