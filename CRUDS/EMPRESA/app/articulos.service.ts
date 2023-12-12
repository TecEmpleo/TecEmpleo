import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ArticulosService {

  url='http://localhost/empresa/'; // disponer url de su servidor que tiene las páginas PHP

  constructor(private http: HttpClient) { }

  recuperarTodos() {
    return this.http.get(`${this.url}recuperartodos.php`);
  }

  alta(articulo:any) {
    return this.http.post(`${this.url}alta.php`, JSON.stringify(articulo));    
  }

  baja(id_empresa:number) {
    return this.http.get(`${this.url}baja.php?codigo=${id_empresa}`);
  }
  
  seleccionar(id_empresa: number) {
    return this.http.get(`${this.url}seleccionar.php?id_empresa=${id_empresa}`);
  }

  modificacion(empresa: any) {
    return this.http.post(`${this.url}modificacion.php`, JSON.stringify(empresa));
  }
}
