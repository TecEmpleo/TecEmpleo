import { Component, OnInit } from '@angular/core';
import { PostulacionesService } from './postulaciones.service';

@Component({
  selector: 'app-postulaciones',
  templateUrl: './postulaciones.component.html',
  styleUrls: ['./postulaciones.component.css'],
})
export class PostulacionesComponent implements OnInit {
  postulaciones: any[]= [];
  modoEdicion: boolean = false;
  postulacionSeleccionada: any = {};

  constructor(private postulacionesService: PostulacionesService) {}

  ngOnInit(): void {
    this.obtenerPostulaciones();
  }

  obtenerPostulaciones(): void {
    this.postulacionesService.obtenerPostulaciones().subscribe((data) => {
      this.postulaciones = data.postulaciones;
    });
  }

  agregarPostulacion(): void {
    this.modoEdicion = false;
    this.postulacionSeleccionada = {};
  }

  guardarPostulacion(): void {
    if (this.modoEdicion) {
      this.postulacionesService
        .actualizarPostulacion(
          this.postulacionSeleccionada.idPostulaciones,
          this.postulacionSeleccionada
        )
        .subscribe(() => {
          this.obtenerPostulaciones();
          this.modoEdicion = false;
          this.postulacionSeleccionada = {};
        });
    } else {
      this.postulacionesService
        .agregarPostulacion(this.postulacionSeleccionada)
        .subscribe(() => {
          this.obtenerPostulaciones();
          this.postulacionSeleccionada = {};
        });
    }
  }

  seleccionarPostulacion(postulacion: any): void {
    this.modoEdicion = true;
    this.postulacionSeleccionada = { ...postulacion };
  }

  actualizarPostulacion(): void {
    
  }

  eliminarPostulacion(id: number): void {
    this.postulacionesService.eliminarPostulacion(id).subscribe(() => {
      this.obtenerPostulaciones();
    });
  }
}
