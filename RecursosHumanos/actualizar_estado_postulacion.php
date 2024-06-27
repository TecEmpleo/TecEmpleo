<?php
if (isset($_POST['id_postulacion']) && isset($_POST['accion'])) {
    $conexion = new mysqli("localhost", "root", "", "tecempleo");
    
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $idPostulacion = $_POST['id_postulacion'];
    $accion = $_POST['accion'];
    $consulta_estado = "SELECT estado FROM postulacion WHERE id_postulacion = $idPostulacion";
    $resultado_estado = $conexion->query($consulta_estado);

    if ($resultado_estado->num_rows > 0) {
        $fila = $resultado_estado->fetch_assoc();
        $estado_actual = $fila['estado'];

        if ($accion === "enviar_mensaje") {
            if ($estado_actual !== "Cerrado") {
                $consulta_actualizar = "UPDATE postulacion SET estado = 'Proceso en Espera' WHERE id_postulacion = $idPostulacion";
                if ($conexion->query($consulta_actualizar) === TRUE) {
                    $mensaje = "¡Mensaje enviado! La postulación está en proceso.";
                } else {
                    $mensaje = "Error al enviar mensaje: " . $conexion->error;
                }
            } else {
                $mensaje = "Error: No se puede enviar un mensaje a una postulación cerrada.";
            }
        } elseif ($accion === "cerrar_proceso") {
            if ($estado_actual !== "Proceso en Espera") {
                $consulta_actualizar = "UPDATE postulacion SET estado = 'Cerrado' WHERE id_postulacion = $idPostulacion";
                if ($conexion->query($consulta_actualizar) === TRUE) {
                    $mensaje = "Proceso de postulación cerrado.";
                } else {
                    $mensaje = "Error al cerrar proceso: " . $conexion->error;
                }
            } else {
                $mensaje = "La postulación se mantiene en estado 'Proceso en Espera'.";
            }
        } elseif ($accion === "activar_postulacion") {
            if ($estado_actual === "Cerrado" || $estado_actual === "Proceso en Espera") {
                $consulta_actualizar = "UPDATE postulacion SET estado = 'Activo' WHERE id_postulacion = $idPostulacion";
                if ($conexion->query($consulta_actualizar) === TRUE) {
                    $mensaje = "Postulación activada.";
                } else {
                    $mensaje = "Error al activar la postulación: " . $conexion->error;
                }
            } else {
                $mensaje = "La postulación ya se encuentra activa o en proceso.";
            }
        } else {
            $mensaje = "Error: Acción no válida.";
        }
    } else {
        $mensaje = "Error: No se encontró la postulación.";
    }

    $conexion->close();

    echo $mensaje;
} else {
    echo "Error: No se recibieron los datos correctamente.";
}
?>
