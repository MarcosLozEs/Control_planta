<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../estils.css">
    <link rel="stylesheet" href="../../dashboard/estils_dashboard.css">
    <link rel="stylesheet" href="../../tareas/estils_tareas.css">
    <link rel="stylesheet" href="estils_dashboard_encargado.css">


</head>

<body>
   
<?php require_once "../../control_sessions/verificar_sessio.php";?>

    <div class="container-fluid">

        <div class="row align-items-center" name="linea" style="background-color: rgb(61, 61, 61);">
            <div class="col-1">
                <button onclick="history.back()" class="btn">&lt;</button>
            </div>
            <div class="col-3 text-left">
                <p>Seccion administrador</p>
            </div>
            <div class="col-8 text-right">
                <p id="nom_usuari">Hola <?php echo $_SESSION['nom_usuari'] ?>!</p>
            </div>
        </div>

        <div class="container">
            <div class="row" name="contenedor-central">

                <div class="card col-12 col-lg-4">
                    <div class="row" name="categorias">
                        <div class="col">
                            <p>CAMPOS</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="card-body">
                            <div class="green-box col-12">
                                <button type="button" onclick="crear_menu(['ALTA','BAJA'])" class="btn w-100">Personal</button>
                                <button type="button" onclick="crear_menu(['IMPRIMIR'])" class="btn w-100">Estadisticas</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card col-12  col-lg-7" style="display: none;" id="submenu">
                    <div class="row" name="categorias">
                        <div class="col">
                            <p>ACCIONES</p>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="green-box col-12" id="contenedor"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" name="linea">
            <div class="col-12">
                <p class="error" id="error" style="text-align: center;"></p>
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

    <script>
        function crear_menu(menu) {

            const contenedor = document.getElementById("contenedor");
            contenedor.innerHTML = "";

            menu.forEach(function(incidencia) {

                var boto = document.createElement("button");
                boto.innerText = incidencia;
                boto.className = "btn w-100";
                boto.id = incidencia;

                boto.onclick = function() {
                    accio_supervisor(incidencia);
                };

                contenedor.appendChild(boto);
            })
            contenedor.style.display = "block";
            submenu.style.display = "block";
        }

        function accio_supervisor(incidencia) {

            switch (incidencia) {

                case "ALTA":
                    window.location.href = "../dar_alta/formulario_alta.php";
                    break;

                case "BAJA":
                    window.location.href = "../dar_baja/formulario_baja.php";
                    break;
               case "IMPRIMIR":
                window.location.href = "../imprimir/formulario_imprimir.php";
                    break;
            }
        }


    </script>
</body>

</html>