<?php

if (isset($_POST['id_imagen'])) {

    include('../conexion.php');

    $id_imagen = $_POST['id_imagen'];

    $queryEliminar = mysqli_query($conn, "DELETE FROM imagenes_tatuajes WHERE id_imagenes_tatuajes = '$id_imagen'");

    if ($queryEliminar) {
        echo json_encode(array('mensaje' => 'ok'));
    }


    //
} else {
    echo json_encode(array('mensaje' => "No puedes estar aqui"));
}
