import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { NavbarComponent } from './navbar/navbar.component';
import { CategoriasComponent } from './categorias/categorias.component';
import { VacantesComponent } from './vacantes/vacantes.component';
import { EstudiosComponent } from './estudios/estudios.component';
import { EmpresasComponent } from './empresas/empresas.component';
import { PostulacionesComponent } from './postulaciones/postulaciones.component';

const routes: Routes = [
  { path: '', component: NavbarComponent, pathMatch: 'full' },
  { path: 'categorias', component: CategoriasComponent },
 {path: 'empresas', component: EmpresasComponent},
  { path: 'vacantes', component: VacantesComponent },
  { path: 'estudios', component: EstudiosComponent },
  {path: 'postulaciones', component: PostulacionesComponent}

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
