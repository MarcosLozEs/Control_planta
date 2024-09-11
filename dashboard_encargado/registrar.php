<?php

$id = htmlspecialchars($_POST['id']);
$nombre = htmlspecialchars($_POST['nombre']);
$rol = htmlspecialchars($_POST['rol']);
$data = date("Y-m-d");
$seccion = htmlspecialchars($_POST['seccion']);
$id_supervisor = htmlspecialchars($_POST['id_supervisor']);
$hash_contraseña = htmlspecialchars(password_hash($_POST['contrasenya'], PASSWORD_DEFAULT));



require "../clase_consultar.php";
require "../clase_base_dades.php";

if ($id_supervisor === '') {
    $id_supervisor = null;
}


if (empty($id) || empty($nombre) || empty($rol) || empty($seccion) || empty($hash_contraseña) || empty($data)) {
    echo "Por favor, complete todos los campos.";
} else {
    $valors = array_de_valors($id, $nombre, $rol, $data, $seccion, $hash_contraseña, $id_supervisor);
    $db = new baseDades();
    $registre = new Consultar($db, $valors, "INSERT INTO usuaris (usuari_id, nom_usuari, rol, 
    data_incorporacio ,seccio, contraseña, supervisor_id ) VALUES (?, ?, ?, ?, ?, ?, ?)", "isssssi");
    $registre->consultar();
    header("Refresh:0");
}

function array_de_valors($id, $nombre, $data, $rol, $seccion, $id_supervisor, $hash_contraseña)
{
    $valors = [
        $id, $nombre,
        $data, $rol, $seccion,
        $id_supervisor,
        $hash_contraseña
    ];

    return $valors;
}
