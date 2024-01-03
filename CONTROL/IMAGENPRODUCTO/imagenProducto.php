<?php
session_start();

if (empty($_SESSION['entrar'])) {
    header('Location: ../../index.php');
    die();
}

include('../../conexion.php');

$queryTodosProductos = mysqli_query($conn, "SELECT * FROM productos");
$totalProductos = mysqli_num_rows($queryTodosProductos);


// PAGINACION
$limite = 12;

if (empty($_REQUEST['pagina'])) {
    $pagina = 1;
} else {
    $pagina = $_REQUEST['pagina'];
}

$totalPaginas = ceil($totalProductos / $limite);
$desde = ($pagina - 1) * $limite;



// ELIMINAR
if (isset($_REQUEST['eliminar'])) {
    $id_producto = $_REQUEST['eliminar'];

    $queryEliminar = mysqli_query($conn, "DELETE FROM `productos` WHERE `productos`.`id_producto` = $id_producto ");

    if ($queryEliminar) {
        echo "<script> 
            alert('Eliminado')
            window.location.href= './imagenProducto.php'
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


    <link rel="stylesheet" href="../../estiloSpiner.css">
    <link rel="stylesheet" href="../../defecto.css">
    <link rel="stylesheet" href="estiloImagenProducto.css">

    <title>Imagenes Productos</title>
</head>

<body id="body">



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
                        <a class="nav-link active" aria-current="page"><img src="../../imagenes/iconos/subir.png" alt="" width="10px"> Imagenes Productos</a>
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

                        <a class="nav-link enlaceCampana" href="../CONTACTO/contacto.php"><img src="../../imagenes/iconos/campana.webp" alt="" width="25PX"></a>

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


    <!-- MAIN -->
    <main class="main">

        <div class="contenedorFlex">

            <!-- FORMULARIO -->
            <div class="contenedorFormulario">

                <form id="formulario" class="formulario">

                    <h1>Productos (<?php echo $totalProductos ?>)</h1>
                    <hr>


                    <!-- imagen -->
                    <div class="mb-3">
                        <input class="form-control" id="imagen" name="imagenes[]" type="file" id="imagenProducto" accept=".png, , .webp ,.jpeg, .jpg" multiple required>
                    </div>


                    <!-- nombre -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre Producto</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="emailHelp" required>
                    </div>


                    <!-- descripcion -->
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" name="detalle" id="descripcion" cols="30" rows="10" required></textarea>
                    </div>


                    <!-- precio -->
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio Producto</label>
                        <input type="number" step="0.1" class="form-control" name="precio" id="precio" aria-describedby="emailHelp" required>
                    </div>


                    <!-- categoria -->
                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoria producto*</label>


                        <select class="form-select categoria" name="categoria" id="categoria">

                            <?php

                            // CONSULTA CATEGORIA TATUAJES
                            $queryCategoriaProducto = mysqli_query($conn, "SELECT * FROM categoria_producto");

                            while ($recorrerCategoriaProducto = mysqli_fetch_array($queryCategoriaProducto)) {
                            ?>
                                <option value="<?php echo $recorrerCategoriaProducto['id_categoria_producto'] ?>"><?php echo $recorrerCategoriaProducto['nombre'] ?></option>
                            <?php
                            }
                            ?>


                        </select>


                    </div>

                    <div class="mb-3">
                        <input type="submit" class="form-control botonGuardar" value="Guardar" aria-describedby="emailHelp">
                    </div>

                </form>

            </div>


            <!-- CONTENEDOR PRODUCTO -->
            <div class="contenedorProductos" id="contenedorProductos">


                <?php

                $queryMostrarProductos = mysqli_query($conn, "SELECT * FROM productos ORDER BY fecha DESC LIMIT $desde,$limite");

                $contador = 0;

                while ($recorrerDatos = mysqli_fetch_array($queryMostrarProductos)) {

                    $contador += 1;

                    $id_producto = $recorrerDatos['id_producto'];

                    // QUERY PARA MOSTRAR LAS IMAGENES DE LOS PRODUCTOS
                    $queryImagenes = mysqli_query($conn, "SELECT * FROM imagenes_producto WHERE fk_id_productos = $id_producto ");

                ?>



                    <div id="carouselExampleIndicators<?php echo $contador ?>" class="carousel slide" style="background-color: #424242; max-width: 200px; height: 350px; position: relative;">


                        <!-- editar -->
                        <a href="./editarProducto.php?editar=<?php echo $id_producto ?>" style="position: absolute; left: 5px; top: 5px; z-index: 3; cursor: pointer;">
                            <img src="../../imagenes/iconos/editar.png" alt="" width="25px">
                        </a>


                        <!-- eliminar -->
                        <span onclick="eliminarPorducto(<?php echo $id_producto ?>)" style="z-index: 3; cursor: pointer; position: absolute; right: 5px; top: 5px; background-color: #df42427c; padding: 3px 7px; " class="eliminar">X</span>


                        <!-- INDICADORES -->
                        <div class="carousel-indicators">
                            <?php

                            for ($i = 0; $i < mysqli_num_rows($queryImagenes); $i++) {
                            ?>

                                <button type="button" data-bs-target="#carouselExampleIndicators<?php echo $i + 1 ?>" data-bs-slide-to="<?php echo $i ?>" class="<?php echo $i == 0 ? 'active' : '' ?>" aria-current="true" aria-label="Slide <?php echo $i + 1 ?>"></button>

                            <?php
                            }

                            ?>

                        </div>


                        <!-- IMAGENES -->
                        <div class="carousel-inner" style="height: 70%;">

                            <?php

                            $contadorImagen = 0;
                            while ($row = mysqli_fetch_assoc($queryImagenes)) {
                                $contadorImagen += 1;
                            ?>

                                <a href="../../DETALLE/DETALLEPRODUCTO/detalleProducto.php?producto=<?php echo $id_producto ?>" class="carousel-item <?php echo $contadorImagen - 1 == 0 ? 'active' : '' ?>" style="width: 100%; height: 100%; background-color: #DEDEDE;">
                                    <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($row['imagen']) ?>" class="d-block w-100" alt="..." style="width: 100%; height: 100%; object-fit: cover;">
                                    
                                    <!-- imagen agotado -->
                                    <?php
                                    if ($recorrerDatos['agotado']) {
                                    ?>
                                        <div class="contenedorImagenAgotado" style="position: absolute; bottom: 3rem;"><img src="../../imagenes/iconos/agotado.png" alt=""></div>
                                    <?php
                                    }

                                    ?>
                                </a>

                            <?php
                            }


                            ?>

                        </div>

                        <!-- BOTONES -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators<?php echo $contador ?>" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators<?php echo $contador ?>" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>


                        <!-- TITULO -->
                        <div class="contenedorTitulo" style="padding: 5px; text-align: center;">
                            <span><?php echo $recorrerDatos['nombre'] ?></span>
                        </div>

                    </div>




                <?php
                }

                ?>


                <div class="paginacion">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">

                            <?php

                            $i = 0;
                            $limiteFor = 5;
                            for ($i; $i < $totalPaginas; $i++) {
                                if ($limiteFor >= $i) {
                            ?>

                                    <li class="page-item <?php if ($i + 1 == $pagina) echo 'active' ?>"><a class="page-link" href="?pagina=<?php echo $i + 1 ?>"><?php echo $i + 1 ?></a></li>

                            <?php
                                }
                            }

                            ?>


                            <li class="page-item <?php if ($pagina > $limiteFor) echo 'active' ?>"><a class="page-link"><?php echo '-' . $pagina . '-' ?></a></li>


                            <li class="page-item <?php if ($pagina >= $i) echo 'disabled' ?>">
                                <a class="page-link" href="?pagina=<?php echo $pagina + 1 ?>" aria-label="Next">
                                    <span aria-hidden="true" style="color: #424242;">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>



            </div>

        </div>


        </div>


    </main>


    <!-- Js  Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script src="../../evitarReenvioFormulario.js"></script>
    <script src="../spinner.js"></script>

    <!-- ALERTA PERSONALIZADA -->
    <script src="../alertaPersonalizada.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- js animacion -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>


    <script>
        // DATOS GENERALES
        var formulario = document.getElementById('formulario')
        var contenedorProductos = document.getElementById('contenedorProductos')


        // INSERTAR PRODUCTO
        formulario.addEventListener('submit', function(e) {

            e.preventDefault()

            let formdata = new FormData(formulario)

            fetch('./queryInsertarPruducto.php', {
                    method: 'POST',
                    body: formdata
                })
                .then(res => res.json())
                .then(e => {


                    // DATOS VACIOS
                    if (e.mensaje == 'Datos vacios') {
                        alert(e.mensaje)
                        return
                    }


                    // CORRECTO
                    if (e.mensaje == 'ok') {

                        alertaPersonalizada('CORRECTO', 'Producto Guardado', 'success', 'Regresar', 'si')
                    }


                })
        })



        const eliminarPorducto = id => {

            mostrarLoader()

            let FD = new FormData()
            FD.append('id', id)

            fetch('queryEliminarProducto.php', {
                    method: 'POST',
                    body: FD
                })
                .then(res => res.json())
                .then(e => {

                    // CORRECTO
                    if (e.mensaje !== 'ok') {

                        alertaPersonalizada('ERROR', 'Ocurrio Un error', 'error', 'Regresar', 'no')
                    }

                    if (e.mensaje === 'ok') {

                        alertaPersonalizada('CORRECTO', 'Producto Eliminado', 'success', 'Regresar', 'si')
                    }


                })
                .finally(f => {
                    ocultarLoader()
                })
        }

        //
    </script>
</body>

</html>