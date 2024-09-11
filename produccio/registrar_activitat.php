<?php
session_start(); // Iniciar sesión

require "../clase_base_dades.php";
require "../clase_registrar_activitat.php";
require "../clase_consultar.php";

$db = new baseDades;

if (empty($_POST['maquina_id']) || $_POST['maquina_id'] == "maquina_id=" ||empty($_POST['identificador'])) {
    echo "Faltan datos.";
    exit;
} else {
    $maquina_id = array($_POST['maquina_id']);
    $consulta = new Consultar($db, $maquina_id, "SELECT * FROM maquines WHERE maquina_id = ?", "i");

    $maquina_id = $consulta->consultar();

    if ($fila = $maquina_id->fetch_assoc()) {
        $registre = new Registrar($db, $_SESSION['usuari_id'], $fila["maquina_id"], 
        null, date("Y-m-d"), date("H:i:s"),$_POST['identificador']);
        $registre->registrar_activitat();
    } else {
        // La máquina no existe, mostrar mensaje
        echo "ID de máquina no válido.";
    }

    $db->cerrar_conexion();
}
