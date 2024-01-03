<?php

session_start();

if (empty($_SESSION['entrar'])) {
    header('Location: ../index.php');
    die();
}

// error_reporting(0);

include('../conexion.php');



// ---------------- LOGICA PAGINACION ----------------
$queryTotalTattos = mysqli_query($conn, "SELECT * FROM datos_tattoo");
while (mysqli_next_result($conn)) {;
}

$totalTattos = mysqli_num_rows($queryTotalTattos);


// limite consulta
$limite = 10;

if (!isset($_REQUEST['pagina'])) {
    $pagina = 1;
} else {
    $pagina = $_REQUEST['pagina'];
}

$totalPaginas = ceil($totalTattos / $limite);

$desde = ($pagina - 1) * $limite;

// ---------------- FIN LOGICA PAGINACION ----------------


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../imagenes/iconos/astronautaConCohete.ico">


    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


    <!-- animacion -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


    <!-- Fuente Dosis -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../estiloSpiner.css">
    <link rel="stylesheet" href="estiloAdmin.css">
    <title>ADMIN</title>

</head>

<body id="body">


    <img src="../imagenes/iconos/astronautaConCohete.ico" alt="" class="astronauta">

    <!-- HEADER -->
    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">

            <a class="navbar-brand" href="../index.php">Cierva Ink.</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href=""><img src="../imagenes/iconos/subir.png" alt="" width="10px"> Imagenes Tattoo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./IMAGENPRODUCTO/imagenProducto.php"><img src="../imagenes/iconos/subir.png" alt="" width="10px"> Imagenes Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://squoosh.app" target="_blank">Bajar peso Imagen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./HORARIOSESPECIALIDADES/horariosEspecialidades.php">Horarios/Especialidades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./CATEGORIA/categoria.php">Categorias</a>
                    </li>


                    <!-- NOTIFICACION -->
                    <li class="nav-item listaCampana position-relative">

                        <a class="nav-link enlaceCampana" href="./CONTACTO/contacto.php"><img src="../imagenes/iconos/campana.webp" alt="" width="25PX"></a>

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
                        <a class="nav-link salir" href="./cerrarSesion.php">Salir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- MAIN -->
    <main class="main">

        <h1>Ultimos <?php echo $limite ?> Tattoos agregados</h1>

        <div class="contenedorFlex">

            <!-- FORMULARIO -->
            <div class="contenedorFormulario">

                <form method="post" class="formulario" enctype="multipart/form-data" id="formulario">

                    <h2>Ingresar Imagenes</h2>


                    <div class="conetenedorInputs">

                        <!-- imagen -->
                        <div class="mb-3">
                            <label for="imagen" class="form-label">Subir Imagen (jpg/png/webp)</label>
                            <input type="file" name="imagenes[]" id="imagen" class="form-control" accept=".png, , .webp ,.jpeg, .jpg" multiple>
                        </div>


                        <!-- titulo -->
                        <div class="mb-3">
                            <label for="tituloTattoo" class="form-label">Titulo del Tattoo</label>
                            <input class="form-control" name="tituloTattoo" id="tituloTattoo" type="text">
                        </div>


                        <!-- descripcion -->
                        <div class="form-floating">
                            <textarea class="form-control" name="descripcionTattoo" id="descripcionTattoo" placeholder="Leave a comment here" style="height: 300px"></textarea>
                            <label for="floatingTextarea2" class="labelDescripcion">Descripción de el tattoo</label>
                        </div>


                        <!-- sesiones -->
                        <div class="mb-3">
                            <label for="tituloTattoo" class="form-label">Total de Sesiones</label>
                            <input class="form-control" name="sesionesTattoo" id="sesionesTattoo" type="number">
                        </div>


                        <!-- horas por sesiones -->
                        <div class="mb-3">
                            <label for="tituloTattoo" class="form-label">Horas por Sesiones</label>
                            <input class="form-control" name="horasTattoo" id="horasTattoo" type="number">
                        </div>


                        <!-- precio -->
                        <div class="mb-3">
                            <label for="tituloTattoo" class="form-label">Precio aproximado</label>
                            <input class="form-control" name="precioTattoo" id="precioTattoo" type="number" step="0.01">
                        </div>


                        <!-- categoria tatuaje -->
                        <div class="mb-3">
                            <label for="categoriaTatuaje" class="form-label">Categoria tatuaje*</label>


                            <select class="form-select categoriaTatuaje" name="categoriaTatuaje" id="categoriaTatuaje">

                                <?php

                                // CONSULTA CATEGORIA TATUAJES
                                $queryCategoriaTatuaje = mysqli_query($conn, "SELECT * FROM categoria_tatuaje");

                                while ($recorrerCategoriaTatuaje = mysqli_fetch_array($queryCategoriaTatuaje)) {
                                ?>
                                    <option value="<?php echo $recorrerCategoriaTatuaje['id_categoria_tatuaje'] ?>"><?php echo $recorrerCategoriaTatuaje['nombre'] ?></option>
                                <?php
                                }
                                ?>




                            </select>
                        </div>


                        <!-- checkbox -->
                        <div class="form-check">
                            <label class="form-check-label" for="checkbox">
                                Poner como cabecera
                            </label>
                            <input class="form-check-input" name="checkbox" id="checkbox" type="checkbox">
                        </div>


                        <div class="mb-3">
                            <input class="form-control botonSubir" name="subir" type="submit">
                        </div>

                    </div>



                </form>


            </div>


            <!-- CONTENEDOR CARTA -->
            <div class="contenedorGridImagenes" id="contenedorGridImagenes">


                <?php

                // mostrar fotos
                $queryMostrarFotos = mysqli_query($conn, "SELECT * FROM datos_tattoo ORDER BY fecha_tattoo DESC LIMIT $desde, $limite");

                // mostrar las fotos
                $contadorContenedor = 0;

                while ($recorrerFotos = mysqli_fetch_array($queryMostrarFotos)) {

                    $contadorContenedor += 1;


                    $id_tatuaje = $recorrerFotos['id_datos_tattoo'];

                    // consulta para mostrar las imagenes
                    $queryImagenes = mysqli_query($conn, "SELECT * FROM imagenes_tatuajes WHERE fk_id_datos_tattoo = $id_tatuaje ORDER BY fecha DESC ");

                ?>

                    <div class="carta">

                        <!-- editar -->
                        <a class="editar" href="./editarAdmin.php?editar=<?php echo $recorrerFotos['id_datos_tattoo'] ?>">
                            <img src="../imagenes/iconos/editar.png" alt="" width="25px">
                        </a>


                        <!-- eliminar -->
                        <span onclick="eliminarTatuaje(<?php echo $recorrerFotos['id_datos_tattoo'] ?>)" style="z-index: 2; cursor: pointer;" class="eliminar">X</span>


                        <!-- imagen -->
                        <a class="direccionDeImagen" href="../DETALLE/detalleTattoo.php?tattoo=<?php echo $recorrerFotos['id_datos_tattoo'] ?>" style="">

                            <div id="carouselExampleIndicators<?php echo $contadorContenedor ?>" class="carousel slide" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">

                                <!-- INDICADORES-->
                                <div class="carousel-indicators">

                                    <!-- muestra las barritas de abajo dependiendo cuantas imagenes hay -->
                                    <?php
                                    for ($i = 0; $i < mysqli_num_rows($queryImagenes); $i++) {
                                    ?>

                                        <button type="button" data-bs-target="#carouselExampleIndicators<?php echo $contadorContenedor ?>" data-bs-slide-to="<?php echo $i ?>" class="<?php echo $i == 0 ? 'active' : '' ?>" aria-current="true" aria-label="Slide <?php echo $i + 1 ?>"></button>

                                    <?php
                                    }
                                    ?>

                                </div>


                                <!-- CONTENEDOR IMAGENES -->
                                <div class="carousel-inner">

                                    <?php

                                    $contadorImagen = 0;

                                    while ($recorrerImagenes = mysqli_fetch_array($queryImagenes)) {
                                        $contadorImagen += 1;

                                    ?>

                                        <!-- IMAGENES -->
                                        <div class="carousel-item <?php echo $contadorImagen - 1 == 0 ? 'active' : '' ?>" style=" height: 340px;">
                                            <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($recorrerImagenes['imagen']); ?> " alt="<?php echo $recorrerImagenes['nombre'] ?>" class="d-block w-100" style="width: 100%;  height: 100%; object-fit: cover;">
                                        </div>

                                    <?php
                                    }


                                    ?>

                                </div>


                                <!-- BOTON ATRAS -->
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators<?php echo $contadorContenedor ?>" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>

                                <!-- BOTON ADELANTE -->
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators<?php echo $contadorContenedor ?>" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>

                            </div>

                        </a>

                        <?php

                        // mostrar un cuadradito la imagen se mostrara en la pagina principal
                        if ($recorrerFotos['en_cabecera'] == 1) {
                            echo "<div class='en_cabecera'></div>";
                        }

                        ?>


                    </div>

                <?php
                }

                ?>

            </div>


        </div>

        <footer class="foorter">

            <nav aria-label="Page navigation example">
                <ul class="pagination">


                    <?php
                    $i = 0;
                    $limiteFor = 6;
                    for ($i; $i < $totalPaginas; $i++) {

                        // se muestra la paginacion hasta el limite del for '$limiteFor'
                        if ($i < $limiteFor) {
                    ?>
                            <li class="page-item <?php if ($pagina == $i + 1) echo 'active' ?>"><a class="page-link" href="?pagina=<?php echo $i + 1 ?>"> <?php echo $i + 1 ?></a></li>

                    <?php

                        }
                    }

                    ?>

                    <!-- muestra la pagina actual -->
                    <li class="page-item <?php if ($pagina > $limiteFor) echo 'active' ?>"><a class="page-link">-<?php echo $pagina ?>-</a></li>


                    <li class="page-item <?php if ($pagina >= $i) echo 'disabled' ?>">
                        <a class="page-link" href="?pagina=<?php echo $pagina + 1 ?>" aria-label="Next">
                            <span aria-hidden="true" class="flechaDerecha">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>

        </footer>


    </main>


    <!-- Js  Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script src="../evitarReenvioFormulario.js"></script>
    <script src="./spinner.js"></script>

    <!-- ALERTA PERSONALIZADA -->
    <script src="./alertaPersonalizada.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- js animacion -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init();

        // obtener datos
        var formulario = document.getElementById('formulario')
        var contenedorGridImagenes = document.getElementById('contenedorGridImagenes')
        var contenedorDatoVacios = document.getElementById('contenedorDatoVacios')



        // enviar formulario a php
        formulario.addEventListener('submit', function(e) {

            e.preventDefault()

            formdata = new FormData(formulario)


            // enviar datos al archivo php
            fetch('./insertarTatuajeAdmin.php', {
                    method: 'POST',
                    body: formdata
                })
                .then(respuesta => respuesta.json())
                .then(json => {



                    // si los datos estan vacios
                    if (json.mensaje == 'Datos vacios') {

                        alertaPersonalizada('ERROR', 'Datos vacios', 'error', 'Regresar', 'no')

                        return
                    }


                    if (json.mensaje == 'ok') {
                        alertaPersonalizada('AGREGADO', 'Agregado Correctamente', 'success', 'Regresar', 'si')
                    }




                })
        })


        // eliminar tatuaje
        const eliminarTatuaje = id => {

            mostrarLoader()

            FD = new FormData()
            FD.append('id', id)

            fetch('queryEliminarTatuaje.php', {
                    method: 'POST',
                    body: FD
                })
                .then(res => res.json())
                .then(e => {

                    // si los datos estan vacios
                    if (e.mensaje !== 'ok') {

                        alertaPersonalizada('ERROR', 'Algo salio mal', 'error', 'Regresar', 'no')
                        return
                    }


                    if (e.mensaje == 'ok') {
                        alertaPersonalizada('ELIMINADO', 'Eliminado Correctamente', 'success', 'Regresar', 'si')
                    }

                })
                .finally(f => {

                    ocultarLoader();

                })
        }




        //
    </script>


</body>

</html>