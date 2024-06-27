
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
    <link rel="stylesheet" href="cssRecursos_Humanos/proceso.css">
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
<br>
<div class="container">
    <h1>Proceso De Seleccion a la Postulacion</h1>
    <?php
$conexion = new mysqli("localhost", "root", "", "tecempleo");


if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$consulta = "SELECT postulacion.*, usuarios.Nombre_Reg, usuarios.Apellido_Reg, vacantes.Descripcion_vac, empresa.Nombre_emp, empresa.Email_emp
             FROM postulacion
             INNER JOIN usuarios ON postulacion.usuarios_id = usuarios.id
             INNER JOIN vacantes ON postulacion.id_vacante = vacantes.idVacantes
             INNER JOIN empresa ON vacantes.Empresa_id_empresa = empresa.id_empresa
             ORDER BY postulacion.id_postulacion DESC";


$resultado = $conexion->query($consulta);

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo '<div class="list-group-item d-flex justify-content-between align-items-center">';
        echo '<div>';
        echo '<h1 class="mb-1">Nombre: ' . $fila['Nombre_Reg'] . ' ' . $fila['Apellido_Reg'] . '</h1>';
        echo '</div>';
        echo '<div>';
        echo '<h2 class="mb-1">' . $fila['Descripcion_vac'] . '</h2>';
        echo '<p class="mb-1">ID de Postulación: ' . $fila['id_postulacion'] . '</p>';
        echo '<p class="mb-1">Nombre de la Empresa: ' . $fila['Nombre_emp'] . '</p>';
        echo '<p class="mb-1">Email de la Empresa: ' . $fila['Email_emp'] . '</p>';
        echo '<p class="mb-1">ID de Vacante: ' . $fila['id_vacante'] . '</p>';
        echo '<div>';
        echo '<button onclick="enviarMensaje(' . $fila['id_postulacion'] . ')"><i class="ri-close-fill"></i></i> Cerrar</button>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<div class="list-group-item">No hay postulaciones.</div>';
}

$conexion->close();
?>

</div>





<script src="JavascriptRRHH/menu.js"></script>
<script src="JavascriptRRHH/proceso.js"></script>
</body>
</html>