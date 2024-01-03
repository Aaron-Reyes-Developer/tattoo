<?php



if (isset($_POST['botonEnviar'])) {

    if ($_POST['username'] == "" || $_POST['password'] == "") {
        echo ('Datos incompletos');
        die();
    }

    include('../conexion.php');


    // obtener datos
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // comparar con la base de datos
    $queryConsulta = mysqli_query($conn, "SELECT * FROM admin WHERE user_name = '$username' AND contra = '$password' ");
    $n_r = mysqli_num_rows($queryConsulta);

    if ($n_r >= 1) {

        session_start();
        $_SESSION['entrar'] = true;
        header('Location: admin.php');
    } else {

?>
        <section>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="../alertaPersonalizada.js" onload="alertaPersonalizada('ERROR','Datos no encontrados', 'error','Volver')"></script>
        </section>

<?php
        die();
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estiloValidarAdmin.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


    <!-- animacion -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


    <title>Validar Admin</title>
</head>

<body>

    <main>

        <form action="" method="post" data-aos="fade-up" class="formulario">
            <h1>Login</h1>

            <div class="contenedorInputs">
                <input type="text" class="form-control" name="username" placeholder="User Name" required>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <input type="submit" class="botonEnviar" name="botonEnviar" value="Entrar">
            </div>

        </form>

    </main>




    <!-- Js  Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <!-- validar formulario -->
    <script src="../validacionFormularioBoostrap.js"></script>
    <script src="../evitarReenvioFormulario.js"></script>


    <!-- js animacion -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>



</body>

</html>