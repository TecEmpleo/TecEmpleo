function enviarAccion(idPostulacion, accion) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'tuscript.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert(xhr.responseText);
        }
    };
    xhr.send('id_postulacion=' + idPostulacion + '&accion=' + accion);
}


function cerrarProceso(idPostulacion) {
    var elemento = document.getElementById("postulacion_" + idPostulacion);
    
    var fadeEffect = setInterval(function () {
        if (!elemento.style.opacity) {
            elemento.style.opacity = 1;
        }
        if (elemento.style.opacity > 0) {
            elemento.style.opacity -= 0.1;
        } else {
            clearInterval(fadeEffect);
            elemento.style.display = 'none';
        }
    }, 100); 
    
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "actualizar_estado_postulacion.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            alert("Proceso de postulación activado");
        }
    };
    xhr.send("id_postulacion=" + idPostulacion + "&accion=cerrar_proceso");
}
