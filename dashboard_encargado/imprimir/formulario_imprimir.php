<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../estils.css">
  <link rel="stylesheet" href="../../dashboard/estils_dashboard.css">
  <link rel="stylesheet" href="../../tareas/estils_tareas.css">
  <link rel="stylesheet" href="../../produccio/estils_id.css">
  <link rel="stylesheet" href="../dashboard_encargado/estils_dashboard_encargado.css">
  <link rel="stylesheet" href="estilo_formulario_imprimir.css">
  <title>actualizar</title>
</head>


<body>
  <?php session_start(); ?>

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

    <div class="container" style="background-color: white; height: 650px;">
      <div class="row" name="contenedor-central" style=" font-size: 20px;">
        <div class="col-6" style="text-align: center;">
          <label for="fechaInicio">Fecha de inicio:</label>
          <input type="date" id="fecha_inici">
        </div>
        <div class="col-6" style="text-align: center;">
          <label for="fechaFin">Fecha de fin:</label>
          <input type="date" id="fecha_fi">
        </div>

      
        <div class="col-12"  style="text-align: center;">
        <small class="form-text">Fechas con registros: del 01/04/24 al 05/04/24</small>
        </div>
        

      </div>
      <canvas class="col-12" id="grafico"></canvas>
      <div class="col-12" id="datos_produccion" style="text-align: center; color:red">

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
      <div class="col-lg-3">
        <button type="button" onclick="salir()" class="btn salir w-100">Salir</button>
      </div>
    </div>

    <div class="row" name="linea">
      <div class="col-12" style="background-color: rgb(61, 61, 61);">
      </div>
    </div>


  </div>

  <script src="../../clase_enviar_dades.js"></script>
  <script src="clase_oee.js"></script>

  <script>
    var grafico; // Variable global para almacenar la referencia al gráfico

    function calcular_datos() {
      const fecha_inici = document.getElementById("fecha_inici").value;
      const fecha_fi = document.getElementById("fecha_fi").value;

      if (!fecha_inici || !fecha_fi) {
        return {
          error: "Por favor, seleccione ambas fechas."
        };
      }

      if (fecha_inici > fecha_fi) {
        return {
          error: "La fecha de fin debe ser posterior a la fecha de inicio."
        };
      }

      const dates = [
        ["fecha_inici", fecha_inici],
        ["fecha_fi", fecha_fi],
        ["maquina_id", "100"]
      ]
      return dates;
    }

    function enviar() {
      var dades = calcular_datos();
      document.getElementById("datos_produccion").innerHTML = "";

      if (dades.error) {
        document.getElementById("datos_produccion").innerHTML = dades.error;
        return;
      }

      var numero_dies = calcular_dies(dades[0][1], dades[1][1]);
      var maquina_id = [dades[2]];

      Promise.all([

        new Enviar(dades, "calcular_temps_treball.php").enviarDades(),
        new Enviar(maquina_id, "consultar_temps_maquina.php").enviarDades(),
        new Enviar(dades, "consultar_numero_maquines.php").enviarDades()

      ]).then(function(resultat) {

        var resultat_fetxa = JSON.parse(resultat[0]);
        var temps_maquina = JSON.parse(resultat[1]);
        var numero_maquines = JSON.parse(resultat[2]);
        var suma_minuts_treballats = sumar_minuts_dies(resultat_fetxa);

        var oee_calculadora = new Oee_calculadora(480 * numero_dies, 15 * numero_dies, temps_maquina.temps, suma_minuts_treballats, 
        numero_maquines.numero_maquines_diferents);

        actualitzar_grafic(oee_calculadora);

      }).catch(function(error) {
        console.log(error);
      });
    }

    function sumar_minuts_dies(array_minuts) {
      return array_minuts.reduce(function(total, elemento) {
        return total + parseInt(elemento.minutos_trabajados, 10);
      }, 0); // El segundo argumento es el valor inicial del total
    }


    function calcular_dies(fecha_inici, fecha_final) {
      var fechaInici = moment(fecha_inici);
      var fechaFinal = moment(fecha_final);

      var diferencia_dies = fechaFinal.diff(fechaInici, 'days') + 1;

      return diferencia_dies;
    }

    function actualitzar_grafic(oee_calculadora) {
      // Actualizar los datos del gráfico si ya existe
      if (grafico) {
        console.log(grafico)
        //actualizar dataset
        grafico.data.datasets[0].data = [oee_calculadora.disponibilitat * 100,
         oee_calculadora.rendiment * 100,
          oee_calculadora.oee];
        grafico.update();
      } else {
        // Crear el gráfico si no existe
        dibuixar_grafic(['Disponibilidad', 'Rendimiento', 'OEE'],
         [oee_calculadora.disponibilitat * 100, 
         oee_calculadora.rendiment * 100, 
         oee_calculadora.oee]);
      }
    }


    function dibuixar_grafic(labels, data) {
      var canvas = document.getElementById('grafico').getContext('2d');
      grafico = new Chart(canvas, {
        type: 'bar',
        data: {
          labels: labels,
          datasets: [{
            label: 'OOE',
            data: data,
            backgroundColor: [
              'rgba(255, 99, 132, 0.7)',
              'rgba(54, 162, 235, 0.7)',
              'rgba(255, 206, 86, 0.7)'
            ],
            borderColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    }
  </script>
</body>

</html>