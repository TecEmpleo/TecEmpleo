<?php
session_start();

if (!isset($_SESSION["id"]) || !isset($_SESSION["Nombre_Reg"])) {
    header("Location: ../TecEmpleo.php");
    exit();
}
$Nombre_Reg = $_SESSION["Nombre_Reg"];
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./cssTecEmpleo/styloTecEmpleo.css">
   <link rel="stylesheet" href="cssTecEmpleo/chat.css">
    
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.19.1/js/uikit.min.js" integrity="sha512-vFi9G4t82KENdGzcl3wMaHGBsxPO/dtPPgCuLB7zNmbRa3jqcMh1XFMzUx1E5Ccxxmxu44LHj66zwJyx/m2Z1Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.19.1/css/uikit-core-rtl.min.css" integrity="sha512-yewVTraqvhTD0tHJwnSvihwkxOA8tAXyALdV4dd8HH2DfnAB4iqLqPFJnZYRqK4nKv/X9hyKEWBwCkctgtNFSw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!--  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/css/bootstrap.min.css" integrity="sha384-b1vbLQXJHv0hBLW1gI+5kGQOFLJf5fuTtcBHTOKjQcPD6JbqFq2bTtr1o5iq2DkT" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="./buscador/style.css"> 
   <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="./img/Logo.png">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <title>TecEmpleo | Portal de Empleo</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<style>
    .enlace-personalizado {
        text-decoration: none; 
        color: white; 
        transition: color 0.3s, transform 0.3s; 
        display: inline-block; 
    }
    .enlace-personalizado:hover {
        text-decoration: none; 
        color: #fff; 
        transform: scale(1.5); 
    }
</style>

    <nav>
        <button class="menu" id="menuButton">
            <i class="fa-solid fa-bars" style="color: #ffffff;"></i>
        </button>
        
        <div class="sidebar" id="sidebar">
            <h1><a href="perfil/mi_perfil.php" class="enlace-personalizado"><?= $Nombre_Reg; ?></a></h1>
            <div class="heading">
            <ul>
                <li><a href=""><i class="ri-heart-line" style="color: #ffffff;"></i>Favoritos</a></li>
                <div class="container-one">
                    <ul>
                        <li><a href="HDV/index.html">Crear HDV</a></li>
                        <li><a href="pruebas/pruebas.php">Test Cognitivo</a></li>
                    </ul>
                </div>
 <center>          
    <br>
    <br>
    <br>
               </div>
                <div class="contenedor">
                    <ul>
                    <?php
                        if (isset($_SESSION["id"])) {
                        echo '<li><a href="inicio\cerrar_sesion.php"><i class="ri-logout-box-line" style="color: #ffffff;"></i>Cerrar Sesión</a></li>';
                        } else {
                        echo '<li><a href="inicio\inicio_sesion.php"><i class="ri-user-line" style="color: #ffffff;"></i>Iniciar Sesión</a></li>';
                      }
                    ?>
<center>
                    </ul>
                 </ul>
            </div>
        </div> 
    </nav>
    <div class="header">
        <h3>!!No Importa Lo Despacio Que Vayas
            Siempre Y Cuando No Te Detengas¡¡
        </h3>
<center>
<div class="form-container">
    <form action="./buscador/" method="get" class="search-container">
        <i class="ri-suitcase-fill"></i>
        <input type="text" class="form-control" id="inputSearchVacantes" name="nombreCategoria" placeholder="Nombre de la Categoría" required>
        <button class="buscar-button" type="button" onclick="search()">Buscar</button>
    </form>
</div>
</div>
</button>
<div class="containerOfContainer">
 <div id="containerTargets"></div>
 </div>
<center> 
    <div class="contenedor-imagenes">
        <div class="cuadro"><a href="empresas/AKT.html"><img src="img/bimbo.png" alt="Imagen 1"></a></div>
        <div class="cuadro"><a href="empresas/Alkosto.html"><img src="img/alkosto.png" alt="Imagen 2"></a></div>
        <div class="cuadro"><a href="empresas/K-Tronix.html"><img src="img/katronix.png" alt="Imagen 3"></a></div>
        <div class="cuadro"><a href="empresas/Alkomprar.html"><img src="img/alkomprar.png" alt="Imagen 4"></a></div>
        <div class="cuadro"><a href="empresas/Bancolombia.html"><img src="img/bancolombia.png" alt="Imagen 5"></a></div>
        <div class="cuadro"><a href="empresas/Coca_Cola.html"><img src="img/Coca-Cola-logo.png" alt="Imagen 6"></a></div>
        <div class="cuadro"><a href="empresas/Banco AV Villas.html"><img src="img/avevillas.png" alt="Imagen 7"></a></div>
        <div class="cuadro"><a href="empresas/Grupo AVAL.html"><img src="img/aval.png" alt="Imagen 8"></a></div>
    </div>
    <div class="contenedor-boton">
        <p class="parrafo">"Tu futuro laboral está lleno de oportunidades esperando a ser descubiertas en TecEmpleo. </p>
        <a class="btn" href="" id="buscarEmpresasLink">Buscar Empresas</a>
    </div>   
    </div>             

