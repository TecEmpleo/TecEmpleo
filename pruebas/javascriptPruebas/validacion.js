document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("formulario-encuesta").addEventListener("submit", function(event) {
        event.preventDefault(); // Evitar que el formulario se envíe por defecto

        // Validar que todos los campos estén completos
        var inputs = document.querySelectorAll('#formulario-encuesta input[type="text"]');
        var camposIncompletos = false;

        inputs.forEach(function(input) {
            if (input.value.trim() === '') {
                camposIncompletos = true;
                return;
            }
        });

        if (camposIncompletos) {
            alert("Por favor, completa todos los campos del formulario.");
            return;
        }

        // Realizar la solicitud POST utilizando Fetch API
        fetch("pruebas.php", {
            method: "POST",
            body: new FormData(this)
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error); 
            } else if (data.success) {
                alert(data.success); 
            }
        })
        .catch(error => {
            console.error("Error:", error);
        });
    });
});
