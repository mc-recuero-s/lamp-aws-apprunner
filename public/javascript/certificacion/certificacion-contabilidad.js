$(document).ready(function() {
      var uriControllers = "./controllers/";
      var certificaciones = [              
      ];
      var table = $('#table').DataTable({
        dom: 'Bfrtip',
        buttons: [
          // 'copy', 'csv', 'excel', 'pdf', 'print'
            'copy', 'excel', 'pdf', 'print'
        ],
        "order": [
          [8, "asc"]
        ],
         "columnDefs": [{
          "targets": [8],
          "visible": false,
        },
        {
          "targets": [0],
          "visible": false,
        }],
        "language": {
          "decimal": ",",
          "thousands": ".",
          "lengthMenu": "Mostrar _MENU_ solicitudes",
          "zeroRecords": "No se encontraron resultados",
          "info": "Mostrando _START_ a _END_ de _TOTAL_ solicitudes",
          "infoEmpty": "Mostrando 0 a 0 de 0 solicitudes",
          "infoFiltered": "(filtrado de _MAX_ solicitudes totales)",
          "search": "Buscar:",
          "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
          },
          "loadingRecords": "Cargando...",
          "processing": "Procesando...",
          "emptyTable": "No hay datos disponibles en la tabla",
          "infoThousands": ",",
          "aria": {
            "sortAscending": ": activar para ordenar la columna de manera ascendente",
            "sortDescending": ": activar para ordenar la columna de manera descendente"
          }
        }
      });

      $.ajax({						
        type: "POST",
        url: uriControllers+"certificacion/certificaciones-contabilidad.php",
      })
      .done(function( data, textStatus, jqXHR ) {
        var data=JSON.parse(data);
        certificaciones=data.certificaciones;
        console.log(data);  
        let data1=[];
        certificaciones.forEach(function(certificacion) {
          if (certificacion.tipo == "1" && typeof(certificacion.historial) == "string") {
            certificacion.historial = (certificacion.historial) ? certificacion.historial.replace(/[\x00-\x1F\x7F]/g, "") : "";
            try {
                certificacion.historial = (certificacion.historial) ? JSON.parse(certificacion.historial) : "";
            } catch (error) {
                console.error("Error al parsear JSON:", error);
            }
          }
          let estado = "<div class='text-warning'>Pendiente</div>";
          estado = (certificacion.estado == "2") ? "<div class='text-warning'>Aprobada</div>" : estado;
          estado = (certificacion.estado == "3") ? "<div class='text-alert'>Rechazada</div>" : estado;
          estado = (certificacion.estado == "4") ? "<div class='text-success'>Aprobado por Revisoria</div>" : estado;
          estado = (certificacion.estado == "5") ? "<div class='text-alert'>Rechazado por Revisoria</div>" : estado;

          let buttons = '';
          if (certificacion.estado == "1" || certificacion.estado == "5") {
            buttons=buttons+'<div class="button btn-aprobar" title="Aprobar"></div><div class="button btn-rechazar" title="Rechazar"></div>';
          }
          buttons = buttons +'<div class="ver-btn button btn-ver" title="Ver">'+crearHoverVer(certificacion).html()+'</div>';
          let tipo = (certificacion.tipo=="1")?"Efectivo":"Especie";

          let archivosArray = certificacion.archivos.split(";");                         

          let archivos = "";
          
          if(certificacion.tipo==1){
            if (!(archivosArray[0] == null || archivosArray[0] == "null")) {
              archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[0] + '" target="_blank" class="ver-btn button btn-soporte" title="Soporte de la donación - Presiona para abrir"></a>';
            }
            if (!(archivosArray[1] == null || archivosArray[1] == "null")) {
              archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[1] + '" target="_blank" class="ver-btn button btn-informe" title="Informe de débitos automáticos - Presiona para abrir"></a>';
            }
          }
          if(certificacion.tipo==2){
            if (archivosArray[0]) {
              archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[0] + '" target="_blank" class="ver-btn button btn-soporte" title="Factura de la donación - Presiona para abrir"></a>';
            }            
          }
          
          if (certificacion.estado != 3){
            if (certificacion.estado == 2 || certificacion.estado == 4 || certificacion.estado == 5 ) {              
              if (certificacion.tipo == 1) {
                if (certificacion.estado == 2) {                
                  archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[2] + '" target="_blank" class="ver-btn button btn-informe" title="Recibo de caja - Presiona para abrir"></a>';
                  archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[3] + '" target="_blank" class="ver-btn button btn-recibo" title="Certificado sin Firmar - Presiona para abrir"></a>';
                }
                if (certificacion.estado == 4) {
                  archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[2] + '" target="_blank" class="ver-btn button btn-informe" title="Recibo de caja - Presiona para abrir"></a>';
                  archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[3] + '" target="_blank" class="ver-btn button btn-recibo" title="Certificado sin Firmar - Presiona para abrir"></a>';
                  archivos = archivos + '<a href="' + './soportes/certificacion/' + certificacion.id + '_firmado.pdf" target="_blank" class="ver-btn button btn-firmado" title="Certificado con Firma - Presiona para abrir"></a>';
                }
              }
              if (certificacion.tipo == 2) {
                if (certificacion.estado == 2) {                
                  archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[1] + '" target="_blank" class="ver-btn button btn-informe2" title="Información de entradas"></a>';
                  archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[2] + '" target="_blank" class="ver-btn button btn-recibo" title="Certificado sin Firmar - Presiona para abrir"></a>';
                }
                if (certificacion.estado == 4) {
                  archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[1] + '" target="_blank" class="ver-btn button btn-informe2" title="Información de entradas"></a>';
                  archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[2] + '" target="_blank" class="ver-btn button btn-recibo" title="Certificado sin Firmar - Presiona para abrir"></a>';
                  archivos = archivos + '<a href="' + './soportes/certificacion/' + certificacion.id + '_firmado.pdf" target="_blank" class="ver-btn button btn-firmado" title="Certificado con Firma - Presiona para abrir"></a>';
                }                
              }
            }else{
              if (certificacion.tipo == 1) {
                archivos = archivos + '<div class="ver-btn button btn-hide" title="Cargar Recibo de caja"><input type="file" accept=".pdf" data-id="' + certificacion.id + '"/></div>';
              }
              if (certificacion.tipo == 2) {
                archivos = archivos + '<div class="ver-btn button btn-hide2 btn-cargar-entradas" title="Cargar Entradas">' + crearHoverEntradas(certificacion).html() + '</div>';                
              }
            }
          }

          let estado2 = certificacion.estado;
          estado2 = (estado2 == "3") ? 1.5 : estado2;
          estado2 = (estado2 == "5") ? 3.5 : estado2;

          data1.push([certificacion.id, certificacion.id_anual || 'N/A', certificacion.institucion, tipo, "$ " + formatMoney(Number(certificacion.monto)), archivos, estado, buttons, estado2]);
        });
        table.clear();
        table.rows.add(data1);
        table.draw();
      });


      $(document).on("change", '.btn-hide input[type="file"]', function (e) {
        var input = e.target;            
        let certificacion = certificaciones.filter((it) => it.id == $(this).data("id"))[0];
        const index = certificaciones.map((element, index) => ({ element, index })).filter(obj => obj.element.id === certificacion.id)[0].index;
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {                
            console.log(input.files[0].name);
            let archivosArray= certificacion.archivos.split(";");
            let archivos = archivosArray[0] + ";" + archivosArray[1]+";";
            let data={            
              id: certificacion.id,
              file: e.target.result,
              archivos
            }
            console.log(data);                
            $.ajax({
              data,
              type: "POST",
              url: uriControllers + "certificacion/contabilidad-upload.php",
            })
            .done(function (data, textStatus, jqXHR) {
              Swal.fire(
                'Hecho!',
                'Archivo cargado existosamente',
                'success'
              );
              let archivosArray = certificacion.archivos.split(";");

              let archivos = "";
              if (!(archivosArray[0] == null || archivosArray[0] == "null")) {
                archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[0] + '" target="_blank" class="ver-btn button btn-soporte" title="Soporte de la donación - Presiona para abrir"></a>';
              }
              if (!(archivosArray[1] == null || archivosArray[1] == "null")) {
                archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[1] + '" target="_blank" class="ver-btn button btn-informe" title="Informe de débitos automáticos - Presiona para abrir"></a>';
              }
              archivos = archivos + '<a href="' + './soportes/certificacion/' + certificacion.id + '_recibo.pdf" target="_blank" class="ver-btn button btn-informe" title="Recibo de caja - Presiona para abrir"></a>';
              
              certificaciones[index].archivos = certificaciones[index].archivos + certificacion.id + "_recibo.pdf;";
              certificaciones[index].preparado=true;
              table.cell(index, 5).data(archivos).draw();
              table.cell(index, 6).data("Preparado para Aprobar").draw();
            })
          };
          reader.readAsDataURL(input.files[0]);
        }
      });

      
      $('#create-btn').on('click', function() {
          alert('Crear nuevo registro');
          // Lógica para crear un nuevo registro
      });
      
      $('.btn-cargar-entradas').on('click', function () {          
          // Lógica para crear un nuevo registro
      });

      $('#table tbody').on('click', '.btn-ver', function() {
        var data = table.row($(this).parents('tr')).data();
        let certificacion= certificaciones.filter((it)=>it.id==data[0])[0];              
        console.log(certificacion);              

      });

      $('#table tbody').on('click', '.btn-aprobar', function() {
        var data = table.row($(this).parents('tr')).data();
        let certificacion= certificaciones.filter((it)=>it.id==data[0])[0];  
        if (certificacion.tipo == 1) {
          if (certificacion.preparado) {
            const index = certificaciones.map((element, index) => ({
              element,
              index
            })).filter(obj => obj.element.id === certificacion.id)[0].index;
            Swal.fire({
              title: '¿Está seguro de aprobar el certificado ' + certificacion.id + '?',
              html:
                '<article class="certificado-info">' +
                  '<p>Monto: $ ' + formatMoney(Number(certificacion.monto)) + '</p>' +
                  '<label for="swal-input1">Declaración de renta:</label>' +
                  '<input id="swal-input1" class="swal2-input" type="text" placeholder="Ingrese declaración de renta">' +
                  '<label for="swal-input2">Fecha de expedición:</label>' +
                  '<input id="swal-input2" class="swal2-input" type="text" placeholder="Selecciona fecha">'+
                '</article>',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Sí, Aprobar',
              cancelButtonText: 'No',
              onOpen: () => {
                let $inputFecha = $('#swal-input2');
                $inputFecha.datepicker({
                  dateFormat: "d MM yy",
                  duration: "medium",
                  closeText: 'Cerrar',
                  prevText: '<Ant',
                  nextText: 'Sig>',
                  currentText: 'Hoy',
                  weekHeader: 'Sm',
                  firstDay: 1,
                  isRTL: false,
                  showMonthAfterYear: false,
                  yearSuffix: ''
                });
              },
              preConfirm: () => {
                const declaracion = document.getElementById('swal-input1').value;
                const fechaExp = document.getElementById('swal-input2').value;
                if (!declaracion || !fechaExp) {
                  Swal.showValidationMessage('Por favor, complete ambos campos.');
                  return false;
                }
                return { declaracion, fechaExp };
              }
            }).then((result) => {
              console.log(result);
              if (result.value) {
                certificacion.declaracion=result.value.declaracion;               
                certificacion.fechaExp=formatearFecha(result.value.fechaExp);               
                console.log(certificacion); 
                $.ajax({
                    data: certificacion,
                    type: "POST",
                    url: uriControllers + "certificacion/aprobar.php",
                  })
                  .done(function (data, textStatus, jqXHR) {
                    console.log(data);
                    let archivosArray = certificacion.archivos.split(";");
                    let archivos = "";
                    if (!(archivosArray[0] == null || archivosArray[0] == "null")) {
                      archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[0] + '" target="_blank" class="ver-btn button btn-soporte" title="Soporte de la donación - Presiona para abrir"></a>';
                    }
                    if (!(archivosArray[1] == null || archivosArray[1] == "null")) {
                      archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[1] + '" target="_blank" class="ver-btn button btn-informe" title="Informe de débitos automáticos - Presiona para abrir"></a>';
                    }
                    archivos = archivos + '<a href="' + './soportes/certificacion/' + certificacion.id + '_recibo.pdf" target="_blank" class="ver-btn button btn-informe" title="Recibo de caja - Presiona para abrir"></a>';
                    archivos = archivos + '<a href="' + './soportes/certificacion/' + certificacion.id + '_certificado.pdf" target="_blank" class="ver-btn button btn-recibo" title="Certificado sin Firmar - Presiona para abrir"></a>';
                    table.cell(index, 5).data(archivos).draw();
                    table.cell(index, 6).data("<div class='text-warning'>Aprobada</div>").draw();
                    table.cell(index, 7).data('<div class="ver-btn button btn-ver" title="Ver">' + crearHoverVer(certificacion).html() + '</div>').draw();
                    Swal.fire(
                      'Hecho!',
                      'El certificado ' + certificacion.id + ' ha sido Aprobado',
                      'success'
                    );
                  });
              }
            });
          } else {
            Swal.fire(
              'Recibo de caja',
              'Se necesita el recibo de caja, para poder aprobar',
              'warning'
            );
          }
        }        
        if (certificacion.tipo==2){
          const index = certificaciones.map((element, index) => ({
            element,
            index
          })).filter(obj => obj.element.id === certificacion.id)[0].index;
          if ($("#table tbody tr").eq(index).find(".entradas-list li").length>0) {
            Swal.fire({
              title: '¿Esta seguro de aprobar el certificado ' + certificacion.id + '?',
              text: "Monto: $ " + formatMoney(Number(certificacion.monto)),
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Sí, Aprobar',
              cancelButtonText: 'No'
            }).then((result) => {
              console.log(result);
              if (result.value) {
                let entradas=[];
                $("#table tbody tr").eq(index).find(".entradas-list li").map((i,it)=>{
                  entradas.push($(it).data("id"));
                })
                certificacion.entradas = entradas;
                certificacion.documento = certificacion.nit;
                console.log(certificacion);                
                $.ajax({
                    data: certificacion,
                    type: "POST",
                    url: uriControllers + "certificacion/aprobar.php",
                  })
                  .done(function (data, textStatus, jqXHR) {
                    console.log(data);
                    // let archivosArray = certificacion.archivos.split(";");
                    // let archivos = "";                   
                    // if (archivosArray[0]) {
                    //   archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[0] + '" target="_blank" class="ver-btn button btn-soporte" title="Factura de la donación - Presiona para abrir"></a>';                      
                    // }
                    // archivos = archivos + '<a href="' + './soportes/certificacion/' + certificacion.id + '_certificado.pdf" target="_blank" class="ver-btn button btn-recibo" title="Certificado sin Firmar - Presiona para abrir"></a>';
                                    
                    // table.cell(index, 4).data(archivos).draw();
                    // table.cell(index, 5).data("<div class='text-warning'>Aprobada</div>").draw();
                    // table.cell(index, 6).data('<div class="ver-btn button btn-ver" title="Ver">' + crearHoverVer(certificacion).html() + '</div>').draw();
                    table.row(index).remove().draw();
                    Swal.fire(
                      'Hecho!',
                      'El certificado ' + certificacion.id + ' ha sido Aprobado',
                      'success'
                    );
                  });
              }
            });
          } else {
            Swal.fire(
              'Entradas',
              'Se necesita enlazar entradas',
              'warning'
            );
          }
        }        
      });

      $('#table tbody').on('click', '.btn-rechazar', function() {
          var data = table.row($(this).parents('tr')).data();
          console.log(data);   
          let certificacion= certificaciones.filter((it)=>it.id==data[0])[0];
          const index = certificaciones.map((element, index) => ({ element, index })).filter(obj => obj.element.id === certificacion.id)[0].index;  
          Swal.fire({
            title: '¿Esta seguro de rechazar la solicitud '+certificacion.id+'?',
            input: 'textarea',
            inputPlaceholder: 'Digita la justificación del rechazo',
            inputAttributes: {
              'aria-label': 'Justificación'
            },
            showCancelButton: true,
            confirmButtonText: 'Sí, Rechazar',
            cancelButtonText: 'No'
          }).then((result) => {
            console.log(result);
            if (result.value || result.value=="") {                  
              Swal.fire(
                'Hecho!',
                'El certificado ' + certificacion.id + ' ha sido Rechazado',
                'success'
              );
              let descripcion = result.value;
              certificacion.descripcion = descripcion
              console.log(certificacion);              
              $.ajax({
                data: certificacion,
                type: "POST",
                url: uriControllers + "certificacion/rechazar.php",
              })
              .done(function (data, textStatus, jqXHR) {
                console.log(data);                
                table.row(index).remove().draw();
                // table.cell(index, 5).data("Rechazada").draw();
                // table.cell(index, 6).data('<div class="ver-btn button btn-ver" title="Ver">'+crearHoverVer(certificacion).html()+'').draw();
              });                                        
            }
        });           
      });

      let controlSearch=true;

      $(document).on("keyup", '.btn-cargar-entradas .article-info input', function (e) {        
        let value = $(e.target).val();
        let data = {
          value
        }
        let that= $(this);
        if (controlSearch){
          controlSearch=false;
          $.ajax({
            data,
            type: "POST",
            url: uriControllers + "certificacion/buscar-entrada.php",
            })
            .done(function (data, textStatus, jqXHR) {                            
              var data = JSON.parse(data);               
              controlSearch=true;                            
              that.parent().parent().parent().parent().find(' .search-list').empty();
              data.entradas.map((it,i)=>{
                that.parent().parent().parent().find(' > .search-list').append("<li data-id='" + it.id + "'><p class='ver-global'><a target='_blank'  href='./entrada.php?id=" + it.id + "'>" + it.factura + "</a></p><p>" + moment(it.fecha).format("DD-MM-YYYY") + " </p><div class='ver-btn button btn-add' title='Agregar'></div ><div class='ver-btn button btn-remove' title='Eliminar'></div > </li>");
              });                      
            });
          }
      });

      $(document).on('click', '.btn-cargar-entradas .article-info .search-list .btn-add', function () {            
        let found= false;
        let that = $(this).parent().data("id");
        $(this).parent().parent().parent().parent().find(".entradas-list li").map((i,it)=>{                  
          if ($(it).data("id") == that) {
            found= true;
          }
        })
        if(!found){
          $(this).parent().parent().parent().parent().find(".entradas-list").append($(this).parent());
        }        
        $(this).parent().parent().parent().find("> h2 ").show();               
      })      
        
      $(document).on('click', '.btn-cargar-entradas .article-info .btn-remove', function () {                
        if ($(this).parent().parent().parent().parent().find(".entradas-list li").length<2){
          $(this).parent().parent().parent().find("> h2 ").hide();
        }
        $(this).parent().remove();
      })   
      
      function formatearFecha(fechaStr) {
        const partes = fechaStr.split(' ');
        if (partes.length !== 3) return fechaStr; 
      
        const [dia, mesEn, anio] = partes;
        const meses = {
          'January': 'enero',
          'February': 'febrero',
          'March': 'marzo',
          'April': 'abril',
          'May': 'mayo',
          'June': 'junio',
          'July': 'julio',
          'August': 'agosto',
          'September': 'septiembre',
          'October': 'octubre',
          'November': 'noviembre',
          'December': 'diciembre'
        };
        const mesEs = meses[mesEn] || mesEn;
        return `${dia} de ${mesEs} de ${anio}`;
      }
  });


