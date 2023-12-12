import { Component, OnInit } from '@angular/core';
import { VacantesService } from './vacantes.service'; 
@Component({
  selector: 'app-vacantes',
  templateUrl: './vacantes.component.html',
  styleUrls: ['./vacantes.component.css']
})
export class VacantesComponent implements OnInit {

  vacantes: any[] = [];
  vacante: any = {
    Categoria_idCategoria: '',
    Empresa_idEmpresa: '',
    Descripcion_vac: '',
    Fecha_Publicacion: '',
    Fecha_Cierre: '',
    Estado: ''
  };

  constructor(private vacantesServicio: VacantesService) { } // Corregir el nombre del servicio

  ngOnInit() {
    this.recuperarTodos();
  }

  recuperarTodos() {
    this.vacantesServicio.recuperarTodos().subscribe((result: any) => this.vacantes = result);
  }

  alta() {
    this.vacantesServicio.alta(this.vacante).subscribe((datos: any) => {
      if (datos['resultado'] == 'OK') {
        alert(datos['mensaje']);
        this.recuperarTodos();
      }
    });
  }

  baja(idVacantes: number) {
    this.vacantesServicio.baja(idVacantes).subscribe((datos: any) => {
      if (datos['resultado'] == 'OK') {
        alert(datos['mensaje']);
        this.recuperarTodos();
      }
    });
  }

  modificacion() {
    this.vacantesServicio.modificacion(this.vacante).subscribe((datos: any) => {
      if (datos['resultado'] == 'OK') {
        alert(datos['mensaje']);
        this.recuperarTodos();
      }
    });
  }

  seleccionar(idVacantes: number) {
    this.vacantesServicio.seleccionar(idVacantes).subscribe((result: any) => this.vacante = result[0]);
  }

  hayRegistros() {
    return this.vacantes && this.vacantes.length > 0;
  }
}
