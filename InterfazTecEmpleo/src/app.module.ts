// app.module.ts
import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { RouterModule } from '@angular/router';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { NavbarComponent } from './navbar/navbar.component';
import { FormsModule } from '@angular/forms';


import { OfertaEmpleoComponent } from './oferta-empleo/oferta-empleo.component';
import { CalculadoraSalarialComponent } from './calculadora-salarial/calculadora-salarial.component';
import { LoginComponent } from './login/login.component';



@NgModule({
  declarations: [
    AppComponent,
    NavbarComponent,
    OfertaEmpleoComponent,
    CalculadoraSalarialComponent,
    LoginComponent,


  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    RouterModule,
  ],
  providers: [

  ],
  bootstrap: [AppComponent],
})
export class AppModule {}
