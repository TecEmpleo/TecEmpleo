var preguntasMostradas = false;

function searchCompanies() {
    var searchInput = document.getElementById("messageInput").value.trim();

    if (searchInput === "") {
        alert("Por favor, ingresa un término de búsqueda válido.");
        return;
    }

    if (preguntasMostradas) {
        alert("Ya se han mostrado las preguntas.");
        return;
    }

    var contenidoAnterior = document.getElementById("contenidoAnterior");
    if (contenidoAnterior) {
        contenidoAnterior.style.display = "none";
    }

    var questions = [
        "¿Cómo puedo crear una cuenta de usuario?",
        "¿Cuál es el proceso para aplicar a una oferta de empleo?",
        "¿Qué requisitos se necesitan para ser contratado?",
        "¿Cuál es la política de la empresa respecto a la privacidad de los datos?"
    ];

    var chatBody = document.getElementById("chatBody");
    questions.forEach(function(question, index) {
        var questionElement = document.createElement("div");
        questionElement.classList.add("question");
        questionElement.textContent = question;
        chatBody.appendChild(questionElement);

        if (index < questions.length - 1) {
            var spaceElement = document.createElement("div");
            spaceElement.textContent = " ";
            chatBody.appendChild(spaceElement);
        }
    });

    var chatButton = document.createElement("button");
    chatButton.textContent = "Chat en línea";
    chatButton.classList.add("chat-en-linea");
    chatButton.addEventListener("click", startChat); 
    chatBody.appendChild(chatButton);

    preguntasMostradas = true;

    var searchButton = document.querySelector(".mi-nueva-clase");
    if (searchButton) {
        searchButton.disabled = true;
    }

    var navbarchat = document.getElementById("navbarchat");
    navbarchat.scrollIntoView({ behavior: 'smooth', block: 'start' });
}
function startChat() {
    var contenidoAnterior = document.getElementById("contenidoAnterior");
    if (contenidoAnterior) {
        contenidoAnterior.style.display = "none";
    }

    window.location.href = "chatenvivo.php";

    var chatContainer = document.getElementById("chatContainer");
    if (chatContainer) {
        chatContainer.style.display = "block";
        var messageInput = chatContainer.querySelector(".message-input");
        if (messageInput) {
            messageInput.focus();
            messageInput.select();
        }
    } else {
        chatContainer = document.createElement("div");
        chatContainer.classList.add("chat-en-vivo");
        chatContainer.id = "chatContainer";
        document.getElementById("chatBody").appendChild(chatContainer);
        var chatMessages = document.createElement("div");
        chatMessages.classList.add("chat-messages");
        var messageInput = document.createElement("input");
        messageInput.classList.add("message-input");
        messageInput.setAttribute("type", "text");
        messageInput.setAttribute("placeholder", "Escribe tu mensaje...");
        var sendButton = document.createElement("button");
        sendButton.textContent = "Enviar";
        sendButton.addEventListener("click", function() {
            sendMessage(); 
        });
        sendButton.classList.add("send-btn");
        chatContainer.appendChild(chatMessages);
        chatContainer.appendChild(messageInput);
        chatContainer.appendChild(sendButton);
        messageInput.focus();
        messageInput.select();
    }
}
function sendMessage() {
    var messageInput = document.querySelector(".message-input");
    var messageText = messageInput.value.trim();
    if (messageText === "") {
        alert("Por favor, escribe un mensaje válido.");
        return;
    }
    var chatMessages = document.querySelector(".chat-messages");
    var messageElement = document.createElement("div");
    messageElement.textContent = messageText;
    messageElement.classList.add("message");
    chatMessages.appendChild(messageElement);
    messageInput.value = "";
    chatMessages.scrollTop = chatMessages.scrollHeight;
}
