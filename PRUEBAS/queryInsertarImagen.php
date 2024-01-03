<?php

include('../conexion.php');



$correcto = false;

foreach ($_FILES['imagenes']['tmp_name'] as $key => $tmp_name) {

    $nombre_imagen = $_FILES['imagenes']['name'][$key];
    $nombre_temporal = $_FILES['imagenes']['tmp_name'][$key];


    // leer el contenedio del archivo
    $data = file_get_contents($nombre_temporal);


    // Escapar el contenido para prevenir inyecciones de SQL (si es necesario)
    $data = $conn->real_escape_string($data);


    // Insertarlo en la base de datos
    $queryInsertarImagen = mysqli_query($conn, "INSERT INTO imagenes_tatuajes (imagen, fk_id_datos_tattoo) VALUES ('$data', 29)");

    if ($queryInsertarImagen) {
        $correcto = true;
    }
}



if ($correcto) {

    echo json_encode(array("mesaje: " => "ok"));
} else {
    echo json_encode(array("mesaje: " => "nop"));
}
