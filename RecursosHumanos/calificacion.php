<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tecempleo";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die(json_encode(array('success' => false, 'error' => 'Conexión fallida: ' . $conn->connect_error)));
    }

    if (isset($_POST["id_usuario"]) && is_numeric($_POST["id_usuario"]) && isset($_POST["puntaje"]) && is_numeric($_POST["puntaje"])) {
        $usuario_id = $_POST["id_usuario"];
        $puntaje = $_POST["puntaje"];


        $stmt = $conn->prepare("SELECT id_usuario FROM puntaje WHERE id_usuario = ?");
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            die("<script>alert('Este usuario ya está calificado.'); window.location.href = 'pruebas.php';</script>");     
        }

        $sql = "INSERT INTO puntaje (id_usuario, puntaje) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die(json_encode(array('success' => false, 'error' => 'Error al preparar la consulta: ' . $conn->error)));
        }
        $stmt->bind_param("ii", $usuario_id, $puntaje);
        $stmt->execute();
        $success = $stmt->affected_rows > 0;
        $stmt->close();

        $conn->close();
        if ($success) {
            echo json_encode(array('success' => true, 'message' => 'Calificación agregada exitosamente.'));
            echo "<script>alert('Calificación agregada exitosamente.'); window.location.href = 'pruebas.php';</script>";
        } else {
            echo json_encode(array('success' => false, 'error' => 'No se pudo agregar la calificación.'));
        }
        exit;
    } else {
        echo json_encode(array('success' => false, 'error' => 'Datos incompletos o inválidos'));
    }
} else {
    echo json_encode(array('success' => false, 'error' => 'Método de solicitud no permitido'));
}
?>
