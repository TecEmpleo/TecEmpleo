<?php
include("conexiones/conexion.php");

session_start();

$mensajeError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Email_reg = $_POST["Email_reg"];
    $Contrasena = $_POST["Contrasena"];

    $sql = "SELECT id, Nombre_Reg, Apellido_Reg, Rol, Contrasena FROM usuarios WHERE Email_reg = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $Email_reg);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $Nombre_Reg, $Apellido_Reg, $rol, $contraseña_hash);
        $stmt->fetch();

        if (password_verify($Contrasena, $contraseña_hash)) {
            $_SESSION["id"] = $id;
            $_SESSION["Nombre_Reg"] = $Nombre_Reg;
            $_SESSION["Apellido_Reg"] = $Apellido_Reg; 

            if ($rol == 'administrador') {
                header("Location: ../Admin/Administrador.php");
                exit();
            } elseif ($rol == 'usuario') {
                header("Location: ../TecEmpleo.php");
                exit();
            } elseif ($rol == 'recursos_humanos') {
                header("Location: ../RecursosHumanos/PanelRRHH.php");
                exit();
            } else {
                $mensajeError = "Rol no válido.";
            }
        } else {
            $mensajeError = "Contraseña incorrecta.";
        }
    } else {
        $mensajeError = "Email no encontrado.";
    }

    $_SESSION["mensajeError"] = $mensajeError;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>LOGIN TECEMPLEO</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,600;0,700;1,400;1,500&display=swap" rel="stylesheet">
    <link rel="icon" href="img/logohead.png" type="image/x-icon">
    <link rel="stylesheet" href="CSS/inicio.css">
</head>
<body>
    <div class="container-form login hide">
        <div class="information">
            <div class="info-childs">
                <img src="img/bbb.png" width="280" height="100"> 
                <p>Bienvenido a TecEmpleo</p>
                <input type="button" value="Crear Cuenta" onclick="redirigirARegistro()">
            </div>
        </div>
       <br>
        <div class="form-information">
    <div class="form-information-childs">
        <h2>INICIAR SESIÓN</h2>
        <br>
        <div class="icons">
            <i class="ri-google-fill"></i>
            <i class="ri-facebook-circle-fill"></i>
            <i class="ri-instagram-fill"></i>
        </div>
        <br>
        <form class="form" action="inicio_sesion.php" method="POST" onsubmit="return validarFormulario()">
            <label>
                <i class="ri-mail-fill"></i>
                <input type="email" name="Email_reg" id="emailInput" placeholder="Correo Electrónico" required oninput="validarEmailRegistro(this)">
            </label>
            <div class="error-message" id="emailError">
                <?php echo isset($_SESSION["mensajeError"]) ? $_SESSION["mensajeError"] : ""; ?>
            </div>

            <label>
                <i class="ri-eye-line"></i>
                <input type="password" name="Contrasena" id="contrasenaInput" placeholder="Contraseña" required oninput="validarContrasenaRegistro(this)">
            </label>
            <div class="error-message" id="contrasenaError"></div>

            <input type="submit" value="Iniciar Sesión">

            <div class="error-message" id="formError"></div>

            <?php
            unset($_SESSION["mensajeError"]);
            ?>
        </form>
        <center>
    </div>
</div>

<div class="boton-flotante">
         <button onclick="window.location.href='registro_empresa.php'">Registra tu empresa</button>
</div>


<script src='Javascriptinicio/validacioninicio.js'></script>
<script src='Javascriptinicio/redireccionamientos.js'></script>

</body>
</body>
</html>
