<?php

session_start();

if (!isset($_SESSION['entrar'])) {
    header('Location: ../../index.php');
    die();
}



include('../../conexion.php');


// EDITAR
if (!isset($_REQUEST['editar'])) {
    echo "ocurrio un error";
    die();
}


$id_producto = $_REQUEST['editar'];

// QUERY DETALLE PRODUCTO
$queryDatosEditar = mysqli_query($conn, "SELECT 
prod.*, 
catPro.nombre nombreCategoria 
FROM productos prod
INNER JOIN categoria_producto catPro
ON catPro.id_categoria_producto = prod.fk_id_categoria_producto
WHERE prod.id_producto = '$id_producto' ");


$recorrerEditar = mysqli_fetch_array($queryDatosEditar);



// QUERY IMAGENES
$queryDetalleImagenes = mysqli_query($conn, "SELECT * FROM imagenes_producto WHERE fk_id_productos = $id_producto ORDER BY fecha DESC");


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
    <link rel="stylesheet" href="estiloEditarProducto.css">

    <title>Editar</title>
</head>

<body>

    <div class="desctivadoLoaderMain" id="contenedorLoaderMain">
        <div id="spinerMain" class="desctivadoSpiner"></div>
    </div>


    <main class="main">

        <!-- IMAGENES -->
        <div class="contenedorImagen">


            <?php

            while ($rowImagen = mysqli_fetch_assoc($queryDetalleImagenes)) {
            ?>

                <div class="carta">
                    <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($rowImagen['imagen']) ?>" alt="">
                    <a class="eliminar" onclick="eliminarImagen(<?php echo $rowImagen['id_imagenes_producto'] ?>)">X</a>
                </div>

            <?php
            }
            ?>

        </div>



        <!-- FORMULARIO -->
        <div class="contenedorFormulario">

            <form class="formulario" id="formulario">

                <h1>Editar Producto</h1>
                <hr>

                <div class="contenedorDatoVacios" id="contenedorDatoVacios"> </div>


                <!-- imagen -->
                <div class="mb-3">

                    <label for="imagen" class="form-label">Subir Imagen (jpg/png/webp) <br> <span class="menajeNoEditarImagen">(no subir imagen si no se quiere editar)</span> </label>
                    <input type="file" name="imagenes[]" id="imagen" class="form-control" accept="image/*" multiple>

                </div>


                <!-- titulo -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Titulo del Producto*</label>
                    <input class="form-control" name="nombre" id="nombre" type="text" value="<?php echo $recorrerEditar['nombre'] ?>" required>
                </div>


                <!-- descripcion -->
                <div class="form-floating mb-3">
                    <textarea class="form-control" name="detalle" id="detalle" placeholder="Detalle aqui" style="height: 100px" required><?php echo $recorrerEditar['descripcion'] ?></textarea>
                    <label for="detalle" class="labelDescripcion">Descripción del Producto*</label>
                </div>


                <!-- precio -->
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio aproximado*</label>
                    <input class="form-control" name="precio" id="precio" type="number" step="0.01" value="<?php echo $recorrerEditar['precio'] ?>" required>
                </div>


                <!-- categoria producto -->
                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoria Producto*</label>


                    <select class="form-select " name="categoria" id="categoria" required>

                        <?php

                        // CONSULTA CATEGORIA TATUAJES
                        $queryCategoriaProducto = mysqli_query($conn, "SELECT * FROM categoria_producto");

                        while ($rowCategoriaProducto = mysqli_fetch_array($queryCategoriaProducto)) {
                        ?>
                            <option value="<?php echo $rowCategoriaProducto['id_categoria_producto'] ?>"><?php echo $rowCategoriaProducto['nombre'] ?></option>
                        <?php
                        }

                        ?>
                        <option selected value="<?php echo $recorrerEditar['fk_id_categoria_producto'] ?>"><?php echo $recorrerEditar['nombreCategoria'] ?></option>





                    </select>
                </div>


                <div id="contenedorDatosVacios"></div>


                <div class="mb-3">
                    <input class="form-control botonEditar" name="editar" type="submit" value="Editar">
                </div>

            </form>

        </div>

    </main>


    <!-- ALERTA PERSONALIZADA -->
    <script src="../alertaPersonalizada.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>



    <script>
        // mostrar/ocultar spiner
        function mostrarLoader(toggleMostrar) {

            // obtener datos
            var contenedorLoaderMain = document.getElementById('contenedorLoaderMain')
            var spinerMain = document.getElementById('spinerMain')

            if (toggleMostrar == "mostrar") {

                window.scrollTo(0, 0)

                // mostrar el spiner
                contenedorLoaderMain.classList.add('loaderMain')
                spinerMain.classList.add('maze-3')

                // desactivar el scroll
                document.getElementsByTagName("html")[0].style.overflow = "hidden";

            } else {

                window.scrollTo(0, 0)


                // oculatar el spiner
                contenedorLoaderMain.classList.remove('loaderMain')
                spinerMain.classList.remove('maze-3')

                // desactivar el scroll
                document.getElementsByTagName("html")[0].style.overflow = "auto";
            }
        }


        // obtener datos 
        var id_producto = <?php echo $recorrerEditar['id_producto'] ?>;
        var formulario = document.getElementById('formulario')
        var contenedorDatosVacios = document.getElementById('contenedorDatosVacios')


        formulario.addEventListener('submit', function(e) {

            e.preventDefault()

            // mostrar el loader
            mostrarLoader('mostrar')

            let formdata = new FormData(formulario)

            formdata.append('id_producto', id_producto)

            fetch('./queryInsertarPruducto.php', {
                    method: 'POST',
                    body: formdata
                })
                .then(res => res.json())
                .then(e => {


                    // mensaje datos vacios
                    if (e.mensaje == 'Datos vacios') {

                        alertaPersonalizada('ERROR', 'Datos vacios', 'info', 'Regresar', 'no')

                        return
                    }


                    // si todo sale bien
                    if (e.mensaje == 'ok') {

                        alertaPersonalizada('CORRECTO', 'Actualizado Correctamente', 'success', 'Regresar', 'si')

                    }


                })
                .catch(error => console.log('ERRROOOORRR PTM', error))
                .finally(_ => {
                    mostrarLoader('ocultar')
                })
        })


        // Eliminar Imagen
        const eliminarImagen = id_imagen => {

            let FD = new FormData();
            FD.append('id_imagen', id_imagen)

            fetch('./queryEliminarImagenProducto.php', {
                    method: 'POST',
                    body: FD
                })
                .then(res => res.json())
                .then(e => {

                    if (e.mensaje !== 'ok') {
                        alertaPersonalizada('ERROR', 'Algo salió mal, recarga la página y vuelve a intentar', 'error', 'Regresar', 'no')
                        return
                    }


                    if (e.mensaje === 'ok') {
                        alertaPersonalizada('CORRECTO', 'Eliminado Correctamente', 'success', 'Regresar', 'si')

                    }
                })
        }
    </script>
</body>

</html>