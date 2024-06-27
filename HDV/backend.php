<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "tecempleo";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

function insertarRegistro($nombre_completo, $cargo, $nombre_cargo, $funciones, $trabajando, $desde, $hasta, $nivel_educativo, $centro_educativo, $cursando_actualmente) {
    global $conn;
    $sql = "INSERT INTO hdv (nombre_completo, cargo, nombre_cargo, funciones, trabajando, desde, hasta, nivel_educativo, centro_educativo, cursando_actualmente) VALUES ('$nombre_completo', '$cargo', '$nombre_cargo', '$funciones', '$trabajando', '$desde', '$hasta', '$nivel_educativo', '$centro_educativo', '$cursando_actualmente')";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return "Error al ejecutar la consulta: " . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nombre_completo"]) && isset($_POST["cargo"]) && isset($_POST["nombre_cargo"]) && isset($_POST["funciones"]) && isset($_POST["trabajando"]) && isset($_POST["desde"]) && isset($_POST["hasta"]) && isset($_POST["nivel_educativo"]) && isset($_POST["centro_educativo"]) && isset($_POST["cursando_actualmente"])) {

        $resultado = insertarRegistro($_POST["nombre_completo"], $_POST["cargo"], $_POST["nombre_cargo"], $_POST["funciones"], $_POST["trabajando"], $_POST["desde"], $_POST["hasta"], $_POST["nivel_educativo"], $_POST["centro_educativo"], $_POST["cursando_actualmente"]);
        if ($resultado === true) {
            echo "Registro insertado correctamente.";
            echo "<script>alert('Registro de HDV exitoso.'); window.location.href = 'index.html';</script>";
        } else {
            echo "Error al insertar el registro: " . $resultado;
        }
    } else {
        echo "<script>alert('Por favor, valide todos los campos antes de enviar el formulario.');</script>";
    }
}

?>
