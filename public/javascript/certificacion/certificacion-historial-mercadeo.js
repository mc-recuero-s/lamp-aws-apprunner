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
            
    $.ajax({        
        type: "POST",
        url: uriControllers + "certificacion/mercadeo-historial.php",
    })
    .done(function (data, textStatus, jqXHR) {        
        var data = JSON.parse(data);
        console.log(data);
        certificaciones = data.certificaciones;
        let data1 = [];
        certificaciones.forEach(function (certificacion) {                        
            let estado = "<div class='text-warning'>Pendiente</div>";
            estado = (certificacion.estado == "2") ? "<div class='text-warning'>Aprobada por contabilidad</div>" : estado;
            estado = (certificacion.estado == "3") ? "<div class='text-alert'>Rechazada por contabilidad</div>" : estado;
            estado = (certificacion.estado == "4") ? "<div class='text-success'>Aprobado por Revisoria</div>" : estado;
            estado = (certificacion.estado == "5") ? "<div class='text-alert'>Rechazado por Revisoria</div>" : estado;
            estado = (certificacion.estado == "6") ? "<div class='text-success'>Solicitud enviada</div>" : estado;
            estado = (certificacion.estado == "7") ? "<div class='text-alert'>Rechazada por firma</div>" : estado;

            let buttons = '';           
            if (certificacion.estado == "3") {
                buttons = buttons + '<a class="button btn-editar" title="Editar" target="_parent" href="certificacion-mercadeo.php?id=' + certificacion.id + '"></a><div class="button btn-delete" title="Eliminar"></div>';
                }
            if (certificacion.estado == "5") {
                buttons = buttons + '<a class="button btn-editar" title="Editar" target="_parent" href="certificacion-mercadeo.php?id=' + certificacion.id + '">';
                buttons = buttons + '</a><div class="button btn-aprobar btn-redireccionar" title="Redireccionar a Contabilidad"></div>';
                buttons = buttons + '</a><div class="button btn-delete" title="Eliminar"></div>';
            }
            if (certificacion.estado == "4") {                
                buttons = buttons + '</a><div class="button btn-enviar" title="Enviar"></div><div class="button btn-rechazar" title="Rechazar"></div>';
            }
            buttons = buttons + '<div class="ver-btn button btn-ver" title="Ver">'+crearHoverVer(certificacion).html()+'</div>';
            let tipo = (certificacion.tipo == "1") ? "Efectivo" : "Especie";

            let archivosArray = certificacion.archivos.split(";");

            let archivos = "";                                 
            if (archivosArray[0]) {
                archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[0] + '" target="_blank" class="ver-btn button btn-soporte" title="Facturas de la donación - Presiona para abrir"></a>';
            }

            // if (!(archivosArray[1] == null || archivosArray[1] == "null")) {
            //     archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[1] + '" target="_blank" class="ver-btn button btn-informe" title="Informe de débitos automáticos - Presiona para abrir"></a>';
            // }

                                         
            if (certificacion.estado == 2) {                    
                archivos = archivos + '<div class="ver-btn button btn-entradas btn-cargar-entradas" title="Entradas">' + crearHoverEntradas2(certificacion).html() + '</div>';
                archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[1] + '" target="_blank" class="ver-btn button btn-recibo" title="Certificado sin Firmar - Presiona para abrir"></a>';
            }
            if (certificacion.estado == 4 || certificacion.estado == 6 || certificacion.estado == 7) {
                archivos = archivos + '<div class="ver-btn button btn-entradas btn-cargar-entradas" title="Entradas">' + crearHoverEntradas2(certificacion).html() + '</div>';
                archivos = archivos + '<a href="' + './soportes/certificacion/' + certificacion.id + '_firmado.pdf" target="_blank" class="ver-btn button btn-firmado" title="Certificado con Firma - Presiona para abrir"></a>';
            }
            if (certificacion.estado == 5) {
                archivos = archivos + '<div class="ver-btn button btn-entradas btn-cargar-entradas" title="Entradas">' + crearHoverEntradas2(certificacion).html() + '</div>';
                archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[1] + '" target="_blank" class="ver-btn button btn-recibo" title="Certificado sin Firmar - Presiona para abrir"></a>';
            }                            

            let estado2=certificacion.estado;
            estado2= (estado2=="3")?1.5:estado2;            
            estado2= (estado2=="5")?3.5:estado2;            
            estado2 = (estado2 == "7") ? 3.4 : estado2;

            data1.push([certificacion.id, certificacion.institucion, tipo, "$ " + formatMoney(Number(certificacion.monto)), archivos, estado, buttons, estado2, moment(certificacion.expedicion).format("DD-MM-YYYY HH:mm"), (certificacion.fecha_donacion) ? moment(certificacion.fecha_envio).format("DD-MM-YYYY HH:mm") : moment(certificacion.expedicion_factura).format("DD-MM-YYYY HH:mm")]);
        })
        table.clear();
        table.rows.add(data1);
        table.draw();
    })





    $('#table tbody').on('click', '.btn-redireccionar', function () {
        var data = table.row($(this).parents('tr')).data();
        console.log(data);
        let certificacion = certificaciones.filter((it) => it.id == data[0])[0];
        const index = certificaciones.map((element, index) => ({
            element,
            index
        })).filter(obj => obj.element.id === certificacion.id)[0].index;
        Swal.fire({
            title: "Certificación",
            text: '¿Esta seguro de redireccionar a contabilidad, la solicitud ' + certificacion.id + '?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, Redireccionar',
            cancelButtonText: 'No'
        }).then((result) => {
            console.log(result);
            if (result.value || result.value == "") {
                Swal.fire(
                    'Hecho!',
                    'El certificado ' + certificacion.id + ' ha sido redireccionado.',
                    'success'
                );
                let descripcion = result.value;
                certificacion.descripcion = descripcion
                console.log(certificacion);
                $.ajax({
                    data: certificacion,
                    type: "POST",
                    url: uriControllers + "certificacion/redireccionar.php",
                })
                .done(function (data, textStatus, jqXHR) {
                    console.log(data);
                    let archivos = "";
                    let archivosArray = certificacion.archivos.split(";");
                    if (archivosArray[0]) {
                        archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[0] + '" target="_blank" class="ver-btn button btn-soporte" title="Facturas de la donación - Presiona para abrir"></a>';
                    }
                    table.cell(index, 4).data(archivos).draw();
                    table.cell(index, 5).data("<div class='text-warning'>Pendiente</div>").draw();
                    table.cell(index, 6).data('<div class="ver-btn button btn-ver" title="Ver">' + crearHoverVer(certificacion).html() + '</div>').draw();
                });
            }
        });
    });
    
    $('#table tbody').on('click', '.btn-enviar', function () {
        var data = table.row($(this).parents('tr')).data();
        console.log(data);
        let certificacion = certificaciones.filter((it) => it.id == data[0])[0];
        const index = certificaciones.map((element, index) => ({
            element,
            index
        })).filter(obj => obj.element.id === certificacion.id)[0].index;
        Swal.fire({
            title: "Certificación",
            text: '¿Esta seguro de enviar y finalizar la solicitud ' + certificacion.id + '?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, Enviar',
            cancelButtonText: 'No'
        }).then((result) => {
            console.log(result);
            if (result.value || result.value == "") {
                Swal.fire(
                    'Hecho!',
                    'El certificado ' + certificacion.id + ' ha sido enviado',
                    'success'
                );
                let descripcion = result.value;
                certificacion.descripcion = descripcion
                certificacion.fecha_envio = moment().format("YYYY-MM-DD HH:mm:ss");
                console.log(certificacion);
                $.ajax({
                    data: certificacion,
                    type: "POST",
                    url: uriControllers + "certificacion/enviar.php",
                })
                .done(function (data, textStatus, jqXHR) {
                    let archivos = "";
                    let archivosArray = certificacion.archivos.split(";");
                    if (archivosArray[0]) {
                        archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[0] + '" target="_blank" class="ver-btn button btn-soporte" title="Facturas de la donación - Presiona para abrir"></a>';
                    }
                    archivos = archivos + '<div class="ver-btn button btn-entradas btn-cargar-entradas" title="Entradas">' + crearHoverEntradas2(certificacion).html() + '</div>';
                    archivos = archivos + '<a href="' + './soportes/certificacion/' + certificacion.id + '_firmado.pdf" target="_blank" class="ver-btn button btn-firmado" title="Certificado con Firma - Presiona para abrir"></a>';
                    table.cell(index, 4).data(archivos).draw();
                    table.cell(index, 5).data("<div class='text-success'>Solicitud enviada</div>").draw();
                    table.cell(index, 6).data('<div class="ver-btn button btn-ver" title="Ver">' + crearHoverVer(certificacion).html() + '</div>').draw();
                    });
            }
        });
    });
    
    $('#table tbody').on('click', '.btn-rechazar', function () {
        var data = table.row($(this).parents('tr')).data();
        console.log(data);
        let certificacion = certificaciones.filter((it) => it.id == data[0])[0];
        const index = certificaciones.map((element, index) => ({
            element,
            index
        })).filter(obj => obj.element.id === certificacion.id)[0].index;
        Swal.fire({
            title: '¿Esta seguro de rechazar la solicitud ' + certificacion.id + '?',
            input: 'textarea',
            inputPlaceholder: 'Digita la justificación de eliminación',
            inputAttributes: {
                'aria-label': 'Justificación'
            },
            showCancelButton: true,
            confirmButtonText: 'Sí, rechazar',
            cancelButtonText: 'No'
        }).then((result) => {
            console.log(result);
            if (result.value || result.value == "") {
                Swal.fire(
                    'Hecho!',
                    'El certificado ' + certificacion.id + ' ha sido rechazada',
                    'success'
                );
                let descripcion = result.value;
                certificacion.descripcion = descripcion
                console.log(certificacion);
                $.ajax({
                        data: certificacion,
                        type: "POST",
                        url: uriControllers + "certificacion/rechazar-tesoreria.php",
                    })
                    .done(function (data, textStatus, jqXHR) {
                        console.log(data);
                        // table.row(index).remove().draw()
                        let archivos = "";
                        let archivosArray = certificacion.archivos.split(";");
                        if (archivosArray[0]) {
                            archivos = archivos + '<a href="' + './soportes/certificacion/' + archivosArray[0] + '" target="_blank" class="ver-btn button btn-soporte" title="Facturas de la donación - Presiona para abrir"></a>';
                        }
                        archivos = archivos + '<div class="ver-btn button btn-entradas btn-cargar-entradas" title="Entradas">' + crearHoverEntradas2(certificacion).html() + '</div>';
                        archivos = archivos + '<a href="' + './soportes/certificacion/' + certificacion.id + '_firmado.pdf" target="_blank" class="ver-btn button btn-firmado" title="Certificado con Firma - Presiona para abrir"></a>';
                        table.cell(index, 5).data("<div class='text-alert'>Rechazado por firma</div>").draw();
                        table.cell(index, 6).data('<div class="ver-btn button btn-ver" title="Ver">' + crearHoverVer(certificacion).html() + '</div>').draw();
                    });
            }
        });
    });
    
    $('#table tbody').on('click', '.btn-delete', function () {
        var data = table.row($(this).parents('tr')).data();
        console.log(data);
        let certificacion = certificaciones.filter((it) => it.id == data[0])[0];
        const index = certificaciones.map((element, index) => ({
            element,
            index
        })).filter(obj => obj.element.id === certificacion.id)[0].index;
        Swal.fire({
            title: '¿Esta seguro de eliminar la solicitud ' + certificacion.id + '?',
            input: 'textarea',
            inputPlaceholder: 'Digita la justificación de eliminación',
            inputAttributes: {
                'aria-label': 'Justificación'
            },
            showCancelButton: true,
            confirmButtonText: 'Sí, Eliminar',
            cancelButtonText: 'No'
        }).then((result) => {
            console.log(result);
            if (result.value || result.value == "") {
                Swal.fire(
                    'Hecho!',
                    'El certificado ' + certificacion.id + ' ha sido eliminado',
                    'success'
                );
                let descripcion = result.value;
                certificacion.descripcion = descripcion
                console.log(certificacion);
                $.ajax({
                        data: certificacion,
                        type: "POST",
                        url: uriControllers + "certificacion/eliminar.php",
                    })
                    .done(function (data, textStatus, jqXHR) {
                        console.log(data);
                        table.row(index).remove().draw()
                    });
            }
        });
    });
});

