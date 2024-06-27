<?php
session_start();
include("../inicio/conexiones/conexion.php");

if (!isset($_SESSION["id"])) {
    header("Location: ../inicio/inicio_sesion.php");
    exit();
}

$id_usuario = $_SESSION["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['id_Documento'], $_POST['Profesion'], $_POST['Edad'], $_POST['Fecha_Nacimiento'], $_POST['Sexo'], $_POST['Departamento'], $_POST['Ciudad'], $_POST['Direccion'], $_POST['Telefono'], $_POST['Correo_Electronico'])) {
        
        $id_Documento = $_POST['id_Documento'];
        $Profesion = $_POST['Profesion'];
        $Edad = $_POST['Edad'];
        $Fecha_Nacimiento = $_POST['Fecha_Nacimiento'];
        $Sexo = $_POST['Sexo'];
        $Departamento = $_POST['Departamento'];
        $Ciudad = $_POST['Ciudad'];  
        $Direccion = $_POST['Direccion'];
        $Telefono = $_POST['Telefono'];
        $Correo_Electronico = $_POST['Correo_Electronico'];

        
        if (isset($_FILES['Fotografia']) && $_FILES['Fotografia']['error'] === 0) {
            $foto_temp = $_FILES['Fotografia']['tmp_name'];
            $foto_nombre = $_FILES['Fotografia']['name'];
            $ruta_destino = "Fotografia_perfil/" . $foto_nombre;
            
            if (move_uploaded_file($foto_temp, $ruta_destino)) {
                $sql = "INSERT INTO perfil (id_Documento, Usuario_id, fotografia, Profesion, Edad, Fecha_Nacimiento, Sexo, Departamento, Ciudad, Direccion, Telefono, Correo_Electronico) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param("iississsssss", $id_Documento, $id_usuario, $ruta_destino, $Profesion, $Edad, $Fecha_Nacimiento, $Sexo, $Departamento, $Ciudad, $Direccion, $Telefono, $Correo_Electronico);
                
                if ($stmt->execute()) {
                    echo "";
                } else {
                    echo "Ha ocurrido un error al guardar el perfil. Por favor, inténtalo de nuevo más tarde.";
                }
            } else {
                echo "Error al mover el archivo de la imagen.";
            }
        } else {
            echo "Lo siento, hubo un error al subir la imagen.";
        }
    } else {
        echo "Por favor, complete todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil creado exitosamente</title>
    <link rel="stylesheet" href="Css/guardar_perfil.css">
    
</head>
<body>

<div class="mensaje">
    <?php echo "Perfil creado exitosamente. <a href='mi_perfil.php'>Ir a mi perfil</a>"; ?>
</div>

</body>
</html>
