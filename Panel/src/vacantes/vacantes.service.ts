import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
@Injectable({
  providedIn: 'root'
})
export class VacantesService { 
  url = 'http://localhost/Backend/vacantes';
  constructor(private http: HttpClient) { }
  recuperarTodos() {
    return this.http.get(`${this.url}/recuperartodos.php`); 
  }
  alta(vacante: any) { 
    return this.http.post(`${this.url}/alta.php`, JSON.stringify(vacante));    
  }
  baja(idVacantes: number) { 
    return this.http.get(`${this.url}/baja.php?codigo=${idVacantes}`); 
  } 
  seleccionar(idVacantes: number) { 
    return this.http.get(`${this.url}/seleccionar.php?id_empresa=${idVacantes}`);
  }
  modificacion(vacante: any) { 
    return this.http.post(`${this.url}/modificacion.php`, JSON.stringify(vacante)); 
  }
}
