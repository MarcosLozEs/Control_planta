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
    <link rel="stylesheet" href="../../produccio/estils_id.css">
    <link rel="stylesheet" href="../dashboard_encargado/estils_dashboard_encargado.css">
    <link rel="stylesheet" href="estils_formulari_alta.css">
</head>

<body>
    <?php require_once "../../control_sessions/verificar_sessio.php"; ?>

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
                <div class="card col-12">

                    <div class="row align-items-center" name="categorias">
                        <div class="col">
                            <p>ALTA TRABAJADOR</p>
                        </div>
                    </div>

                    <div class="row align-items-center" name="formulari">
                        <div class="col-3"><label for="id">ID</label></div>
                        <div class="col-9"><input type="text" name="inputs" class="form-control" id="id" readonly></div>
                    </div>

                    <div class="row align-items-center" name="formulari">
                        <div class="col-3"><label for="nombre">Nombre</label></div>
                        <div class="col-9"><input type="text" name="inputs" class="form-control " id="nombre"></div>
                    </div>

                    <div class="row align-items-center" name="formulari">
                        <div class="col-3"><label for="rol">Rol</label></div>
                        <div class="col-9">
                            <select name="opciones" class="form-control" id="rol" onchange="seleccionar_opcio()">
                                <option value="-1">Eligir rol</option>
                                <option value="supervisor">Supervisor</option>
                                <option value="operario">Operario</option>
                                <option value="coordinador">Coordinador</option>
                            </select>
                        </div>
                    </div>

                    <div class="row align-items-center" name="formulari">
                        <div class="col-3"><label for="seccion">Sección</label></div>
                        <div class="col-9">
                            <select name="opciones" class="form-control " id="seccion" onchange="select_supervisor()">
                                <option value="-1">Eligir sección</option>
                                <option value="trenes">Trenes</option>
                                <option value="buses">Buses</option>
                                <option value="puentes">Puentes</option>
                                <option value="carretillas">Carretillas</option>
                                <option value="pitura">Pitura</option>
                            </select>
                        </div>
                    </div>

                    <div class="row align-items-center" name="formulari">
                        <div class="col-3"><label for="id_supervisor">ID Supervisor</label></div>
                        <div class="col-9"><select class="form-control" id="id_supervisor" name="id_supervisor" name="inputs">
                            </select>
                        </div>
                    </div>

                    <div class="row align-items-center" name="formulari">
                        <div class="col-3"><label for="contrasenya">Contraseña</label></div>
                        <div class="col-9"><input type="password" class="form-control mb-1" id="contrasenya" name="inputs"></div>
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
            <div class="col-lg-3"></div>
            <div class="col-lg-3"></div>

            <div class="col-lg-3">
                <button type="button" class="btn enviar w-100" onclick="enviar()">Enviar</button>
            </div>
            <div class="col-12 col-lg-3">
                <a class="btn salir w-100" href="http://200.234.226.157/control_sessions/tancar_sessio.php">Salir</a>
            </div>
        </div>

        <div class="row" name="linea">
            <div class="col-12" style="background-color: rgb(61, 61, 61);">
            </div>
        </div>

    </div>


    <script src="../../funcions.js"></script>
    <script src="../../clase_enviar_dades.js"></script>
    <script>
        var select = document.getElementById('rol');
        var id_supervisor = document.getElementById('id_supervisor');


        window.addEventListener('load', function() {
            consulta_id();
        });

        function consulta_id() {

            var consulta_ultima_id = [
                ["consulta", "SELECT MAX(usuari_id) AS maxim_id FROM usuaris"],
                ["dada_a_consultar", "null"],
                ["tipo_dato", "null"]
            ];

            function enviarDadesAlServidor(consulta_ultima_id) {

                var enviar = new Enviar(consulta_ultima_id, "consultar.php");
                return enviar.enviarDades();
            }

            enviarDadesAlServidor(consulta_ultima_id).then(function(resposta) {

                var nou_id = JSON.parse(resposta);

                document.getElementById("id").value = nou_id[0].maxim_id + 1;

            }).catch(function(error) {
                document.getElementById("error").value = error;
            });
        }


        select.addEventListener('change', function() {

            if (select.value === "supervisor") {
                id_supervisor.disabled = true;
            } else {
                id_supervisor.disabled = false;
            }

        });

        function select_supervisor() {
            if (document.getElementById("rol").value !== "supervisor") {

                var seccion = document.getElementById("seccion").value;
                var consultar_id_supervisor = [
                    ["consulta", "SELECT CONCAT(usuari_id, ' - ', nom_usuari) AS usuario FROM usuaris WHERE seccio = ? AND rol = 'supervisor'"],
                    ["dada_a_consultar", seccion],
                    ["tipo_dato", "s"],
                ];

                var enviar = new Enviar(consultar_id_supervisor, "consultar.php");

                enviar.enviarDades().then(function(resposta) {
                    var resultados = JSON.parse(resposta);
                    crear_select_supervisor(resultados);

                }).catch(function(error) {
                    document.getElementById('error').innerHTML = error;
                });

            } else {
                document.getElementById("id_supervisor").innerHTML = "";
            }
        }

        function crear_select_supervisor(resultados) {

            var selectSupervisor = document.getElementById("id_supervisor");
            selectSupervisor.innerHTML = "";

            if (resultados.length !== 0) {
                id_supervisor.disabled = false;
                resultados.forEach(function(resultado) {

                    var opcion = document.createElement("option");
                    opcion.value = resultado.usuario.trim();
                    opcion.textContent = resultado.usuario.trim();
                    selectSupervisor.appendChild(opcion);
                });
            } else {
                selectSupervisor.innerHTML = "";
                id_supervisor.disabled = true;
            }
        }

        function seleccionar_opcio() {

            if (document.getElementById("rol").value === "supervisor") {
                document.getElementById("id_supervisor").innerHTML = "";
                document.getElementById("seccion").value = "-1";


            } else {
                document.getElementById("id_supervisor").innerHTML = "";
                document.getElementById("seccion").value = "-1";
            }
        }

        function enviar() {
            try {
                var valors = obtindreValors();
                var formulari = validarFormulari(valors);

                if (formulari) {
                    var enviarFormulari = new Enviar(valors, "../registrar.php");
                    enviarFormulari.enviarDades().then(function() {
                        reiniciar_valors();
                        consulta_id();
                        document.getElementById('error').style = "text-align: center; color:green";
                        document.getElementById('error').innerHTML = 'Registro completado.';
                    });
                }
            } catch (error) {
                document.getElementById('error').style = "text-align: center; color:red";
                document.getElementById('error').innerHTML = error;
            }
        }

        function reiniciar_valors() {
            document.getElementById('nombre').value = "";
            document.getElementById('rol').value = -1;
            document.getElementById('seccion').value = -1;
            document.getElementById('id_supervisor').value = "";
            document.getElementById('contrasenya').value = "";
        }

        function obtindreValors() {

            return [
                ["id", document.getElementById('id').value],
                ["nombre", document.getElementById('nombre').value],
                ["rol", document.getElementById('rol').value],
                ["seccion", document.getElementById('seccion').value],
                ["id_supervisor", document.getElementById('id_supervisor').value],
                ["contrasenya", document.getElementById('contrasenya').value]
            ];
        }

        function verificar_input(valor_nom) {
            if (!sanititzar(valor_nom)) {
                document.getElementById('nombre').value = "";
                throw ("El nombre no puede incluir valores especiales");
            }
        }

        function validarFormulari(valors) {

            for (var i = 0; i < valors.length; i++) {

                if ((valors[i][1] === '' || valors[i][1] === "-1")) {
                    if (document.getElementById('rol').value === "supervisor" && document.getElementById('seccion').value !== "-1") {
                        document.getElementById('id_supervisor').value = "";
                        verificar_input(valors[1][1]);
                        return true;
                    }
                    throw ("Por favor, complete todos los campos.");
                }
            }
            verificar_input(valors[1][1]);
            return true;
        }
    </script>
</body>

</html>