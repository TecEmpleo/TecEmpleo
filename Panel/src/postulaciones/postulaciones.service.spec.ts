import { TestBed } from '@angular/core/testing';
import { PostulacionesService } from './postulaciones.service';

describe('PostulacionesService', () => {
  let service: PostulacionesService;

  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [PostulacionesService],
    });
    service = TestBed.inject(PostulacionesService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
