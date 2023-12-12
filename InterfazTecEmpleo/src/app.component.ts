import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'TecEmpleo';
  imageUrls: string[] = [
    'assets/AKT Publicidad.png',
    'assets/aval.png',
    'assets/katronix.png',
    'assets/avevillas.png',
    'assets/bancolombia.png',
    'assets/Coca-Cola-logo.png',
  ];
  filtroCategoria: string = 'Todas';

  cambiarCategoria(categoria: string) {
    this.filtroCategoria = categoria;
  }
}



