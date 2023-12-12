import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CalculadoraSalarialComponent } from './calculadora-salarial.component';

describe('CalculadoraSalarialComponent', () => {
  let component: CalculadoraSalarialComponent;
  let fixture: ComponentFixture<CalculadoraSalarialComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [CalculadoraSalarialComponent]
    });
    fixture = TestBed.createComponent(CalculadoraSalarialComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
