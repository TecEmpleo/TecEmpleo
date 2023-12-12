import { TestBed } from '@angular/core/testing';
import { VacantesService } from './vacantes.service'; 

describe('VacantesService', () => { 
  let service: VacantesService; 

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(VacantesService); 
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
