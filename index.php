<?php
include('./conexion.php');


?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0C0C0C">
    <link rel="icon" type="image/png" href="./imagenes/logoTattoo.ico">
    <meta name="description" content="Explora nuestra galería de tatuajes impresionantes y creativos. Desde tatuajes en blanco y negro hasta diseños vibrantes de estilo acuarela, tenemos opciones para todos los gustos. Nuestros artistas del tatuaje expertos te ayudarán a transformar tu visión en arte corporal único. ¡Reserva tu cita hoy para obtener el tatuaje de tus sueños!">


    <!-- Fuente Dosis -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


    <!-- animacion -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">



    <link rel="stylesheet" href="estiloIndex.css">
    <link rel="stylesheet" href="defecto.css">
    <link rel="stylesheet" href="estiloHeader.css">

    <title>Cierva Ink</title>
</head>

<body>

    <div class="page" data-scroll-container>


        <header class="header" id="header" data-scroll-section>

            <div class="contenedorLogo" id="contenedorLogo"> <a> <img src="./imagenes/logoTattoo.webp" alt="" title="logo empresa"> </a> </div>

            <nav class="nav" id="nav">
                <ul>
                    <li id="liNav" class="active"><a href="./index.php">Inicio</a> </li>
                    <li id="liNav" id="nosotrps"><a href="#sobreNosotros">Nosotros</a> </li>
                    <li id="liNav"><a href="./VERTODO/VERTODOPRODUCTO/vertodoProducto.php">Tienda</a> </li>
                    <li id="liNav"><a href="#horarios">Citas</a> </li>
                    <li id="liNav"><a href="#contacto">Contacto</a> </li>
                    <li id="cotizar liNav">
                        <a href="https://wa.me/<?php echo $telefono ?>?text=Deseo cotizar un tatuaje en su estudio" target="_blank">
                            Cotizar
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="contenedorBar" id="bar" onclick="barFuncion()">
                <img src="./imagenes/iconos/bar.png" alt="" id="imagenBar">
                <img src="./imagenes/iconos/close.png" alt="" id="imagenBarClose" style="display: none;">
            </div>

        </header>

        <main data-scroll-section>

            <div class="contenedorIrArriba" id="flechaIrArriba" data-scroll>
                <img src="./imagenes/iconos/flechaArriba.png" alt="">
            </div>


            <!-- PORTADA -->
            <div class="contenedorPortada" data-aos="fade-up" data-scroll>

                <h1> CIERVA INK • ESTUDIO </h1>
                <span>
                    Empresa de tatuajes experta en el <b> <strong>Arte</strong> <strong>Corporal</strong> </b>
                </span>

                <div class="rombo" id="rombo" onclick="irAbajo('portafolio')"></div>

            </div>


            <!-- PORTAFOLIO -->
            <section class="seccionPortafolio container" id="portafolio" data-scroll>

                <div class="contenedorTituloPortafolio">
                    <h2>PORTAFOLIO</h2>
                    <a href="./VERTODO/verTodo.php">Ver todo...</a>
                </div>

                <div class="grid">

                    <?php

                    // mostrar fotos
                    $queryMostrarFotos = mysqli_query($conn, "SELECT 
                    im_ta.imagen, 
                    im_ta.fk_id_datos_tattoo,
                    dat_ta.nombre
                    FROM imagenes_tatuajes im_ta
                    INNER JOIN datos_tattoo dat_ta
                    ON dat_ta.id_datos_tattoo = im_ta.fk_id_datos_tattoo
                    WHERE dat_ta.en_cabecera = 1
                    GROUP BY dat_ta.id_datos_tattoo
                    ORDER BY dat_ta.fecha_tattoo DESC LIMIT 8 ");

                    // mostrar las fotos
                    while ($recorrerFotos = mysqli_fetch_array($queryMostrarFotos)) {
                    ?>

                        <div class="cartaPortafolio" data-aos="fade-up">
                            <a href="./DETALLE/detalleTattoo.php?tattoo=<?php echo $recorrerFotos['fk_id_datos_tattoo'] ?>">
                                <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($recorrerFotos['imagen']) ?>" alt="<?php echo $recorrerFotos['nombre'] ?>">
                            </a>
                        </div>
                    <?php
                    }

                    ?>





                </div>

            </section>


            <!-- SOBRE NOSOTROS -->
            <section class="seccionSobreNosotros container" id="sobreNosotros" data-aos="fade-up" data-scroll>

                <h2>SOBRE NOSOTROS</h2>

                <div class="contenedorTextoMaps">


                    <div class="contenedorTexto">
                        <p>
                            En CIERVA INK, fusionamos la pasión por el arte con la expresión
                            personal, convirtiendo cada tatuaje en una obra única y significativa.
                            Nuestro equipo de artistas talentosos está comprometido en plasmar tus
                            ideas y emociones en la piel, creando diseños que cuentan historias y
                            perduran en el tiempo.
                        </p>

                        <div class="contenedorLogosRedes">

                            <!-- whatsapp -->
                            <a target="_blank" href="https://wa.me/<?php echo $telefono ?>">
                                <img src="./imagenes/iconos/whatsappMax.webp" width="35px" alt="">
                            </a>

                            <!-- instagram -->
                            <a target="_blank" href="https://www.instagram.com/ciervaink.estudio/">
                                <img src="./imagenes/iconos/instagramMax.webp" width="35px" alt="">
                            </a>
                        </div>

                        <button onclick="agendarCitaWp()">Agendar Cita</button>
                    </div>


                    <div class="contenedorMaps">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3989.273686800299!2d-80.7334071!3d-0.9467127!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x902be16d63dde979%3A0x583a86515baaa7ec!2sCierva%20Ink%20Tattoo!5e0!3m2!1ses!2sec!4v1698208800217!5m2!1ses!2sec" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>



                </div>


            </section>


            <!-- ESPECIALIDADES -->
            <section class="seccionEspecialidades" id="especialidades" data-aos="fade-up" data-scroll>

                <div class="contenedorEspecialidades container">

                    <h2>ESPECIALIDADES</h2>

                    <div class="subContenedorEspecialidades">


                        <div class="contenedorIconosEspecialidades">
                            <img src="./imagenes/maquina-de-tatuar.webp" alt="Maquina de tatuar icono">
                            <img src="./imagenes/perforacion.webp" alt="Perforacion Icono">
                            <img src="./imagenes/tienda.webp" alt="Tienda icono">
                        </div>


                        <div class="conetenedorListaEspecialidades">
                            <?php
                            $queryEspecialidades = mysqli_query($conn, "SELECT * FROM especialidad");
                            $recorrerEspecialidad = mysqli_fetch_array($queryEspecialidades);
                            ?>
                            <p><?php echo $recorrerEspecialidad['parrafo'] ?></p>
                            <ul>
                                <li><strong><?php echo $recorrerEspecialidad['especialidad_1'] ?></strong></li>
                                <li><strong><?php echo $recorrerEspecialidad['especialidad_2'] ?></strong></li>
                                <li><strong><?php echo $recorrerEspecialidad['especialidad_3'] ?></strong></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </section>


            <!-- HORARIOS DE ATENCION -->
            <section class="seccionHorario container" id="horarios" data-aos="fade-up" data-scroll>

                <h2>HORARIOS DE ATENCIÓN</h2>

                <div class="subcontenedorHorarios">
                    <?php
                    $queryHorario = mysqli_query($conn, "SELECT * FROM horario");
                    $recorrerHorario = mysqli_fetch_array($queryHorario);
                    ?>

                    <ul>
                        <li>Lunes: <?php echo $recorrerHorario['lunes'] ?> </li>
                        <li>Martes: <?php echo $recorrerHorario['martes'] ?> </li>
                        <li>Miercoles: <?php echo $recorrerHorario['miercoles'] ?> </li>
                        <li>Jueves: <?php echo $recorrerHorario['jueves'] ?> </li>
                        <li>Viernes: <?php echo $recorrerHorario['viernes'] ?> </li>
                        <li>Sabado: <?php echo $recorrerHorario['sabado'] ?> </li>
                        <li style="color: rgb(255, 88, 88);">Domingo: <?php echo $recorrerHorario['domingo'] ?></li>
                    </ul>



                    <div class="contenedorAgendarCita">
                        <a href="https://wa.me/<?php echo $telefono ?>?text=Deseo cotizar un tatuaje en su estudio" target="_blank">Cotizar <img src="./imagenes/iconos/whatsappAdquirir.png" width="15px" alt=""></a>
                    </div>
                </div>

            </section>


            <!-- PRODUCTOS -->
            <section class="seccionProductos container" data-aos="fade-up" data-scroll>

                <div class="contenTituloProducto">
                    <h2>PRODUCTOS</h2>
                    <a href="./VERTODO/VERTODOPRODUCTO/vertodoProducto.php">Ver todo...</a>
                </div>


                <div class="contenedorProductos">

                    <?php
                    $queryProducto = mysqli_query($conn, "SELECT 
                    pro.id_producto, 
                    pro.nombre , 
                    pro.precio ,
                    pro.agotado, 
                    ima.imagen
                    FROM productos pro
                    INNER JOIN imagenes_producto ima
                    ON pro.id_producto = ima.fk_id_productos
                    GROUP BY id_producto
                    ORDER BY pro.fecha DESC 
                    LIMIT 6");

                    while ($recorrerProductos = mysqli_fetch_array($queryProducto)) {

                    ?>
                        <div class="cartaProducto">

                            <!-- imagen pproducto -->
                            <a href="./DETALLE/DETALLEPRODUCTO/detalleProducto.php?producto=<?php echo $recorrerProductos['id_producto'] ?>" class="contenedorImagenProducto">

                                <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($recorrerProductos['imagen']) ?>" alt="<?php echo $recorrerProductos['nombre'] ?>">

                                <!-- imagen agotado -->
                                <?php
                                if ($recorrerProductos['agotado']) {
                                ?>
                                    <div class="contenedorImagenAgotado"><img src="./imagenes/iconos/agotado.png" alt=""></div>
                                <?php
                                }
                                ?>

                            </a>


                            <div class="contenedorTextoProducto">

                                <div class="contenedorTituloProducto">
                                    <span><?php echo $recorrerProductos['nombre'] ?></span>
                                    <span class="precio">$<?php echo $recorrerProductos['precio'] ?></span>
                                </div>

                                <button onclick="enviarWhatsapp('<?php echo $recorrerProductos['nombre'] ?>','<?php echo $recorrerProductos['precio'] ?>')">Adquirir <img src="./imagenes/iconos/whatsappAdquirir.png" alt="" width="18px"></button>
                            </div>
                        </div>

                    <?php

                    }

                    ?>

                </div>


            </section>


            <!-- ESTADISTICAS -->
            <section id="seccionEstadistica" class="seccionEstadistica" data-aos="fade-up" data-scroll>

                <div class="contenedorEstadistica container">

                    <div class="anosExperiencia  subContenedorEstadistica">
                        <span class="numeroExperiencia numeroEstadistica numero" id="anosExperiencia" data-val="8"></span>
                        <span class="textoExperiencia textoEstadistica">Años de experiencia</span>
                    </div>


                    <div class="clientesAtendido subContenedorEstadistica">
                        <span class="numeroAtendido numeroEstadistica numero" data-val="50">>50</span>
                        <span class="textoAtendido textoEstadistica">Clientes atendidos </span>
                    </div>


                    <div class="colaboradores subContenedorEstadistica">
                        <span class="numeroColaboradores numeroEstadistica numero" data-val="4">4</span>
                        <span class="textoColaboradores textoEstadistica">Colaboradores</span>
                    </div>
                </div>

            </section>


            <!-- COLABORADORES -->
            <section class="seccionColaboradores container" data-scroll>


                <h2>COLABORADORES</h2>

                <div class="contenedorColaboradorGrid">


                    <div class="colaborador" data-aos="fade-up">
                        <div class="contenedorImagenColaborador"><img src="https://imagenes.elpais.com/resizer/6zpje8PQ5sGMj4kx-45mAMrkU2c=/1200x0/cloudfront-eu-central-1.images.arcpublishing.com/prisa/I4PZI3PSQBEX7JBAKXFS35BJZE.jpg" alt="Foto persona Tatuando"></div>
                        <hr>
                        <span class="nombreColaborador">Aaron Reyes</span>
                        <p class="fraseColaborador">
                            Lorem ipsum dolor sit amet consectetur,
                            adipisicing elit. Voluptatibus eaque,
                            sequi sit esse earum facere.
                        </p>
                    </div>


                    <div class="colaborador" data-aos="fade-up">
                        <div class="contenedorImagenColaborador"><img src="https://previews.123rf.com/images/avistock/avistock2103/avistock210300162/166079582-maestro-de-tatuajes-masculinos-sonriendo-tatuando-a-una-clienta-m%C3%A1quina-de-tatuaje-y-l%C3%A1mpara.jpg" alt="Foto persona Tatuando"></div>
                        <hr>
                        <span class="nombreColaborador">Aaron Reyes</span>
                        <p class="fraseColaborador">
                            Lorem ipsum dolor sit amet consectetur,
                            adipisicing elit. Voluptatibus eaque,
                            sequi sit esse earum facere.
                        </p>
                    </div>


                    <div class="colaborador" data-aos="fade-up">
                        <div class="contenedorImagenColaborador"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTgiEQ6D0hxYbleNQKYxlb-lBdJIYbWNKyOQA&usqp=CAU" alt="Foto persona Tatuando"></div>
                        <hr>
                        <span class="nombreColaborador">Aaron Reyes</span>
                        <p class="fraseColaborador">
                            Lorem ipsum dolor sit amet consectetur,
                            adipisicing elit. Voluptatibus eaque,
                            sequi sit esse earum facere.
                        </p>
                    </div>
                </div>

            </section>


            <!-- RESEÑAS -->
            <section class="seccionResena container" data-scroll>

                <h2>RESEÑAS</h2>
                <span class="textoAlternativo">( Comentarios tomados de 'Google maps' )</span>


                <div class="contenedorResenas">

                    <!-- CARTA 1 -->
                    <div class="cartaResena" data-aos="fade-up">

                        <div class="contenedorImagenNombre">
                            <div class="contenedorImagen"> <img src="https://lh3.googleusercontent.com/a-/ALV-UjWL0bQiAWxI5gb2zr-s7h3PC0DP4kj8jw06NBOlYW1mgw=w60-h60-p-rp-mo-br100" alt=""> </div>
                            <span class="nombre">catalina Gonzalez serna</span>
                        </div>

                        <div class="contenedorComentario">
                            <span>
                                "Un lugar con una excelente vibra , bryan Fuquen un súper artista me ayudó muchísimo en el diseño de mi tatuaje ... Fue perfecto , muy profesional trazos impecables y cierva 🐶 Hermosa !!!!
                                Gracias sin duda volveré pronto.…"
                            </span>
                        </div>

                        <a href="https://maps.app.goo.gl/Hko4XmXeiYP5Qwz19" class="verResena" target="_blank">Ver reseña...</a>
                    </div>

                    <!-- CARTA 2 -->
                    <div class="cartaResena" data-aos="fade-up">

                        <div class="contenedorImagenNombre">
                            <div class="contenedorImagen"> <img src="https://lh3.googleusercontent.com/a-/ALV-UjX9Ow7HnImCfbVMxAmhwM4DFmLSiI8-fcVBDqv1CXpMgQ=w60-h60-p-rp-mo-br100" alt=""> </div>
                            <span class="nombre">Evelyn Jaramillo</span>
                        </div>

                        <div class="contenedorComentario">
                            <span>
                                "Muy buena experiencia, lo recomiendo 100 %,el ambiente es super cómodo,
                                relajado y perfecto, cuenta con todo lo necesario; la atención que
                                brindan es muy buena, el artista muy dedicado y minucioso se lo agradezco
                                millón me encantó su trabajo."
                            </span>
                        </div>

                        <a href="https://maps.app.goo.gl/nAX2GF8Kx6wNWayZ6" class="verResena" target="_blank">Ver reseña...</a>

                    </div>

                    <!-- CARTA 3 -->
                    <div class="cartaResena" data-aos="fade-up">

                        <div class="contenedorImagenNombre">
                            <div class="contenedorImagen"> <img src="https://lh3.googleusercontent.com/a-/ALV-UjUKyUw9OFjg0apbsbfAiZuiRbSo6betj4oz37WatPGKMg=w60-h60-p-rp-mo-br100" alt=""> </div>
                            <span class="nombre">Camila Macias Alava</span>
                        </div>

                        <div class="contenedorComentario">
                            <span>
                                "Me encantó el lugar , el servicio y la elaboración de los tatuajes 🥰!!! Muy delicados.
                                El piercing muy chevere y con todos los cuidados necesarios. Ame hacerme mi primer tatuaje con ellos!"
                            </span>
                        </div>

                        <a href="https://maps.app.goo.gl/eRHUKLjq2RzNaiAm6" class="verResena" target="_blank">Ver reseña...</a>
                    </div>

                    <!-- CARTA 4 -->
                    <div class="cartaResena" data-aos="fade-up">

                        <div class="contenedorImagenNombre">
                            <div class="contenedorImagen"> <img src="https://lh3.googleusercontent.com/a-/ALV-UjW0v9ajNSfH8sMTOjMB2C802gMLpLRP1Xg8Of-1EmMI2Ns=w60-h60-p-rp-mo-br100" alt=""> </div>
                            <span class="nombre">Belkys juliana Mero espinoza</span>
                        </div>

                        <div class="contenedorComentario">
                            <span>
                                "Muy buena atención y tatúa muy lindo"
                            </span>
                        </div>

                        <a href="https://maps.app.goo.gl/6vQyQSRjAmdib7B86" class="verResena" target="_blank">Ver reseña...</a>
                    </div>

                    <!-- CARTA 5 -->
                    <div class="cartaResena" data-aos="fade-up">

                        <div class="contenedorImagenNombre">
                            <div class="contenedorImagen"> <img src="https://lh3.googleusercontent.com/a/ACg8ocLpt7hdChs4ANzqenuB8mVxYqcTAKl5r6IoRBjBA3Du=w36-h36-p-rp-mo-br100" alt=""> </div>
                            <span class="nombre">MARIA ALEJANDRA PINTO CASTILLO</span>
                        </div>

                        <div class="contenedorComentario">
                            <span>
                                "Son maravillosos!
                                Bryan y James son artistas maravillosos,
                                captan tu idea en un segundo, y los acabados
                                de sus tatuajes son de otro mundo! Volvería
                                una y otra vez a tatuarme con ellos 😊🎉"
                            </span>
                        </div>

                        <a href="https://maps.app.goo.gl/5LLyjq6W6LJGcj8r8" class="verResena" target="_blank">Ver reseña...</a>
                    </div>

                    <!-- CARTA 6 -->
                    <div class="cartaResena" data-aos="fade-up">

                        <div class="contenedorImagenNombre">
                            <div class="contenedorImagen"> <img src="https://lh3.googleusercontent.com/a-/ALV-UjX0ZBPqPMLZpNskLNUqw4uqRf6dwIgL2S5E4lvf11rhvzI=w60-h60-p-rp-mo-br100" alt=""> </div>
                            <span class="nombre">Mario Navia</span>
                        </div>

                        <div class="contenedorComentario">
                            <span>
                                "Excelente trabajo,Bryan eres un excelente artista,muy recomendados gracias por todo,el local impecable."
                            </span>
                        </div>

                        <a href="https://maps.app.goo.gl/RmB9kYG7TTr3uwqu8" class="verResena" target="_blank">Ver reseña...</a>
                    </div>

                </div>


            </section>


            <!-- modal -->
            <div class="contenedorModalImagen" id="contenedorModalImagen" data-scroll>
            </div>


            <!-- FOTOS LOCAL -->
            <section class="seccionFotosLocal container" id="seccionFotosLocal" data-aos="fade-up" data-scroll>

                <h2>LOCAL</h2>


                <div class="gridLocal">

                    <div class="div1 contenedorImagenLocal" id="div1" onclick="mostrarImagen('div1')">
                        <img src="./imagenes/local/local1.webp" alt="">
                    </div>

                    <div class="div2 contenedorImagenLocal" id="div2" onclick="mostrarImagen('div2')">
                        <img src="https://i.pinimg.com/236x/51/93/6e/51936e0bde43ac62b25ba426e05c15dd.jpg" alt="">

                    </div>

                    <div class="div3 contenedorImagenLocal" id="div3" onclick="mostrarImagen('div3')">
                        <img src="https://blog.herbitas.com/wp-content/uploads/2019/12/e2.jpg" alt="">

                    </div>

                    <div class="div4 contenedorImagenLocal" id="div4" onclick="mostrarImagen('div4')">
                        <img src="https://blog.herbitas.com/wp-content/uploads/2019/12/e1.jpg" alt="">

                    </div>

                    <div class="div5 contenedorImagenLocal" id="div5" onclick="mostrarImagen('div5')">
                        <img src="https://www.cristianroldan.art/wp-content/uploads/2020/10/escaparate-pintado-a-mano-estudio-de-tatuaje.jpg" alt="">

                    </div>

                    <div class="div6 contenedorImagenLocal" id="div6" onclick="mostrarImagen('div6')">
                        <img src="https://i0.wp.com/www.rotupia.com/wp-content/uploads/2021/04/octopus-tattoo2.jpg" alt="">

                    </div>

                    <div class="div7 contenedorImagenLocal" id="div7" onclick="mostrarImagen('div7')">
                        <img src="https://lh5.googleusercontent.com/p/AF1QipPVk-SPmX66S2NpfTqrtcB7Z9tT-10AyJv9NBF_" alt="">

                    </div>

                    <div class="div8 contenedorImagenLocal" id="div8" onclick="mostrarImagen('div8')">
                        <img src="https://lh5.googleusercontent.com/p/AF1QipMe9co5U9oAqSGf0hNW6dUbjP3f8-wsL4WdjPDw=w280-h157-k-no" alt="">

                    </div>

                </div>


            </section>


            <!-- SECCION # -->
            <section class="seccionEmpresa container" data-aos="fade-up" data-scroll>

                <h2>#CIERVA INK</h2>

                <div class="linea"></div>

                <p>
                    Antes de decidir hacerte un tatuaje, es fundamental que examines
                    ejemplos de nuestros trabajos para evaluar si nuestro estilo y
                    enfoque son de tu agrado.

                    En nuestro sitio web, podrás encontrar una selección reducida
                    pero representativa de nuestras creaciones más recientes.
                    No obstante, te invitamos a explorar nuestro extenso portafolio
                    en <a style="color: #FCBA0C;" href="https://www.instagram.com/ciervaink.estudio/">Instagram</a>
                    para obtener una visión más completa de nuestra labor.
                </p>

            </section>


            <!-- SECCION CONTACTO -->
            <section class="seccionContacto container" id="contacto" data-aos="fade-up" data-scroll>

                <h2>CONTÁCTANOS</h2>


                <div class="contenedorContactanos">


                    <div class="contenedorFormulario">


                        <form id="formularioContacto" class="formulario ">

                            <h3>Contáctanos</h3>

                            <div class="form-floating mb-3 has-validation">
                                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre y Apellido" required>
                                <label for="nombre">Nombre y Apellido</label>
                            </div>



                            <div class="form-floating mb-3">
                                <input type="email" name="correo" class="form-control" id="correo" placeholder="correo@ejemplo.com" required>
                                <label for="correo">Correo Electronico</label>
                            </div>

                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Mensaje" id="mensaje" name="mensaje" style="height: 100px" required></textarea>
                                <label for="mensaje">Mensaje</label>
                            </div>

                            <input type="submit" value="Enviar" class="botonEnviar">
                        </form>

                    </div>




                    <div class="contenedorImagenFormulario">
                        <img src="./imagenes/contacto.webp" alt="">
                    </div>
                </div>


            </section>


            <!-- FOOTER -->
            <div class="contenedorMainFooter" data-aos="fade-up" data-scroll>

                <div style="height: 150px; overflow: hidden;">
                    <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">
                        <path d="M-84.08,154.45 C149.99,150.00 467.27,63.66 515.79,169.25 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #303030;"></path>
                    </svg>
                </div>


                <footer class="footer" id="footer">

                    <div class="contenedorFooter">

                        <div class="contenedorLogoFooter">
                            <img src="./imagenes/logoTattoo.webp" alt="">
                            <span>CIERVA INK</span>
                        </div>

                        <div class="contenedorSobreNosotrosFooter sobreNosotrosFooter">
                            <span class="textoSobreNosotros">Sobre Nosotros</span>
                            <ul>
                                <li><a href="./index.php">Inicio</a></li>
                                <li><a href="#portafolio">Portafolio</a></li>
                                <li><a href="#sobreNosotros">Nosotros</a></li>
                                <li><a href="./VERTODO/VERTODOPRODUCTO/vertodoProducto.php">Tienda</a></li>
                                <li><a href="#horarios">Citas</a></li>
                            </ul>
                        </div>

                        <div class="contenedorSobreNosotrosFooter contenedorRedesFooter">

                            <span>Redes</span>

                            <ul>


                                <li>
                                    <a href="" target="_blank">
                                        Faceboock
                                        <img src="./imagenes/iconos/facebook.png" alt="">
                                    </a>
                                </li>


                                <li>
                                    <a href="https://wa.me/<?php echo $telefono ?>?text=Deseo obtener más informacion sobre su estudio" target="_blank">
                                        Whatsapp
                                        <img src="./imagenes/iconos/whatsapp.png" alt="">
                                    </a>
                                </li>


                                <li>
                                    <a target="_blank" href="https://www.instagram.com/ciervaink.estudio/">
                                        Instagram
                                        <img src="./imagenes/iconos/instagram.png" alt="">
                                    </a>
                                </li>


                                <li>
                                    <a href="">
                                        Youtube
                                        <img src="./imagenes/iconos/youtube.png" alt="">
                                    </a>
                                </li>

                            </ul>

                        </div>
                    </div>


                    <hr>

                    <div class="contenedorMiMarca">
                        ©
                        <b id="fechaMiMarca"></b>
                        &nbsp By: &nbsp Aaron Reyes &nbsp -> &nbsp
                        <a href="#"> www.aaronreyes.com </a>
                        <img src="./imagenes/iconos/estrella1.png" alt="">
                    </div>

                </footer>

            </div>


        </main>



    </div>




    <!-- Js  Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>


    <!-- js animacion -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>



    <script src="logicaHeader.js"></script>

    <!-- ALERTA PERSONALIZADA -->
    <script src="./alertaPersonalizada.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        AOS.init();

        // IR A #
        const irAbajo = e => {
            window.location.href = `#${e}`
        }

        // IR A WHASTAPP
        const enviarWhatsapp = (mensaje) => {
            window.open(`https://wa.me/<?php echo $telefono ?>?text=Deseo adquirir el producto '${mensaje}'`, '_blank')
        }


        // AGENDAR CITA
        const agendarCitaWp = (mensaje) => {
            window.open(`https://wa.me/<?php echo $telefono ?>?text=Deseo agendar una cita `, '_blank')
        }


        // pinta los años de experiencia que tiene el local
        idDiv = document.getElementById('anosExperiencia')
        date = new Date().getFullYear()
        let añosExper = date - 2015
        idDiv.innerHTML = añosExper
        idDiv.val = añosExper



        // mostar  modal con la imagen en fotos local
        function mostrarImagen(div) {

            let miDiv = document.getElementById(div)

            let contenedorModalImagen = document.getElementById("contenedorModalImagen")

            // imagen
            var miImagen = miDiv.getElementsByTagName("img")[0];

            contenedorModalImagen.innerHTML = `
                <div class="modalImagen" id="modalImagen">
                    <span class="cerrarModal" onclick="cerrarModal()">&times;</span>
                    <img src="${miImagen.src}" alt="">
                </div>
            `

        }


        // Cerrar el modal
        function cerrarModal() {

            // quitamos la clase del modal
            const modalImagen = document.getElementById('modalImagen');
            modalImagen.remove()

        }



        //////////////////      FUNCIONALIDAD CONTACTO      //////////////////
        var formularioContacto = document.getElementById('formularioContacto')
        formularioContacto.addEventListener('submit', function(e) {
            e.preventDefault()

            let formdata = new FormData(formularioContacto)

            if (formdata.get('nombre') == '' || formdata.get('correo') == '' || formdata.get('mensaje') == '') {

                alert('datos vacios')
                return
            }


            fetch('./CONTROL/CONTACTO/insertarContacto.php', {
                    method: 'POST',
                    body: formdata
                })
                .then(res => res.json())
                .then(e => {

                    if (e.mensaje === 'error bd') {
                        alertaPersonalizada('CORRECTO', 'Algo salio mal :( .', 'error', 'Regresar', 'no')
                        return
                    }


                    if (e.mensaje === 'ok') {
                        alertaPersonalizada('CORRECTO', 'Enviado Correctamente, nos pondremos en contacto contigo lo más antes posible.', 'success', 'Regresar', 'no')

                        document.getElementById('nombre').value = ''
                        document.getElementById('correo').value = ''
                        document.getElementById('mensaje').value = ''
                    }
                })


        })



        // ANIMACION NUMEROS
        let elementoObservar = document.getElementById('seccionEstadistica')
        let obserdor = new IntersectionObserver(confirmarVisibilidad, {})

        function confirmarVisibilidad(entidades) {

            let entidad = entidades[0]

            if (entidad.isIntersecting) {

                obserdor.unobserve(elementoObservar)

                let valueDisplays = document.querySelectorAll(".numero");

                let interval = 2000;


                valueDisplays.forEach((valueDisplay) => {

                    let startValue = 0;
                    let endValue = parseInt(valueDisplay.getAttribute("data-val"));
                    let duration = Math.floor(interval / endValue);
                    let counter = setInterval(function() {
                        startValue += 1;
                        valueDisplay.textContent = startValue;
                        if (startValue == endValue) {
                            clearInterval(counter);
                        }
                    }, duration);

                });

            }
        }

        obserdor.observe(elementoObservar)





        // FECHA ACTUAL MI MARCA
        let fechaMiMarca = document.getElementById('fechaMiMarca')
        let year = new Date()
        fechaMiMarca.innerHTML = year.getFullYear()



        // scroll lento


        //
    </script>
</body>

</html>