<?php
session_start(); // Inicia la sesión si aún no se ha iniciado

// Procesar la creación de la vacante
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si la sesión de empresa está iniciada
    if(isset($_SESSION['id_empresa'])) {
        require_once 'conexion.php';
        
        // Obtiene los datos del formulario
        $categoriaId = $_POST['categoria'];
        $descripcionVacante = $_POST['descripcionVacante'];
        $fechaPublicacion = $_POST['fechaPublicacion'];
        $fechaCierre = $_POST['fechaCierre'];
        $estadoVacante = $_POST['estadoVacante'];
        $salario = $_POST['salario'];
        $empresaId = $_POST['empresaId']; // ID de la empresa obtenida del campo oculto
        $enlaceVacante = isset($_POST['enlaceVacante']) ? $_POST['enlaceVacante'] : null; // Nuevo campo para el enlace de la vacante (opcional)
        
        // Prepara la consulta SQL
        $sql_insert = "INSERT INTO vacantes (Categoria_idCategoria, Empresa_id_empresa, Descripcion_vac, Fecha_Publicacion, Fecha_Cierre, Estado, Salario, enlace_vacante) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = $conexion->prepare($sql_insert);
        
        // Ejecuta la consulta
        // Si $enlaceVacante es null, se insertará NULL en la base de datos
        $stmt_insert->bind_param("iissssss", $categoriaId, $empresaId, $descripcionVacante, $fechaPublicacion, $fechaCierre, $estadoVacante, $salario, $enlaceVacante);
        if ($stmt_insert->execute()) {
            $_SESSION['success_message'] = "La vacante se creó exitosamente.";
        } else {
            $_SESSION['error_message'] = "Hubo un error al crear la vacante. Por favor, inténtalo de nuevo.";
        }
        
        // Cierra la conexión y el statement
        $stmt_insert->close();
        $conexion->close();
        
        // Redirige a algún lugar apropiado después de crear la vacante
        header("Location: ../Empresa.php");
        exit();
    } else {
        // Si no está iniciada la sesión de empresa, redirige a la página de inicio de sesión
        header("Location: ../inicio/inicio_empresa.php");
        exit();
    }
}
?>
