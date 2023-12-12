import { Component, OnInit, OnDestroy } from '@angular/core';
import { EmpresasService } from './empresas.service'; 
import { Subscription } from 'rxjs';

@Component({
  selector: 'app-empresas',  
  templateUrl: './empresas.component.html',  
  styleUrls: ['./empresas.component.css']  
})
export class EmpresasComponent implements OnInit, OnDestroy {

  empresas: any;
  empresa = {
    id_empresa: 0,
    Ciudad_emp: "",
    Direccion_emp: "",
    Email_emp: "",
    Telefono_emp: "",
    Nom_emp: ""
  };

  private empresasSubscription: Subscription | undefined;

  constructor(private empresasService: EmpresasService) {}  

  ngOnInit() {
    this.recuperarTodos();
  }

  ngOnDestroy() {
    if (this.empresasSubscription) {
      this.empresasSubscription.unsubscribe();
    }
  }

  recuperarTodos() {
    this.empresasSubscription = this.empresasService.recuperarTodos().subscribe(
      (result: any) => {
        this.empresas = result;
      },
      error => {
        console.error('Error al recuperar empresas:', error);
      }
    );
  }

  alta() {
  

    this.empresasService.alta(this.empresa).subscribe(
      (datos: any) => {
        if (datos['resultado'] === 'OK') {
          alert(datos['mensaje']);
          this.recuperarTodos();
        } else {
          alert('Error al agregar empresa');
        }
      },
      error => {
        console.error('Error al realizar alta:', error);
      }
    );
  }

  baja(id_empresa: number) {

    this.empresasService.baja(id_empresa).subscribe(
      (datos: any) => {
        if (datos['resultado'] === 'OK') {
          alert(datos['mensaje']);
          this.recuperarTodos();
        } else {
          alert('Error al eliminar empresa');
        }
      },
      error => {
        console.error('Error al realizar baja:', error);
      }
    );
  }

  modificacion() {
    this.empresasService.modificacion(this.empresa).subscribe(
      (datos: any) => {
        if (datos['resultado'] === 'OK') {
          alert(datos['mensaje']);
          this.recuperarTodos();
        } else {
          alert('Error al modificar empresa: ' + datos['mensaje']);
        }
      },
      error => {
        console.error('Error al realizar modificación:', error);
        alert('Error al realizar modificación. Consulta la consola para más detalles.');
      }
    );    
  }
  
  seleccionar(id_empresa: number) {
    this.empresasService.seleccionar(id_empresa).subscribe(
      (result: any) => {
        this.empresa = result[0];
      },
      error => {
        console.error('Error al seleccionar empresa:', error);
      }
    );
  }

  hayRegistros() {
    return this.empresas && this.empresas.length > 0;
  } 
}
