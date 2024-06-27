document.getElementById("messageInput").addEventListener("keypress", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault(); 
        enviarMensaje(); 
    }
});

// Función para enviar el mensaje
function enviarMensaje() {
    var mensajeUsuario = document.getElementById("messageInput").value;
    agregarMensaje(mensajeUsuario, "usuario");
    procesarMensaje(mensajeUsuario);
    document.getElementById("messageInput").value = "";
}

        function agregarMensaje(mensaje, clase) {
            var messageElement = document.createElement("div");
            messageElement.classList.add("message", clase);
            messageElement.textContent = mensaje;
            document.getElementById("chatContainer").appendChild(messageElement);
        }

        function procesarMensaje(mensaje) {
            var respuesta = obtenerRespuesta(mensaje);
            agregarMensaje(respuesta, "chatbot");
        }

        function obtenerRespuesta(mensaje) {
    var mensajeMinusculas = mensaje.toLowerCase();

    if (mensajeMinusculas.includes("hola") || mensajeMinusculas.includes("buenos dias") || 
    mensajeMinusculas.includes("que se cuenta") || 
    mensajeMinusculas.includes("Buenas tardes") ||  
    mensajeMinusculas.includes("buenos noches") ||  
    mensajeMinusculas.includes("que tal") ||  
     mensajeMinusculas.includes("buenas")) {
        return "¡Hola! ¿En qué puedo ayudarte?";
    } else if (mensajeMinusculas.includes("como busco trabajo") || 
    mensajeMinusculas.includes("que proceso puedo hacer para una vacante") ||
    mensajeMinusculas.includes("como me postulo a una vacante") ||
    mensajeMinusculas.includes("que hago para postularme a una vacante") ||
    mensajeMinusculas.includes("digame como es el proceso para una vacante") ||
    mensajeMinusculas.includes("ayudeme a como postularme a una vacante") ||
    mensajeMinusculas.includes("dame la solucion para buscar vacantes") ||
    mensajeMinusculas.includes("necesito que me diga como postularme a una vacante") ||
    mensajeMinusculas.includes("donde busco las vacantes") ||
    mensajeMinusculas.includes("donde puedo encontrar las vacantes") ||
    mensajeMinusculas.includes("donde puedo seleccionar las vacantes") ||
    mensajeMinusculas.includes("donde selecciono las vacantes") ||
    mensajeMinusculas.includes("dame solucion al encontrar las vacantes") ||
    mensajeMinusculas.includes("donde miro las vacantes") ||
    mensajeMinusculas.includes("donde miro la vacante") ||
    mensajeMinusculas.includes("donde busco unas vacantes") || 
    mensajeMinusculas.includes("donde busco una vacante") ||
    mensajeMinusculas.includes("que proceso hago para buscar vacante") ||
    mensajeMinusculas.includes("que proceso hago para buscar vacantes") ||
    mensajeMinusculas.includes("cual es la manera correcta para buscar vacantes") ||
    mensajeMinusculas.includes("cual es la manera correcta para buscar vacante") ||
    mensajeMinusculas.includes("ayudeme no encuentro las vacantes") ||
    mensajeMinusculas.includes("quiero que me diga donde estan las vacantes") ||
    mensajeMinusculas.includes("quiero que me diga donde esta la vacante") ||
    mensajeMinusculas.includes("si yo busco una vacante de desarrollador de software, donde la encuentro") ||
    mensajeMinusculas.includes("si yo busco las vacantes disponibles de desarrollador de software, donde las ubico") ||
    mensajeMinusculas.includes("diagame en que parte estan las vacantes de auxiliar de enfermeria") ||
    mensajeMinusculas.includes("diagame donde estan ubicadas las vacantes de desarrollador html, css, javascript, php de enfermeria") ||
    mensajeMinusculas.includes("en donde se encuentran las vacantes de asesor") ||
    mensajeMinusculas.includes("digame en que parte estan ubicadas las vacantes de desarrollador php") ||
    mensajeMinusculas.includes("donde encuentro la vacante para desarrollador de software php") ||
    mensajeMinusculas.includes("ayudeme a buscar una vacante") ||
    mensajeMinusculas.includes("donde encuentro una vacante") ||
    mensajeMinusculas.includes("como busco una vacante") ||
    mensajeMinusculas.includes("como puedo buscar una vacante") ||
    mensajeMinusculas.includes("ayudame a buscar una vacante") ||
    mensajeMinusculas.includes("como busco empleo") ||
    mensajeMinusculas.includes("como hago para buscar empleo") ||
    mensajeMinusculas.includes("cuales son los pasos para buscar una vacante")) {
        return "Puedes buscar vacantes en nuestro buscador y seguir los pasos de postulación."; 
    } else if (mensajeMinusculas.includes("como creo mi perfil") ||
    mensajeMinusculas.includes("como abro mi perfil") ||
    mensajeMinusculas.includes("como creo un perfil") ||
    mensajeMinusculas.includes("quiero crear mi perfil") ||
    mensajeMinusculas.includes("como hago para crear mi perfil") ||
    mensajeMinusculas.includes("como comienzo mi perfil") ||
    mensajeMinusculas.includes("como inicio mi perfil") ||
    mensajeMinusculas.includes("necesito abrir mi perfil") ||
    mensajeMinusculas.includes("necesito crear mi perfil") ||
    mensajeMinusculas.includes("quiero comenzar mi perfil") ||
    mensajeMinusculas.includes("quiero iniciar mi perfil") ||
    mensajeMinusculas.includes("cómo configuro mi perfil") ||
    mensajeMinusculas.includes("cómo establezco mi perfil") ||
    mensajeMinusculas.includes("quiero configurar mi perfil") ||
    mensajeMinusculas.includes("cómo empiezo mi perfil") ||
    mensajeMinusculas.includes("cómo inicio mi perfil de usuario") ||
    mensajeMinusculas.includes("cómo completo mi perfil") ||
    mensajeMinusculas.includes("cómo edito mi perfil") ||
    mensajeMinusculas.includes("quiero editar mi perfil") ||
    mensajeMinusculas.includes("cómo personalizo mi perfil") ||
    mensajeMinusculas.includes("cómo configuro mi cuenta") ||
    mensajeMinusculas.includes("cómo accedo a mi perfil")) {
        return "Para crear tu perfil en TecEmpleo, primero inicia sesión en tu cuenta. Luego, ve a la sección de perfil y completa la información solicitada, como tu experiencia laboral, habilidades y educación. Asegúrate de proporcionar información precisa y relevante para aumentar tus posibilidades de éxito en la búsqueda de empleo.";
    } else if (mensajeMinusculas.includes("puedo cerrar mi postulacion") ||
    mensajeMinusculas.includes("puedo finalizar mi postulacion") ||
    mensajeMinusculas.includes("como cierro mi postulacion") ||
    mensajeMinusculas.includes("como finalizo mi postulacion") ||
    mensajeMinusculas.includes("puedo cancelar mi postulacion") ||
    mensajeMinusculas.includes("como cierro mi postulacion") ||
    mensajeMinusculas.includes("como finalizo mi postulacion") ||
    mensajeMinusculas.includes("quiero cancelar mi postulacion") ||
    mensajeMinusculas.includes("quiero cerrar mi postulacion") ||
    mensajeMinusculas.includes("quiero finalizar mi postulacion") ||
    mensajeMinusculas.includes("como detengo mi postulacion") ||
    mensajeMinusculas.includes("como termino mi postulacion") ||
    mensajeMinusculas.includes("necesito cancelar mi postulacion") ||
    mensajeMinusculas.includes("necesito cerrar mi postulacion") ||
    mensajeMinusculas.includes("necesito finalizar mi postulacion") ||
    mensajeMinusculas.includes("puedo detener mi postulacion") ||
    mensajeMinusculas.includes("puedo terminar mi postulacion") ||
    mensajeMinusculas.includes("como anulo mi postulacion") ||
    mensajeMinusculas.includes("como completo mi postulacion")) {
        return "Solo el departamento de Recursos Humanos puede cerrar una postulacion.";
    } else if (mensajeMinusculas.includes("como creo mi hoja de vida") ||
    mensajeMinusculas.includes("como hago una hoja de vida") ||
    mensajeMinusculas.includes("como podria crear una hoja de vida") ||
    mensajeMinusculas.includes("que  puedo haacer para crear una hoja de vida") ||
    mensajeMinusculas.includes("como hago mi hoja de vida") ||
    mensajeMinusculas.includes("deme los paso para la creacion de la hoja de vida") ||
    mensajeMinusculas.includes("como elaboro mi hoja de vida") ||
    mensajeMinusculas.includes("como construyo mi hoja de vida") ||
    mensajeMinusculas.includes("como redacto mi hoja de vida") ||
    mensajeMinusculas.includes("como puedo realizar mi Hoja de Vida, necesito pasos a realizar.") ||
    mensajeMinusculas.includes("como puedo realizar mi Hdv, necesito pasos a realizar.") ||
    mensajeMinusculas.includes("quiero crear la hoja de vida como hago") || 
    mensajeMinusculas.includes("quiero crear la hdv como hago") || 
    mensajeMinusculas.includes("como preparo mi hoja de vida")) {
        return "Para crear tu hoja de vida, puedes seguir estos pasos: 1. Abre un procesador de texto o utiliza una plantilla de hoja de vida. 2. Agrega tu información personal, como nombre, contacto y dirección. 3. Incluye tu experiencia laboral, educación y habilidades. 4. Destaca tus logros y competencias relevantes para el trabajo que estás solicitando. 5. Revisa y edita tu hoja de vida para asegurarte de que esté bien organizada y sin errores. ¡Buena suerte!"; 
    } else if (mensajeMinusculas.includes("despedida") || mensajeMinusculas.includes("adios")) {
        return "¡Adiós! Espero verte pronto.";
    } else {
        return "Lo siento, no entendí tu mensaje. ¿Puedes ser más específico?";
    }
        }

        window.onload = function() {
            enviarMensajeAutomatico("¡Hola! Soy un Chat Con Inteligencia Artificial ¿En qué puedo ayudarte?");
        };

        function enviarMensajeAutomatico(mensaje) {
            agregarMensaje(mensaje, "chatbot");
        }