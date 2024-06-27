<?php
session_start();

// Verificar si la sesión está iniciada
if(isset($_SESSION['id_empresa'])) {
    // Si se ha enviado el parámetro 'cerrar_sesion', cerrar la sesión y redirigir al usuario
    if(isset($_GET['cerrar_sesion'])) {
        // Destruir todas las variables de sesión
        $_SESSION = array();

        // Si se desea destruir la sesión, también es útil borrar la cookie de sesión
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Finalmente, destruir la sesión
        session_destroy();

        // Redirigir al usuario de vuelta a la página de inicio de sesión
        header("Location: inicio/inicio_empresa.php");
        exit();
    }

    // Procesar la carga de la imagen
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $imagen_emp = ''; // Inicializa la variable de la imagen

        if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $ruta_destino = 'Imagen_emp/'; // Carpeta donde se guardarán las imágenes
            $nombre_imagen = $_FILES['imagen']['name'];
            $imagen_emp = $ruta_destino . $nombre_imagen;

            // Mueve la imagen al directorio de destino
            move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen_emp);
        }

        // Actualiza la imagen en la base de datos
        if (!empty($imagen_emp)) {
            require_once 'inicio/conexiones/conexion.php';

            $id_empresa = $_SESSION['id_empresa'];

            $sql_update = "UPDATE empresa SET Imagen_emp = ? WHERE id_empresa = ?";
            $stmt_update = $conexion->prepare($sql_update);
            $stmt_update->bind_param("si", $imagen_emp, $id_empresa);
            $stmt_update->execute();

            // Cierra la conexión a la base de datos
            $stmt_update->close();
            $conexion->close();

            // Recarga la página para mostrar la nueva imagen
            header("Location: Empresa.php");
            exit();
        }
    }
} else {
    // Si no está iniciada la sesión, redirigir al usuario a la página de inicio de sesión
    header("Location: inicio/inicio_empresa.php");
    exit();
}

require_once 'inicio/conexiones/conexion.php';
$id_empresa = $_SESSION['id_empresa'];
$sql_select_empresa = "SELECT Nombre_emp, Direccion_emp, Ciudad_emp, Email_emp, Telefono_emp FROM empresa WHERE id_empresa = ?";
$stmt_select_empresa = $conexion->prepare($sql_select_empresa);
$stmt_select_empresa->bind_param("i", $id_empresa);
$stmt_select_empresa->execute();
$result_select_empresa = $stmt_select_empresa->get_result();
$row_empresa = $result_select_empresa->fetch_assoc();

// Verificar si se encontraron datos de la empresa
if($row_empresa) {
    $Nombre_emp = $row_empresa['Nombre_emp'];
    $Direccion_emp = $row_empresa['Direccion_emp'];
    $Ciudad_emp = $row_empresa['Ciudad_emp'];
    $Email_emp = $row_empresa['Email_emp'];
    $Telefono_emp = $row_empresa['Telefono_emp'];
} else {
    header("Location: error.php");
    exit();
}

if(isset($_SESSION['success_message'])) {
    echo '<div class="success-message">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']); 
}

if(isset($_SESSION['error_message'])) {
    echo '<div class="error-message">' . $_SESSION['error_message'] . '</div>';
    unset($_SESSION['error_message']); 
}


$sql_categorias = "SELECT * FROM categorias";
$result_categorias = $conexion->query($sql_categorias);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["crear"])) {

    }
}

$sql_vacantes = "SELECT * FROM vacantes WHERE Empresa_id_empresa = ?";
$stmt_vacantes = $conexion->prepare($sql_vacantes);
$stmt_vacantes->bind_param("i", $id_empresa);
$stmt_vacantes->execute();
$result_vacantes = $stmt_vacantes->get_result();



?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cssTecEmpleo/empresa.css">
    <title>Empresa</title>
    <!-- Agrega aquí tus enlaces a archivos CSS, si los tienes -->
</head>
<body>
<div class="cerrar">
    <button onclick="window.location.href='?cerrar_sesion=true'">Cerrar Sesión</button>
</div>
<nav>
    <center>
        <img src="img/LogoTecEmpleo.png">
    </center>
