document.addEventListener("DOMContentLoaded", function() {
    var verRespuestasBtn = document.getElementById('verRespuestasBtn');
    var respuestasContenedor = document.getElementById('respuestasContenedor');

    verRespuestasBtn.addEventListener('click', function() {
        respuestasContenedor.style.display = respuestasContenedor.style.display === 'none' ? 'block' : 'none';
    });
});
