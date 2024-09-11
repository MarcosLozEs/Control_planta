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
    <link rel="stylesheet" href="../dar_alta/estils_formulari_alta.css">
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
            <div class="row" name="contenedor-central baja">
                <div class="card col-12">

                    <div class="row align-items-center" name="categorias">
                        <div class="col">
                            <p>BAJA TRABAJADOR</p>
                        </div>
                    </div>

                    <div class="row align-items-center" name="formulari">
                        <div class="col-3"><label for="id">ID</label></div>
                        <div class="col-9"><input type="text" class="form-control" id="id"></div>
                    </div>
                    <div class="row align-items-center" name="formulari">
                        <div class="col-3"><label for="nombre" onchange="">Nombre</label></div>
                        <div class="col-9"><input type="text" class="form-control" id="nombre" readonly></div>
                    </div>
                    <div class="row align-items-center" name="formulari">
                        <div class="col-3"><label for="rol">Rol</label></div>
                        <div class="col-9"><input type="text" class="form-control" id="rol" readonly></div>
                    </div>
                    <div class="row align-items-center" name="formulari">
                        <div class="col-3"><label for="seccion">Sección</label></div>
                        <div class="col-9"><input type="text" class="form-control" id="seccio" readonly></div>
                    </div>
                    <div class="row align-items-center" name="formulari">
                        <div class="col-3"><label for="id_supervisor">ID Supervisor</label></div>
                        <div class="col-9"><input type="text" class="form-control mb-1" id="id_supervisor" readonly></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" name="linea">
            <div class="col-12" style="text-align: center;">
                <p class="error" id="error"></p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3"></div>

            <div class="col-lg-3">
                <button type="button" class="btn enviar w-100" id="eliminar" onclick="enviar('dar_baja.php')" disabled>Eliminar</button>
            </div>
            <div class="col-lg-3">
                <button type="button" class="btn enviar w-100" onclick="enviar('../datos_operario.php')">Enviar</button>
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

    <script src="../../clase_enviar_dades.js"></script>
    <script>
        function enviar(enviar_a) {
            var id = document.getElementById("id").value;

            if (!isNaN(id) && id != "") {
                obtenerDatos(id, enviar_a);
            } else {
                mostrarError("El Id debe ser un valor numérico.","red");
            }
        }

        function obtenerDatos(id, enviar_a) {
            var array_id = [
                ["id", id]
            ];

            var enviar = new Enviar(array_id, enviar_a);

            enviar.enviarDades().then(function(resultat) {
              
                var dades = JSON.parse(resultat);
                procesarDatos(dades);

            }).catch(function(error) {
                mostrarError("Error al obtener la información", "red")
            });
        }

        function procesarDatos(dades) {

            var boto_eliminar = document.getElementById("eliminar");

            if (Array.isArray(dades[0])) {
                boto_eliminar.disabled = false;
                mostrarDatos(dades);
            } else {
                boto_eliminar.disabled = true;
                if(dades.valido){mostrarError(dades.valido, "red");}
                if(dades.eliminado){mostrarError(dades.eliminado, "green");}
                vaciar_formulario("");
            }
        }

        function vaciar_formulario(string) {
            document.getElementById("id").value = string;
            document.getElementById("nombre").value = string;
            document.getElementById("rol").value = string;
            document.getElementById("seccio").value = string;
            document.getElementById("id_supervisor").value = string;
        }


        function mostrarDatos(dades) {
            document.getElementById("nombre").value = dades[0][0];
            document.getElementById("rol").value = dades[0][1];
            document.getElementById("seccio").value = dades[0][2];
            document.getElementById("id_supervisor").value = dades[0][3];
            document.getElementById("error").innerHTML = "";
        }

        function mostrarError(mensaje, color) {
            document.getElementById("error").style = "color:"+color;
            document.getElementById("error").innerHTML = mensaje;
        }

    </script>

</body>

</html>