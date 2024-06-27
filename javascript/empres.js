$(document).ready(function() {
    $('#crearEmpresaForm').submit(function() {
        var email = $('#email').val();
        var telefono = $('#telefono').val();
        var error = false;

        if (!isValidEmail(email)) {
            $('#errorEmail').text('El correo electrónico no es válido');
            error = true;
        } else {
            $('#errorEmail').text('');
        }

        if (!isValidPhoneNumber(telefono)) {
            $('#errorTelefono').text('El teléfono solo debe contener números');
            error = true;
        } else {
            $('#errorTelefono').text('');
        }

        return !error;
    });

    // Función para validar el formato del correo electrónico
    function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Función para validar que el teléfono solo contenga números
    function isValidPhoneNumber(phoneNumber) {
        var phoneNumberRegex = /^\d+$/;
        return phoneNumberRegex.test(phoneNumber);
    }
});