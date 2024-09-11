<?php

$id = $_POST['id'];

require "../clase_consultar.php";
require "../clase_base_dades.php";

if (empty($id)) {
    echo "Por favor, introduzca un ID";
} else { 
     $db = new baseDades();
     $donar_baixa = new Consultar($db, array($id),"SELECT `nom_usuari`, `rol`,`seccio`,`supervisor_id` FROM `usuaris` WHERE `usuari_id`= ?","i" );    
     $resultat = $donar_baixa->consultar();
     
     if ($resultat->num_rows > 0) {
          $row = $resultat->fetch_assoc();

           $respuesta[] = array($row["nom_usuari"],$row["rol"],$row["seccio"],$row["supervisor_id"]);
           echo json_encode($respuesta);
       }
     else{echo json_encode(array("valido"=>"Introduzca un id válido."));}

} 
?>