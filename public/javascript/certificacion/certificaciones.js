$(document).ready(function () {
    var uriControllers = "./controllers/";
    let certificaciones = [];
    var table = $('#table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ],
        "order": [
            [7, "asc"]
        ], "columnDefs": [{
            "targets": [7],
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

    $('input[name="daterange"]').daterangepicker({
        opens: 'left',
        startDate: moment().startOf('month').format('DD/MM/YYYY'),
        endDate: moment().endOf('month').format('DD/MM/YYYY'),
        "locale": {
            "format": "DD/MM/YYYY",
            "separator": " - ",
            "applyLabel": "Buscar",
            "cancelLabel": "Cerrar",
            "fromLabel": "Desde",
            "toLabel": "a",
            "customRangeLabel": "Personalizado",
            "daysOfWeek": [
                "Do",
                "Lu",
                "Ma",
                "Mi",
                "Ju",
                "Vi",
                "Sa"
            ],
            "monthNames": [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            ],
            "firstDay": 1
        }
    }, function (start, end, label) {
        search(start, end, label);
    });



    var search = function (start, end, label) {
    	var data1 = {
    	    inicio: start.format('YYYY-MM-DD'),
    	    fin: end.format('YYYY-MM-DD')    	    
    	};
        $.ajax({
			data: data1,
            type: "POST",
            url: uriControllers + "certificacion/certificaciones-historial.php",
        })
        .done(function (data, textStatus, jqXHR) {        
            var data = JSON.parse(data);
            certificaciones = data.certificaciones;
            console.log(data);
            let data1 = [];
            certificaciones.forEach(function (certificacion) {    
                console.log(certificacion);                         
                if (certificacion.tipo == "1" && typeof(certificacion.historial) == "string") {
                    certificacion.historial = (certificacion.historial) ? certificacion.historial.replace(/[\x00-\x1F\x7F]/g, "") : "";
                    try {
                        certificacion.historial = (certificacion.historial) ? JSON.parse(certificacion.historial) : "";
                    } catch (error) {
                        console.error("Error al parsear JSON:", error);
                    }
                }
                let estado = "<div class='text-warning'>Pendiente</div>";
                estado = (certificacion.estado == "0") ? "<div class='text-alert'>Solicitud eliminada</div>" : estado;
                estado = (certificacion.estado == "2") ? "<div class='text-warning'>Aprobada por Contabilidad</div>" : estado;
                estado = (certificacion.estado == "3") ? "<div class='text-alert'>Rechazada por Contabilidad</div>" : estado;
                estado = (certificacion.estado == "4") ? "<div class='text-success'>Aprobado por Revisoria</div>" : estado;
                estado = (certificacion.estado == "5") ? "<div class='text-alert'>Rechazado por Revisoria</div>" : estado;
                estado = (certificacion.estado == "6") ? "<div class='text-success'>Solicitud enviada</div>" : estado;
                estado = (certificacion.estado == "7") ? "<div class='text-alert'>Rechazada por firma</div>" : estado;

                let buttons = '';                
                buttons = buttons + '<div class="ver-btn button btn-ver" title="Ver">' + crearHoverVer(certificacion).html() + '</div>';
                let tipo = (certificacion.tipo == "1") ? "Efectivo" : "Especie";

                let archivosArray = certificacion.archivos.split(";");

                let archivos = "";

                if (certificacion.tipo == 1) {
                    if (!(archivosArray[0] == null || archivosArray[0] == "null")) {
                        archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[0] + '" target="_blank" class="ver-btn button btn-soporte" title="Soporte de la donación - Presiona para abrir"></a>';
                    }
                    if (!(archivosArray[1] == null || archivosArray[1] == "null")) {
                        archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[1] + '" target="_blank" class="ver-btn button btn-informe" title="Informe de débitos automáticos - Presiona para abrir"></a>';
                    }
                }
                if (certificacion.tipo == 2) {
                    if (archivosArray[0]) {
                        archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[0] + '" target="_blank" class="ver-btn button btn-soporte" title="Factura de la donación - Presiona para abrir"></a>';
                    }
                }

                
                if (certificacion.estado > 1) {
                    if (certificacion.tipo == 1) {
                        if (certificacion.estado == 2) {
                            archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[2] + '" target="_blank" class="ver-btn button btn-informe" title="Recibo de caja - Presiona para abrir"></a>';
                            archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[3] + '" target="_blank" class="ver-btn button btn-recibo" title="Certificado sin Firmar - Presiona para abrir"></a>';
                        }
                        if (certificacion.estado == 4 || certificacion.estado == 6 || certificacion.estado == 7) {
                            archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[2] + '" target="_blank" class="ver-btn button btn-informe" title="Recibo de caja - Presiona para abrir"></a>';
                            archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[3] + '" target="_blank" class="ver-btn button btn-recibo" title="Certificado sin Firmar - Presiona para abrir"></a>';                            
                            archivos = archivos + '<a href="' + './soportes/certificacion/' + certificacion.id + '_firmado.pdf" target="_blank" class="ver-btn button btn-firmado" title="Certificado con Firma - Presiona para abrir"></a>';
                        }
                        if (certificacion.estado == 5) {
                            archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[2] + '" target="_blank" class="ver-btn button btn-informe" title="Recibo de caja - Presiona para abrir"></a>';
                            archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[3] + '" target="_blank" class="ver-btn button btn-recibo" title="Certificado sin Firmar - Presiona para abrir"></a>';
                        }
                    }
                    if (certificacion.tipo == 2) {
                        if (certificacion.estado == 2) {
                            archivos = archivos + '<div class="ver-btn button btn-entradas btn-cargar-entradas" title="Cargar Entradas">' + crearHoverEntradas2(certificacion).html() + '</div>';
                            archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[1] + '" target="_blank" class="ver-btn button btn-recibo" title="Certificado sin Firmar - Presiona para abrir"></a>';
                        }
                        if (certificacion.estado == 4 || certificacion.estado == 6 || certificacion.estado == 7) {
                            archivos = archivos + '<div class="ver-btn button btn-entradas btn-cargar-entradas" title="Cargar Entradas">' + crearHoverEntradas2(certificacion).html() + '</div>';
                            archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[1] + '" target="_blank" class="ver-btn button btn-recibo" title="Certificado sin Firmar - Presiona para abrir"></a>';
                            archivos = archivos + '<a href="' + './soportes/certificacion/' + certificacion.id + '_firmado.pdf" target="_blank" class="ver-btn button btn-firmado" title="Certificado con Firma - Presiona para abrir"></a>';
                        }
                        if (certificacion.estado == 5) {
                            archivos = archivos + '<div class="ver-btn button btn-entradas btn-cargar-entradas" title="Cargar Entradas">' + crearHoverEntradas2(certificacion).html() + '</div>';
                            archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[1] + '" target="_blank" class="ver-btn button btn-recibo" title="Certificado sin Firmar - Presiona para abrir"></a>';                            
                        }
                    }
                }else{
                    // if (certificacion.tipo == 1) {
                    //     archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[2] + '" target="_blank" class="ver-btn button btn-informe" title="Recibo de caja - Presiona para abrir"></a>';
                    // }
                    if (certificacion.entradas && certificacion.entradas.length>0) {
                        archivos = archivos + '<div class="ver-btn button btn-entradas btn-cargar-entradas" title="Cargar Entradas">' + crearHoverEntradas2(certificacion).html() + '</div>';
                    }
                }
                

                let estado2 = certificacion.estado;
                estado2 = (estado2 == "3") ? 1.5 : estado2;
                estado2 = (estado2 == "5") ? 3.5 : estado2;
                estado2 = (estado2 == "0") ? 8 : estado2;
                estado2 = (estado2 == "7") ? 3.4 : estado2;


                data1.push([certificacion.id, certificacion.institucion, tipo, "$ " + formatMoney(Number(certificacion.monto)), archivos, estado, buttons, estado2, moment(certificacion.expedicion).format("DD-MM-YYYY HH:mm"), (certificacion.fecha_donacion) ? moment(certificacion.fecha_donacion).format("DD-MM-YYYY HH:mm") : moment(certificacion.expedicion_factura).format("DD-MM-YYYY HH:mm"), (certificacion.fecha_envio) ? moment(certificacion.fecha_envio).format("DD-MM-YYYY HH:mm"):""]);
            });
            table.clear();
            table.rows.add(data1);
            table.draw();
        })    
    }

    search(moment().startOf('month'), moment().endOf('month'), "label");
});

let crearHoverVer = function (certificacion) {
    let element = "";
    let fecha_envio = (certificacion.fecha_envio)?("<h5>factura de envio: " + moment(certificacion.fecha_envio).format("DD-MM-YYYY HH:mm") + "</h5>"):"";
    if (certificacion.tipo == 1) {
        element = $('<div><div class="article-info"><section class="article-info-data"></section><ul></ul></div></div>');
        element.find(".article-info-data").append("<h5>Id: " + certificacion.id + "</h5><h5>Institución : " + certificacion.institucion + "</h5><h5>Tipo Documento: " + certificacion.tipo_documento + "</h5><h5>Documento: " + formatNumberWithHyphen(certificacion.documento) + "</h5><h5>Correo: " + certificacion.correo + "</h5><h5>Celular: " + certificacion.celular + " </h5><h5>Monto: $" + formatMoney(Number(certificacion.monto)) + "</h5><h5>Destino: " + certificacion.destinatario + "</h5><h5>Fecha Donación: " + moment(certificacion.fecha_donacion).format("DD-MM-YYYY") + "</h5><h5>Remitente: " + certificacion.remitente + "</h5><h5>Destinación de la donación:  " + certificacion.asignacion + "</h5>" + fecha_envio);
    }
    if (certificacion.tipo == 2) {
        element = $('<div><div class="article-info"><section class="article-info-data"></section><ul></ul></div></div>');
        element.find(".article-info-data").append("<h5>Id: " + certificacion.id + "</h5><h5>Institución : " + certificacion.institucion + "</h5><h5>Documento: " + formatNumberWithHyphen(certificacion.nit) + "</h5><h5>Monto: $" + formatMoney(Number(certificacion.monto)) + "</h5><h5>Descripción: " + certificacion.descripcion + "</h5><h5>Factura: " + certificacion.factura + "</h5><h5>Expedición de factura: " + moment(certificacion.expedicion).format("DD-MM-YYYY") + "</h5><h5>Destinación de la donación:  " + certificacion.asignacion + "</h5>"+fecha_envio);
    }
    if (certificacion.historial && certificacion.historial.length > 0) {        
        certificacion.historial.map((it, i) => {
            element.find("ul").append("<li><h5>Rechazo: " + (certificacion.historial.length - i) + "</h5><h5>Observación : " + it.observacion + "</h5><h5>Creado : " + moment(it.creado).format("DD-MM-YYYY - HH:mm") + " </h5></li > ");
        })
    }    
    return element;
}

let crearHoverEntradas = function (certificacion) {
    let element = $('<div><div class="article-info"><h2>Entradas asignadas</h2><ul class="entradas-list"></ul><h3>Buscar entradas</h3><section class="article-info-data"></section><ul class="search-list"></ul></div></div>');
    element.find(".article-info-data").prepend("<article><input type='text' placeholder='Buscar por factura...' /></article>");

    if (certificacion.entradas.length > 0) {
        element.find(".article-info > h2 ").show()
        certificacion.entradas.map((it, i) => {
            if (it.id) {
                element.find(".entradas-list").append("<li data-id='" + it.id + "'><p class='ver-global'><a target='_blank'  href='./entrada.php?id=" + it.id + "'>" + it.factura + "</a></p><p>" + moment(it.fecha).format("DD-MM-YYYY") + " </p><div class='ver-btn button btn-add' title='Agregar'></div ><div class='ver-btn button btn-remove' title='Eliminar'></div ></li>");
            }
        });
    }
    return element;
}

let crearHoverEntradas2 = function (certificacion) {
    let element = $('<div><div class="article-info"><h2>Entradas asignadas</h2><ul class="entradas-list"></ul></div></div>');

    if (certificacion.historial && certificacion.historial.length > 0) {
        element.find(".article-info > h2 ").show();
        certificacion.entradas.map((it, i) => {
            if (it.id) {
                element.find(".entradas-list").append("<li data-id='" + it.id + "'><p class='ver-global'><a target='_blank'  href='./entrada.php?id=" + it.id + "'>" + it.factura + "</a></p><p>" + moment(it.fecha).format("DD-MM-YYYY") + " </p></li>");
            }
        });
    }
    return element;
}

function formatNumberWithHyphen(numberString) {
    if(numberString){
        const parts = numberString.split('-');
    
        const formattedParts = parts.map(part => {
    
            return isNaN(part) ? part : formatMoney(Number(part));
        });
    
        return formattedParts.join('-');
    }
}


function formatMoney(value) {
    return value.toLocaleString('es-ES', {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0             
    }).replace('US', '');
}