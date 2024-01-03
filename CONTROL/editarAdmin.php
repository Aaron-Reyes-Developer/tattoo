<?php

session_start();

if (!isset($_SESSION['entrar'])) {
    header('Location: ../index.php');
    die();
}



include('../conexion.php');

// EDITAR
if (isset($_REQUEST['editar'])) {

    $editar = $_REQUEST['editar'];

    // mustra el dato de el tatuaje
    $queryDatosEditar = mysqli_query($conn, "SELECT dat.*, catu.nombre nombreCategoria FROM datos_tattoo  dat
    INNER JOIN categoria_tatuaje catu
    ON catu.id_categoria_tatuaje = dat.fk_id_categoria_tatuaje
    WHERE id_datos_tattoo = $editar");

    // muestra las imagenes de el tatuaje
    $queryImagen = mysqli_query($conn, "SELECT * FROM imagenes_tatuajes WHERE fk_id_datos_tattoo = $editar");

    $recorrerEditar = mysqli_fetch_array($queryDatosEditar);
}



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
    <link rel="stylesheet" href="../defecto.css">
    <link rel="stylesheet" href="./estiloEditar.css">
    <title>Editar</title>
</head>

<body>

    <div class="desctivadoLoaderMain" id="contenedorLoaderMain">
        <div id="spinerMain" class="desctivadoSpiner"></div>
    </div>


    <main class="main">

        <div class="contenedorImagen">

            <?php

            while ($recorrerImagen = mysqli_fetch_assoc($queryImagen)) {
            ?>
                <div class="carta">
                    <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($recorrerImagen['imagen']) ?>" alt="">
                    <a class="eliminar" onclick="eliminarImagen(<?php echo $recorrerImagen['id_imagenes_tatuajes'] ?>)" >X</a>
                </div>
            <?php
            }


            ?>



        </div>


        <!-- FORMULARIO -->
        <div class="contenedorFormulario">

            <form class="formulario" id="formulario">

                <h1>Editar Tatuaje</h1>

                <hr>

                <div class="contenedorDatoVacios" id="contenedorDatoVacios"> </div>


                <!-- imagen -->
                <div class="mb-3">

                    <label for="imagen" class="form-label">Subir Imagenes nuevas (jpg/png/webp) <br> <span class="menajeNoEditarImagen"></span> </label>
                    <input type="file" name="imagenes[]" id="imagen" class="form-control" accept=".jpg, .webp, .png, .jpeg" multiple>

                </div>


                <!-- titulo -->
                <div class="mb-3">
                    <label for="tituloTattoo" class="form-label">Titulo del Tattoo</label>
                    <input class="form-control" name="tituloTattoo" id="tituloTattoo" type="text" value="<?php echo $recorrerEditar['nombre'] ?>">
                </div>


                <!-- descripcion -->
                <div class="form-floating mb-3">
                    <textarea class="form-control" name="descripcionTattoo" id="descripcionTattoo" placeholder="Detalle aqui" style="height: 100px"><?php echo $recorrerEditar['detalle'] ?></textarea>
                    <label for="descripcionTattoo" class="labelDescripcion">Descripción de el tattoo</label>
                </div>


                <!-- sesiones -->
                <div class="mb-3">
                    <label for="sesionesTattoo" class="form-label">Total de Sesiones</label>
                    <input class="form-control" name="sesionesTattoo" id="sesionesTattoo" type="number" value="<?php echo $recorrerEditar['sesiones'] ?>">
                </div>


                <!-- horas por sesiones -->
                <div class="mb-3">
                    <label for="horasTattoo" class="form-label">Horas por Sesiones</label>
                    <input class="form-control" name="horasTattoo" id="horasTattoo" type="number" value="<?php echo $recorrerEditar['horas_sesiones'] ?>">
                </div>


                <!-- precio -->
                <div class="mb-3">
                    <label for="precioTattoo" class="form-label">Precio aproximado</label>
                    <input class="form-control" name="precioTattoo" id="precioTattoo" type="number" step="0.01" value="<?php echo $recorrerEditar['precio_aproximado'] ?>">
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
                        <option selected value="<?php echo $recorrerEditar['fk_id_categoria_tatuaje'] ?>"><?php echo $recorrerEditar['nombreCategoria'] ?></option>





                    </select>
                </div>


                <!-- checkbox -->
                <div class="form-check mb-3">
                    <label class="form-check-label" for="checkbox"> Poner como cabecera </label>
                    <input class="form-check-input" name="checkbox" id="checkbox" type="checkbox" <?php if ($recorrerEditar['en_cabecera'] == 1) echo 'checked' ?>>
                </div>




                <div class="mb-3">
                    <input class="form-control botonEditar" name="editar" type="submit" value="Editar">
                </div>
            </form>

        </div>

    </main>


    <!-- ALERTA PERSONALIZADA -->
    <script src="./alertaPersonalizada.js"></script>
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
        var id_tattoo = <?php echo $recorrerEditar['id_datos_tattoo'] ?>;
        var formulario = document.getElementById('formulario')
        var contenedorDatoVacios = document.getElementById('contenedorDatoVacios')


        // CUNADO SE ENVIE LOS DATOS
        formulario.addEventListener('submit', function(e) {

            e.preventDefault()

            let formdata = new FormData(formulario)

            formdata.append('id_tattoo', id_tattoo)

            fetch('./insertarTatuajeAdmin.php', {
                    method: 'POST',
                    body: formdata
                })
                .then(res => res.json())
                .then(e => {


                    // mensaje datos vacios
                    if (e.mensaje == 'Datos vacios') {

                        contenedorDatoVacios.innerHTML = `
                            <div class="alert alert-danger" role="alert">
                                Datos Vacios
                            </div>
                        `
                        return
                    }


                    // si todo sale bien
                    if (e.mensaje == 'ok') {

                        alertaPersonalizada('CORRECTO', 'Editado Correctamente', 'success', 'Regresar', 'si')

                    }


                })
                .catch(error => console.log('ERRROOOORRR', error))
                .finally(_ => {

                })
        })


        // Eliminar Imagen
        const eliminarImagen = id_imagen => {

            let FD = new FormData();
            FD.append('id_imagen', id_imagen)

            fetch('./queryEliminarImagen.php', {
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