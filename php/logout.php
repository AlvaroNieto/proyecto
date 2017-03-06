<?php
//iniciamos sesion
session_start();
//destruimos sesion
session_destroy();
//redirigimos a la pagina de login
session_start();
$_SESSION["user"] = "unloged";
header("location:../index.php");
?>
