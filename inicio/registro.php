<?php
session_start();

require_once 'conexiones/conexion.php';

$mensajeRegistro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["Nombre_Reg"];
    $apellido = $_POST["Apellido_Reg"];
    if (strlen(trim($nombre)) <= 0 || strlen(trim($apellido)) <= 0) {
        $_SESSION['mensaje_error'] = "Por favor, ingrese el nombre y el apellido correctamente.";
        header("Location: registro.php");
        exit;
    }

    $email = $_POST["Email_reg"];
    $contrasena = $_POST["Contrasena"];
    $rol = 'usuario';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['mensaje_error'] = "Por favor, ingrese una dirección de correo electrónico válida.";
        header("Location: registro.php");
        exit;
    }

    if (empty($nombre) || empty($apellido) || empty($email) || empty($contrasena)) {
        $_SESSION['mensaje_error'] = "Por favor, complete todos los campos.";
        header("Location: registro.php");
        exit;
    }

    if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $contrasena)) {
        $_SESSION['mensaje_error'] = "La contraseña debe contener al menos 8 caracteres, incluyendo al menos un número.";
        header("Location: registro.php");
        exit;
    }

    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/", $nombre) || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/", $apellido)) {
        $_SESSION['mensaje_error'] = "El nombre y el apellido solo deben contener letras.";
        header("Location: registro.php");
        exit;
    }

    $checkSql = "SELECT id FROM usuarios WHERE Email_Reg = ?";
    $checkStmt = $conexion->prepare($checkSql);
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        $_SESSION['mensaje_error'] = "Este usuario ya está registrado. Por favor, utiliza otro correo electrónico.";
        header("Location: registro.php");
        exit;
    } else {
        $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
        $insertSql = "INSERT INTO usuarios (Email_Reg, Contrasena, Nombre_Reg, Apellido_Reg, Rol) VALUES (?, ?, ?, ?, ?)";
        $insertStmt = $conexion->prepare($insertSql);

        if ($insertStmt) {
            $insertStmt->bind_param("sssss", $email, $contrasena_hash, $nombre, $apellido, $rol);

            if ($insertStmt->execute()) {
                $_SESSION['mensaje_exitoso'] = "¡Registro exitoso! ¡Bienvenido, $nombre!";
                header("Location: registro.php");
                exit;
            } else {
                $_SESSION['mensaje_error'] = "Error al registrar el usuario: " . $insertStmt->error;
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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,600;0,700;1,400;1,500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="CSS/registro.css">
  <link rel="icon" href="img/logohead.png" type="image/x-icon">
  <title>REGISTRO TECEMPLEO</title>
</head>
<body>

<div class="container-form register">
    <div class="information">
        <div class="info-childs">
            <img src="img/bbb.png" width="280" height="100"> 
            <p> Bienvenido a TecEmpleo</p>
            <input type="button" value="Iniciar Sesión" onclick="redirigirALogin()">
        </div>
    </div>
<center> 
    <br>
    <div class="form-information">
    <div class="form-information-childs">
        <h2>CREAR UNA CUENTA</h2>
        <br>
        <div class="icons"> 
            <i class="ri-google-fill"></i>
            <i class="ri-facebook-circle-fill"></i>
            <i class="ri-instagram-fill"></i>
        </div>
        <br>
        <p>O usa email para registrarte</p>
        <br>
        <form class="form" action="registro.php" method="POST">
            <label>
                <i class="ri-sticky-note-add-line"></i>
                <input type="text" name="Nombre_Reg" placeholder="Nombre" required oninput="validarNombre(this)">
            </label>
            <div id="nombreError" class="error-message"></div>

            <label>
                <i class="ri-file-list-3-line"></i>
                <input type="text" name="Apellido_Reg" placeholder="Apellidos" required oninput="validarApellido(this)">
            </label>
            <div id="apellidoError" class="error-message"></div>

            <label>
                <i class="ri-mail-fill"></i>
                <input type="email" name="Email_reg" id="emailInput" placeholder="Correo Electrónico" required oninput="validarEmail(this)">
            </label>
            <div class="error-message" id="emailError"></div>

            <label>
                <i class="ri-eye-line"></i>
                <input type="password" name="Contrasena" id="contrasenaInput" placeholder="Contraseña" required oninput="validarContrasena(this)">
            </label>
            <div class="error-message" id="contrasenaError"></div>

            <div id="errorCamposVacios" class="error">
                <input type="submit" value="Registrarse" onclick="validarCampos()">

                <?php
                if (isset($_SESSION['mensaje_exitoso']) && !empty($_SESSION['mensaje_exitoso'])) {
                    echo '<div class="registro-exitoso">' . $_SESSION['mensaje_exitoso'] . '</div>';
                    $_SESSION['mensaje_exitoso'] = "";
                } 

                if (isset($_SESSION['mensaje_error']) && !empty($_SESSION['mensaje_error'])) {
                    echo '<div class="mensaje-error">' . $_SESSION['mensaje_error'] . '</div>';
                    $_SESSION['mensaje_error'] = "";
                }
                ?>
            </div>
        </form>
    </div>
</div>
</div>

<div class="boton-flotante">
         <button onclick="window.location.href='registro_empresa.php'">Registra tu Empresa </button>
</div>
<script src="Javascriptinicio/validacionregistro.js"></script>
<script src="Javascriptinicio/redireccionamientos.js"></script>
</body>
</html>
