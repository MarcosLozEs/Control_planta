<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Introducción de ID de Producción</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../estils.css">
    <link rel="stylesheet" href="../dashboard/estils_dashboard.css">
    <link rel="stylesheet" href="estils_id.css">
</head>

<body>
    <?php session_start(); ?>

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
                <div class="col-8" style="text-align: center;">
                    <label>Introduce ID de Producción</label>
                    <input type="text" class="form-control" id="maquina_id">
                    <small class="error" id="error"></small>
                    <small class="form-text">IDs: 100,101,102,103.</small>
                </div>
                <div class="col-4" style="text-align: center;">
                    <label>Identificador</label>
                    <input type="text" id="identificador" class="form-control" style="text-align: center;" placeholder="A-Z">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="ccol-12  col-lg-3"></div>
            <div class="col-12  col-lg-3"></div>
            <div class="col-12  col-lg-3">
                <button type="button" onclick="enviarDades()" class="btn enviar w-100">Aceptar</button>
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
    <script src="../funcions.js"></script>
    <script>
        function enviarDades() {

            var maquina_id = document.getElementById('maquina_id').value;
            var identificador = document.getElementById('identificador').value.toLowerCase();
              

            if (!camps_complets([maquina_id, identificador])) {

                document.getElementById("error").style.color = "red";
                document.getElementById("error").textContent = "Error: Complete los campos";


            } else {

                if (isNaN(identificador)&&sanititzar(identificador)) {
                    const valor_elemento = [
                        ['maquina_id', maquina_id],
                        ['identificador', identificador]
                    ];

                    var enviar = new Enviar(valor_elemento, 'registrar_activitat.php');

                    enviar.enviarDades().then(function(resposta) {

                        if (resposta.trim() === "Registro añadido con éxito.") {
                            document.getElementById("error").style.color = "green"
                            document.getElementById("error").textContent = resposta;
                        } else {
                            throw new Error(resposta);
                        }

                    }).catch(function(error) {
                        document.getElementById("error").style.color = "red";
                        document.getElementById("error").textContent = error;
                    })

                } else {
                    document.getElementById("error").style.color = "red";
                    document.getElementById("error").textContent = "Error: El identificador debe ser una letra";
                }

            }
        }

        
    </script>

</body>

</html>