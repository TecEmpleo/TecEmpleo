import { Component } from '@angular/core';

interface OfertaEmpleo {
  titulo: string;
  empresa: string;
  salario: string;
  ubicacion: string;
  fechaPublicacion: string;
  descripcion: string;
  categoria: string;
}

@Component({
  selector: 'app-oferta-empleo',
  templateUrl: './oferta-empleo.component.html',
  styleUrls: ['./oferta-empleo.component.css']
})
export class OfertaEmpleoComponent {
  ofertas: OfertaEmpleo[] = [
      {
        titulo: "Asesor Comercial",
        empresa: "Nombre de la Empresa",
        salario: "$3 a $4 millones",
        ubicacion: "Bogotá",
        fechaPublicacion: "22 Nov 2023",
        descripcion: "Asesor Comercial en Nombre de la Empresa en Bogotá.",
        categoria: "Asesor/Comercial"
      },
      {
        "titulo": "Asesor Comercial - Call Center",
        "empresa": "Nombre de la Empresa de Call Center",
        "salario": "$2 a $3 millones",
        "ubicacion": "Bogotá (o la ubicación del Call Center)",
        "fechaPublicacion": "22 Nov 2023",
        "descripcion": "Asesor Comercial en Call Center para la empresa Nombre de la Empresa de Call Center. Realizará ventas y brindará asesoramiento a clientes a través de llamadas telefónicas.",
        "categoria": "Asesor/Comercial"
      },
      {
      titulo: 'Analista de Nómina',
      empresa: 'Empresa XYZ',
      salario: '$3 a $4 millones',
      ubicacion: 'Bogotá',
      fechaPublicacion: '21 Nov 2023',
      descripcion: 'Analista de nómina en Empresa XYZ.',
      categoria: 'Analista De Nómina'
    },
    {
      titulo: 'Coordinador de Producción',
      empresa: 'Rh Positivo',
      salario: '$2,5 a $3 millones',
      ubicacion: 'Medellín',
      fechaPublicacion: '20 Nov 2023',
      descripcion: 'Coordinador de producción en Rh Positivo.',
      categoria: 'Producción'
    },
    {
      titulo: "Desarrollador de Software Front End",
      empresa: "Nombre de la Empresa",
      salario: "$4 a $5 millones",
      ubicacion: "Ciudad",
      fechaPublicacion: "22 Nov 2023",
      descripcion: "Desarrollador de software front end en Nombre de la Empresa.",
      categoria: "Desarrollo de Software"
    }, 
    {
      titulo: "Practicante Universitario Profesional en SST",
      empresa: "D1 SAS",
      salario: "$1 a $1.5 millones",
      ubicacion: "Funza",
      fechaPublicacion: "21 Nov 2023",
      descripcion: "Practicante universitario profesional en Seguridad y Salud en el Trabajo (SST) en D1 SAS.",
      categoria: 'Practicante Universitario Profesional en SST' 
    }
    
    // Puedes agregar más ofertas aquí
  ];

  categorias: string[] = ['Todas', 'Asesor/Comercial','Servicio al cliente','Analista  De Nómina','Desarrollo de Software', 'Producción', 'Practicante Universitario Profesional en SST'];
  filtroCategoria: string = 'Todas';
  filtrarOfertas(): OfertaEmpleo[] {
    if (this.filtroCategoria === 'Todas') {
      return this.ofertas;
    } else {
      return this.ofertas.filter(oferta => oferta.categoria === this.filtroCategoria);
    }
  }

  verMas() {
    console.log('Ver Más clickeado');
  }
}
