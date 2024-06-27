<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluacion | HDV Postulados</title>
    <link rel="stylesheet" href="cssRecursos_Humanos/evaluacionHDV.css">
    <link rel="icon" href="IMGRecursosHumanos/Logo.png">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
</head>
<body>
    <div class="menu-btn" onclick="toggleNav()" id="menuBtn">&#9776;</div>
<div id="myMenu" class="menu">
<div class="search-container">
</div>
<center>
    <a href="javascript:void(0)" class="close-btn" onclick="toggleNav()">&times;</a>
    <br>
    <a href="PanelRRHH.php"><i class="ri-home-6-line"></i>inicio</a>
    <a href="proceso.php"><i class="ri-loop-left-fill"></i>Postulados</a>
    <a href="pruebas.php"><i class="ri-group-fill"></i>Pruebas Psicotecnicas</a>
    <a href="vacante/vacante.php"><i class="ri-community-line"></i></i>Crea la Vacante</a>
    <br>
    <br>
    <a href="salarios.php"><i class="ri-currency-line"></i>Salarios</a>
    <a href="notificaciones.php"><i class="ri-notification-fill"></i></i>Notificaciones</a>
    <br>
    <li>
    <a href="../inicio/cerrar_sesion.php"><i class="ri-logout-box-line" style="color: #ffffff;"></i>Cerrar Sesión</a>
    </li>
</div>
<br>
<div id="searchContainer">
    <input type="text" id="searchInput" placeholder="Buscar " oninput="searchUsers()">
    <button id="searchButton">Buscar</button>
</div>
<div class="contenedor-hdv">
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tecempleo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id_hdv, nombre_completo, cargo, nombre_cargo, funciones, trabajando, desde, hasta, nivel_educativo, centro_educativo, cursando_actualmente FROM hdv";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nombre Completo</th>
                <th>Cargo</th>
                <th>Nombre Cargo</th>
                <th>Funciones</th>
                <th>Trabajando</th>
                <th>Desde</th>
                <th>Hasta</th>
                <th>Nivel Educativo</th>
                <th>Centro Educativo</th>
                <th>Cursando Actualmente</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["id_hdv"]."</td>
                <td>".$row["nombre_completo"]."</td>
                <td>".$row["cargo"]."</td>
                <td>".$row["nombre_cargo"]."</td>
                <td>".$row["funciones"]."</td>
                <td>".$row["trabajando"]."</td>
                <td>".$row["desde"]."</td>
                <td>".$row["hasta"]."</td>
                <td>".$row["nivel_educativo"]."</td>
                <td>".$row["centro_educativo"]."</td>
                <td>".$row["cursando_actualmente"]."</td>
            </tr>";
    }
    echo "</table>";

    echo '<button onclick="evaluarDatos()">Evaluar Datos <i id="loadingIcon" class="ri-loop-left-line loading-icon" style="display:none;"></i></button>';
} else {
    echo "0 results";
}
$conn->close();
?>
</div>




<script src="JavascriptRRHH/menu.js"></script>
<script src="JavascriptRRHH/evaluacion.js"></script>
</body>
</html>