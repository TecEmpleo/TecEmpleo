// app/calculadora-salarial/calculadora-salarial.component.ts
import { Component } from '@angular/core';

@Component({
  selector: 'app-calculadora-salarial',
  templateUrl: './calculadora-salarial.component.html',
  styleUrls: ['./calculadora-salarial.component.css']
})
export class CalculadoraSalarialComponent {
  salario: number = 0;
  otrosIngresos: number = 0;
  subsidioTransporte: number = 0;
  aporteFvpMaxExento: number = 0;
  deduccionRetencion: number = 0;
  interesesVivienda: number = 0;
  dependientes: string = '';

  salarioMinimoLegalVigente: number = 1160000;
  salarioMinimoIntegralVigente: number = 15080000;
  uvt: number = 42412;

  resultadosCalculados = false;
  baseGravable: number = 0;
  retencionFuente: number = 0;
  compensacionNeta: number = 0;

  calcularSalario() {
    // Realiza los cálculos según la lógica necesaria
    // Puedes utilizar las variables salario, otrosIngresos, subsidioTransporte, etc.

    // Ejemplo de cálculos (adapta según tus necesidades)
    this.baseGravable = this.calcularIngresoPromedioMensual();

    // Ejemplo de cálculo de retención en la fuente
    this.retencionFuente = this.calcularRetencionFuente(this.baseGravable);

    // Ejemplo de cálculo de compensación neta
    this.compensacionNeta = this.baseGravable - this.retencionFuente;

    this.resultadosCalculados = true;
  }

  calcularRetencionFuente(baseGravable: number): number {
    // Implementa aquí la lógica específica para calcular la retención en la fuente
    // Puedes usar las tasas y lógica que aplican en tu región
    const tasaRetencion: number = 0.1; // Ejemplo: retención del 10%
    return baseGravable * tasaRetencion;
  }

  calcularIngresoPromedioMensual(): number {
    // Implementa aquí la lógica para calcular el ingreso promedio mensual
    // Puedes usar las variables salario, otrosIngresos, subsidioTransporte, etc.
    return (
      this.salario +
      this.otrosIngresos -
      this.subsidioTransporte +
      this.aporteFvpMaxExento -
      this.deduccionRetencion +
      this.interesesVivienda
    );
  }
}
