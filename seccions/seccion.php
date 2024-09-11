<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../estils.css">
    <link rel="stylesheet" href="../dashboard/estils_dashboard.css">
    <link rel="stylesheet" href="estils_seccions.css">
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
                    <p>Información del Operario</p>
                </div>
            </div>

            <div class="row" name="contenedor-central">
                <div class="card col">
                    <div class="card-body">
                        <div class="green-box col-8">
                            <p>Id empresa: <?php echo $_SESSION['usuari_id'] ?></p>
                            <p>Nombre del Operario: <?php echo $_SESSION['nom_usuari'] ?></p>
                            <p>Sección: <?php echo $_SESSION['seccio'] ?></p>
                            <p>Cargo: <?php echo $_SESSION['rol'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12 col-lg-9">
            </div>
            <div class="col-12 col-lg-3">
                <a class="btn salir w-100" href="http://localhost/projecte%20planta/html/control_sessions/tancar_sessio.php">Salir</a>
            </div>
        </div>

        <div class="row" name="linea">
            <div class="col-12" style="background-color: rgb(61, 61, 61);">
            </div>
        </div>

    </div>
</body>

</html>