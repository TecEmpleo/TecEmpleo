<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respuestas de Encuesta</title>
    <link rel="stylesheet" href="cssRecursos_Humanos/pruebas.css">
    <link rel="icon" href="IMGRecursosHumanos/Logo.png">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>
    <div class="menu-btn" onclick="toggleNav()" id="menuBtn">&#9776;</div>
<div id="myMenu" class="menu">
<div class="search-container">
</div>
<center>
    <a href="javascript:void(0)" class="close-btn" onclick="toggleNav()">&times;</a>
    <br>
    <br>
    <a href="PanelRRHH.php"><i class="ri-home-6-line"></i>inicio</a>
    <a href="proceso.php"><i class="ri-loop-left-fill"></i>Postulados</a>
    <a href="evaluacion_Datos_HDV.php"><i class="ri-account-pin-box-fill"></i>Evaluacion De Hdv</a>
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

<div class="container">
    <h1>Respuestas de Encuesta</h1>
    <button id="verRespuestasBtn">Ver Respuestas</button>
    <div id="respuestasContenedor" style="display: none;"> 
    <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tecempleo";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
$sql = "SELECT * FROM respuestas_encuesta";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<div class='respuestas-container'>";
    while($row = $result->fetch_assoc()) {
        $usuario_id = $row["id_usuario"]; 
        
        echo "<div class='respuesta'>";
        echo "<h2 class='pregunta'>Respuesta</h2>";
        echo "<ul class='respuestas'>";
        echo "<li><strong>ID Usuario:</strong> " . $row["id_usuario"] . "</li>"; 
        
        echo "<li><strong>Pregunta Trabajo:</strong> " . $row["pregunta_trabajo"] . "</li>";
        echo "<li><strong>Pregunta Características:</strong> " . $row["pregunta_caracteristicas"] . "</li>";
        echo "<li><strong>Pregunta Problema:</strong> " . $row["pregunta_problema"] . "</li>";
        echo "<li><strong>Pregunta Ayuda:</strong> " . $row["pregunta_ayuda"] . "</li>";
        echo "<li><strong>Pregunta Cambio:</strong> " . $row["pregunta_cambio"] . "</li>";
        echo "<li><strong>Pregunta Presión:</strong> " . $row["pregunta_presion"] . "</li>";
        echo "<li><strong>Pregunta Decisiones:</strong> " . $row["pregunta_decisiones"] . "</li>";
        echo "<li><strong>Pregunta Liderazgo:</strong> " . $row["pregunta_liderazgo"] . "</li>";
        echo "<li><strong>Pregunta Responsabilidad:</strong> " . $row["pregunta_responsabilidad"] . "</li>";
        echo "<li><strong>Pregunta Lider:</strong> " . $row["pregunta_lider"] . "</li>";

        echo "</ul>";
        echo "</div>";
        
        echo "<form id='calificarForm_$usuario_id' method='post' action='calificacion.php'>"; 
        echo "<input type='hidden' name='id_usuario' value='$usuario_id'>"; 
        echo "<div class='rating'>";
        echo "<span class='star' data-value='1' onclick=\"setRating($usuario_id, 1)\">&#9733;</span>"; 
        echo "<span class='star' data-value='2' onclick=\"setRating($usuario_id, 2)\">&#9733;</span>";
        echo "<span class='star' data-value='3' onclick=\"setRating($usuario_id, 3)\">&#9733;</span>";
        echo "<span class='star' data-value='4' onclick=\"setRating($usuario_id, 4)\">&#9733;</span>";
        echo "<span class='star' data-value='5' onclick=\"setRating($usuario_id, 5)\">&#9733;</span>";
        echo "<input type='hidden' id='ratingValue_$usuario_id' name='puntaje' value='0'>"; 
        echo "</div>";
        echo "<button type='submit' class='enviarCalificacionBtn'>Enviar Calificación</button>"; 
        echo "</form>";
        
        echo "</ul>";
        echo "</div>";
    }
} else {
    echo "No hay respuestas disponibles.";
}

$conn->close();
?>


    <script src="JavascriptRRHH/menu.js"></script>
    <script src="JavascriptRRHH/pruebas.js"></script>
    <script src="JavascriptRRHH/estrellas.js"></script>
</body>
</html>
