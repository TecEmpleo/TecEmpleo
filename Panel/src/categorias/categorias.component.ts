import { Component, OnInit } from '@angular/core';
import { CategoriaService } from './categoria.service';

@Component({
  selector: 'app-categorias',
  templateUrl: './categorias.component.html',
  styleUrls: ['./categorias.component.css'],
  providers: [CategoriaService]
})
export class CategoriasComponent implements OnInit {
  categorias: any[] = [];
  categoriaSeleccionada: any = {};
  modoEdicion = false;

  constructor(private categoriaService: CategoriaService) {}

  ngOnInit(): void {
    this.obtenerCategorias();
  }

  obtenerCategorias(): void {
    this.categoriaService.obtenerCategorias().subscribe(
      (data) => {
        this.categorias = data.categorias;
      },
      (error) => {
        console.error('Error al obtener categorías:', error);
      }
    );
  }

  seleccionarCategoria(categoria: any): void {
    this.categoriaSeleccionada = { ...categoria };
    this.modoEdicion = true;
  }

  agregarCategoria(): void {
    this.categoriaSeleccionada = {};
    this.modoEdicion = false;
  }

  guardarCategoria(): void {
    let operacionObservable: any;

    if (this.modoEdicion) {
      operacionObservable = this.categoriaService.actualizarCategoria(
        this.categoriaSeleccionada.idCategoria,
        this.categoriaSeleccionada
      );
    } else {
      operacionObservable = this.categoriaService.agregarCategoria(this.categoriaSeleccionada);
    }

    operacionObservable.subscribe(
      () => {
        const mensaje = this.modoEdicion ? 'Categoría actualizada' : 'Nueva categoría agregada';
        console.log(`${mensaje} con éxito.`);
        this.obtenerCategorias();
      },
      (error: any) => {
        console.error(`Error al ${this.modoEdicion ? 'actualizar' : 'agregar'} categoría:`, error);
      }
    );
  }

  eliminarCategoria(id: number): void {
    this.categoriaService.eliminarCategoria(id).subscribe(
      () => {
        console.log('Categoría eliminada con éxito.');
        this.obtenerCategorias();
      },
      (error: any) => {
        console.error('Error al eliminar categoría:', error);
      }
    );
  }
}
