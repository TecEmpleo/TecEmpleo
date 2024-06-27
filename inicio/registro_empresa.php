<?php
session_start();

require_once 'conexiones/conexion.php';

$mensajeRegistro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_empresa = $_POST["Nombre_emp"];
    $direccion_empresa = $_POST["Direccion_emp"];
    $ciudad_empresa = $_POST["Ciudad_emp"];
    $email_empresa = $_POST["Email_emp"];
    $telefono_empresa = $_POST["Telefono_emp"];
    $contrasena = password_hash($_POST["Contrasena"], PASSWORD_DEFAULT);

    // Verificar si el correo electrónico tiene un formato válido
    if (!filter_var($email_empresa, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['mensaje_error'] = "Por favor, ingrese una dirección de correo electrónico válida.";
        header("Location: registro_empresa.php");
        exit;
    }

    if (empty($nombre_empresa) || empty($direccion_empresa) || empty($ciudad_empresa) || empty($email_empresa) || empty($telefono_empresa) || empty($contrasena)) {
        $_SESSION['mensaje_error'] = "Por favor, complete todos los campos.";
        header("Location: registro_empresa.php");
        exit;
    }

    $checkSql = "SELECT id_empresa FROM empresa WHERE Email_emp = ?";
    $checkStmt = $conexion->prepare($checkSql);
    $checkStmt->bind_param("s", $email_empresa);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        $_SESSION['mensaje_error'] = "Esta empresa ya está registrada. Por favor, utiliza otro correo electrónico.";
        header("Location: registro_empresa.php");
        exit;
    } else {
        $insertSql = "INSERT INTO empresa (Nombre_emp, Direccion_emp, Ciudad_emp, Email_emp, Telefono_emp, Contrasena) VALUES (?, ?, ?, ?, ?, ?)";
        $insertStmt = $conexion->prepare($insertSql);

        if ($insertStmt) {
            $insertStmt->bind_param("ssssss", $nombre_empresa, $direccion_empresa, $ciudad_empresa, $email_empresa, $telefono_empresa, $contrasena);

            if ($insertStmt->execute()) {
                $_SESSION['mensaje_exitoso'] = "¡Registro exitoso! ¡Bienvenido, $nombre_empresa!";
                header("Location: registro_empresa.php");
                exit;
            } else {
                $_SESSION['mensaje_error'] = "Error al registrar la empresa: " . $insertStmt->error;
            }

            $insertStmt->close();
        } else {
            $_SESSION['mensaje_error'] = "Error en la preparación de la consulta: " . $conexion->error;
        }
    }

    $checkStmt->close();
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Empresa</title>
    <link rel="stylesheet" href="./css/registro_empresa.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,600;0,700;1,400;1,500&display=swap" rel="stylesheet">
    <link rel="icon" href="img/logohead.png" type="image/x-icon">
</head>
<body>
    <br><br><br>
<div class="container-form register">
    <div class="information">
            <div class="info-childs">
                <img src="img/bbb.png" width="280" height="100"> 
                <p> Bienvenido a TecEmpleo</p>
                <input type="button" value="Iniciar Sesión" onclick="window.location.href = 'inicio_empresa.php'">
            </div>
    </div>

<br><br>
    <div class="form-information">
    <div class="form-information-childs">
        <h2>Registro de Empresa</h2>
        <br><br>
        <form id="registro_empresa" class="form" action="registro_empresa.php" method="POST">
            <label>
                <input type="text" name="Nombre_emp" placeholder="Nombre de la Empresa"required>
            </label>
            <label>
                <input type="text" name="Direccion_emp" placeholder="Dirección de la Empresa" required>
            </label>
            <label>
                <input type="text" name="Ciudad_emp" placeholder=" Ciudad de la Empresa" required>
            </label>
            <label>
                <input type="email" name="Email_emp" placeholder="Correo Electrónico" required pattern="[a-zA-Z0-9._%+-]+@(gmail|hotmail|outlook)\.(com)">
            </label>

            <label>
                <input type="tel" name="Telefono_emp" placeholder="Teléfono" required pattern="[0-9]+" title="Solo números">
            </label>
            <label>
                <input type="password" name="Contrasena" placeholder="Contraseña" required>
            </label>

            <input type="submit" value="Registrarse">
            <br>
            <?php
            if (isset($_SESSION['mensaje_exitoso']) && !empty($_SESSION['mensaje_exitoso'])) {
                echo '<div class="mensaje-exitoso">' . $_SESSION['mensaje_exitoso'] . '</div>';
                $_SESSION['mensaje_exitoso'] = "";
            } 

            if (isset($_SESSION['mensaje_error']) && !empty($_SESSION['mensaje_error'])) {
                echo '<div class="mensaje-error">' . $_SESSION['mensaje_error'] . '</div>';
                $_SESSION['mensaje_error'] = "";
            }
            ?>
        </form>
</div>
</div>

</div>

<div class="boton-flotante">
         <button onclick="window.location.href='inicio_sesion.php'">Iniciar como usuario</button>
</div>
<script src="Javascriptinicio/redireccionamientos.js"></script>

</body>
</html>
