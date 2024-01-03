<?php
include('../conexion.php');

// consulta datos tattoo
$id_tattoo = $_REQUEST['tattoo'];

$queryDatosTattoo = mysqli_query($conn, "SELECT * FROM datos_tattoo WHERE id_datos_tattoo = '$id_tattoo' ");
$recorrerDatosTattoo = mysqli_fetch_array($queryDatosTattoo);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0C0C0C">
    <link rel="icon" type="image/png" href="../imagenes/logoTattoo.ico">


    <!-- Fuente Dosis -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


    <!-- animacion -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


    <link rel="stylesheet" href="../estiloHeader.css">
    <link rel="stylesheet" href="../defecto.css">
    <link rel="stylesheet" href="./estiloDetalle.css">

    <title>Detalle Tattoo</title>
</head>

<body>

    <header class="header" id="header">

        <div class="contenedorLogo"> <a href="#"> <img src="../imagenes/logoTattoo.webp" alt=""> </a> </div>

        <nav class="nav" id="nav">
            <ul>
                <li id="liNav"><a href="../index.php">Inicio</a> </li>
                <li id="liNav" id="nosotrps"><a href="../index.php#sobreNosotros">Nosotros</a> </li>
                <li id="liNav"><a href="../VERTODO/VERTODOPRODUCTO/vertodoProducto.php">Tienda</a> </li>
                <li id="liNav"><a href="../index.php#horarios">Citas</a> </li>
                <li id="liNav"><a href="../index.php#contacto">Contacto</a> </li>
                <li id="cotizar liNav">
                    <a href="https://wa.me/<?php echo $telefono ?>?text=Deseo cotizar un tatuaje en su estudio" target="_blank">
                        Cotizar
                    </a>
                </li>
            </ul>
        </nav>

        <div class="contenedorBar" id="bar" onclick="barFuncion()">
            <img src="../imagenes/iconos/bar.png" alt="" id="imagenBar">
            <img src="../imagenes/iconos/close.png" alt="" id="imagenBarClose" style="display: none;">
        </div>

    </header>

    <main class="main">

        <section class="seccionDetalleTattool">

            <div class="contenedorImg"><img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($recorrerDatosTattoo['imagen']) ?>" alt="<?php echo $recorrerDatosTattoo['nombre'] ?>"></div>

            <div class="contenedorTexto">
                <h1><?php echo $recorrerDatosTattoo['nombre'] ?></h1>
                <p>
                    <?php echo $recorrerDatosTattoo['detalle'] ?>
                </p>
                <ul>
                    <li>Sesiones: &nbsp <b><?php echo $recorrerDatosTattoo['sesiones'] ?></b></li>
                    <li>Horas por sesiones: &nbsp <b><?php echo $recorrerDatosTattoo['horas_sesiones'] ?></b></li>
                </ul>
                <span class="textoPrecio">Precio aproximado</span><br>
                <span class="precio">$<?php echo $recorrerDatosTattoo['precio_aproximado'] ?></span>
            </div>
        </section>


        <!-- tatuajes similares -->
        <section class="seccionTatuajesSimilares">

            <hr>
            <h2>Tatuajes Similares</h2>


            <div class="contenedorTatuajesSimilares">
                <?php

                $id_categoria = $recorrerDatosTattoo['fk_id_categoria_tatuaje'];
                $id_datos_tattoo = $recorrerDatosTattoo['id_datos_tattoo'];

                $queryTatuajesSimilares = mysqli_query($conn, "SELECT id_datos_tattoo, imagen,nombre FROM datos_tattoo WHERE fk_id_categoria_tatuaje =  $id_categoria AND id_datos_tattoo <> $id_datos_tattoo ORDER BY fecha_tattoo DESC LIMIT 5");

                while ($recorrerTatuajesSimilares = mysqli_fetch_array($queryTatuajesSimilares)) {
                ?>
                    <a href="../DETALLE/detalleTattoo.php?tattoo=<?php echo $recorrerTatuajesSimilares['id_datos_tattoo'] ?>" class="contenedorImagenTatuajeSimilar"> <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($recorrerTatuajesSimilares['imagen']) ?>" alt="<?php echo $recorrerTatuajesSimilares['nombre'] ?>"> </a>

                <?php
                }
                ?>


            </div>
        </section>

    </main>


    <!-- Js  Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script src="../validacionFormularioBoostrap.js"></script>

    <!-- js animacion -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <script src="../logicaHeader.js"></script>
</body>

</html>