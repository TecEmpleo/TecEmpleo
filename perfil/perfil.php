<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Perfil</title>
    <link rel="stylesheet" href="Css/perfil.css">
</head>

<body>
    <div class="container">
          
                <a href="../TecEmpleo.php"><img src="../img/LogoTecEmpleo.png"></a>
    </div>

<form action="guardar_perfil.php" method="POST" enctype="multipart/form-data" id="form-perfil" >
    <h2>Crear Perfil</h2>
    <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id']; ?>">
    <p style="color: gray;"> Por favor, asegúrate de que tu fotografía sea adecuada y profesional. Te pedimos que te sitúes de frente, sin posar, con un fondo blanco preferiblemente.</p>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <div style="flex: 1;">
            <label for="id_Documento">Documento de identidad:</label>
            <input type="text" name="id_Documento" id="id_Documento" placeholder="Ingrese su número de documento de identidad" required pattern="[0-9]+" title="Por favor, introduzca solo números">
        </div>
        <div style="flex: 1; margin-left: 20px; margin-top: -14px;">
            <label for="Fotografia"></label>
            <input type="file" name="Fotografia" id="Fotografia" accept="image/*" class="custom-file-input" required onchange="updateFileName(this)">
            <label for="Fotografia" id="file-label" class="custom-file-label" style="color: ;">Seleccionar Archivo para fotografia</label>
        </div>
    </div>

    <br>
    <label for="Profesion">Profesión:</label>
    <input type="text" name="Profesion" id="Profesion" placeholder="Por favor, indique su profesión" required>
    <br><br>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <div style="flex: 1;">
            <label for="Edad">Edad:</label>
            <input type="number" name="Edad" id="Edad" placeholder="Ingrese su edad (debe ser mayor de edad)" required min="18">
        </div>   
        <div style="flex: 1; margin-left: 20px;"> 
            <label for="Fecha_Nacimiento">Fecha de Nacimiento:</label>
            <input type="date" name="Fecha_Nacimiento" id="Fecha_Nacimiento" required max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>">

        </div>  
    </div> 


    <label for="Sexo">Sexo:</label>
    <select name="Sexo" id="Sexo" required>
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
    </select>
    <br><br>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <div style="flex: 1;"> 
        <label for="Departamento">Departamento:</label>
            <select name="Departamento" id="Departamento" required>
                <option value="Amazonas">Amazonas</option>
                <option value="Antioquia">Antioquia</option>
                <option value="Arauca">Arauca</option>
                <option value="Atlántico">Atlántico</option>
                <option value="Bolívar">Bolívar</option>
                <option value="Boyacá">Boyacá</option>
                <option value="Caldas">Caldas</option>
                <option value="Caquetá">Caquetá</option>
                <option value="Casanare">Casanare</option>
                <option value="Cauca">Cauca</option>
                <option value="Cesar">Cesar</option>
                <option value="Chocó">Chocó</option>
                <option value="Córdoba">Córdoba</option>
                <option value="Cundinamarca">Cundinamarca</option>
                <option value="Guainía">Guainía</option>
                <option value="Guaviare">Guaviare</option>
                <option value="Huila">Huila</option>
                <option value="La Guajira">La Guajira</option>
                <option value="Magdalena">Magdalena</option>
                <option value="Meta">Meta</option>
                <option value="Nariño">Nariño</option>
                <option value="Norte de Santander">Norte de Santander</option>
                <option value="Putumayo">Putumayo</option>
                <option value="Quindío">Quindío</option>
                <option value="Risaralda">Risaralda</option>
                <option value="San Andrés y Providencia">San Andrés y Providencia</option>
                <option value="Santander">Santander</option>
                <option value="Sucre">Sucre</option>
                <option value="Tolima">Tolima</option>
                <option value="Valle del Cauca">Valle del Cauca</option>
                <option value="Vaupés">Vaupés</option>
                <option value="Vichada">Vichada</option>
            </select>

    </div>
        <div style="flex: 1; margin-left: 20px;"> 
            <label for="Ciudad">Ciudad:</label>
            <select name="Ciudad" id="Ciudad" required>
                
                <option value="Bogotá D.C">Bogotá D.C</option>
                        <option value="Medellin">Medellín </option>
                        <option value="Cartagena">Cartagena </option>
                        <option value="Cali">Cali </option>
                        <option value="Villavicencio">Villavicencio </option>
                        <option value="SantaMarta">Santa Marta </option>
                        <option value="usa">Valledupar </option>
                        <option value="canada">Tunja </option>
                        <option value="todos">Santander</option>
                        <option value="usa">Cúcuta</option>
                        <option value="canada">Vichada</option>
                        <option value="casanare">Casanare</option>
                        <option value="choco">Chocó</option>
                        <option value="Riohacha">Riohacha </option>
                        <option value="Sincelejo">Sincelejo</option>
                        <option value="Florencia">Florencia </option>
                        <option value="Yopal">Yopal </option>
                        <option value="Mocoa">Mocoa </option>
                        <option value="Leticia">Leticia </option>
                        <option value="Inirida">Inírida </option>
                        <option value="SanJoseDelGuaviare">San José del Guaviare </option>
                        <option value="Mitu">Mitú (Vaupés)</option>
                        <option value="PuertoCarreno">Puerto Carreño </option>
                        <option value="Zipaquira">Zipaquirá </option>
                        <option value="Fusagasuga">Fusagasugá </option>
                        <option value="Girardot">Girardot </option>
                        <option value="Facatativa">Facatativá </option>
                        <option value="Duitama">Duitama </option>
                        <option value="Soacha">Soacha </option>
                        <option value="Palmira">Palmira </option>
                        <option value="Monterrey">Monterrey </option>
                        <option value="Tulua">Tuluá </option>
                        <option value="Buenaventura">Buenaventura </option>
                        <option value="Rionegro">Rionegro </option>
                        <option value="Envigado">Envigado </option>
                        <option value="Buga">Buga </option>
                        <option value="Sabaneta">Sabaneta </option>
                        <option value="Tunja">Tunja </option>
                        <option value="Cartago">Cartago </option>
                        <option value="Maicao">Maicao </option>
                        <option value="Chia">Chía</option>
                        <option value="Apartado">Apartadó </option>
                        <option value="Yumbo">Yumbo </option>
                        <!-- Opciones adicionales de ciudad -->
            </select>
        </div>
    </div>
    <label for="Direccion">Dirección:</label>
    <input type="text" name="Direccion" id="Direccion" placeholder="Por favor, ingrese su dirección completa de domicilio" required>

    <label for="Telefono">Teléfono:</label>
    <input type="tel" name="Telefono" id="Telefono" placeholder="Escriba su número de contacto" required pattern="[0-9]+" title="Por favor, introduzca solo números">

    <label for="Correo_Electronico">Correo Electrónico:</label>
    <input type="text" name="Correo_Electronico" id="Correo_Electronico" 
    placeholder="Ingrese su correo electrónico, preferiblemente el que utilizó para crear la cuenta" required><br><br>
    <input type="submit" value="Crear Perfil">
</form>

</div>
<div class="container_footer">
</div>

<script>
    document.getElementById('form-perfil').addEventListener('submit', function(event) {
    var correoInput = document.getElementById('Correo_Electronico'); // Corregido aquí
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



function updateFileName(input) {
    var label = document.getElementById('file-label');
    var fileName = input.files[0].name;
    label.textContent = fileName;
}
</script>

</body>
</html>