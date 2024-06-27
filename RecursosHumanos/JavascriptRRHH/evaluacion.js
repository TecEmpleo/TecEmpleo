function evaluarDatos() {
    var tableRows = document.querySelectorAll(".contenedor-hdv table tr");
    for (var i = 1; i < tableRows.length; i++) {
        var rowData = tableRows[i].getElementsByTagName("td");
        for (var j = 0; j < rowData.length; j++) {
            if (rowData[j].innerHTML === "") {
                alert("Por favor, complete todos los campos antes de evaluar los datos.");
                return;
            }
        }
    }
    enviarDatos(); 
}

function enviarDatos() {
    document.getElementById('loadingIcon').style.display = 'inline-block';
    setTimeout(function() {
        alert("Datos empres enviados correctamente.");
        document.getElementById('loadingIcon').style.display = 'none';
    }, 3000); 
}