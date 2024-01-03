<?php

session_start();

if (!isset($_SESSION['entrar'])) {
    header('Location: ../../index.php');
    die();
}



include('../../conexion.php');


$respuesta = array('mensaje' => 'Estamos dentro');

// DATOS
$nombre = htmlspecialchars($_POST['nombre']);
$correo = htmlspecialchars($_POST['correo']);
$mensaje = htmlspecialchars($_POST['mensaje']);


$quieryInsertarDatos = mysqli_query($conn, "INSERT INTO contacto (nombre, email, mensaje) VALUES ('$nombre', '$correo', '$mensaje') ");

if ($quieryInsertarDatos >= 1) {
    $respuesta['mensaje'] = 'ok';
} else {
    $respuesta['mensaje'] = 'error bd';
}
echo json_encode($respuesta);
