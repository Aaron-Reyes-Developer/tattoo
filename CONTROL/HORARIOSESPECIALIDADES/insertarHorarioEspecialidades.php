<?php

session_start();

if (!isset($_SESSION['entrar'])) {
    header('Location: ../../index.php');
    die();
}

include('../../conexion.php');

$respuesta = array('mensaje' => 'DATOS RECIBIDOS');

if (empty($_POST['botonEspecialidad'])) {

    if (
        $_POST['parrafo'] == '' ||
        $_POST['lunes'] == '' ||
        $_POST['martes'] == '' ||
        $_POST['miercoles'] == '' ||
        $_POST['jueves'] == '' ||
        $_POST['viernes'] == '' ||
        $_POST['sabado'] == '' ||
        $_POST['domingo'] == ''
    ) {

        $respuesta['mensaje'] = 'Datos vacios';
        echo json_encode($respuesta);

        die();
    }

    // datos desde js para horario
    $parrafo = htmlspecialchars($_POST['parrafo']);
    $lunes = htmlspecialchars($_POST['lunes']);
    $martes = htmlspecialchars($_POST['martes']);
    $miercoles = htmlspecialchars($_POST['miercoles']);
    $jueves = htmlspecialchars($_POST['jueves']);
    $viernes = htmlspecialchars($_POST['viernes']);
    $sabado = htmlspecialchars($_POST['sabado']);
    $domingo = htmlspecialchars($_POST['domingo']);


    $queryEditarHorario = mysqli_query($conn, "UPDATE `horario` 
                                                    SET `parrafo` = '$parrafo', 
                                                    `lunes` = '$lunes', 
                                                    `martes` = '$martes', 
                                                    `miercoles` = '$miercoles', 
                                                    `jueves` = '$jueves', 
                                                    `viernes` = '$viernes', 
                                                    `sabado` = '$sabado', 
                                                    `domingo` = '$domingo' 
                                                    WHERE `horario`.`id_horario` = 1");

    if ($queryEditarHorario) {
        $respuesta['mensaje'] = 'Datos editados Horario';
    } else {
        $respuesta['mensaje'] = 'Error editar horario';
    }
}




// DATOS PARA ESPECIALIDADES
if (isset($_POST['botonEspecialidad'])) {

    if (
        $_POST['parrafoEspecialidad'] == '' ||
        $_POST['especialidad1'] == '' ||
        $_POST['especialidad2'] == '' ||
        $_POST['especialidad3'] == ''
    ) {

        $respuesta['mensaje'] = 'Datos vacios';
        echo json_encode($respuesta);
        die();
    }


    // DATOS ESPECIALIDADES
    $parrafoEspecialidad = $_POST['parrafoEspecialidad'];
    $especialidad1 = $_POST['especialidad1'];
    $especialidad2 = $_POST['especialidad2'];
    $especialidad3 = $_POST['especialidad3'];

    $queryEditarEspecialidad = mysqli_query($conn, "UPDATE `especialidad` 
                                                        SET `parrafo` = '$parrafoEspecialidad', 
                                                        `especialidad_1` = '$especialidad1', 
                                                        `especialidad_2` = '$especialidad2', 
                                                        `especialidad_3` = '$especialidad3'
                                                        WHERE `especialidad`.`id_especialidad` = 1");


    if ($queryEditarEspecialidad) {
        $respuesta['mensaje'] = 'Datos editados Especialidad';
    } else {
        $respuesta['mensaje'] = 'Error editar Especialidad';
    }
}


echo json_encode($respuesta);
