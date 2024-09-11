<?php

require_once "../../clase_base_dades.php";
require_once "../../clase_consultar.php";


if (empty($_POST["maquina_id"])) {
    echo json_encode(array("error" => "el id no es correcto"));
} else {
    $db = new baseDades();
    $consultar = new Consultar(
        $db,
        array($_POST['maquina_id']),
        "SELECT `temps_maquina`FROM maquines WHERE maquina_id = ? ",
        "i"
    );

    $resultat = $consultar->consultar();
    $temps_maquina = $resultat->fetch_assoc();

    if ($temps_maquina) {
        $temps = $temps_maquina['temps_maquina'];
        echo json_encode(array("temps"=>$temps));
    }
}
