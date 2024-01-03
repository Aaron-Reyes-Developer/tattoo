<?php

session_start();

if (empty($_SESSION['entrar'])) {
    header('Location: ../../index.php');
    die();
}

include('../../conexion.php');


// ELIMINAR PRODUCTO
if (isset($_REQUEST['eliminarCategoriaProducto'])) {

    $id_categoriaProducto = $_REQUEST['eliminarCategoriaProducto'];

    $queryEliminar = mysqli_query($conn, "DELETE FROM categoria_producto WHERE id_categoria_producto = $id_categoriaProducto");

    if ($queryEliminar) {
        echo "<script> 
                    alert('Eliminado') 
                    window.location.href='./categoria.php'
            </script>";
    }
}


// ELIMINAR TATUAJE
if (isset($_REQUEST['eliminarCategoriaTatuaje'])) {

    $id_categoriaTatuaje = $_REQUEST['eliminarCategoriaTatuaje'];

    $queryEliminar = mysqli_query($conn, "DELETE FROM categoria_tatuaje WHERE id_categoria_tatuaje = $id_categoriaTatuaje");

    if ($queryEliminar) {
        echo "<script> 
                    alert('Eliminado') 
                    window.location.href='./categoria.php'
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
    <link rel="stylesheet" href="./estiloCategoria.css">

    <title>Categoria</title>
</head>

<body>

    <div id="contenedorLoaderMain" class="desctivadoLoaderMain ">
        <div id="spinerMain" class="desctivadoSpiner "></div>
    </div>


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
                        <a class="nav-link">Categorias</a>
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


    <main class="main container">

        <h1>Categorias</h1>

        <div class="contenedorCategorias mt-3">


            <!-- CARTA CATEGORIA PRODUCTO -->
            <div class="cartaCategoriaProductos cartaCategoria">

                <h2>Categoria Productos.</h2>

                <!-- FORMULARIO -->
                <form id="formularioProducto" class="formulario mt-3 formularioPorducto">

                    <div class="mb-3">
                        <label for="categoriaProducto" class="form-label">Nombre Categoria*</label>
                        <input type="text" class="form-control" name="categoriaProducto" id="categoriaProducto" placeholder="Nombre categoria">
                    </div>

                    <div class="mb-3">
                        <input type="submit" class="form-control botonGuardar" id="botonGuardarProducto" value="Agregar">
                    </div>

                </form>

                <!-- LISTA -->
                <ul id="ulProducto">
                    <?php
                    $queryCategoriaProducto = mysqli_query($conn, "SELECT * FROM categoria_producto ORDER BY id_categoria_producto DESC");

                    while ($recorrerCategoriaProducto = mysqli_fetch_array($queryCategoriaProducto)) {
                    ?>
                        <li><?php echo $recorrerCategoriaProducto['nombre'] ?> <a href="?eliminarCategoriaProducto=<?php echo $recorrerCategoriaProducto['id_categoria_producto'] ?>">X</a></li>
                    <?php
                    }
                    ?>

                </ul>
            </div>


            <!-- CARTA CATEGORIA TATUAJE -->
            <div class="cartaCategoriaTatuaje cartaCategoria">

                <h2>Categoria Tatuaje.</h2>

                <!-- FORMULARIO -->
                <form id="formularioTatuaje" class="formulario mt-3 formularioPorducto">

                    <div class="mb-3">
                        <label for="categoriaTatuaje" class="form-label">Nombre Categoria*</label>
                        <input type="text" class="form-control" name="categoriaTatuaje" id="categoriaTatuaje" placeholder="Nombre categoria">
                    </div>

                    <div class="mb-3">
                        <input type="submit" class="form-control botonGuardar" id="botonGuardarTatuaje" value="Agregar">
                    </div>

                </form>


                <!-- LISTA -->
                <ul id="ulTatuaje">
                    <?php
                    $queryCategoriaTatuaje = mysqli_query($conn, "SELECT * FROM categoria_tatuaje ORDER BY id_categoria_tatuaje DESC");

                    while ($recorrerCategoriaTatuaje = mysqli_fetch_array($queryCategoriaTatuaje)) {
                    ?>
                        <li><?php echo $recorrerCategoriaTatuaje['nombre'] ?> <a href="?eliminarCategoriaTatuaje=<?php echo $recorrerCategoriaTatuaje['id_categoria_tatuaje'] ?>">X</a></li>
                    <?php
                    }
                    ?>

                </ul>

            </div>


        </div>

    </main>



    <!-- Js  Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script src="../../evitarReenvioFormulario.js"></script>

    <!-- ALERTA PERSONALIZADA -->
    <script src="../../alertaPersonalizada.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- js animacion -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>



    <script>
        ///////////////////// LOGICA AGREGAR PRODUCTO   ////////////////////
        const formularioProducto = document.getElementById('formularioProducto')
        const ulProducto = document.getElementById('ulProducto')

        formularioProducto.addEventListener('submit', function(e) {
            e.preventDefault()

            let formdata = new FormData(formularioProducto)

            fetch('./insertarCategoriaProducto.php', {
                    method: 'POST',
                    body: formdata
                })
                .then(res => res.json())
                .then(e => {

                    if (e.mensaje === 'Datos vacios') {
                        alert('Datos vacios')
                        return
                    }


                    if (e.mensaje === 'ok') {
                        alertaPersonalizada('CORRECTO', 'Categoria Registrada', 'success', 'Regresar', 'no')

                        ulProducto.insertAdjacentHTML('afterbegin', `<li>${formdata.get('categoriaProducto')} <a href='?eliminarCategoriaProducto=${e.id}'>X<a/> </li>`)


                        document.getElementById('categoriaProducto').value = ''
                    }


                    if (e.mensaje === 'Error BD') {
                        alertaPersonalizada('ERROR', 'No se pudo registrar la categoria', 'error', 'Regresar', 'no')

                    }

                })
        })





        ///////////////////// LOGICA AGREGAR TATUAJE   ////////////////////
        const formularioTatuaje = document.getElementById('formularioTatuaje')
        const ulTatuaje = document.getElementById('ulTatuaje')

        formularioTatuaje.addEventListener('submit', function(e) {

            e.preventDefault()

            let formdata = new FormData(formularioTatuaje)

            fetch('./insertarCategoriaTatuaje.php', {
                    method: 'POST',
                    body: formdata
                })
                .then(res => res.json())
                .then(e => {

                    if (e.mensaje === 'Datos vacios') {
                        alert('Datos vacios')
                        return
                    }


                    if (e.mensaje === 'ok') {
                        alertaPersonalizada('CORRECTO', 'Categoria Registrada', 'success', 'Regresar', 'no')

                        ulTatuaje.insertAdjacentHTML('afterbegin', `<li>${formdata.get('categoriaTatuaje')} <a href='?eliminarCategoriaTatuaje=${e.id}'>X<a/> </li>`)

                        document.getElementById('categoriaTatuaje').value = ''
                    }

                    if (e.mensaje === 'Error BD') {
                        alertaPersonalizada('ERROR', 'No se pudo registrar la categoria', 'error', 'Regresar', 'no')

                    }


                })

        })
    </script>
</body>

</html>