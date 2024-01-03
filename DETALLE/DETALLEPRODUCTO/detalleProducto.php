<?php
if (!isset($_REQUEST['producto'])) {
    header('Location: ../../index.php');
    die();
}

include('../../conexion.php');

$id_producto = $_REQUEST['producto'];


$queryProducto = mysqli_query($conn, "SELECT pro.*, cat.nombre categoria FROM productos pro
INNER JOIN categoria_producto cat
ON cat.id_categoria_producto = pro.fk_id_categoria_producto 
WHERE id_producto = '$id_producto' ");
$recorrerProducto = mysqli_fetch_array($queryProducto);

// query imagenes
$queryImagen = mysqli_query($conn, "SELECT * FROM imagenes_producto WHERE fk_id_productos  = '$id_producto' ");



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0C0C0C">
    <link rel="icon" type="image/png" href="../../imagenes/logoTattoo.ico">


    <!-- Fuente Dosis -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


    <!-- animacion -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


    <link rel="stylesheet" href="../../estiloHeader.css">
    <link rel="stylesheet" href="../../defecto.css">

    <link rel="stylesheet" href="estiloDetalleProducto.css">
    <title>Detalle Producto</title>
</head>

<body>


    <header class="header" id="header">

        <div class="contenedorLogo"> <a href="../../index.php"> <img src="../../imagenes/logoTattoo.webp" alt=""> </a> </div>

        <nav class="nav" id="nav">
            <ul>
                <li id="liNav"><a href="../../index.php">Inicio</a> </li>
                <li id="liNav" id="nosotrps"><a href="../../index.php#sobreNosotros">Nosotros</a> </li>
                <li id="liNav" class="active"><a href="../../VERTODO/VERTODOPRODUCTO/vertodoProducto.php">Tienda</a> </li>
                <li id="liNav"><a href="../../index.php#horarios">Citas</a> </li>
                <li id="liNav"><a href="../../index.php#contacto">Contacto</a> </li>
                <li id="cotizar liNav">
                    <a href="https://wa.me/<?php echo $telefono ?>?text=Deseo cotizar un tatuaje en su estudio" target="_blank">
                        Cotizar
                    </a>
                </li>
            </ul>
        </nav>

        <div class="contenedorBar" id="bar" onclick="barFuncion()">
            <img src="../../imagenes/iconos/bar.png" alt="" id="imagenBar">
            <img src="../../imagenes/iconos/close.png" alt="" id="imagenBarClose" style="display: none;">
        </div>

    </header>



    <main class="main ">


        <section class="seccionProducto">

            <!-- IMAGEN PRODUCTO -->
            <div id="carouselExampleIndicators" class="carousel slide" style="width:360px ; margin-right: 1rem;">

                <!-- INDICADORES -->
                <div class="carousel-indicators">

                    <?php
                    for ($i = 0; $i < mysqli_num_rows($queryImagen); $i++) {
                    ?>

                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $i ?>" class="<?php echo $i == 0 ? 'active' : '' ?>" aria-current="true" aria-label="Slide <?php echo $i + 1 ?>"></button>

                    <?php
                    }

                    ?>

                </div>

                <!-- IMAGENES -->
                <div class="carousel-inner">

                    <?php

                    $contador = 0;
                    while ($row = mysqli_fetch_assoc($queryImagen)) {
                        $contador += 1;

                    ?>

                        <div class="carousel-item <?php echo $contador - 1  == 0 ? 'active' : '' ?>">
                            <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($row['imagen']) ?>" class="d-block w-100" alt="<?php echo $recorrerProducto['nombre'] ?>">

                            <!-- imagen agotado -->
                            <?php
                            if ($recorrerProducto['agotado']) {
                            ?>
                                <div class="contenedorImagenAgotado" style="position: absolute; bottom: 3rem; width: 100%; display: flex; justify-content: center;"><img src="../../imagenes/iconos/agotado.png" alt=""></div>
                            <?php
                            }
                            ?>
                        </div>

                    <?php
                    }

                    ?>


                </div>

                <!-- BOTONES -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

            </div>


            <!-- DETALLE PRDOCUTO -->
            <div class="contenedorTexto">

                <h1><?php echo $recorrerProducto['nombre'] ?></h1>
                <hr>

                <span class="precio">$<?php echo $recorrerProducto['precio'] ?></span>

                <div class="contenedorDetalle">
                    <p>
                        <?php echo $recorrerProducto['descripcion'] ?>
                    </p>
                </div>

                <button onclick="enviarWhatsapp('<?php echo $recorrerProducto['nombre'] ?>', '<?php echo $recorrerProducto['precio'] ?>')">Adquirir <img src="../../imagenes/iconos/whatsappAdquirir.png" width="20px" alt=""></button>
            </div>


        </section>


        <!-- productos  similares -->
        <section class="seccionTatuajesSimilares ">

            <hr>
            <span><b style="color: #FCBA0C;">Categoria:</b> <?php echo $recorrerProducto['categoria'] ?></span>

            <h2>Productos Similares</h2>


            <div class="contenedorTatuajesSimilares">
                <?php

                $id_categoria = $recorrerProducto['fk_id_categoria_producto'];
                $id_producto = $recorrerProducto['id_producto'];

                $queryProductoSimilares = mysqli_query($conn, "SELECT 
                pro.id_producto, 
                pro.nombre , 
                ima.imagen
                FROM productos pro
                INNER JOIN imagenes_producto ima
                ON pro.id_producto = ima.fk_id_productos
                WHERE fk_id_categoria_producto =  $id_categoria
                AND id_producto <> $id_producto
                GROUP BY id_producto
                ORDER BY pro.fecha DESC 
                LIMIT 5");

                while ($recorrerProductoSimilar = mysqli_fetch_array($queryProductoSimilares)) {

                ?>
                    <a href="?producto=<?php echo $recorrerProductoSimilar['id_producto'] ?>" class="contenedorImagenTatuajeSimilar"> <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($recorrerProductoSimilar['imagen']) ?>" alt="<?php echo $recorrerProductoSimilar['nombre'] ?>"> </a>

                <?php
                }
                ?>


            </div>

        </section>

    </main>



    <!-- Js  Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script src="../../validacionFormularioBoostrap.js"></script>

    <!-- js animacion -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <script src="../../logicaHeader.js"></script>


    <script>
        // IR A WHASTAPP
        const enviarWhatsapp = (mensaje, precio) => {
            window.open(`https://wa.me/<?php echo $telefono ?>?text=Deseo adquirir el producto '${mensaje}' `, '_blank')
        }
    </script>
</body>

</html>