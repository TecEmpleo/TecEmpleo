<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: inicio_sesion.php");
    exit();
}

$Nombre_Reg = $_SESSION["Nombre_Reg"];
?>
