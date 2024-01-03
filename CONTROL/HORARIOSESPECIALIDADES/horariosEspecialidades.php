<?php

session_start();

if (!isset($_SESSION['entrar'])) {
    header('Location: ../../index.php');
    die();
}


include('../../conexion.php');

// CONSULTA HORARIO Y ESPECUIALIDAD
$queryHorario = mysqli_query($conn, "SELECT * FROM horario");
while (mysqli_next_result($conn)) {;
}
$recorrerrHorario = mysqli_fetch_array($queryHorario);


$queryEspecialidad = mysqli_query($conn, "SELECT * FROM especialidad");
while (mysqli_next_result($conn)) {;
}
$recorrerrEspecialidad = mysqli_fetch_array($queryEspecialidad);


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
    <link rel="stylesheet" href="../../estiloSpiner.css">
    <link rel="stylesheet" href="estiloHorariosEspecialidades.css">
    <title>Horario / Especialidades</title>
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
                        <a class="nav-link" href="">Horarios/Especialidades</a>
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


    <main class="main">

        <div class="contenedorMain">

            <!-- CONTENEDOR HORARIO -->
            <div class="contenedorHorario">

                <div class="contenedorImprimirHorario" id="contenedorImprimirHorario">

                    <?php
                    if ($recorrerrHorario['parrafo'] != '') {
                    ?>
                        <p><?php echo $recorrerrHorario['parrafo'] ?></p>

                        <ul>
                            <li>Lunes: <?php echo $recorrerrHorario['lunes'] ?></li>
                            <li>Martes: <?php echo $recorrerrHorario['martes'] ?> </li>
                            <li>Miercoles: <?php echo $recorrerrHorario['miercoles'] ?> </li>
                            <li>Jueves: <?php echo $recorrerrHorario['jueves'] ?> </li>
                            <li>Viernes: <?php echo $recorrerrHorario['viernes'] ?> </li>
                            <li>Sabado: <?php echo $recorrerrHorario['sabado'] ?> </li>
                            <li class="domingo">Domingo: <?php echo $recorrerrHorario['domingo'] ?> </li>
                        </ul>
                    <?php
                    }


                    ?>
                </div>



                <div class="contenedorFormulario">

                    <form id="formularioHorario" class="formulario  needs-validation" novalidate>

                        <h1>Horarios</h1>
                        <hr>

                        <div class="mb-3">
                            <textarea class="form-control" id="parrafo" name="parrafo" rows="3" placeholder="Parrafo" required><?php echo $recorrerrHorario['parrafo'] ?></textarea>
                        </div>

                        <div class="mb-3 input-group has-validation">
                            <input type="text" class="form-control mb-2 inputHorario" id="lunes" name="lunes" placeholder="Horario Lunes" value="<?php echo $recorrerrHorario['lunes'] ?>" required>
                            <input type="text" class="form-control mb-2 inputHorario" id="martes" name="martes" placeholder="Horario Martes" value="<?php echo $recorrerrHorario['martes'] ?>" required>
                            <input type="text" class="form-control mb-2 inputHorario" id="miercoles" name="miercoles" placeholder="Horario Miercoles" value="<?php echo $recorrerrHorario['miercoles'] ?>" required>
                            <input type="text" class="form-control mb-2 inputHorario" id="jueves" name="jueves" placeholder="Horario Jueves" value="<?php echo $recorrerrHorario['jueves'] ?>" required>
                            <input type="text" class="form-control mb-2 inputHorario" id="viernes" name="viernes" placeholder="Horario Viernes" value="<?php echo $recorrerrHorario['viernes'] ?>" required>
                            <input type="text" class="form-control mb-2 inputHorario" id="sabado" name="sabado" placeholder="Horario Sabado" value="<?php echo $recorrerrHorario['sabado'] ?>" required>
                            <input type="text" class="form-control mb-2 inputHorario horarioDomingo" id="domingo" name="domingo" placeholder="Horario Domingo" value="<?php echo $recorrerrHorario['domingo'] ?>" required>

                            <div class="invalid-feedback">
                                Por favor Completa todos los campos
                            </div>
                        </div>

                        <div class="mb-3">
                            <input type="submit" class="form-control botonGuardar" id="enviar" value="Guardar Horario">
                        </div>
                    </form>


                </div>

            </div>


            <!-- CONTENEDOR ESPECIALIDADES -->
            <div class="contenedorEspecialidades">

                <!-- FORMULARIO ESPECIALIDAD -->
                <div class="contenedorFormulario">

                    <form id="formularioEspecialidad" class="formulario needs-validation" novalidate>

                        <h1>Especialidades</h1>
                        <hr>

                        <div class="mb-3">
                            <textarea class="form-control" id="parrafo" name="parrafoEspecialidad" rows="3" placeholder="Parrafo Especialidades" required><?php echo $recorrerrEspecialidad['parrafo'] ?></textarea>
                        </div>

                        <div class="mb-3 input-group has-validation">
                            <input type="text" class="form-control mb-2 inputHorario" id="especialidad1" name="especialidad1" placeholder="Especialidad 1" value="<?php echo $recorrerrEspecialidad['especialidad_1'] ?>" required>
                            <input type="text" class="form-control mb-2 inputHorario" id="especialidad2" name="especialidad2" placeholder="Especialidad 2" value="<?php echo $recorrerrEspecialidad['especialidad_2'] ?>" required>
                            <input type="text" class="form-control mb-2 inputHorario" id="especialidad3" name="especialidad3" placeholder="Especialidad 3" value="<?php echo $recorrerrEspecialidad['especialidad_3'] ?>" required>

                            <div class="invalid-feedback">
                                Por favor Completa todos los campos
                            </div>

                        </div>


                        <div class="mb-3">
                            <input type="submit" class="form-control botonGuardar" value="Guardar Especialidad" name="botonEspecialidad" id="guardarEspecialidad">
                        </div>
                    </form>

                </div>


                <div class="contenedorImprimirEspecialidades" id="contenedorImprimirEspecialidades">

                    <?php

                    if ($recorrerrEspecialidad['parrafo'] != '') {
                    ?>
                        <p><?php echo $recorrerrEspecialidad['parrafo'] ?></p>
                        <ul>
                            <li><?php echo $recorrerrEspecialidad['especialidad_1'] ?></li>
                            <li><?php echo $recorrerrEspecialidad['especialidad_2'] ?></li>
                            <li><?php echo $recorrerrEspecialidad['especialidad_3'] ?></li>
                        </ul>
                    <?php
                    }


                    ?>

                </div>


            </div>


        </div>

    </main>






    <!-- Js  Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script src="../../evitarReenvioFormulario.js"></script>

    <script src="../../validacionFormularioBoostrap.js"></script>

    <!-- ALERTA PERSONALIZADA -->
    <script src="../../alertaPersonalizada.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- js animacion -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>




    <script>
        // DATOS GLOBALES

        // datos horario
        var formularioHorario = document.getElementById('formularioHorario')
        var contenedorImprimirHorario = document.getElementById('contenedorImprimirHorario')


        // datos especialidades
        var formularioEspecialidad = document.getElementById('formularioEspecialidad')
        var contenedorImprimirEspecialidades = document.getElementById('contenedorImprimirEspecialidades')


        // cuando se haga submit en el formulario horario
        formularioHorario.addEventListener('submit', function(e) {

            e.preventDefault()

            let formdata = new FormData(formularioHorario)

            fetch('./insertarHorarioEspecialidades.php', {
                    method: 'POST',
                    body: formdata
                })
                .then(res => res.json())
                .then(e => {

                    if (e.mensaje == 'Datos vacios') {
                        alert(e.mensaje)
                        return
                    }

                    if (e.mensaje == 'Datos editados Horario') {

                        contenedorImprimirHorario.innerHTML = `
                        <p>${formdata.get('parrafo')}</p>
                        
                        <ul>
                            <li>Lunes: ${formdata.get('lunes')}</li>
                            <li>Martes: ${formdata.get('martes')}</li>
                            <li>Miercoles: ${formdata.get('miercoles')}</li>
                            <li>Jueves: ${formdata.get('jueves')}</li>
                            <li>Viernes: ${formdata.get('viernes')}</li>
                            <li>Sabado: ${formdata.get('sabado')}</li>
                            <li class="domingo">Domingo: ${formdata.get('domingo')}</li>
                        </ul>
                    `

                        alertaPersonalizada('CORRECTO', 'Horario Editado Correctamente', 'success', 'Regresar', 'no')

                    } else {
                        alertaPersonalizada('ERROR', 'Algo salio mal', 'error', 'Regresar', 'no')

                    }
                })
        })



        // cuando se haga submit en el formulario especialidades
        formularioEspecialidad.addEventListener('submit', function(e) {

            e.preventDefault()

            let formdataEspecialidad = new FormData(formularioEspecialidad)
            formdataEspecialidad.append('botonEspecialidad', 1)



            fetch('./insertarHorarioEspecialidades.php', {
                    method: 'POST',
                    body: formdataEspecialidad
                })
                .then(res => res.json())
                .then(e => {

                    // datos vacios
                    if (e.mensaje == 'Datos vacios') {
                        alert(e.mensaje)
                        return
                    }

                    // si todo sale bien
                    if (e.mensaje == 'Datos editados Especialidad') {

                        contenedorImprimirEspecialidades.innerHTML = `
                        <p>${formdataEspecialidad.get('parrafoEspecialidad')}</p>
                        <ul>
                            <li>${formdataEspecialidad.get('especialidad1')}</li>
                            <li>${formdataEspecialidad.get('especialidad2')}</li>
                            <li>${formdataEspecialidad.get('especialidad3')}</li>
                        </ul>
                    
                    `

                        alertaPersonalizada('CORRECTO', 'Especialidad Editado Correctamente', 'success', 'Regresar', 'no')

                    } else if (e.mensaje == 'Error editar Especialidad') {
                        alertaPersonalizada('ERROR', 'Algo salio mal', 'error', 'Regresar', 'no')
                    }

                })
                .catch(error => console.error('ERROR ptm: ', error))
                .finally(_ => {

                })
        })
    </script>
</body>

</html>