const insertPostulation = (idVacante) => {

   Swal.fire({
      title: "¿Estas seguro?",
      text: "Recuerda que los datos seran guardados en nuestras bases de datos",
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: "Si guardar",
      denyButtonText: `No guardar`
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
         $.ajax({
            type: "POST",
            url: "./ajax/query_insert.php",
            data: { 
               'idVacante':idVacante
            } ,
            dataType: "JSON",
            success: function (response) {
               console.log(response);
               if(response == true) {
                  Swal.fire("Genial!", "Postulación agregada correctamente", "success");
                  return
               }else{
                  Swal.fire("Uppss!", response, "info");

               }

            }
         });
       
      } else if (result.isDenied) {
        Swal.fire("Cancelaste el envio de la solicitud", "", "info");
      }
    });
 
   }
   

const search = () => {
  let infoInput = document.querySelector("#inputSearchVacantes").value;

  $.ajax({
    type: "POST",
    url: "./ajax/query.php",
    data: { 'infoInput': infoInput },
    dataType: "JSON",
    success: function (response) {
      let accordeonInfo = '<ul uk-accordion="collapsible: false">';
      let classBadget = "";
      response.forEach((element) => {
        if (element.Estado == "Abierta") {
          classBadget = "badgetOneV1";
        } else {
          classBadget = "badgetOneV2";
        }

        accordeonInfo += `<li>
            <a class="uk-accordion-title" href><b>${element.Nombre_emp}</b> - ${element.Descripcion_vac}</a>
            <div class="uk-accordion-content">
            <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m">
            
            <div class="uk-card-badge uk-label ${classBadget}">${element.Estado}</div>
            <br>
            <div class="containerListInformation">
            <dl class="uk-description-list uk-description-list-divider">
               <dt>Fecha de publicacion</dt>
               <dd>${element.Fecha_Publicacion}</dd>
               <dt>Fecha de cierre</dt>
               <dd>${element.Fecha_Cierre}</dd>
               <dt>Direccion de la empresa</dt>
               <dd>${element.Direccion_emp}</dd>
               <dt>Descripcion</dt>
               <dd>${element.Descripcion_vac}</dd>
               <dt>Email empresa</dt>
               <dd>${element.Email_emp}</dd>
               <dt>Ciudad de la empresa</dt>
               <dd>${element.Ciudad_emp}</dd>
               <dt>telefono de la empresa</dt>
               <dd>${element.Telefono_emp}</dd>
               <dt>Nombre categoria</dt>
               <dd>${element.Nombre_Cat}</dd>
               </dl><dt>Enlace de la vacante</dt>
               <dd>${element.enlace_vacante}</dd>
               </dl>
               
               </div>
               <div id="containerPostularse">
               <div class="badgetOneV3">
               <p onClick='insertPostulation(${element.idVacantes})'>Postularse</p>
            </div>
               </div>
              

        
        </div>
            </div>
        </li>`;
      });


      accordeonInfo += "</ul>";

      document.querySelector("#containerTargets").innerHTML = "";
      $("#containerTargets").append(accordeonInfo);
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    },
  });
};





