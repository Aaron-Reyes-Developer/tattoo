<?php
session_start();

if (empty($_SESSION['entrar'])) {
    header('Location: ../../index.php');
    die();
}


include('../../conexion.php');
include('../../truncarDato.php');


// ELIMINAR
if (isset($_REQUEST['eliminar'])) {
    $id_contacto = $_REQUEST['eliminar'];

    $queryEliminar = mysqli_query($conn, "DELETE FROM contacto WHERE id_contacto = $id_contacto");
    if ($queryEliminar >= 1) {
        echo "<script> 
            alert('Eliminado') 
            window.location.href= './contacto.php'
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../imagenes/iconos/astronautaConCohete.ico">
    <meta name="theme-color" content="#0C0C0C">


    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


    <!-- animacion -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


    <!-- Fuente Dosis -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="../../defecto.css">
    <link rel="stylesheet" href="./estliContacto.css">



    <title>Contacto</title>
</head>

<body>

    <img src="../../imagenes/iconos/astronautaConCohete.ico" alt="" class="astronauta">


    <!-- HEADER -->
    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../index.php">Cierva Ink.</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../admin.php"><img src="../../imagenes/iconos/subir.png" alt="" width="10px"> Imagenes Tattoo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../IMAGENPRODUCTO/imagenProducto.php"><img src="../../imagenes/iconos/subir.png" alt="" width="10px"> Imagenes Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://squoosh.app" target="_blank">Bajar peso Imagen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../HORARIOSESPECIALIDADES/horariosEspecialidades.php">Horarios/Especialidades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../CATEGORIA/categoria.php">Categorias</a>
                    </li>

                    <!-- NOTIFICACION -->
                    <li class="nav-item listaCampana position-relative">

                        <a class="nav-link enlaceCampana" href="./CONTACTO/contacto.php"><img src="../../imagenes/iconos/campana.webp" alt="" width="25PX"></a>

                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">

                            <?php
                            // notificacion
                            $queryNofitifacion = mysqli_query($conn, "SELECT COUNT(id_contacto) totalNotificacion FROM contacto WHERE activo = 1");
                            $TotalNotificacion = mysqli_fetch_array($queryNofitifacion);
                            if ($TotalNotificacion['totalNotificacion'] >= 1) echo $TotalNotificacion['totalNotificacion'], ''

                            ?>

                        </span>

                    </li>

                    <li class="nav-item">
                        <a class="nav-link salir" href="../cerrarSesion.php">Salir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="main container mt-3">

        <h1>Personas / Empresas</h1>
        <span>Te queiren contactar</span>

        <section class="seccionTabla">
            <table class="table table-dark table-striped mt-3 table-hover ">

                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">MENSAJE</th>
                        <th scope="col">FECHA</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $queryDatosContacto = mysqli_query($conn, "SELECT * FROM contacto ORDER BY fecha DESC");

                    $contador = 0;
                    while ($recorrerContacto = mysqli_fetch_array($queryDatosContacto)) {
                        $contador += 1;
                    ?>
                        <tr>
                            <th <?php if ($recorrerContacto['activo'] != 0) echo 'style="color: green;" ' ?> scope="row "><?php echo $contador ?></th>
                            <td><?php echo $recorrerContacto['nombre'] ?> <a href="?eliminar=<?php echo    $recorrerContacto['id_contacto'] ?>">X</a></td>
                            <td><?php echo $recorrerContacto['email'] ?></td>
                            <td><?php echo $recorrerContacto['mensaje'] ?></td>
                            <td><?php echo truncarDato($recorrerContacto['fecha'], 10) ?></td>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>

            </table>
        </section>

    </main>



    <?php

    $queryActualizarEstadoNotificacion = mysqli_query($conn, "UPDATE contacto SET activo = '0'");


    ?>


    <!-- Js  Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script src="../../evitarReenvioFormulario.js"></script>

</body>

</html>