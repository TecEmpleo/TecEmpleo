<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <link rel="stylesheet" href="cssTecEmpleo/chatenvivo.css">
    <link rel="icon" href="img/Logo.png">
</head>
<body>
    <nav>
        <h1>¿Necesitas Ayuda?</h1>
    </nav>
    <div class="chat-contenedor-en-vivo" id="chatContainer">
        <div class="scroll-anchor">
        </div>
    </div>
<br>
<br>
    <div class="mensaje-input-container">
        <textarea class="mensaje-input" id="messageInput" placeholder="Escribe tu mensaje..."></textarea>
        <button class="enviar-mensaje-btn" onclick="enviarMensaje()">Enviar</button>
    </div>

    <script src="JavaScriptprincipal/ChatIA.js"></script>
</body>
</html>
