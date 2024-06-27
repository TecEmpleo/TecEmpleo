<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salarios | Recursos Humanos TecEmpleo</title>
    <link rel="stylesheet" href="cssRecursos_Humanos/salarios.css">
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
    <a href="pruebas.php"><i class="ri-group-fill"></i>Pruebas Psicotecnicas</a>
    <a href="vacante/vacante.php"><i class="ri-community-line"></i></i>Crea la Vacante</a>
    <br>
    <br>
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
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="calculator">
        <h1>Calculadora TecEmpleo</h1>
        <input type="text" class="screen" id="screen" readonly>
        <div class="buttons">
            <button onclick="appendToScreen('1')">1</button>
            <button onclick="appendToScreen('2')">2</button>
            <button onclick="appendToScreen('3')">3</button>
            <button onclick="appendToScreen('+')">+</button>
            <button onclick="appendToScreen('4')">4</button>
            <button onclick="appendToScreen('5')">5</button>
            <button onclick="appendToScreen('6')">6</button>
            <button onclick="appendToScreen('7')">7</button>
            <button onclick="appendToScreen('8')">8</button>
            <button onclick="appendToScreen('9')">9</button>
            <button onclick="appendToScreen('0')">0</button>
            <button onclick="appendToScreen('.')">.</button>
            <button onclick="appendToScreen(',')">,</button> 
            <button onclick="backspace()">←</button> 
            <button onclick="clearScreen()">C</button>
            <button onclick="calculate()">=</button>
            <button onclick="appendToScreen('+')">+</button>
            <button onclick="appendToScreen('-')">-</button>
            <button onclick="appendToScreen('*')">*</button>
            <button onclick="appendToScreen('/')">/</button>
        </div>
    </div>
    <?php
function mostrarVacantes($vacantes) {
    echo "<div style='overflow-x: auto; overflow-y: auto; max-height: 400px;'>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Categoría</th><th>Empresa</th><th>Descripción</th><th>Fecha de Publicación</th><th>Fecha de Cierre</th><th>Estado</th><th>Salario</th><th>Actualizar Salario</th><th>Eliminar Salario</th></tr>";
    foreach ($vacantes as $vacante) {
        echo "<tr>";
        echo "<td>{$vacante['idVacantes']}</td>";
        echo "<td>{$vacante['Nombre_Cat']}</td>";
        echo "<td>{$vacante['Nombre_emp']}</td>";
        echo "<td>{$vacante['Descripcion_vac']}</td>";
        echo "<td>{$vacante['Fecha_Publicacion']}</td>";
        echo "<td>{$vacante['Fecha_Cierre']}</td>";
        echo "<td>{$vacante['Estado']}</td>";
        echo "<td>{$vacante['Salario']}</td>";
        echo "<td>";
        echo "<form id='form{$vacante['idVacantes']}' action='{$_SERVER['PHP_SELF']}' method='post' onsubmit='return validarSalario({$vacante['idVacantes']});'>";
        echo "<input type='hidden' name='idVacante' value='{$vacante['idVacantes']}'>";
        echo "<input type='number' name='salario' step='0.01' placeholder='Ingrese el salario'>";
        echo "<button type='submit'>Actualizar Salario</button>";
        echo "</form>";
        echo "</td>";
        echo "<td>";
        echo "<form action='{$_SERVER['PHP_SELF']}' method='post'>";
        echo "<input type='hidden' name='idVacante' value='{$vacante['idVacantes']}'>";
        echo "<input type='hidden' name='eliminarSalario' value='true'>";
        echo "<button type='submit'>Eliminar Salario</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tecempleo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminarSalario'])) {
    $idVacante = $_POST['idVacante'];
    $sql = "UPDATE vacantes SET Salario=NULL WHERE idVacantes=$idVacante";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Salario eliminado correctamente.');</script>";
    } else {
        echo "<script>alert('Error al eliminar el salario: " . $conn->error . "');</script>";
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['salario'])) {
    $idVacante = $_POST['idVacante'];
    $nuevoSalario = $_POST['salario'];
    $sql = "UPDATE vacantes SET Salario=$nuevoSalario WHERE idVacantes=$idVacante";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Salario actualizado correctamente.');</script>";
    } else {
        echo "<script>alert('Error al actualizar el salario: " . $conn->error . "');</script>";
    }
}

$sql = "SELECT v.idVacantes, v.Categoria_idCategoria, v.Empresa_id_empresa, v.Descripcion_vac, v.Fecha_Publicacion, v.Fecha_Cierre, v.Estado, v.Salario, c.Nombre_Cat, e.Nombre_emp
        FROM vacantes v
        INNER JOIN categorias c ON v.Categoria_idCategoria = c.id_categoria
        INNER JOIN empresa e ON v.Empresa_id_empresa = e.id_empresa";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    $vacantes = array();
    while ($row = $result->fetch_assoc()) {
        $vacante = array(
            "idVacantes" => $row["idVacantes"],
            "Categoria_idCategoria" => $row["Categoria_idCategoria"],
            "Empresa_id_empresa" => $row["Empresa_id_empresa"],
            "Descripcion_vac" => $row["Descripcion_vac"],
            "Fecha_Publicacion" => $row["Fecha_Publicacion"],
            "Fecha_Cierre" => $row["Fecha_Cierre"],
            "Estado" => $row["Estado"],
            "Salario" => $row["Salario"],
            "Nombre_Cat" => $row["Nombre_Cat"],
            "Nombre_emp" => $row["Nombre_emp"],
            "Nuevo_salario" => "" 
        );
        $vacantes[] = $vacante;
    }
    mostrarVacantes($vacantes);
} else {
    echo "No se encontraron vacantes.";
}

$conn->close();
?>

<script src="JavascriptRRHH/menu.js"></script>
<script src="JavascriptRRHH/validarsalario.js"></script>
<script src="JavascriptRRHH/salariocalculadora.js"></script>
</body>
</html>