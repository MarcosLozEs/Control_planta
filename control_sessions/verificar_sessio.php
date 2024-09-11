<?php
session_start();
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuari_id'])) {
  
    header("Location: http://localhost/projecte_planta/html/index.html");    
    exit(); 
}
?>
