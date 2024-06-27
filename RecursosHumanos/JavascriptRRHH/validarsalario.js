function validarSalario(idVacante) {
    var salario = document.forms["form" + idVacante]["salario"].value;
    if (salario == "" || isNaN(salario)) {
        alert("Por favor, ingrese un salario válido.");
        return false;
    }
    return true;
}