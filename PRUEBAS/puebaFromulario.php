<?php

include('../conexion.php');




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>PRUEBA FORMULARIO</title>



</head>

<body>


    <main style="width: 360px;" class="container mt-1">


        <form id="formulario" class="mt-5 container" enctype="multipart/form-data">


            <div class="mb-3">
                <label for="imagenes" class="form-label">IMAGENES</label>
                <input type="file" class="form-control" id="imagenes" name="imagenes[]" accept=".png, , .jpeg, .jpg" multiple>
            </div>


            <div class="mt-3">
                <input type="submit" class="form-control bg-primary" id="exampleFormControlInput1" accept=".png, .webp, .jpeg, .jpg">
            </div>

        </form>


    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


    <script>
        formulario = document.getElementById('formulario')

        formulario.addEventListener('submit', function(e) {

            e.preventDefault()

            let FD = new FormData(formulario)

            fetch('./queryInsertarImagen.php', {
                    method: 'POST',
                    body: FD
                })
                .then(res => res.json())
                .then(e => console.log(e))
        })
    </script>


</body>

</html>