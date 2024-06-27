document.addEventListener('DOMContentLoaded', function() {
    fetch('notificaciones.php') // Reemplaza 'tuscript.php' con la ruta correcta a tu script PHP
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const usuarios = data.usuarios.map(usuario => usuario.nombre);
                const puntajes = data.usuarios.map(usuario => usuario.puntaje);
                
                const ctx = document.getElementById('graficoPuntajes').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: usuarios,
                        datasets: [{
                            label: 'Puntajes de Usuarios',
                            data: puntajes,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            } else {
                console.error(data.error);
            }
        })
        .catch(error => console.error('Error al obtener los datos:', error));
});
