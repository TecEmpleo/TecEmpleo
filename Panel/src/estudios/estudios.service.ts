import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class EstudiosService {

  private url = 'http://localhost/Backend/estudios/'; 

  constructor(private http: HttpClient) { }

  recuperarTodos() {
    return this.http.get(`${this.url}recuperartodos.php`);
  }

  alta(estudios: any) {
    return this.http.post(`${this.url}alta.php`, JSON.stringify(estudios));
  }

  baja(idEstudios: number) {
    return this.http.get(`${this.url}baja.php?idEstudios=${idEstudios}`);
  }

  seleccionar(idEstudios: number) {
    return this.http.get(`${this.url}seleccionar.php?idEstudios=${idEstudios}`);
  }

  modificacion(estudios: any) {
    return this.http.post(`${this.url}modificacion.php`, JSON.stringify(estudios));
  }
}
