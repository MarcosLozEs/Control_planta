<?php
session_start();
session_destroy();
header("Location: http://localhost/projecte_planta/html/index.html");
exit();
?>
