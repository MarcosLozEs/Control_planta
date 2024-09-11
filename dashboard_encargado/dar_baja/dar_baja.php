<?php

$id = $_POST['id'];

require "../../clase_consultar.php";
require "../../clase_base_dades.php";

if (empty($id)) {
    echo json_encode(array("Por favor, introduzca un ID"));
} else {

    $db = new baseDades();

    $eliminar_activitats = new Consultar($db, array($id), "DELETE FROM activitats WHERE usuari_id = ?", "i");
    $eliminar_activitats->consultar();

    $donar_baixa = new Consultar($db, array($id), "DELETE FROM usuaris WHERE usuari_id = ?", "i");
    $resultat = $donar_baixa->consultar();

    if ($resultat) {
        echo json_encode(array("eliminado"=>"El registro con ID $id ha sido eliminado correctamente."));
    }
}
