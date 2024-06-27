var historialPreguntas = [];

function mostrarOpciones() {
    document.querySelector('.contenedor-pruebas').style.display = "none";
    document.getElementById("contenedor-genero").style.display = "block";
}

function mostrarPreguntaAnterior() {
    var contenedorActual = document.querySelector('.contenedor-centralizado[style="display: block;"]');
    contenedorActual.style.display = "none";
    var preguntaAnterior = historialPreguntas.pop();
    if (preguntaAnterior) {
        document.getElementById(preguntaAnterior).style.display = "block";
    }
}

document.getElementById("btn-atras").addEventListener("click", mostrarPreguntaAnterior);
document.getElementById("btn-atras-2").addEventListener("click", mostrarPreguntaAnterior);
document.getElementById("btn-atras-3").addEventListener("click", mostrarPreguntaAnterior);

document.getElementById("btn-atras-4").addEventListener("click", mostrarPreguntaAnterior);
document.getElementById("btn-atras-5").addEventListener("click", mostrarPreguntaAnterior);
document.getElementById("btn-atras-6").addEventListener("click", mostrarPreguntaAnterior);
document.getElementById("btn-atras-7").addEventListener("click", mostrarPreguntaAnterior);
document.getElementById("btn-atras-8").addEventListener("click", mostrarPreguntaAnterior);
document.getElementById("btn-atras-9").addEventListener("click", mostrarPreguntaAnterior);
document.getElementById("btn-atras-10").addEventListener("click", mostrarPreguntaAnterior);

document.getElementById("btn-siguiente-genero").addEventListener("click", function() {
    historialPreguntas.push("contenedor-genero");
    document.getElementById("contenedor-genero").style.display = "none";
    document.getElementById("contenedor-otra-pregunta").style.display = "block";
});

document.getElementById("btn-siguiente-pregunta").addEventListener("click", function() {
    historialPreguntas.push("contenedor-otra-pregunta");
    document.getElementById("contenedor-otra-pregunta").style.display = "none";
    document.getElementById("contenedor-otra-pregunta-2").style.display = "block";
});

document.getElementById("btn-siguiente-pregunta-2").addEventListener("click", function() {
    historialPreguntas.push("contenedor-otra-pregunta-2");
    document.getElementById("contenedor-otra-pregunta-2").style.display = "none";
    document.getElementById("contenedor-otra-pregunta-3").style.display = "block";
});

document.getElementById("btn-siguiente-pregunta-3").addEventListener("click", function() {
    historialPreguntas.push("contenedor-otra-pregunta-3");
    document.getElementById("contenedor-otra-pregunta-3").style.display = "none";
    document.getElementById("contenedor-otra-pregunta-4").style.display = "block";
});

document.getElementById("btn-siguiente-pregunta-4").addEventListener("click", function() {
    historialPreguntas.push("contenedor-otra-pregunta-4");
    document.getElementById("contenedor-otra-pregunta-4").style.display = "none";
    document.getElementById("contenedor-otra-pregunta-5").style.display = "block";
});

document.getElementById("btn-siguiente-pregunta-5").addEventListener("click", function() {
    historialPreguntas.push("contenedor-otra-pregunta-5");
    document.getElementById("contenedor-otra-pregunta-5").style.display = "none";
    document.getElementById("contenedor-otra-pregunta-6").style.display = "block";
});

document.getElementById("btn-siguiente-pregunta-6").addEventListener("click", function() {
    historialPreguntas.push("contenedor-otra-pregunta-6");
    document.getElementById("contenedor-otra-pregunta-6").style.display = "none";
    document.getElementById("contenedor-otra-pregunta-7").style.display = "block";
});

document.getElementById("btn-siguiente-pregunta-7").addEventListener("click", function() {
    historialPreguntas.push("contenedor-otra-pregunta-7");
    document.getElementById("contenedor-otra-pregunta-7").style.display = "none";
    document.getElementById("contenedor-otra-pregunta-8").style.display = "block";
});

document.getElementById("btn-siguiente-pregunta-8").addEventListener("click", function() {
    historialPreguntas.push("contenedor-otra-pregunta-8");
    document.getElementById("contenedor-otra-pregunta-8").style.display = "none";
    document.getElementById("contenedor-otra-pregunta-9").style.display = "block";
});

document.getElementById("btn-siguiente-pregunta-9").addEventListener("click", function() {
    historialPreguntas.push("contenedor-otra-pregunta-9");
    document.getElementById("contenedor-otra-pregunta-9").style.display = "none";
    document.getElementById("contenedor-otra-pregunta-10").style.display = "block";
});