</nav>
<br><br>
<div class="cont">
<div class="contenedor">
    <div class="contenedor-circular">
        <?php

        if (isset($_SESSION['id_empresa'])) {
            require_once 'inicio/conexiones/conexion.php';

            $id_empresa = $_SESSION['id_empresa'];

            $sql_select = "SELECT Imagen_emp FROM empresa WHERE id_empresa = ?";
            $stmt_select = $conexion->prepare($sql_select);
            $stmt_select->bind_param("i", $id_empresa);
            $stmt_select->execute();
            $result_select = $stmt_select->get_result();

            if ($result_select->num_rows > 0) {
                $row_select = $result_select->fetch_assoc();
                $imagen_emp = $row_select['Imagen_emp'];
                if (!empty($imagen_emp) && file_exists($imagen_emp)) {
                    echo '<img src="' . $imagen_emp . '" alt="Imagen de la empresa">';
                }
            }

            // Cierra el statement y la conexión a la base de datos
            $stmt_select->close();
            $conexion->close();
        }

        ?> 
    </div>
</div>
        <div class="container_name">
           <h1> <?= $Nombre_emp; ?></h1>
        </div>

        <div class="container_config">
    <button onclick="mostrarConfiguracion()">Configuración</button>
    <button onclick="mostrarCimagen()">Cambiar Imagen</button>
    <button onclick="mostrarCrearVacantes()">Crear Vacantes</button>
    <button onclick="mostrarVerVacantes()">Ver vacantes</button>
</div>
</div>
<br><br><br><br><br>

