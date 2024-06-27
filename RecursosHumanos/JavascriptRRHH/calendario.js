document.addEventListener('DOMContentLoaded', function() {
  function generarMeses() {
    const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    const selectMes = document.getElementById('mes');

    for (let i = 0; i < meses.length; i++) {
      const option = document.createElement('option');
      option.textContent = meses[i];
      option.value = i; 
      selectMes.appendChild(option);
    }

    selectMes.selectedIndex = new Date().getMonth(); 
  }

  function generarAños() {
    const selectAño = document.getElementById('año');

    for (let i = 1900; i <= 2030; i++) {
      const option = document.createElement('option');
      option.textContent = i;
      option.value = i;
      selectAño.appendChild(option);
    }

    selectAño.value = new Date().getFullYear(); 
  }

  function obtenerUltimoDiaDelMes(mes, año) {
    return new Date(año, mes + 1, 0).getDate();
  }

  function generarDias(mes, año) {
    const diasContenedor = document.getElementById('dias');
    diasContenedor.innerHTML = '';

    const ultimoDiaDelMes = obtenerUltimoDiaDelMes(mes, año);

    for (let i = 1; i <= ultimoDiaDelMes; i++) {
      const dia = document.createElement('div');
      dia.classList.add('dia');
      dia.textContent = i;
      diasContenedor.appendChild(dia);
    }
  }
  function actualizarCalendario() {
    const fechaActual = new Date();
    const diaActual = fechaActual.getDate();
    const mesSeleccionado = parseInt(document.getElementById('mes').value);
    const añoSeleccionado = parseInt(document.getElementById('año').value);
    generarDias(mesSeleccionado, añoSeleccionado);
    if (mesSeleccionado === fechaActual.getMonth() && añoSeleccionado === fechaActual.getFullYear()) {
      const dias = document.querySelectorAll('.dia');
      dias.forEach(function(dia, index) {
        if (parseInt(dia.textContent) === diaActual) {
          dia.classList.add('dia-actual');
        }
      });
    }
  }

  document.getElementById('flecha-izquierda').addEventListener('click', retrocederMes);
  document.getElementById('flecha-derecha').addEventListener('click', avanzarMes);

  function retrocederMes() {
    const selectMes = document.getElementById('mes');
    selectMes.selectedIndex = Math.max(0, selectMes.selectedIndex - 1);
    actualizarCalendario();
  }

  function avanzarMes() {
    const selectMes = document.getElementById('mes');
    selectMes.selectedIndex = Math.min(11, selectMes.selectedIndex + 1);
    actualizarCalendario();
  }

  generarMeses();
  generarAños();
  actualizarCalendario();
});
