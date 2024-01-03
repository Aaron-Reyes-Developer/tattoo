<?php

if (isset($_POST['id'])) {

    include('../../conexion.php');

    $id = $_POST['id'];

    $queryEliminarImagen = mysqli_query($conn, "DELETE FROM imagenes_producto WHERE fk_id_productos  = '$id'");

    if ($queryEliminarImagen) {


        $queryEliminarTatuaje = mysqli_query($conn, "DELETE FROM productos WHERE id_producto  = '$id' ");

        if ($queryEliminarTatuaje) {

            echo json_encode(array('mensaje' => 'ok'));
        } else {
            echo json_encode(array('mensaje' => 'nop'));
        }

        //
    }


    //
} else {
    echo json_encode(array('mensaje' => "No puedes estar aqui"));
}
