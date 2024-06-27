function mostrarFormulario(email) {
    cerrarFormulario(); 
    var formularioModal = `
        <div class="modal fade" id="agregarAdminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Enviar Mensaje Al Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="miFormulario">
                            <div class="form-group">
                                <label for="email"><i class="ri-mail-line"></i> Email: ${email}</label>
                                <input type="hidden" id="email" name="email" value="${email}">
                            </div>
                            <div class="form-group">
                                <label for="mensaje">Mensaje máx. 200 caracteres..</label>
                                <textarea class="form-control" id="mensaje" name="mensaje" maxlength="200" rows="3" required></textarea>
                            </div>
                            <button type="button" onclick="enviarMensaje()" class="btn btn-primary btn-block">Enviar Mensaje</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    `;
  
    document.body.innerHTML += formularioModal;
    var agregarAdminModal = $('#agregarAdminModal');
    agregarAdminModal.modal('show');

    agregarAdminModal.on('hidden.bs.modal', function () {
        limpiarFormulario();
        location.reload();
    });
}

function cerrarFormulario() {
    $('#agregarAdminModal').modal('hide');
    $('#agregarAdminModal').on('hidden.bs.modal', function () {
        $(this).remove();
    });
}

function limpiarFormulario() {
    document.getElementById('miFormulario').reset();
}

function evitarRepetirAccion() {
    if (typeof window.history.replaceState === 'function') {
        var nuevaURL = window.location.protocol + '//' + window.location.host + window.location.pathname;
        window.history.replaceState(null, null, nuevaURL);
    }
}

function enviarMensaje() {
    var email = document.getElementById('email').value;
    var mensaje = document.getElementById('mensaje').value;

    // Realizar la solicitud AJAX al servidor
    $.ajax({
        type: "POST",
        url: "enviar_correo.php", // Reemplaza "enviar_correo.php" por el nombre de tu script PHP que maneja el envío del correo
        data: { email: email, mensaje: mensaje },
        success: function(response) {
            // Manejar la respuesta del servidor aquí
            alert("Mensaje enviado exitosamente al usuario");
            cerrarFormulario(); // Cerrar el formulario modal después de enviar el mensaje
        },
        error: function(xhr, status, error) {
            // Manejar errores aquí
            console.error(error);
            alert("Hubo un error al enviar el mensaje al usuario. Por favor, inténtelo de nuevo más tarde.");
        }
    });
}

evitarRepetirAccion();
