<?php

require_once "../../clase_base_dades.php";
require_once "../../clase_consultar.php";

if ($_POST['fecha_inici'] > $_POST['fecha_fi']) {
    echo json_encode(array("error" => "La fecha de inicio debe ser anterior a la fecha de fin."));
    exit();
}
$db = new baseDades();
$consultar = new Consultar(
    $db,
    array($_POST['fecha_inici'], $_POST['fecha_fi']),
    "SELECT COUNT(DISTINCT SUBSTRING(identificador, 1, 1))AS numero_maquines_diferents
     FROM activitats
      WHERE fecha BETWEEN ? AND ?",
    "ss"
);

$resultat = $consultar->consultar();
$numero_maquines_diferents = $resultat->fetch_assoc();

if ($numero_maquines_diferents) {
    $numero = $numero_maquines_diferents['numero_maquines_diferents'];
    echo json_encode(array("numero_maquines_diferents" => $numero));
}
