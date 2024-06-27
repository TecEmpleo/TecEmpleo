$(document).ready(function() {
    $('#crearCategoriaForm').submit(function(e) {
        var nombreCategoria = $.trim($('input[name="nombreCategoria"]').val());
        if (!/^[a-zA-Z ]+$/.test(nombreCategoria)) {
            e.preventDefault();
            $('#nombreCategoriaError').text('Solo se permiten letras y espacios en blanco').show();
            return false;
        } else {
            $('#nombreCategoriaError').hide();
        }
    });

    $('#agregarCategoriaModal').on('hidden.bs.modal', function() {
        $('#nombreCategoriaError').hide(); // Ocultar el mensaje de error al cerrar el modal
    });
});