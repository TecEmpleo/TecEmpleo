import { ComponentFixture, TestBed } from '@angular/core/testing';

import { OfertaEmpleoComponent } from './oferta-empleo.component';

describe('OfertaEmpleoComponent', () => {
  let component: OfertaEmpleoComponent;
  let fixture: ComponentFixture<OfertaEmpleoComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [OfertaEmpleoComponent]
    });
    fixture = TestBed.createComponent(OfertaEmpleoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
