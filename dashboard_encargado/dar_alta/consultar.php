<?php

require_once "../../clase_base_dades.php";
require_once "../../clase_consultar.php";


consultar(htmlspecialchars($_POST["consulta"]), array(htmlspecialchars($_POST["dada_a_consultar"])), $_POST["tipo_dato"]);


function consultar($consulta, $dada_a_consultar, $tipo_dato)
{
    $bd = new baseDades();

    $consultar_id = new Consultar($bd, $dada_a_consultar, $consulta, $tipo_dato);

    $resultat = $consultar_id->consultar();

    if ($resultat->num_rows > 0) {
        while ($row = $resultat->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        echo json_encode([]);
    }
}
