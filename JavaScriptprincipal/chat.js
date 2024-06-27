function toggleChat() {
    var chatContainer = document.getElementById("chatContainer");
    var openChatBtn = document.querySelector(".open-chat-btn");

    if (chatContainer.style.display === "none" || chatContainer.style.display === "") {
        chatContainer.style.display = "block";
        openChatBtn.style.display = "none";
    } else {
        chatContainer.style.display = "none";
    }
}

function sendMessage() {
    var messageInput = document.getElementById("messageInput");
    var chatBody = document.getElementById("chatBody");
    var message = messageInput.value.trim();

    if (message !== "") {
        chatBody.innerHTML += "<p>" + message + "</p>";
        messageInput.value = "";
        messageInput.focus();
    }
}

function closeChat(event) {
    var chatContainer = document.getElementById("chatContainer");
    var openChatBtn = document.querySelector(".open-chat-btn");
    var messageInput = document.getElementById("messageInput");
    var searchButton = document.querySelector(".mi-nueva-clase");

    if (event.target === messageInput || event.target === searchButton) {
        return;
    }

    if (!chatContainer.contains(event.target) && event.target !== openChatBtn) {
        chatContainer.style.display = "none";
        openChatBtn.style.display = "block";
    }
}

document.addEventListener("DOMContentLoaded", function() {
    var chatContainer = document.getElementById("chatContainer");
    document.addEventListener("click", function(event) {
        closeChat(event);
    });
});

