<?php
include('../conexion.php');

$queryTodosTattos = mysqli_query($conn, "SELECT * FROM datos_tattoo ");
while (mysqli_next_result($conn)) {;
}
$n_r_datosTattoos = mysqli_num_rows($queryTodosTattos);


// DATOS PARA LA PAGINACION
$pagina = isset($_REQUEST['pagina']) ? $_REQUEST['pagina'] : 1;

$limite = 10;
$totalPagina = ceil($n_r_datosTattoos / $limite);
$desde = ($pagina - 1) * $limite;

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0C0C0C">
    <link rel="icon" type="image/png" href="../imagenes/logoTattoo.ico">


    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


    <!-- animacion -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


    <!-- Fuente Dosis -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../defecto.css">
    <link rel="stylesheet" href="../estiloHeader.css">
    <link rel="stylesheet" href="./estiloVerTodo.css">
    <title>Todo Tattoos</title>
</head>

<body>

    <header class="header" id="header">

        <div class="contenedorLogo"> <a href="../index.php"> <img src="../imagenes/logoTattoo.webp" alt=""> </a> </div>

        <nav class="nav" id="nav">
            <ul>
                <li id="liNav"><a href="../index.php">Inicio</a> </li>
                <li id="liNav" id="nosotrps"><a href="../index.php#sobreNosotros">Nosotros</a> </li>
                <li id="liNav"><a href="./VERTODOPRODUCTO/vertodoProducto.php">Tienda</a> </li>
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

        <h1>Tattos (<?php echo $n_r_datosTattoos ?>)</h1>


        <div class="contenedorGrid">


            <?php

            $queryTodosTattosLiminte = mysqli_query($conn, "SELECT 
            im_ta.imagen, 
            im_ta.fk_id_datos_tattoo ,
            dat_ta.nombre
            FROM imagenes_tatuajes im_ta
            INNER JOIN datos_tattoo dat_ta
            ON dat_ta.id_datos_tattoo = im_ta.fk_id_datos_tattoo
            GROUP BY dat_ta.id_datos_tattoo
            ORDER BY dat_ta.fecha_tattoo DESC
            LIMIT $desde, $limite");

            while ($recorrerTattoo = mysqli_fetch_array($queryTodosTattosLiminte)) {
            ?>
                <a href="../DETALLE/detalleTattoo.php?tattoo=<?php echo $recorrerTattoo['fk_id_datos_tattoo'] ?>" class="carta">
                    <div class="contenedorImagen"> <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($recorrerTattoo['imagen']) ?>" alt="<?php echo $recorrerTattoo['nombre'] ?>"></div>
                    <div class="contenedortexto"> <span><?php echo $recorrerTattoo['nombre'] ?></span> </div>
                </a>
            <?php
            }

            ?>






        </div>


        <!-- PAGINACION -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">

                <?php

                $i = 0;
                $limitePaginacion = 7;
                for ($i; $i < $totalPagina; $i++) {

                    if ($i + 1 <= $limitePaginacion) {
                ?>
                        <li class="page-item <?php if ($i + 1 == $pagina) echo "active" ?>"><a class="page-link" href="?pagina=<?php echo $i + 1 ?>"><?php echo $i + 1 ?></a></li>
                <?php
                    }
                }

                ?>

                <li class="page-item <?php if ($pagina >= $i) echo 'disabled' ?>">
                    <a class="page-link" href="?pagina=<?php echo $pagina + 1 ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </main>

    <!-- Js  Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script src="../evitarReenvioFormulario.js"></script>


    <!-- js animacion -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <script src="../logicaHeader.js"></script>
</body>

</html>