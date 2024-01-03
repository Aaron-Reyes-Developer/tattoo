<?php


$server = "localhost";
$usuario = "root";
$contra = "";
$bd = "tatuajebd";

$conn = mysqli_connect($server, $usuario, $contra, $bd);

$queryNumeroTelefono = mysqli_query($conn, "SELECT * FROM numero_telefono");
$recorrerTelefono = mysqli_fetch_assoc($queryNumeroTelefono);
$telefono = $recorrerTelefono['numero'];
