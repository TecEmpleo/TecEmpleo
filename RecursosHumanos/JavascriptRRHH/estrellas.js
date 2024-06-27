// Función para establecer el valor del rating y almacenarlo en localStorage
function setRating(usuario_id, valor) {
    // Establecer el valor del rating en el campo oculto correspondiente
    document.getElementById('ratingValue_' + usuario_id).value = valor;
    
    // Almacenar el valor seleccionado en localStorage
    localStorage.setItem('rating_' + usuario_id, valor);
    
    // Obtener todas las estrellas
    var stars = document.querySelectorAll('#calificarForm_' + usuario_id + ' .star');
    
    // Iterar sobre todas las estrellas y aplicar el estilo según el valor almacenado
    for (var i = 0; i < stars.length; i++) {
        if (i < valor) {
            stars[i].classList.add('selected');
        } else {
            stars[i].classList.remove('selected');
        }
    }
}


// Función para inicializar los eventos de clic en las estrellas
function initRating(usuario_id) {
    // Obtener el valor almacenado en localStorage, si existe
    var storedValue = localStorage.getItem('rating_' + usuario_id);
    var valor = storedValue ? parseInt(storedValue) : 0;
    
    // Establecer el valor inicial del rating
    setRating(usuario_id, valor);
    
    // Obtener todas las estrellas
    var stars = document.querySelectorAll('#calificarForm_' + usuario_id + ' .star');
    
    // Iterar sobre todas las estrellas y agregar el evento de clic
    for (var i = 0; i < stars.length; i++) {
        stars[i].addEventListener('click', function() {
            var valor = parseInt(this.getAttribute('data-value'));
            setRating(usuario_id, valor);
        });
    }
}
