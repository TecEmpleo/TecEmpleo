let startTime;
let running = false;
let pauseTime = 0;

function iniciarTiempo() {
    if (!running) {
        startTime = Date.now();
        running = true;
        document.getElementById('iniciar-tiempo').disabled = true;
        document.getElementById('detener-tiempo').disabled = false;
        document.getElementById('reanudar-tiempo').disabled = true;
        document.getElementById('horas-trabajadas').textContent = '0 h';
        document.getElementById('minutos-trabajados').textContent = '0 m';
        document.getElementById('segundos-trabajados').textContent = '0 s';
        document.getElementById('h-label').textContent = 'h';
        document.getElementById('m-label').textContent = 'm';
        document.getElementById('s-label').textContent = 's';
        localStorage.setItem('startTime', startTime);
        localStorage.removeItem('pauseTime'); // Elimina la clave 'pauseTime' del localStorage
    }
}

function detenerTiempo() {
    if (running) {
        running = false;
        pauseTime = Date.now();
        document.getElementById('iniciar-tiempo').disabled = false;
        document.getElementById('detener-tiempo').disabled = true;
        document.getElementById('reanudar-tiempo').disabled = false;
        localStorage.setItem('pauseTime', pauseTime);
    }
}

function reanudarTiempo() {
    if (!running) {
        let pausedTime = Date.now() - parseInt(localStorage.getItem('pauseTime') || 0);
        startTime = parseInt(localStorage.getItem('startTime')) + pausedTime;
        running = true;
        document.getElementById('reanudar-tiempo').disabled = true;
        document.getElementById('detener-tiempo').disabled = false;
    }
}

function actualizarTiempo() {
    if (running) {
        let elapsedTime = Math.floor((Date.now() - startTime) / 1000);
        let horas = Math.floor(elapsedTime / 3600);
        let minutos = Math.floor((elapsedTime % 3600) / 60);
        let segundos = elapsedTime % 60;
        document.getElementById('horas-trabajadas').textContent = horas + ' h';
        document.getElementById('minutos-trabajados').textContent = minutos + ' m';
        document.getElementById('segundos-trabajados').textContent = segundos + ' s';
    }
}

window.onload = function() {
    if (localStorage.getItem('startTime')) {
        if (!localStorage.getItem('pauseTime')) {
            iniciarTiempo();
        } else {
            reanudarTiempo();
        }
    }
}

window.onbeforeunload = function() {
    if (running) {
        detenerTiempo();
    }
}

setInterval(actualizarTiempo, 1000);
