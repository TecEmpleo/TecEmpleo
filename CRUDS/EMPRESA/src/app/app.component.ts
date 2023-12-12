import { Component, OnInit, OnDestroy } from '@angular/core';
import { ArticulosService } from './articulos.service';
import { Subscription } from 'rxjs';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit, OnDestroy {

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

  constructor(private articulosServicio: ArticulosService) {}

  ngOnInit() {
    this.recuperarTodos();
  }

  ngOnDestroy() {
    // Desuscribirse de las suscripciones para evitar pérdidas de memoria
    if (this.empresasSubscription) {
      this.empresasSubscription.unsubscribe();
    }
  }

  recuperarTodos() {
    this.empresasSubscription = this.articulosServicio.recuperarTodos().subscribe(
      (result: any) => {
        this.empresas = result;
      },
      error => {
        // Manejar el error de manera más sofisticada, como utilizando un servicio de registro
        console.error('Error al recuperar empresas:', error);
      }
    );
  }

  alta() {
    // Agregar validaciones antes de realizar la operación de alta

    this.articulosServicio.alta(this.empresa).subscribe(
      (datos: any) => {
        if (datos['resultado'] === 'OK') {
          // Considerar usar un componente de notificación en lugar de una alerta
          alert(datos['mensaje']);
          this.recuperarTodos();
        } else {
          // Manejar el error de manera más sofisticada
          alert('Error al agregar empresa');
        }
      },
      error => {
        // Manejar el error de manera más sofisticada
        console.error('Error al realizar alta:', error);
      }
    );
  }

  baja(id_empresa: number) {
    // Agregar validaciones antes de realizar la operación de baja

    this.articulosServicio.baja(id_empresa).subscribe(
      (datos: any) => {
        if (datos['resultado'] === 'OK') {
          // Considerar usar un componente de notificación en lugar de una alerta
          alert(datos['mensaje']);
          this.recuperarTodos();
        } else {
          // Manejar el error de manera más sofisticada
          alert('Error al eliminar empresa');
        }
      },
      error => {
        // Manejar el error de manera más sofisticada
        console.error('Error al realizar baja:', error);
      }
    );
  }

  modificacion() {
    this.articulosServicio.modificacion(this.empresa).subscribe(
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
    this.articulosServicio.seleccionar(id_empresa).subscribe(
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
