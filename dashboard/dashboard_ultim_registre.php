<?php
require "../clase_consultar.php";
require "../clase_base_dades.php";

$bd = new baseDades();
$consulta = new Consultar(
    $bd,
    array($_POST['usuari_id']),
    "SELECT  IFNULL(maquines.nom, accions.nom) AS nom_ultima_accio
     FROM (
     SELECT 
   IFNULL(maquina_id, accions_id) AS id_ultima_accio,
   IF(maquina_id IS NOT NULL, 'maquines', 'accions') AS ultima_accio 
 FROM activitats
 WHERE usuari_id = ?
     ORDER BY fecha DESC, hora DESC
  LIMIT 1     ) AS ua
LEFT JOIN maquines ON ua.ultima_accio = 'maquines' AND maquines.maquina_id = ua.id_ultima_accio
 LEFT JOIN accions ON ua.ultima_accio = 'accions' AND accions.accio_id = ua.id_ultima_accio;",
    "s"
);

if ($consulta->consultar()->num_rows > 0) {
    $row = $consulta->consultar()->fetch_assoc();
    echo strtoupper($row["nom_ultima_accio"]);
} else {
    echo "SENSE REGISTRES.";
}