<center>
    <div id="configuracionContainer" class="config" style="display: none;">
        <form id="form-editar-perfil" action="actualizar/actualizar_informacion_empresa.php" method="POST">
            <div class="form-row">
                <div class="form-group">
                    <label for="direccionEmpresa">Dirección de la Empresa:</label>
                    <input type="text" id="direccionEmpresa" name="direccionEmpresa" value="<?= $Direccion_emp; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="ciudadEmpresa">Ciudad de la Empresa:</label>
                    <input type="text" id="ciudadEmpresa" name="ciudadEmpresa" value="<?= $Ciudad_emp; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="emailEmpresa">Correo Electrónico de la Empresa:</label>
                    <input type="email" id="emailEmpresa" name="emailEmpresa" value="<?= $Email_emp; ?>" pattern="[a-zA-Z0-9._%+-]+@(gmail\.com|hotmail\.com|outlook\.com)" title="Por favor, ingrese una dirección de correo electrónico válida con los dominios @gmail.com, @hotmail.com o @outlook.com">
                </div>
                <div class="form-group">
                    <label for="telefonoEmpresa">Teléfono de la Empresa:</label>
                    <input type="tel" id="telefonoEmpresa" name="telefonoEmpresa" value="<?= $Telefono_emp; ?>" pattern="[0-9]+" title="Por favor, ingrese solo números">
                </div>
            </div>
            <div class="form-row">
                <input type="submit" value="Guardar Cambios">
            </div>
        </form>
    </div>

    <div id="imagenContainer" style="display: none;">
        <form action="Empresa.php" method="POST" enctype="multipart/form-data">
            <div class="input-file-container">
                <input type="file" name="imagen" accept="image/*">
            </div>
            <br><br>
            <input type="submit" value="Subir Imagen">
        </form>
    </div>

    <div id="CrearVacantes" >
        <form action="actualizar/procesar_creacion_vacante.php" method="POST">
            <div class="input-file-container">
                <label for="descripcionVacante">Descripción de la vacante:</label><br>
                <textarea id="descripcionVacante" name="descripcionVacante" required></textarea><br>
                <label for="fechaPublicacion">Fecha de Publicación:</label><br>
                <input type="date" id="fechaPublicacion" name="fechaPublicacion" value="<?php echo date('Y-m-d'); ?>" readonly><br>
                <label for="fechaCierre">Fecha de Cierre:</label><br>
                <input type="date" id="fechaCierre" name="fechaCierre" required><br>
                <label for="estadoVacante">Estado de la vacante:</label><br>
                <select id="estadoVacante" name="estadoVacante" required>
                    <option value="Activo">Activo</option>
                    <option value="Cerrado">Cerrado</option>
                </select><br>
                <label for="enlaceVacante">Enlace test:</label><br>
                <input type="url" id="enlaceVacante" name="enlaceVacante" placeholder="https://ejemplo.com (este campo no es obligatorio es dependiendo de sus terminos)" pattern="https?://.+" title="Por favor, ingrese un enlace válido comenzando con http:// o https://"><br>

                <label for="salario">Salario:</label><br>
                <input type="text" id="salario" name="salario" pattern="[0-9]*" title="Por favor, ingrese solo números" required><br>


                <!-- Agregar selección de categorías -->
                <label for="categoria_id">Categoría:</label>
                <select name="categoria" class="form-control" required>
                    <option value="">Selecciona una categoría</option>
                    <?php
                    if ($result_categorias->num_rows > 0) {
                        while ($row_categoria = $result_categorias->fetch_assoc()) {
                            echo "<option value='" . $row_categoria["id_categoria"] . "'>" . $row_categoria["Nombre_Cat"] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay categorías disponibles</option>";
                    }
                    ?>
                </select>

                <!-- Campo oculto para la ID de la empresa -->
                <input type="hidden" id="empresaId" name="empresaId" value="<?php echo $_SESSION['id_empresa']; ?>">
            </div>
            <br><br> <!-- Espacio adicional -->
            <input type="submit" value="Crear Vacante">
        </form>
    </div>

<br><br>
<div id="VerVacantes" style="display: none;">
    <h2>Mis Vacantes</h2>
    <?php
    // Verificar si hay vacantes para mostrar
    if ($result_vacantes && $result_vacantes->num_rows > 0) {
        // Iterar sobre cada vacante y mostrar su información
        while ($row_vacante = $result_vacantes->fetch_assoc()) {
            echo "<div>";
            echo "<h3>" . $row_vacante["Descripcion_vac"] . "</h3>";
            echo "<p>Fecha de Publicación: " . $row_vacante["Fecha_Publicacion"] . "</p>";
            echo "<p>Fecha de Cierre: " . $row_vacante["Fecha_Cierre"] . "</p>";
            echo "<p>Estado: " . $row_vacante["Estado"] . "</p>";
            echo "<p>Salario: " . $row_vacante["Salario"] . "</p>";
            // Botón para ver postulados
            echo "<button type='button' class='ver-postulados' data-id='" . $row_vacante['idVacantes'] . "'>Ver Postulados</button>";
            echo "</div>";
        }
    } else {
        // Si no hay vacantes para mostrar, mostrar un mensaje
        echo "<p>No hay vacantes creadas.</p>";
    }
    ?>
</div>

<div id="postulados" style="display: none;">
<h2>Usuarios Postulados</h2>
    <div id="postulados-list">
        <?php
        // Verificar si hay usuarios postulados para mostrar
        if (!empty($usuariosPostulados)) {
            // Iterar sobre los usuarios postulados y mostrar su información
            foreach ($usuariosPostulados as $usuarioString) {
                // Separar la cadena en un array
                $usuarioInfo = explode(",", $usuarioString);
                // Mostrar la información del usuario
                echo "<div>";
                echo "<p>Nombre: " . $usuarioInfo[0] . "</p>";
                echo "<p>Apellido: " . $usuarioInfo[1] . "</p>";
                echo "<p>Email: " . $usuarioInfo[2] . "</p>";
                echo "</div>";
            }
        } else {
            // Si no hay usuarios postulados, mostrar un mensaje
            echo "<p>No hay usuarios postulados.</p>";
        }
        ?>
    </div>
</div>

</center>
<script>
 // Script para mostrar u ocultar la sección de postulados
document.querySelectorAll('.ver-postulados').forEach(item => {
        item.addEventListener('click', event => {
            const vacanteId = event.target.dataset.id;

            // Petición AJAX para obtener los usuarios postulados a la vacante seleccionada
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        const users = response.users;
                        const userHTML = users.map(user => `<p>${user.nombre}</p>`).join('');
                        document.getElementById('postulados').innerHTML = userHTML;
                        document.getElementById('VerVacantes').style.display = 'none';
                        document.getElementById('postulados').style.display = 'block';
                    } else {
                        console.error('Error al obtener los usuarios postulados.');
                    }
                }
            };
            xhr.open('GET', 'actualizar/obtener_postulados.php?vacanteId=' + vacanteId, true);
            xhr.send();
        });
    });

