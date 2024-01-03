<?php

include('../../conexion.php');

$queryTodoProductoSinLimite = mysqli_query($conn, "SELECT * FROM productos ");
while (mysqli_next_result($conn)) {;
}

// PAGINACION
$limite = 10;
if (empty($_REQUEST['pagina'])) {
    $pagina = 1;
} else {
    $pagina = $_REQUEST['pagina'];
}

$totalProductos = mysqli_num_rows($queryTodoProductoSinLimite);
$totalPaginas = ceil($totalProductos / $limite);
$desde = ($pagina - 1) * $limite;



$queryTodoProducto = mysqli_query($conn, "SELECT 
pro.id_producto, 
pro.nombre , 
pro.precio , 
ima.imagen
FROM productos pro
INNER JOIN imagenes_producto ima
ON pro.id_producto = ima.fk_id_productos
GROUP BY id_producto
ORDER BY pro.fecha DESC 
LIMIT $desde,$limite");
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


    <link rel="stylesheet" href="../../defecto.css">
    <link rel="stylesheet" href="../../estiloHeader.css">
    <link rel="stylesheet" href="estiloTodoProducto.css">

    <title>Todo Producto</title>
</head>

<body>

    <header class="header" id="header">

        <div class="contenedorLogo" id="contenedorLogo"> <a href="#"> <img src="../../imagenes/logoTattoo.webp" alt=""> </a> </div>

        <nav class="nav" id="nav">
            <ul>
                <li id="liNav"><a href="../../index.php">Inicio</a> </li>
                <li id="liNav" id="nosotrps"><a href="../../index.php#sobreNosotros">Nosotros</a> </li>
                <li id="liNav" class="active"><a>Tienda</a> </li>
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


    <main class="main">

        <h1>Todos los productos</h1>
        <hr>

        <div class="contenedorGrid">

            <?php
            while ($recorrerProducto = mysqli_fetch_array($queryTodoProducto)) {
            ?>
                <div class="cartaProducto">

                    <a href="../../DETALLE/DETALLEPRODUCTO/detalleProducto.php?producto=<?php echo $recorrerProducto['id_producto'] ?>" class="contenendorImagen"><img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($recorrerProducto['imagen']) ?>" alt="<?php echo $recorrerProducto['nombre'] ?>"></a>

                    <div class="contenedorTexto">

                        <div class="contenedorTituloPrecio">
                            <span class="titulo"><?php echo $recorrerProducto['nombre'] ?></span>
                            <span class="precio">$<?php echo $recorrerProducto['precio'] ?></span>
                        </div>

                        <button onclick="enviarWhatsapp('<?php echo $recorrerProducto['nombre'] ?>')">Adquirir <img src="../../imagenes/iconos/whatsappAdquirir.png" width="20px" alt=""></button>
                    </div>
                </div>
            <?php

            }

            ?>


        </div>

        <!-- PAGINACION -->
        <div class="paginacion">
            <nav aria-label="Page navigation example">
                <ul class="pagination">

                    <?php
                    $i = 0;
                    $limiteFor = 2;
                    for ($i; $i < $totalPaginas; $i++) {
                        if ($i < $limiteFor) {
                    ?>
                            <li class="page-item <?php if ($i + 1 == $pagina) echo 'active' ?>"><a class="page-link" href="?pagina=<?php echo $i + 1 ?>"><?php echo $i + 1 ?></a></li>

                    <?php
                        }
                    }


                    ?>

                    <li class="page-item <?php if ($pagina >= $i) echo 'active' ?>"><a class="page-link">-<?php echo $pagina ?>-</a></li>



                    <li class="page-item <?php if ($pagina >= $i) echo 'disabled' ?>">
                        <a class="page-link" href="?pagina=<?php echo $pagina + 1 ?>" aria-label="Next">
                            <span aria-hidden="true" style="color: #424242;">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
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
            window.open(`https://wa.me/<?php echo $telefono ?>?text=Deseo adquirir el producto '${mensaje}'`, '_blank')
        }
    </script>
</body>

</html>