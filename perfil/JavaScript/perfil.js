$(document).ready(function() {
    $('#mensajeModal').modal('show'); 
    
    setTimeout(function() {
        $('#mensajeModal').modal('hide'); 
        window.location.href = '../TecEmpleo.php'; 
    }, 3000); 
});
