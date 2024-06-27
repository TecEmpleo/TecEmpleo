<?php
session_start();
include("../inicio/conexiones/conexion.php");

if (!isset($_SESSION["id"])) {
    header("Location: ../inicio_sesion.php");
    exit();
}
$id_usuario = $_SESSION["id"];
$nueva_fotografia = $_FILES["nueva_fotografia"];

if ($nueva_fotografia["error"] === UPLOAD_ERR_OK) {
    $nueva_foto_tmp = $nueva_fotografia["tmp_name"];
    $nueva_foto_destino = "Fotografia_perfil/" . basename($nueva_fotografia["name"]);
    
    if (move_uploaded_file($nueva_foto_tmp, $nueva_foto_destino)) {
        $sql = "UPDATE perfil SET Fotografia = ? WHERE Usuario_id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("si", $nueva_foto_destino, $id_usuario);
        $stmt->execute();
        header("Location: mi_perfil.php?mensaje=Nueva fotografía actualizada correctamente");
        exit();
    } else {
        echo "Error al cargar la nueva fotografía.";
    }
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $profesion = $_POST["profesion"];
    $edad = $_POST["edad"];
    $departamento = $_POST["departamento"];
    $ciudad = $_POST["ciudad"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $correo_electronico = $_POST["correo_electronico"];
    $sql = "UPDATE perfil SET Profesion = ?, Edad = ?, Departamento = ?, Ciudad = ?, Direccion = ?, Telefono = ?, Correo_Electronico = ? WHERE Usuario_id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sisssssi", $profesion, $edad, $departamento, $ciudad, $direccion, $telefono, $correo_electronico, $id_usuario);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: mi_perfil.php?mensaje=Perfil actualizado correctamente");
        exit();
    } else {
        header("Location: mi_perfil.php?error=No se pudo actualizar el perfil");
        exit();
    }
} else {

    header("Location: mi_perfil.php");
    exit();
}

