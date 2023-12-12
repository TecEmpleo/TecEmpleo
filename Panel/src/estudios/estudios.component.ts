import { Component, OnInit } from '@angular/core';
import { EstudiosService } from './estudios.service';

@Component({
  selector: 'app-estudios',
  templateUrl: './estudios.component.html',
  styleUrls: ['./estudios.component.css']
})
export class EstudiosComponent implements OnInit {

  estudios: any;

  estudioSeleccionado = {
    idEstudios: 0,
    Estudios_universitarios: "",
    Estudios_Primaria: "",
    Estudios_Segundaria: "",
    Otros_Estudios: "",
  };

  constructor(private estudiosServicio: EstudiosService) { }

  ngOnInit() {
    this.recuperarTodos();
  }

  recuperarTodos() {
    this.estudiosServicio.recuperarTodos().subscribe((result: any) => this.estudios = result);
  }

  alta() {
    this.estudiosServicio.alta(this.estudioSeleccionado).subscribe((datos: any) => {
      if (datos['resultado'] == 'OK') {
        alert(datos['mensaje']);
        this.recuperarTodos();
      }
    });
  }

  baja(idEstudios: number) {
    this.estudiosServicio.baja(idEstudios).subscribe((datos: any) => {
      if (datos['resultado'] == 'OK') {
        alert(datos['mensaje']);
        this.recuperarTodos();
      }
    });
  }

  modificacion() {
    this.estudiosServicio.modificacion(this.estudioSeleccionado).subscribe((datos: any) => {
      if (datos['resultado'] == 'OK') {
        alert(datos['mensaje']);
        this.recuperarTodos();
      }
    });
  }

  seleccionar(idEstudios: number) {
    this.estudiosServicio.seleccionar(idEstudios).subscribe((result: any) => this.estudioSeleccionado = result[0]);
  }

  hayRegistros() {
    return this.estudios && this.estudios.length > 0;
  }
}
