<?php
session_start();

// Verificar si la sesión está iniciada
if(isset($_SESSION['id_empresa'])) {
    // Procesar la actualización de la información de la empresa
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recuperar los datos del formulario
        $direccionEmpresa = $_POST['direccionEmpresa'];
        $ciudadEmpresa = $_POST['ciudadEmpresa'];
        $emailEmpresa = $_POST['emailEmpresa'];
        $telefonoEmpresa = $_POST['telefonoEmpresa'];

        // Actualizar los datos en la base de datos
        require_once '../inicio/conexiones/conexion.php';
        $id_empresa = $_SESSION['id_empresa'];
        $sql_update_empresa = "UPDATE empresa SET  Direccion_emp=?, Ciudad_emp=?, Email_emp=?, Telefono_emp=? WHERE id_empresa=?";
        $stmt_update_empresa = $conexion->prepare($sql_update_empresa);
        $stmt_update_empresa->bind_param("ssssi",  $direccionEmpresa, $ciudadEmpresa, $emailEmpresa, $telefonoEmpresa, $id_empresa);
        $stmt_update_empresa->execute();

        // Cerrar la conexión y redirigir de vuelta a la página principal
        $stmt_update_empresa->close();
        $conexion->close();
        header("Location: ../Empresa.php");
        exit();
    }
} else {
    // Si no está iniciada la sesión, redirigir al usuario a la página de inicio de sesión
    header("Location: ../inicio/inicio_empresa.php");
    exit();
}
?>
