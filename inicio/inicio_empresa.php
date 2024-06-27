<?php
session_start();

require_once 'conexiones/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["Email_emp"];
    $contrasena = $_POST["Contrasena"];

    $sql = "SELECT * FROM empresa WHERE Email_emp = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($contrasena, $row['Contrasena'])) {
            $_SESSION["id_empresa"] = $row["id_empresa"];
            $_SESSION["Nombre_emp"] = $row["Nombre_emp"];
            $_SESSION["Email_emp"] = $row["Email_emp"];
            // Redirigir a la página de inicio de sesión exitosa
            header("Location: ../Empresa.php");
            exit();
        } else {
            $_SESSION["mensaje_error"] = "Contraseña incorrecta.";
        }
    } else {
        $_SESSION["mensaje_error"] = "No se encontró ninguna empresa con ese correo electrónico.";
    }
}

$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Empresa</title>
    <link rel="stylesheet" href="./css/inicio_empresa.css">
</head>
<body>
<br><br><br>

<div class="container-form register">
    <div class="information">
            <div class="info-childs">
                <img src="img/bbb.png" width="280" height="100"> 
                <p> Bienvenido a TecEmpleo</p>
                <input type="button" value="Registra tu empresa" onclick="window.location.href = 'registro_empresa.php'">
            </div>
    </div>
<br><br>
    <div class="form-information">
    <div class="form-information-childs">
        <h2>Iniciar Sesión - Empresa</h2>
        <br><br>
        <form class="form" action="inicio_empresa.php" method="POST">
            <label>
               <input type="email" name="Email_emp" id="Email_emp" placeholder="Correo Electrónico:" required>
            </label>
            <label for="Contrasena">
                <input type="password" name="Contrasena" id="Contrasena" placeholder="Dijite su contraseña" required>
            </label>
            
            <input type="submit" value="Iniciar Sesión">
            <br>
            <?php
            if (isset($_SESSION['mensaje_error']) && !empty($_SESSION['mensaje_error'])) {
                echo '<div class="mensaje-error">' . $_SESSION['mensaje_error'] . '</div>';
                unset($_SESSION['mensaje_error']);
            }
            ?>
        </form>
    
    </div>
</div>

</div>    

<div class="boton-flotante">
         <button onclick="window.location.href='inicio_sesion.php'">Iniciar como usuario</button>
</div>

</body>
</html>
