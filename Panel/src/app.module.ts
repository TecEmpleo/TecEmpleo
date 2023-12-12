import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from '@angular/common/http';
import { FormsModule } from '@angular/forms';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { NavbarComponent } from './navbar/navbar.component';
import { CategoriasComponent } from './categorias/categorias.component';
import { CategoriaService } from './categorias/categoria.service';
import { RouterModule } from '@angular/router';

import { VacantesComponent } from './vacantes/vacantes.component';
import { EstudiosComponent } from './estudios/estudios.component';
import { EmpresasComponent } from './empresas/empresas.component';
import { EmpresasService } from './empresas/empresas.service';
import { PostulacionesComponent } from './postulaciones/postulaciones.component';

@NgModule({
  declarations: [
    AppComponent,
    NavbarComponent,
    CategoriasComponent,

    VacantesComponent,
     EstudiosComponent,
     EmpresasComponent,
     PostulacionesComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule,
    RouterModule,
  ],
  providers: [
    CategoriaService, EmpresasService
  ],
  bootstrap: [AppComponent]
})
export class AppModule {}
