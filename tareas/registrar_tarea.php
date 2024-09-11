<?php
session_start(); // Iniciar sesión

require "../clase_base_dades.php";
require "../clase_registrar_activitat.php";
require "../clase_consultar.php";

$db = new baseDades;

$accions_id =  $_POST['accions_id'];

if (empty($_POST['accions_id']) || $_POST['accions_id'] == "accions_id=") {
    echo "Faltan datos.";
    exit;
} else {

    $accions_id = array($_POST['accions_id']);
    $_SESSION['accio_id']=$_POST["accions_id"]; //guardar en session para cuadro verde dashboard;
    $consulta = new Consultar($db,$accions_id,"SELECT accio_id FROM accions WHERE nom = ?", "s");
   
    $id_tarea = $consulta->consultar();
   
    if ($fila = $id_tarea->fetch_assoc()) {
        
        $registre = new Registrar($db, $_SESSION['usuari_id'], null, $fila["accio_id"], date("Y-m-d"), date("H:i:s"));
        $registre->registrar_activitat();
    }

    $db->cerrar_conexion();
}
