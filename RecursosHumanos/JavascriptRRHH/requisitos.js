function openModal() {
    document.querySelector('.custom-modal').style.display = 'flex';
    document.body.style.overflow = 'hidden'; 
}

function closeModal() {
    document.querySelector('.custom-modal').style.display = 'none';
    document.body.style.overflow = 'auto'; 
}


document.getElementById('modalRiesgosLaborales').addEventListener('click', function() {
    openModal('modalRequisitosLaborales');
});

document.getElementById('modalPoliticaPrivada').addEventListener('click', function() {
    openModal('modalPoliticaPrivadaModal');
});


document.getElementById('modalTecEmpleo').addEventListener('click', function() {
    openModal('modalTecEmpleoModal');
});

document.getElementById('modalBoletin').addEventListener('click', function() {
    openModal('modalBoletinModal');
});