let crearHoverVer = function (certificacion) {
    let element = "";
    let fecha_envio = (certificacion.fecha_envio) ? ("<h5>factura de envio: " + moment(certificacion.fecha_envio).format("DD-MM-YYYY HH:mm") + "</h5>") : "";
    if (certificacion.tipo == 1) {
        element = $('<div><div class="article-info"><section class="article-info-data"></section><ul></ul></div></div>');
        element.find(".article-info-data").append("<h5>Id: " + certificacion.id + "</h5><h5>Institución : " + certificacion.institucion + "</h5><h5>Tipo Documento: " + certificacion.tipo_documento + "</h5><h5>Documento: " + formatNumberWithHyphen(certificacion.documento) + "</h5><h5>Correo: " + certificacion.correo + "</h5><h5>Celular: " + certificacion.celular + " </h5><h5>Monto: $" + formatMoney(Number(certificacion.monto)) + "</h5><h5>Destino: " + certificacion.destinatario + "</h5><h5>Fecha Donación: " + moment(certificacion.fecha_donacion).format("DD-MM-YYYY") + "</h5><h5>Remitente: " + certificacion.remitente + "</h5><h5>Destinación de la donación:  " + certificacion.asignacion + "</h5>" + fecha_envio);
    }
    if (certificacion.tipo == 2) {
        element = $('<div><div class="article-info"><section class="article-info-data"></section><ul></ul></div></div>');
        element.find(".article-info-data").append("<h5>Id: " + certificacion.id + "</h5><h5>Institución : " + certificacion.institucion + "</h5><h5>Documento: " + formatNumberWithHyphen(certificacion.nit) + "</h5><h5>Monto: $" + formatMoney(Number(certificacion.monto)) + "</h5><h5>Descripción: " + certificacion.descripcion + "</h5><h5>Factura: " + certificacion.factura + "</h5><h5>Expedición de factura: " + moment(certificacion.expedicion_factura).format("DD-MM-YYYY") + "</h5><h5>Destinación de la donación:  " + certificacion.asignacion + "</h5>" + fecha_envio);
    }
    if (certificacion.historial && certificacion.historial.length > 0) {        
        certificacion.historial.map((it, i) => {
            element.find("ul").append("<li><h5>Rechazo: " + (certificacion.historial.length - i) + "</h5><h5>Observación : " + it.observacion + "</h5><h5>Creado : " + moment(it.creado).format("DD-MM-YYYY - HH:mm") + " </h5></li > ");
        })
    }
    return element;
}

let crearHoverEntradas2 = function (certificacion) {
    let element = $('<div><div class="article-info"><h2>Entradas asignadas</h2><ul class="entradas-list"></ul></div></div>');

    if (certificacion.historial && certificacion.historial.length > 0) {        
        certificacion.entradas.map((it, i) => {            
            element.find(".entradas-list").append("<li data-id='" + it.id + "'><p class='ver-global'><a target='_blank'  href='./entrada.php?id=" + it.id + "'>" + it.factura + "</a></p><p>" + moment(it.fecha).format("DD-MM-YYYY") + " </p></li>");
        });
    }
    return element;
}

function formatNumberWithHyphen(numberString) {
    if (numberString) {
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