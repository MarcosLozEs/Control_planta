<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../login/estils_login.css">
    <link rel="stylesheet" href="../estils.css">
    <link rel="stylesheet" href="estils_dashboard.css">
</head>

<body>

    <?php require_once "../control_sessions/verificar_sessio.php"; ?>

    <div class="container-fluid">

        <div class="row align-items-center" name="linea" style="background-color: rgb(61, 61, 61);">
            <div class="col-1">
                <button onclick="history.back()" class="btn">&lt;</button>
            </div>
            <div class="col-3 text-left">
                <p>Seccion <?php echo $_SESSION['seccio'] ?></p>
            </div>
            <div class="col-8 text-right">
                <p id="nom_usuari">Hola <?php echo $_SESSION['nom_usuari'] ?>!</p>
            </div>
        </div>

        <div class="container">

            <div class="row" name="tareas">
                <div class="col">
                    <p>TAREAS</p>
                </div>
            </div>

            <div class="row" name="contenedor-central">
                <div class="card col">
                    <div class="card-body">
                        <div class="green-box col-12 col-lg-3">
                            <p id="ultim_registre"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12 col-lg-3">
                <button type="button" onclick="navegar_vistes('../seccions/seccion.php')" class="btn  w-100">Sección</button>
            </div>
            <div class="col-12 col-lg-3">
                <button type="button" onclick="navegar_vistes('../tareas/tareas.php')" class="btn  w-100">Tareas</button>
            </div>
            <div class="col-12 col-lg-3">
                <button type="button" onclick="navegar_vistes('../produccio/id_produccio.php')" class="btn  w-100">PF</button>
            </div>
            <div class="col-12 col-lg-3">
                <a class="btn salir w-100" href="http://localhost/projecte_planta/html/control_sessions/tancar_sessio.php">Salir</a>
            </div>
        </div>
        <div class="row" name="linea">
            <div class="col-12" style="background-color: rgb(61, 61, 61);">
            </div>
        </div>
    </div>

    <script src="../clase_enviar_dades.js"></script>
    <script>
        window.addEventListener('load', function() {

            ultim_registre().then(function(resposta) {
                document.getElementById('ultim_registre').innerHTML = resposta;
            })
        });

        function ultim_registre() {

            var enviar = new Enviar([
                ["usuari_id",<?php echo $_SESSION['usuari_id'] ?>]
            ], "dashboard_ultim_registre.php");
            return enviar.enviarDades();
        }

        function navegar_vistes(ruta) {
            window.location.href = ruta;
        }
    </script>

</body>

</html>