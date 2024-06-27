function validarNombre(input) {
    var nombre = input.value.trim();
    var nombreError = document.getElementById("nombreError");

    var regex = /^[a-zA-Z\s]+$/;

    if (nombre.length === 0) {
        nombreError.innerHTML = "Por favor, complete el campo de nombre.";
        input.style.borderColor = "red";
    } else if (!regex.test(nombre)) {
        nombreError.innerHTML = "Ingrese solo letras en el campo de nombre.";
        input.style.borderColor = "red";
    } else {
        nombreError.innerHTML = "";
        input.style.borderColor = "";
    }
}
function validarApellido(input) {
    var apellido = input.value.trim();
    var apellidoError = document.getElementById("apellidoError");

    var regex = /^[a-zA-Z\s]+$/;

    if (apellido.length === 0) {
        apellidoError.innerHTML = "Por favor, complete el campo de apellido.";
        input.style.borderColor = "red";
    } else if (!regex.test(apellido)) {
        apellidoError.innerHTML = "Ingrese solo letras en el campo de apellido.";
        input.style.borderColor = "red";
    } else {
        apellidoError.innerHTML = "";
        input.style.borderColor = "";
    }
}
function validarEmail(input) {
    var email = input.value.trim();
    var emailError = document.getElementById("emailError");

    // Expresión regular para validar correos electrónicos
    var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (email.length === 0) {
        alert("Por favor, complete todos los campos, incluido el correo electrónico.");
        input.style.borderColor = "red";
        return;
    }

    if (!regex.test(email) || !/\.\w{2,}$/.test(email) || !email.includes('.com')) {
        input.style.borderColor = "red";
    } else {
        emailError.innerHTML = "";
        input.style.borderColor = "";
    }
}

function validarCampo(input, mensajeError) {
    var valor = input.value.trim();
    var errorElement = document.getElementById(input.id + "Error");

    if (valor.length === 0) {
        errorElement.innerHTML = mensajeError;
        input.style.borderColor = "red";
        return false;
    } else {
        errorElement.innerHTML = "";
        input.style.borderColor = "";
        return true;
    }
}







function validarContrasena(input) {
    var contrasena = input.value.trim();
    var contrasenaError = document.getElementById("contrasenaError");
    var esDebil = contrasena.length < 8; 
    if (esDebil) {
        contrasenaError.innerHTML = "La contraseña es débil. Debe tener al menos 8 caracteres.";
        input.style.borderColor = "red";

    } else {
        contrasenaError.innerHTML = "";
        input.style.borderColor = "";
    }
}
