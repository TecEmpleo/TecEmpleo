<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tecempleo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "SELECT Email_Reg, Nombre_Reg, Apellido_Reg FROM usuarios";
$result = $conn->query($sql);

$usuarios = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = array(
            'email' => $row["Email_Reg"],
            'nombre' => $row["Nombre_Reg"],
            'apellido' => $row["Apellido_Reg"]
        );
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recursos Humanos</title>
    <link rel="shortcut icon" href="favicon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="cssRecursos_Humanos/CssRRHH.css">
    <link rel="icon" href="IMGRecursosHumanos/Logo.png">
</head>
<body>
<center>

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

<center>
<div class="container-xxl">
    <h1>Conversacion De Usuarios</h1>
    <ul class="list-group contenedor-usuarios lista-usuarios" id="listaUsuarios">
        <?php
        if (!empty($usuarios)) {
            foreach ($usuarios as $usuario) {
                echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
                echo '<div>';
                echo '<h1 class="mb-1">Nombre: ' . $usuario['nombre'] . ' ' . $usuario['apellido'] . '</h1>';
                echo '<h2 class="mb-1">Correo: ' . $usuario['email'] . '</h2>';
                echo '</div>';
                echo '<div class="iconos-derecha">';
                echo '<i class="ri-check-line" onclick="mostrarFormulario(\'' . $usuario['email'] . '\')"></i>';
                echo '</div>';
                echo '</li>';
            }
        } else {
            echo '<li class="list-group-item">No se encontraron usuarios.</li>';
        }
        ?>
    </ul>
</div>

</center>
<br>
<div class="vacancy-container">
    <h1>Crear Vacante</h1>
    <p>Recibe notificaciones sobre las nuevas vacantes que publica la empresa. Mantente al tanto de las oportunidades laborales disponibles.</p>
    <img src="empresa.jpg" alt="" class="imagen-estilizada">
    <br>
    <a href="./vacante/vacante.php" class="button-vacancy">Abrir Formulario</a>
</div>
<br>
<div class="contenedor-principal">
<div class="contenedor-izquierda">
    <h1>Cronogra Tiempo</h1>
    <i class="ri-time-line"></i>
    <span id="horas-trabajadas">0</span> <span id="h-label">h:</span>
    <span id="minutos-trabajados">0</span> <span id="m-label">m:</span>
    <span id="segundos-trabajados">0</span> <span id="s-label">s:</span>
    <h2>Jornada De Hoy</h2>
    <br>
    <button id="iniciar-tiempo" onclick="iniciarTiempo()">Iniciar</button>
    <button id="detener-tiempo" onclick="detenerTiempo()" disabled>Detener</button>
    <button id="reanudar-tiempo" onclick="reanudarTiempo()" disabled>Reanudar</button>
</div>
</div>
<div class="calendario-container">
<h1>Calendario </h1>
  <select class="mes" id="mes"></select>
  <select class="año" id="año"></select>
  <div class="dias" id="dias"></div>
  <br>
  <button class="flecha-izquierda" id="flecha-izquierda"><i class="ri-arrow-left-fill"></i></button>
  <button class="flecha-derecha" id="flecha-derecha"><i class="ri-arrow-right-fill"></i></button>
</div>
</div>
<br>


    <div class="contenedor-derecha">
    </div>
</div>
</div>
    </ul>
</div>

<script src="JavascriptRRHH/menu.js"></script>
<script src="JavascriptRRHH/chat.js"></script>
<script src="JavascriptRRHH/politicaPrivada.js"></script>
<script src="JavascriptRRHH/requisitos.js"></script>
<script src="JavascriptRRHH/jornada.js"></script>
<script src="JavascriptRRHH/calendario.js"></script>

</body>
</html>