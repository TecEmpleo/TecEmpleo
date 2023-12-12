import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { NavbarComponent } from './navbar/navbar.component';
import { CalculadoraSalarialComponent } from './calculadora-salarial/calculadora-salarial.component';
import { LoginComponent } from './login/login.component';
import { OfertaEmpleoComponent } from './oferta-empleo/oferta-empleo.component'; // Importar el componente

const routes: Routes = [
  { path: '', component: NavbarComponent, pathMatch: 'full' },
  { path: 'calculadora-salarial', component: CalculadoraSalarialComponent },
  { path: 'login', component: LoginComponent },
  { path: 'ofertas-empleo', component: OfertaEmpleoComponent }, // Agregar la ruta para OfertaEmpleoComponent
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
