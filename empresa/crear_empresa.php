<?php
include 'conexionempresa.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ciudad = limpiarDatos($_POST["ciudad"]);
    $direccion = limpiarDatos($_POST["direccion"]);
    $email = limpiarDatos($_POST["email"]);
    $telefono = limpiarDatos($_POST["telefono"]);
    $nombreEmpresa = limpiarDatos($_POST["nombreEmpresa"]);
    $error = false;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<span class="error">El correo electrónico no es válido</span><br>';
        $error = true;
    }
    if (!ctype_digit($telefono)) {
        echo '<span class="error">El teléfono solo debe contener números</span><br>';
        $error = true;
    }

    if (empty($nombreEmpresa)) {
        echo '<span class="error">El nombre de la empresa es requerido</span><br>';
        $error = true;
    }

    if (!$error) {
        $sql = "INSERT INTO empresa (Ciudad_emp, Direccion_emp, Email_emp, Telefono_emp, Nom_emp) VALUES ('$ciudad', '$direccion', '$email', '$telefono', '$nombreEmpresa')";
        if ($conn->query($sql) === TRUE) {
            echo '<span class="success">Empresa creada con éxito</span><br>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

function limpiarDatos($dato) {
    $dato = trim($dato);
    $dato = stripslashes($dato);
    $dato = htmlspecialchars($dato);
    return $dato;
}
?>
