import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class PostulacionesService {
  private apiUrl = 'http://localhost:4000/postulaciones';

  constructor(private http: HttpClient) {}

  obtenerPostulaciones(): Observable<any> {
    return this.http.get(`${this.apiUrl}`);
  }

  obtenerPostulacionPorId(id: number): Observable<any> {
    return this.http.get(`${this.apiUrl}/${id}`);
  }

  agregarPostulacion(postulacion: any): Observable<any> {
    return this.http.post(`${this.apiUrl}`, postulacion);
  }

  actualizarPostulacion(id: number, postulacion: any): Observable<any> {
    return this.http.put(`${this.apiUrl}/${id}`, postulacion);
  }

  eliminarPostulacion(id: number): Observable<any> {
    return this.http.delete(`${this.apiUrl}/${id}`);
  }
}
