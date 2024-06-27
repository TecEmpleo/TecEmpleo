function validarFormulario() {
    var emailInput = document.getElementById("emailInput");
    var contrasenaInput = document.getElementById("contrasenaInput");
    var emailError = document.getElementById("emailError");
    var contrasenaError = document.getElementById("contrasenaError");
    var formError = document.getElementById("formError");
    emailError.innerHTML = "";
    contrasenaError.innerHTML = "";
    formError.innerHTML = "";

    if (emailInput.value.trim() === "") {
        emailError.innerHTML = "Por favor, completa el campo de correo electrónico.";
        emailInput.style.borderColor = "red";
        return false;
    }

    if (contrasenaInput.value.trim() === "") {
        contrasenaError.innerHTML = "Por favor, completa el campo de contraseña.";
        contrasenaInput.style.borderColor = "red";
        return false;
    }

    return true;
}

function validarEmailRegistro(input) {
    var email = input.value.trim();
    var emailError = document.getElementById("emailError");

    emailError.innerHTML = "";

    var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email.length > 0 && !regex.test(email)) {
        emailError.innerHTML = "Ingresa una dirección de correo electrónico válida.";
        input.style.borderColor = "red";
    } else {
        input.style.borderColor = "";
    }
}

function validarContrasenaRegistro(input) {
    var contrasena = input.value.trim();
    var contrasenaError = document.getElementById("contrasenaError");
    contrasenaError.innerHTML = "";

    var esDebil = contrasena.length < 8;
    if (esDebil) {
        contrasenaError.innerHTML = "La contraseña es débil. Debe tener al menos 8 caracteres.";
        input.style.borderColor = "red";
    } else {
        input.style.borderColor = "";
    }
}
