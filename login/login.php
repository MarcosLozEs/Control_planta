<?php
session_start();

require '../clase_base_dades.php';
require '../clase_consultar.php';

$db = new baseDades();

if (empty($_POST['usuari_id']) || empty($_POST['contraseña'])) {
    echo json_encode(array("error" => "Complete todos los campos."));
    exit;
} else {
    $usuari_id = htmlspecialchars($_POST['usuari_id']);
    $contraseña = htmlspecialchars($_POST['contraseña']);

    $autenticar = new Consultar($db, array($usuari_id), 'SELECT contraseña, nom_usuari, rol, seccio, supervisor_id, usuari_id, 
    (SELECT nom_usuari FROM usuaris WHERE usuari_id = supervisor_id) AS nom_supervisor FROM usuaris WHERE usuari_id = ?', "s");

    $resultat = $autenticar->consultar();
    if ($resultat->num_rows > 0) {
        $row = $resultat->fetch_assoc();
        if (password_verify($contraseña, $row['contraseña'])) {
            // Guardar variables de sesión
            $_SESSION['usuari_id'] = htmlspecialchars($row['usuari_id']);
            $_SESSION['seccio'] =  htmlspecialchars($row['seccio']);
            $_SESSION['nom_usuari'] = htmlspecialchars($row['nom_usuari']);
            $_SESSION['supervisor_id'] = htmlspecialchars($row['supervisor_id']);
            $_SESSION['rol'] = htmlspecialchars($row['rol']);

            if ($_SESSION['rol'] == 'admin') {
                echo json_encode(array("ruta"=> "dashboard_encargado/dashboard_encargado/dashboard_encargado.php"));
            } else {
                echo json_encode(array("ruta"=> "dashboard/dashboard.php"));
            }
        } else {
            echo json_encode(array("error"=> "Contraseña incorrecta"));
        }
    } else {
        echo json_encode(array("error"=> "Usuario no encontrado"));
    }
}

$db->cerrar_conexion();
