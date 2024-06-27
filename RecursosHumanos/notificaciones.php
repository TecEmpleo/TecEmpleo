<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificaciones | Recursos Humanos</title>
    <link rel="stylesheet" href="cssRecursos_Humanos/notificaciones.css">
    <link rel="icon" href="IMGRecursosHumanos/Logo.png">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>
    <div class="menu-btn" onclick="toggleNav()" id="menuBtn">&#9776;</div>
    <div id="myMenu" class="menu">
        <div class="search-container"></div>
        <center>
            <a href="javascript:void(0)" class="close-btn" onclick="toggleNav()">&times;</a>

            <br>
            <br>
            <a href="PanelRRHH.php"><i class="ri-home-6-line"></i>Inicio</a>
            <a href="proceso.php"><i class="ri-loop-left-fill"></i>Postulados</a>
            <a href="evaluacion_Datos_HDV.php"><i class="ri-account-pin-box-fill"></i>Evaluación De Hdv</a>
            <a href="pruebas.php"><i class="ri-group-fill"></i>Pruebas Psicotécnicas</a>
            <a href="vacante/vacante.php"><i class="ri-community-line"></i>Crea la Vacante</a>
            <br>
            <br>
            <a href="salarios.php"><i class="ri-currency-line"></i>Salarios</a>
            <br>
            <li>
                <a href="../inicio/cerrar_sesion.php"><i class="ri-logout-box-line" style="color: #ffffff;"></i>Cerrar Sesión</a>
            </li>
        </center>
    </div>
    <br>
    <div id="searchContainer">
        <input type="text" id="searchInput" placeholder="Buscar " oninput="searchUsers()">
        <button id="searchButton">Buscar</button>
    </div>
    <div class="contenedor-notificaciones">
        <h1>Recibe la notificación del usuario que haya sido calificado correctamente</h1>
        <div id="notification" class="notification"><i class="ri ri-notification-line"></i></div>
    </div>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tecempleo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "SELECT u.Nombre_Reg, p.puntaje FROM usuarios u JOIN puntaje p ON u.id = p.id_usuario ORDER BY p.id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<script>
                var notification = document.getElementById('notification');
                notification.innerHTML += '<p>El usuario <strong>" . $row['Nombre_Reg'] . "</strong> tiene un puntaje de <strong>" . $row['puntaje'] . "</strong></p>';
                notification.style.display = 'block';
             </script>";
    }
} else {
    echo "<script>alert('No hay notificaciones disponibles');</script>";
}

$conn->close();
?>

<script>
        function blinkIcon() {
            var icon = document.querySelector('.notification i');
            setInterval(function() {
                icon.style.visibility = (icon.style.visibility == 'visible' ? 'hidden' : 'visible');
            }, 500); 
        }
        window.onload = function() {
            blinkIcon();
        };
    </script>



    <script src="JavascriptRRHH/menu.js"></script>
</body>
</html>