<center> 
    <div class="profile-container">
        <img src="img/perfil.png" alt="Tu imagen de perfil" class="profile-image">
        <div class="profile-description">
            <h1>!!Crea De Manera Rapida Tu Perfil¡¡</h1>
            <h2>!!Refistrate Gratis Y Crea Tu Perfil De manera Gratuita¡¡</h2>
            <h2>!!Completa Tu Hoja De vida Y Enviala¡¡</h2>
            <h3>En TecEmpleo Encontraras Ofertas de Trabajo Gartis¡¡</h3>
            <h4>!!Buscamos Empresas Que Necesiten Empleados¡¡</h4>
            <a class="btn-nuevo" href="perfil/perfil.php" id="buscarEmpresasLink">Crear Perfil</a>
        </div>
    </div>
    <div class="contenedor-cuadrados">
        <div class="cuadrado izquierda">
            <img src="img/buscar.png"Imagen Izquierda">
            <h2>¡Únete a nuestro equipo y sé parte de una aventura profesional!"</h2>
            <p>¿Estás listo para unirte a la comunidad de empresas que están transformando el panorama laboral y descubriendo el talento del mañana? "</p>
        </div>
        <div class="cuadrado centro">
            <img src="img/vision.png" alt="Imagen Centro" style="margin-top: -35px;">
            <h2>Visión de TecEmpleo</h2>
            <p>Ser la plataforma líder en la transformación del mundo laboral, conectando de manera efectiva a empresas con talento</p>
        </div>
        <div class="cuadrado derecha">
            <img src="img/contratacion.jpg" alt="Imagen Derecha">
            <h2>"Contrata el talento que tu empresa necesita en TecEmpleo."</h2>
            <p>En TecEmpleo, transformamos tu búsqueda de talento en un viaje hacia el éxito empresarial.</p>
        </div>
    </div>
</head>
<body>
<button id="openChatBtn" class="open-chat-btn" onclick="toggleChat()"><i class="ri-chat-3-line"></i>Ayuda</button>
<div class="chat-container" id="chatContainer" style="display: none;">
    <nav class="navbarchat">
        <div class="user-info">
            <span class="user-name">Ayuda</span>
            <div class="user-icons">
                <a href="tu_enlace" target="_blank"><i class="ri-mail-line user-icon"></i></a>
                <a href="" target="_blank"><i class="ri-phone-line user-icon"></i></a>
            </div>
        </div>
    </nav>
    <div class="chat-header">
    <div class="chat-body" id="chatBody">
        <div class="chat-input-container">
            <input type="text" id="messageInput" class="chat-input" placeholder="Necesitas Ayuda">
            <button class="search-btn" onclick="searchCompanies()">Buscar</button>
        </div>
    </div>
</div>
</div>
<div class="fire">
  <div class="fire-left">
    <div class="main-fire"></div>
    <div class="particle-fire"></div>
  </div>
  <div class="fire-center">
    <div class="main-fire"></div>
    <div class="particle-fire"></div>
  </div>
  <div class="fire-right">
    <div class="main-fire"></div>
    <div class="particle-fire"></div>
  </div>
  <div class="fire-bottom">
    <div class="main-fire"></div>
  </div>
</div>

    <footer class="footer">
    <div class="copyright">
        &copy; 2023 TecEmpleo. Todos los derechos reservados.
    </div>
</footer>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('registro_form').addEventListener('submit', function(event) {
            var correoInput = document.getElementById('Email_reg');
            var correo = correoInput.value;

            if (!correo.endsWith('.com')) {
                alert('Por favor, ingrese una dirección de correo electrónico con la extensión .com');
                event.preventDefault();
            }
        });
    });
</script>
    
    
    <script src="JavaScriptprincipal/tecempleo.js"></script>
    <script src="JavaScriptprincipal/chat.js"></script>
    <script src="JavaScriptprincipal/chatenvivo.js"></script>
    <script src="./buscador/server.js"></script>


</html>