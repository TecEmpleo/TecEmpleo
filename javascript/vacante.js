$(document).ready(function() {
    $('#crearVacanteForm').submit(function(e) {
        var descripcion = $.trim($('textarea[name="descripcion"]').val());
        if (!descripcion) {
            e.preventDefault();
            $('#descripcionError').text('La descripción es requerida').show();
            return false;
        } else {
            $('#descripcionError').hide();
        }
    });

    $('#agregarVacanteModal').on('hidden.bs.modal', function() {
        $('#descripcionError').hide(); 
    });
});