var fechaActual = new Date();
    
    // Calcular la fecha mínima permitida sumando un día a la fecha actual
    var fechaMinima = new Date(fechaActual);
    fechaMinima.setDate(fechaActual.getDate() + 1);
    
    // Formatear la fecha mínima en el formato "yyyy-mm-dd"
    var fechaMinimaFormato = fechaMinima.toISOString().split('T')[0];
    
    // Establecer el valor mínimo para la fecha de cierre
    document.getElementById("fechaCierre").min = fechaMinimaFormato;

function mostrarConfiguracion() {
    var configuracionContainer = document.getElementById("configuracionContainer");
    var imagenContainer = document.getElementById("imagenContainer");
    var crearVacantesContainer = document.getElementById("CrearVacantes");
    var verVacantesContainer = document.getElementById("VerVacantes");
    var postulados = document.getElementById("postulados");

    configuracionContainer.style.display = "block";
    imagenContainer.style.display = "none";
    crearVacantesContainer.style.display = "none";
    verVacantesContainer.style.display = "none";
}

function mostrarCimagen() {
    var configuracionContainer = document.getElementById("configuracionContainer");
    var imagenContainer = document.getElementById("imagenContainer");
    var crearVacantesContainer = document.getElementById("CrearVacantes");
    var verVacantesContainer = document.getElementById("VerVacantes");
    var postulados = document.getElementById("postulados");

    configuracionContainer.style.display = "none";
    imagenContainer.style.display = "block";
    crearVacantesContainer.style.display = "none";
    verVacantesContainer.style.display = "none";
    postulados.style.display = "none";
}

function mostrarCrearVacantes() {
    var configuracionContainer = document.getElementById("configuracionContainer");
    var imagenContainer = document.getElementById("imagenContainer");
    var crearVacantesContainer = document.getElementById("CrearVacantes");
    var verVacantesContainer = document.getElementById("VerVacantes");
    var postulados = document.getElementById("postulados");

    configuracionContainer.style.display = "none";
    imagenContainer.style.display = "none";
    crearVacantesContainer.style.display = "block";
    verVacantesContainer.style.display = "none";
    postulados.style.display = "none";
}

function mostrarVerVacantes() {
    var configuracionContainer = document.getElementById("configuracionContainer");
    var imagenContainer = document.getElementById("imagenContainer");
    var crearVacantesContainer = document.getElementById("CrearVacantes");
    var verVacantesContainer = document.getElementById("VerVacantes");
    var postulados = document.getElementById("postulados");

    configuracionContainer.style.display = "none";
    imagenContainer.style.display = "none";
    crearVacantesContainer.style.display = "none";
    verVacantesContainer.style.display = "block";
    postulados.style.display = "none";
}

function postulados() {
    var configuracionContainer = document.getElementById("configuracionContainer");
    var imagenContainer = document.getElementById("imagenContainer");
    var crearVacantesContainer = document.getElementById("CrearVacantes");
    var verVacantesContainer = document.getElementById("VerVacantes");
    var postulados = document.getElementById("postulados");

    configuracionContainer.style.display = "none";
    imagenContainer.style.display = "none";
    crearVacantesContainer.style.display = "none";
    verVacantesContainer.style.display = "none";
    postulados.style.display = "block";
}

    document.getElementById('form-editar-perfil').addEventListener('submit', function(event) {
        var correoInput = document.getElementById('emailEmpresa');
        var correo = correoInput.value;
        var dominiosPermitidos = ['gmail.com', 'hotmail.com', 'outlook.com'];

        // Validamos si el correo tiene un dominio permitido
        var dominioValido = dominiosPermitidos.some(function(dominio) {
            return correo.endsWith('@' + dominio);
        });

        if (!dominioValido) {
            alert('Por favor, ingrese una dirección de correo electrónico válida con dominios gmail.com, hotmail.com o outlook.com');
            event.preventDefault();
        }
    });

    document.getElementById('btn-editar-perfil').addEventListener('click', function() {
        alert('Por favor, asegúrate de proporcionar información verídica. Es fundamental que los datos que nos proporciones sean precisos para evitar confusiones con las empresas y garantizar una correcta gestión de tu información. ¡Gracias por tu colaboración!');
    });



</script>



</body>
</html>
 