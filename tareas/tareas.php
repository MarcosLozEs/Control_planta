<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../estils.css">
    <link rel="stylesheet" href="../dashboard/estils_dashboard.css">
    <link rel="stylesheet" href="estils_tareas.css">
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
            <div class="row" name="contenedor-central">

                <div class="card col-12 col-lg-4 ">
                    <div class="row" name="categorias">
                        <div class="col">
                            <p>CATEGORIAS</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="card-body">
                            <div class="green-box col-12">
                                <button type="button" onclick="crear_menu(['FALTA MATERIAL','INCIDENCIA CALIDAD EXTERNO','INCIDENCIA CALIDAD INTERNO','INCIDENCIA LOGISTICA'])" class="btn w-100">Incidencias</button>
                                <button type="button" onclick="crear_menu(['DESCANSO','SALIDA'])" class="btn w-100 ">Pausa</button>
                                <button type="button" onclick="crear_menu(['REUNIÓN','DOCUMENTACIÓN'])" class="btn w-100 ">Coordinación</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card col-12  col-lg-7" style="display: none;" id="submenu">
                    <div class="row" name="categorias">
                        <div class="col">
                            <p>CATEGORIAS</p>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="green-box col-12" id="categoria"></div>
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

    <script src="../clase_enviar_dades.js"></script>
    <script>
        function crear_menu(menu) {

            const contenedor = document.getElementById("contenedor");
            const submenu = document.getElementById("submenu");
            const categoria = document.getElementById("categoria");


            categoria.innerHTML = "";


            menu.forEach(function(incidencia) {
                var boto = document.createElement("button");
                boto.innerText = incidencia;
                boto.className = "btn w-100";
                boto.id = incidencia;

                boto.onclick = function() {
                    enviarDades(incidencia);
                };

                categoria.appendChild(boto);
            });


            categoria.style.display = "block";
            submenu.style.display = "block";
        }



        function enviarDades(id) {
            const valor_elemento = [
                ['accions_id', id]
            ];

            var enviar = new Enviar(valor_elemento, 'registrar_tarea.php');

            enviar.enviarDades().then(function(resposta) {

                if (resposta.trim() === "Registro añadido con éxito.") {
                    document.getElementById("error").textContent = resposta;
                } else {
                    throw new Error(resposta);
                }
            }).catch(function(error) {
                document.getElementById("error").textContent = error;
            })
        }
    </script>
</body>

</html>