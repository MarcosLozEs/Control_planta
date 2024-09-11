<?php

require "../../clase_consultar.php";
require "../../clase_base_dades.php";

if (!empty($_POST['fecha_inici']) && !empty($_POST['fecha_fi']) && !empty($_POST['maquina_id'])) {

    $db = new baseDades();
    $consultar = new Consultar(
        $db,
        array($_POST['maquina_id'], $_POST['fecha_inici'], $_POST['fecha_fi']),
        "SELECT 
            fecha,
            ROUND(SUM(TIME_TO_SEC(TIMEDIFF(hora_salida, hora_entrada))) / 60) AS minutos_trabajados
        FROM (
            SELECT 
                fecha,
                MIN(hora) AS hora_entrada,
                MAX(hora) AS hora_salida
            FROM activitats
            WHERE maquina_id = ?
            AND fecha BETWEEN ? AND ?
            GROUP BY fecha
        ) AS trabajos_maquina
        GROUP BY fecha;",
        "sss"
    );

    $resultat = $consultar->consultar();

    if ($resultat) {
        $data = array();
        if ($resultat->num_rows > 0) {
            while ($row = $resultat->fetch_assoc()) {
                $data[] = $row;
            }
            echo json_encode($data);
        } else {
            echo json_encode(array("error" => "No se encontraron resultados."));
        }
    } else {
        echo json_encode(array("error" => "Error al ejecutar la consulta."));
    }
} else {
    echo json_encode(array("error" => "Rellene todos los campos"));
}
