<?php
session_start();
include("../inicio/conexiones/conexion.php");

if (!isset($_SESSION["id"])) {
    header("Location: ../inicio_sesion.php");
    exit();
}

$id_usuario = $_SESSION["id"];

$sql = "SELECT * FROM perfil WHERE Usuario_id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();

$perfil_existe = false;
$perfil = array(); 

if ($resultado->num_rows > 0) {
    $perfil_existe = true;
    $perfil = $resultado->fetch_assoc();
} else {
   
}


$Nombre_Reg = $_SESSION["Nombre_Reg"];
$Apellido_Reg = $_SESSION["Apellido_Reg"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="Css/mi_perfil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css"rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<a href="../TecEmpleo.php" class="back-link"><i class="ri-arrow-go-back-line"></i></a>
<br>

<div class="container_foto">
    <table class="foto">
        <tr>
            <th class="thinfo">
                <?php if ($perfil_existe && !empty($perfil['Fotografia'])): ?>
                    <div class="perfil-img">
                        <?php if (strpos($perfil['Fotografia'], 'data:image') === 0): ?>
                            <img src="<?php echo $perfil['Fotografia']; ?>" alt="Fotografía de perfil">
                        <?php else: ?>
                            <img src="<?php echo $perfil['Fotografia']; ?>" alt="Fotografía de perfil">
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="perfil-img">
                        <img src="img/PerfilTEC.png" alt="Imagen por defecto">
                    </div>
                <?php endif; ?>
                <div style="color: white;">
                    <h1><?php echo $Nombre_Reg . ' ' . $Apellido_Reg; ?></h1>
                    <h2><?php echo $perfil_existe ? $perfil['Profesion'] : 'Profesión'; ?></h2>
                </div>
            </th>
            <th class="thfoto">
                <a href="../TecEmpleo.php">
                <img src="../img/LogoTecEmpleo.png">
                </a>
            </th>
        </tr>
    </table>
</div>
  
<div class="container" style="background-color: #f2f2f2; padding: 20px;">
    <?php if ($perfil_existe): ?>
        <div class="dato" style="background-color: #E2E2E2; padding: 1px; margin-bottom: 8px;">
        <h2 style="font-size: 24px; font-weight: bold;">Datos personales</h2>
        </div>
        <div class="perfil">
            <div class="dato" style="background-color: #E2E2E2; padding: 1px; margin-bottom: 10px;">
            <p style="font-size: 18px; color: black;"><i class="fa-sharp fa-solid fa-address-card fa-2xl" style="color: #0026e3; margin-right: 16px;"></i> <span style="font-weight: bold;"> Número de Identificacion: <?php echo $perfil['id_Documento']; ?></p>
            </div>
            <div class="dato" style="background-color: #E2E2E2; padding: 1px; margin-bottom: 10px;">           
            <p style="font-size: 18px; color: black;"><i class="fa-sharp fa-solid fa-handshake fa-2xl" style="color: #0026e3;margin-right: 10px;"></i> <span style="font-weight: bold;"> Profesión: <?php echo $perfil['Profesion']; ?></p>
            </div>
            <div class="dato" style="background-color: #E2E2E2; padding: 1px; margin-bottom: 10px;">    
            <p style="font-size: 18px; color: black;"><i class="fa-solid fa-image-portrait fa-2xl" style="color: #0026e3; margin-right: 28px;"></i> <span style="font-weight: bold;"> Edad: <?php echo $perfil['Edad']; ?></p>
            </div>
            <div class="dato" style="background-color: #E2E2E2; padding: 1px; margin-bottom: 10px;">    
            <p style="font-size: 18px; color: black;"><i class="fa-sharp fa-solid fa-calendar-days fa-2xl" style="color: #0026e3;margin-right: 24px;"></i> <span style="font-weight: bold;"> Fecha de Nacimiento: <?php echo $perfil['Fecha_Nacimiento']; ?></p>
            </div>
            <div class="dato" style="background-color: #E2E2E2; padding: 1px; margin-bottom: 10px;">    
            <p style="font-size: 18px; color: black;"><i class="fa-solid fa-venus-mars fa-2xl" style="color: #0026e3;margin-right: 10px;"></i> <span style="font-weight: bold;"> Sexo: <?php echo $perfil['Sexo']; ?></p>
            </div>
            <div class="dato" style="background-color: #E2E2E2; padding: 1px; margin-bottom: 10px;">    
            <p style="font-size: 18px; color: black;"><i class="fa-solid fa-building fa-2xl" style="color: #0026e3;margin-right: 28px;"></i> <span style="font-weight: bold;"> Departamento: <?php echo $perfil['Departamento']; ?></p>
            </div>
            <div class="dato" style="background-color: #E2E2E2; padding: 1px; margin-bottom: 10px;">
            <p style="font-size: 18px; color: black;"><i class="fa-solid fa-city fa-2xl" style="color: #0026e3;margin-right: 11px;"></i> <span style="font-weight: bold;"> Ciudad: <?php echo $perfil['Ciudad']; ?></p>
            </div>
            <div class="dato" style="background-color: #E2E2E2; padding: 1px; margin-bottom: 10px;">    
            <p style="font-size: 18px; color: black;"><i class="fa-sharp fa-solid fa-map-location-dot fa-2xl" style="color: #0026e3;margin-right: 15px;"></i> <span style="font-weight: bold;"> Dirección: <?php echo $perfil['Direccion']; ?></p>
            </div>
            <div class="dato" style="background-color: #E2E2E2; padding: 1px; margin-bottom: 10px;">    
            <p style="font-size: 18px; color: black;"><i class="fa-sharp fa-solid fa-phone fa-2xl" style="color: #0026e3;margin-right: 18px;"></i> <span style="font-weight: bold;"> Teléfono: <?php echo $perfil['Telefono']; ?></p>
            </div>
            <div class="dato" style="background-color: #E2E2E2; padding: 1px; margin-bottom: 10px;">    
            <p style="font-size: 18px; color: black;"><i class="fa-solid fa-envelope fa-2xl" style="color: #0026e3;margin-right: 18px;"></i> <span style="font-weight: bold;"> Correo Electrónico: <?php echo $perfil['Correo_Electronico']; ?></p>
            </div>
        </div>
    <?php endif; ?>
</div>




<!-- The Modal -->
<div id="modal-editar-perfil" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Editar Perfil</h2>
        <form id="form-editar-perfil" action="actualizar_perfil.php" method="POST" enctype="multipart/form-data">
            <!-- Campos de actualización -->
            <p style="color: gray;"> Por favor, asegúrate de que tu fotografía sea adecuada y profesional. Te pedimos que te sitúes de frente, sin posar, con un fondo blanco preferiblemente.</p> 
            <label for="nueva_fotografia onclick="mostrarMensaje()">Nueva Fotografía: </label>
            <input type="file" id="nueva_fotografia" name="nueva_fotografia" accept="image/*" ><br><br>

            <label for="profesion">Profesión:</label>
            <input type="text" id="profesion" name="profesion" pattern="[A-Za-záéíóúÁÉÍÓÚ\s]+" title="Por favor, ingrese solo letras y espacios" value="<?php echo $perfil['Profesion']; ?>"><br><br>

            <label for="edad">Edad:</label>
            <input type="number" id="edad" name="edad" required min="18" value="<?php echo $perfil['Edad']; ?>"><br><br>

            <label for="departamento">Departamento:</label>
            <select name="departamento" id="departamento" required>
                <option value="">Seleccione un departamento</option>
                <option value="Amazonas" <?php if ($perfil['Departamento'] == 'Amazonas') echo 'selected'; ?>>Amazonas</option>
                <option value="Antioquia" <?php if ($perfil['Departamento'] == 'Antioquia') echo 'selected'; ?>>Antioquia</option>
                <option value="Arauca" <?php if ($perfil['Departamento'] == 'Arauca') echo 'selected'; ?>>Arauca</option>
                <option value="Atlántico" <?php if ($perfil['Departamento'] == 'Atlántico') echo 'selected'; ?>>Atlántico</option>
                <option value="Bolívar" <?php if ($perfil['Departamento'] == 'Bolívar') echo 'selected'; ?>>Bolívar</option>
                <option value="Boyacá" <?php if ($perfil['Departamento'] == 'Boyacá') echo 'selected'; ?>>Boyacá</option>
                <option value="Caldas" <?php if ($perfil['Departamento'] == 'Caldas') echo 'selected'; ?>>Caldas</option>
                <option value="Caquetá" <?php if ($perfil['Departamento'] == 'Caquetá') echo 'selected'; ?>>Caquetá</option>
                <option value="Casanare" <?php if ($perfil['Departamento'] == 'Casanare') echo 'selected'; ?>>Casanare</option>
                <option value="Cauca" <?php if ($perfil['Departamento'] == 'Cauca') echo 'selected'; ?>>Cauca</option>
                <option value="Cesar" <?php if ($perfil['Departamento'] == 'Cesar') echo 'selected'; ?>>Cesar</option>
                <option value="Chocó" <?php if ($perfil['Departamento'] == 'Chocó') echo 'selected'; ?>>Chocó</option>
                <option value="Córdoba" <?php if ($perfil['Departamento'] == 'Córdoba') echo 'selected'; ?>>Córdoba</option>
                <option value="Cundinamarca" <?php if ($perfil['Departamento'] == 'Cundinamarca') echo 'selected'; ?>>Cundinamarca</option>
                <option value="Guainía" <?php if ($perfil['Departamento'] == 'Guainía') echo 'selected'; ?>>Guainía</option>
                <option value="Guaviare" <?php if ($perfil['Departamento'] == 'Guaviare') echo 'selected'; ?>>Guaviare</option>
                <option value="Huila" <?php if ($perfil['Departamento'] == 'Huila') echo 'selected'; ?>>Huila</option>
                <option value="La Guajira" <?php if ($perfil['Departamento'] == 'La Guajira') echo 'selected'; ?>>La Guajira</option>
                <option value="Magdalena" <?php if ($perfil['Departamento'] == 'Magdalena') echo 'selected'; ?>>Magdalena</option>
                <option value="Meta" <?php if ($perfil['Departamento'] == 'Meta') echo 'selected'; ?>>Meta</option>
                <option value="Nariño" <?php if ($perfil['Departamento'] == 'Nariño') echo 'selected'; ?>>Nariño</option>
                <option value="Norte de Santander" <?php if ($perfil['Departamento'] == 'Norte de Santander') echo 'selected'; ?>>Norte de Santander</option>
                <option value="Putumayo" <?php if ($perfil['Departamento'] == 'Putumayo') echo 'selected'; ?>>Putumayo</option>
                <option value="Quindío" <?php if ($perfil['Departamento'] == 'Quindío') echo 'selected'; ?>>Quindío</option>
                <option value="Risaralda" <?php if ($perfil['Departamento'] == 'Risaralda') echo 'selected'; ?>>Risaralda</option>
                <option value="San Andrés y Providencia" <?php if ($perfil['Departamento'] == 'San Andrés y Providencia') echo 'selected'; ?>>San Andrés y Providencia</option>
                <option value="Santander" <?php if ($perfil['Departamento'] == 'Santander') echo 'selected'; ?>>Santander</option>
                <option value="Sucre" <?php if ($perfil['Departamento'] == 'Sucre') echo 'selected'; ?>>Sucre</option>
                <option value="Tolima" <?php if ($perfil['Departamento'] == 'Tolima') echo 'selected'; ?>>Tolima</option>
                <option value="Valle del Cauca" <?php if ($perfil['Departamento'] == 'Valle del Cauca') echo 'selected'; ?>>Valle del Cauca</option>
                <option value="Vaupés" <?php if ($perfil['Departamento'] == 'Vaupés') echo 'selected'; ?>>Vaupés</option>
                <option value="Vichada" <?php if ($perfil['Departamento'] == 'Vichada') echo 'selected'; ?>>Vichada</option>
            </select><br><br>

            <label for="ciudad">Ciudad:</label>
            <select name="ciudad" id="ciudad" required>
                <option value="Bogotá D.C" <?php if ($perfil['Ciudad'] == 'Bogotá D.C') echo 'selected'; ?>>Bogotá D.C</option>
                <option value="Medellin" <?php if ($perfil['Ciudad'] == 'Medellin') echo 'selected'; ?>>Medellín</option>
                <option value="Cartagena" <?php if ($perfil['Ciudad'] == 'Cartagena') echo 'selected'; ?>>Cartagena</option>
                <option value="Cali" <?php if ($perfil['Ciudad'] == 'Cali') echo 'selected'; ?>>Cali</option>
                <option value="Villavicencio" <?php if ($perfil['Ciudad'] == 'Villavicencio') echo 'selected'; ?>>Villavicencio</option>
                <option value="SantaMarta" <?php if ($perfil['Ciudad'] == 'SantaMarta') echo 'selected'; ?>>Santa Marta</option>
                <option value="Valledupar" <?php if ($perfil['Ciudad'] == 'Valledupar') echo 'selected'; ?>>Valledupar</option>
                <option value="Tunja" <?php if ($perfil['Ciudad'] == 'Tunja') echo 'selected'; ?>>Tunja</option>
                <option value="Santander" <?php if ($perfil['Ciudad'] == 'Santander') echo 'selected'; ?>>Santander</option>
                <option value="Cúcuta" <?php if ($perfil['Ciudad'] == 'Cúcuta') echo 'selected'; ?>>Cúcuta</option>
                <option value="Vichada" <?php if ($perfil['Ciudad'] == 'Vichada') echo 'selected'; ?>>Vichada</option>
                <option value="Casanare" <?php if ($perfil['Ciudad'] == 'Casanare') echo 'selected'; ?>>Casanare</option>
                <option value="Chocó" <?php if ($perfil['Ciudad'] == 'Chocó') echo 'selected'; ?>>Chocó</option>
                <option value="Riohacha" <?php if ($perfil['Ciudad'] == 'Riohacha') echo 'selected'; ?>>Riohacha</option>
                <option value="Sincelejo" <?php if ($perfil['Ciudad'] == 'Sincelejo') echo 'selected'; ?>>Sincelejo</option>
                <option value="Florencia" <?php if ($perfil['Ciudad'] == 'Florencia') echo 'selected'; ?>>Florencia</option>
                <option value="Yopal" <?php if ($perfil['Ciudad'] == 'Yopal') echo 'selected'; ?>>Yopal</option>
                <option value="Mocoa" <?php if ($perfil['Ciudad'] == 'Mocoa') echo 'selected'; ?>>Mocoa</option>
                <option value="Leticia" <?php if ($perfil['Ciudad'] == 'Leticia') echo 'selected'; ?>>Leticia</option>
                <option value="Inirida" <?php if ($perfil['Ciudad'] == 'Inirida') echo 'selected'; ?>>Inírida</option>
                <option value="SanJoseDelGuaviare" <?php if ($perfil['Ciudad'] == 'SanJoseDelGuaviare') echo 'selected'; ?>>San José del Guaviare</option>
                <option value="Mitu" <?php if ($perfil['Ciudad'] == 'Mitu') echo 'selected'; ?>>Mitú (Vaupés)</option>
                <option value="PuertoCarreno" <?php if ($perfil['Ciudad'] == 'PuertoCarreno') echo 'selected'; ?>>Puerto Carreño</option>
                <option value="Zipaquira" <?php if ($perfil['Ciudad'] == 'Zipaquira') echo 'selected'; ?>>Zipaquirá</option>
                <option value="Fusagasuga" <?php if ($perfil['Ciudad'] == 'Fusagasuga') echo 'selected'; ?>>Fusagasugá</option>
                <option value="Girardot" <?php if ($perfil['Ciudad'] == 'Girardot') echo 'selected'; ?>>Girardot</option>
                <option value="Facatativa" <?php if ($perfil['Ciudad'] == 'Facatativa') echo 'selected'; ?>>Facatativá</option>
                <option value="Duitama" <?php if ($perfil['Ciudad'] == 'Duitama') echo 'selected'; ?>>Duitama</option>
                <option value="Soacha" <?php if ($perfil['Ciudad'] == 'Soacha') echo 'selected'; ?>>Soacha</option>
                <option value="Palmira" <?php if ($perfil['Ciudad'] == 'Palmira') echo 'selected'; ?>>Palmira</option>
                <option value="Monterrey" <?php if ($perfil['Ciudad'] == 'Monterrey') echo 'selected'; ?>>Monterrey</option>
                <option value="Tulua" <?php if ($perfil['Ciudad'] == 'Tulua') echo 'selected'; ?>>Tuluá</option>
                <option value="Buenaventura" <?php if ($perfil['Ciudad'] == 'Buenaventura') echo 'selected'; ?>>Buenaventura</option>
                <option value="Rionegro" <?php if ($perfil['Ciudad'] == 'Rionegro') echo 'selected'; ?>>Rionegro</option>
                <option value="Envigado" <?php if ($perfil['Ciudad'] == 'Envigado') echo 'selected'; ?>>Envigado</option>
                <option value="Buga" <?php if ($perfil['Ciudad'] == 'Buga') echo 'selected'; ?>>Buga</option>
                <option value="Sabaneta" <?php if ($perfil['Ciudad'] == 'Sabaneta') echo 'selected'; ?>>Sabaneta</option>
                <option value="Tunja" <?php if ($perfil['Ciudad'] == 'Tunja') echo 'selected'; ?>>Tunja</option>
                <option value="Cartago" <?php if ($perfil['Ciudad'] == 'Cartago') echo 'selected'; ?>>Cartago</option>
                <option value="Maicao" <?php if ($perfil['Ciudad'] == 'Maicao') echo 'selected'; ?>>Maicao</option>
                <option value="Chia" <?php if ($perfil['Ciudad'] == 'Chia') echo 'selected'; ?>>Chía</option>
                <option value="Apartado" <?php if ($perfil['Ciudad'] == 'Apartado') echo 'selected'; ?>>Apartadó</option>
                <option value="Yumbo" <?php if ($perfil['Ciudad'] == 'Yumbo') echo 'selected'; ?>>Yumbo</option>

                <!-- Opciones adicionales de ciudad -->
            </select><br><br>


            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" value="<?php echo $perfil['Direccion']; ?>"><br><br>

            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" pattern="[0-9]+" title="Por favor, ingrese solo números" value="<?php echo $perfil['Telefono']; ?>"><br><br>
            <label for="correo_electronico">Correo Electrónico:</label>
            <input type="text" id="correo_electronico" name="correo_electronico" 
                title="Por favor, ingrese una dirección de correo electrónico válida con dominios gmail.com, hotmail.com o outlook.com" 
                value="<?php echo $perfil['Correo_Electronico']; ?>" required><br><br>


            <!-- Botón de guardar cambios -->
            <button type="submit">Guardar Cambios</button>
        </form>
    </div>
</div>
<script>
document.getElementById('form-editar-perfil').addEventListener('submit', function(event) {
    var correoInput = document.getElementById('correo_electronico');
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



<?php if (!$perfil_existe): ?>
    <div class="container">
        <p>No has creado tu perfil aún. <a class="btn-crear-perfil" href="perfil.php">Crear Perfil</a></p>
    </div>
<?php endif; ?>

<?php if ($perfil_existe): ?>
    <div class="container_b">
        <button id="btn-editar-perfil">Editar Perfil</button>
    </div>
<?php endif; ?>




<script src="JavaScript/modal.js">
</script>

</body>
</html>
