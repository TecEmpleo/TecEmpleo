<?php
// obtener_postulados.php

// Tu código PHP para conectar a la base de datos y obtener los usuarios postulados a la vacante
require_once 'conexion.php';

if(isset($_GET['vacanteId'])) {
    $vacanteId = $_GET['vacanteId'];

    // Consulta SQL para obtener los usuarios postulados a la vacante especificada
    $sql_postulados = "SELECT * FROM postulacion WHERE id_vacante = ?";
    $stmt_postulados = $conexion->prepare($sql_postulados);
    $stmt_postulados->bind_param("i", $vacanteId);
    $stmt_postulados->execute();
    $result_postulados = $stmt_postulados->get_result();

    $postulados = array();
    while ($row_postulado = $result_postulados->fetch_assoc()) {
        $postulados[] = array(
            'id' => $row_postulado['usuarios_id'],
            'nombre' => obtenerNombreUsuario($row_postulado['usuarios_id']) // Función para obtener el nombre del usuario
        );
    }

    // Cerrar conexión a la base de datos
    $stmt_postulados->close();
    $conexion->close();

    // Devolver los usuarios postulados como una respuesta JSON
    echo json_encode(array('success' => true, 'users' => $postulados));
} else {
    // Si no se proporciona el ID de la vacante, devolver un mensaje de error
    echo json_encode(array('success' => false, 'message' => 'ID de vacante no proporcionado.'));
}


function obtenerNombreUsuario($idUsuario) {
    global $conexion;
    $sql = "SELECT Nombre_Reg, Apellido_Reg, Email_Reg FROM usuarios WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();
    $stmt->bind_result($nombre, $apellido, $correo);
    $stmt->fetch();

    // Retorna una cadena con los valores separados por coma
    return "$nombre $apellido | $correo";
}

?>
