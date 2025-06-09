$(document).ready(function () {

	var uriControllers = "./controllers/";
	var benefactores = [];
	var benefactor = [];
	var soporte = [];
	var informe = [];
	var archivos = [];

    $(".fecha-factura").datepicker({
        dateFormat: "d MM yy",
        duration: "medium",
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        // monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        // monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        // dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        // dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        // dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        weekHeader: 'Sm',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    });
    $(".fecha-donacion").datepicker({
        dateFormat: "d MM yy",
        duration: "medium",
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        // monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        // monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        // dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        // dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        // dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        weekHeader: 'Sm',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    });

    $.ajax({
        type: "POST",
        url: uriControllers + "datos/benefactor-efectivo.php",
    })
    .done(function (data, textStatus, jqXHR) {
        var data = JSON.parse(data);
        benefactores = data.benefactores;
        var $select = $('#benefactor').selectize();
        console.log($select);
        var selectize = $select[0].selectize;
        let data1 = [];
        benefactores.forEach(function (benefactor) {
            data1.push({
                text: benefactor.documento+" - "+benefactor.nombre,
                value: benefactor.codigo + "-" + benefactor.id + "-" + benefactor.documento
            });
        });
        selectize.addOption(data1);
        selectize.refreshOptions(false);
    });

    let select = $("#anio_expedicion");
    let currentYear = new Date().getFullYear();

    for (let i = 0; i < 10; i++) {
        let year = currentYear - i;
        let selected = (i === 0) ? "selected" : "";
        select.append(`<option value="${year}" ${selected}>${year}</option>`);
    }


    var selectBenefactor = $('#benefactor').selectize({
        sortField: 'text',
        onChange: function (value, isOnInitialize) {
            let benefactor1 = value.split("-");
            benefactor = benefactores.filter((it) => it.id == benefactor1[1])[0];
            if(benefactor){
                $(".numero_documento input").val(benefactor.documento);
                $("#tipo_identificacion").val(benefactor.tipo_documento);
                $(".correo input").val(benefactor.correo);
                $(".celular input").val(benefactor.celular);
                $(".benefactor-info").css("display","flex");
                $(".benefactor-info2").css("display","flex");
                $(".benefactor-info3").hide();
            }else{
                $(".benefactor-info").hide();
                $(".benefactor-info2").hide();
                $(".benefactor-info2").show();
            }
        }
    });

    if ($(".editando-certificado") && $(".editando-certificado").data("id")) {
        $("#crear-efectivo").text("Editar solicitud");
    }

    var editar = function(data){
        data.id = $(".editando-certificado").data("id");
        console.log(data);
        $.ajax({
            data: data,
            type: "POST",
            url: uriControllers + "certificacion/editar.php",
        })
        .done(function (data, textStatus, jqXHR) {
            console.log(data);
            Swal.fire({
                title: 'Certificado de Donación',
                html: "La solicitud " + $(".editando-certificado").data("id") + " ha sido actualizada.",
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: "#1D9993",
                confirmButtonText: 'Cerrar'
            }).then((result) => {
                window.location.href = "./certificacion-historial.php";
            });
        })
    }

    $("#crear-efectivo").click(function () {

        var valido = true;
        var mensaje = "";
        console.log(benefactor);
        if (benefactor.id == undefined) {
            mensaje = mensaje + "<br> - Debe seleccionar un Benefactor.";
            valido = false;
        };
        if ($("#tipo_identificacion").val()==0){
            mensaje = mensaje + "<br> - Debe seleccionar un tipo de documento.";
            valido = false;
        }
        if ($(".numero_documento input").val()=="") {
            mensaje = mensaje + "<br> - Debe ingresar un número de documento.";
            valido = false;
        }
        if ($(".correo input").val() == "") {
            mensaje = mensaje + "<br> - Debe ingresar un correo electrónico.";
            valido = false;
        }
        if ($(".celular input").val() == "") {
            mensaje = mensaje + "<br> - Debe ingresar un celular.";
            valido = false;
        }
        if ($(".efectivo_valor input").val() == "") {
            mensaje = mensaje + "<br> - Debe ingresar un Monto.";
            valido = false;
        }
        if ($(".destinatario select").val() == 0) {
            mensaje = mensaje + "<br> - Debe seleccionar un destinatario.";
            valido = false;
        }
        if ($(".dia_donacion input").val() == "") {
            mensaje = mensaje + "<br> - Debe ingresar una fecha de donación";
            valido = false;
        }
        if ($(".remitente input").val() == "") {
            mensaje = mensaje + "<br> - Debe ingresar un número de cuenta remitente.";
            valido = false;
        }
        if ($(".efectivo_asignacion select").val() == 0) {
            mensaje = mensaje + "<br> - Debe seleccionar una asignación.";
            valido = false;
        }
        if ($(".anio_expedicion select").val() == 0) {
            mensaje = mensaje + "<br> - Debe seleccionar una asignación.";
            valido = false;
        }
        if (soporte.length < 1 && informe.length < 1 && !($(".editando-certificado") && $(".editando-certificado").data("id"))) {
            mensaje = mensaje + "<br> - Debe adjuntar un soporte de la donación y/o un informe de débitos automáticos.";
            valido = false;
        }

        if (!valido) {
            Swal.fire({
                title: 'Información faltante.',
                html: mensaje,
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: "#1D9993",
                confirmButtonText: 'Cerrar'
            })
        } else {
            let data = {
                "institucion": benefactor.id,
                "tipo_documento": $("#tipo_identificacion").val(),
                "documento": $(".numero_documento input").val(),
                "correo": $(".correo input").val(),
                "celular": $(".celular input").val(),
                "tipo": 1,
                "monto": $(".efectivo_valor input").val().replace(/\./g, ''),
                "destinatario": $(".destinatario select").val(),
                "fecha_donacion": moment($(".dia_donacion input").val()).format("YYYY-MM-DD HH:mm:ss"),
                "remitente": $(".remitente input").val(),
                "asignacion": $(".efectivo_asignacion select").val(),
                "descripcion": $(".descripcion input").val(),
                "factura": $(".factura input").val(),
                "expedicion_factura": moment($(".expedicion_factura input").val()).format("YYYY-MM-DD HH:mm:ss"),
                "expedicion": moment().format("YYYY-MM-DD HH:mm:ss"),
                "anio": $(".anio_expedicion select").val(),

                soporte,
                informe,
                archivos
            }
            console.log(data);

            if ($(".editando-certificado") && $(".editando-certificado").data("id")) {
                console.log($(".editando-certificado").data("estado"));
                if ($(".editando-certificado").data("estado") == "5") {
                    Swal.fire({
                        title: '¿A dónde deseas redireccionar la solicitud ' + $(".editando-certificado").data("id") + '?',
                        showCancelButton: true,
                        cancelButtonText: 'Revisoria',
                        cancelButtonColor: '#43cc7a',
                        confirmButtonText: 'Contabilidad',
                        reverseButtons: true
                    }).then((result) => {
                        console.log(result);
                        if (!(result.dismiss && result.dismiss == "backdrop")) {
                            if (result.value) {
                                data.redirect= "1";
                            }
                            if (result.dismiss && result.dismiss=="cancel") {
                                data.redirect = "2";
                            }
                            editar(data);
                        }
                        });
                }else{
                    data.redirect= "1";
                    editar(data);
                }
            }else{
                $.ajax({
                    data: data,
                    type: "POST",
                    url: uriControllers + "certificacion/crear.php",
                })
                .done(function (data, textStatus, jqXHR) {
                    console.log(data);
                    Swal.fire({
                        title: 'Certificado de Donación',
                        html: "La solicitud ha sido almacenada.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: "#1D9993",
                        confirmButtonText: 'Cerrar'
                    });
                    $("#tipo_identificacion").val(0);
                    $(".numero_documento input").val("");
                    $(".correo input").val("");
                    $(".celular input").val("");
                    $(".efectivo_valor input").val("");
                    $(".destinatario select").val(0);
                    $(".dia_donacion input").val("");
                    $(".remitente input").val("");
                    $(".efectivo_asignacion select").val(0);
                    $(".anio_expedicion select").val(0);
                    $(".descripcion input").val("");
                    $(".factura input").val("");
                    $(".expedicion_factura input").val("");
                    $(".soporte input").val("");
                    $(".informe input").val("");
                    selectBenefactor[0].selectize.setValue("");
                })
            }
        }

    })

    $(document).on("change", '.soporte input[type="file"]', function (e) {
        var input = e.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                soporte.push(input.files[0].name);
                soporte.push(e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    });

    $(document).on("change", '.informe input[type="file"]', function (e) {
        var input = e.target;
        console.log(e);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                informe.push(input.files[0].name);
                informe.push(e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    });

    $('.efectivo_valor input').on('input', function () {
        let input = $(this).val();
        input = input.replace(/[^0-9]/g, '');
        console.log(input);
        if ($.isNumeric(input)) {
            let formattedInput = Number(input).toLocaleString('es-ES', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            });
            $(this).val(formattedInput);
        }
    });


    $("input.entero").on("keydown", function (e) {
        if (
            $.inArray(e.keyCode, [46, 8, 9]) !== -1 ||
            ($.inArray(e.keyCode, [65, 67, 88]) !== -1 && (e.ctrlKey === true || e.metaKey === true)) ||
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    if ($(".editando-certificado") && $(".editando-certificado").data("id")){
        let data={
            id: $(".editando-certificado").data("id")
        }
        $.ajax({
            data,
            type: "POST",
            url: uriControllers + "certificacion/certificacion.php",
        })
        .done(function (data, textStatus, jqXHR) {
            var data = JSON.parse(data);
            let currentCertificacion=data.certificacion;
            console.log(data);
            selectBenefactor[0].selectize.setValue(currentCertificacion.codigo + "-" + currentCertificacion.id_institucion + "-" + currentCertificacion.documento);
            $(".efectivo_valor input").val(currentCertificacion.monto);
            $(".destinatario select").val(currentCertificacion.destinatario);
            $(".dia_donacion input").val(moment(currentCertificacion.fecha_donacion, "YYYY-MM-DD HH:mm:ss.SSSSSS").format("DD MMMM YYYY"));
            $(".remitente input").val(currentCertificacion.remitente);
            $(".efectivo_asignacion select").val(currentCertificacion.asignacion);
            $(".anio_expedicion select").val(currentCertificacion.anio);
        })
    }
});

let crearHoverVer = function (certificacion) {
    let element="";
    let fecha_envio = (certificacion.fecha_envio) ? ("<h5>factura de envio: " + moment(certificacion.fecha_envio).format("DD-MM-YYYY HH:mm") + "</h5>") : "";
    if(certificacion.tipo==1){
        element = $('<div><div class="article-info"><section class="article-info-data"></section><ul></ul></div></div>');
        element.find(".article-info-data").append("<h5>Id: " + certificacion.id + "</h5><h5>Institución : " + certificacion.institucion + "</h5><h5>Tipo Documento: " + certificacion.tipo_documento + "</h5><h5>Documento: " + formatNumberWithHyphen(certificacion.documento) + "</h5><h5>Correo: " + certificacion.correo + "</h5><h5>Celular: " + certificacion.celular + " </h5><h5>Monto: $" + formatMoney(Number(certificacion.monto)) + "</h5><h5>Destino: " + certificacion.destinatario + "</h5><h5>Fecha Donación: " + moment(certificacion.fecha_donacion).format("DD-MM-YYYY") + "</h5><h5>Remitente: " + certificacion.remitente + "</h5><h5>Destinación de la donación:  " + certificacion.asignacion + "</h5>" + fecha_envio);
    }
    if(certificacion.tipo==2){
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

let crearHoverEntradas = function (certificacion) {
    let element = $('<div><div class="article-info"><h2>Entradas asignadas</h2><ul class="entradas-list"></ul><h3>Buscar entradas</h3><section class="article-info-data"></section><ul class="search-list"></ul></div></div>');
    element.find(".article-info-data").prepend("<article><input type='text' placeholder='Buscar por factura...' /></article>");

    if (certificacion.entradas.length > 0) {
        element.find(".article-info > h2 ").show()
        certificacion.entradas.map((it, i) => {
            if(it.id){
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

function formatMoney(value) {
    return value.toLocaleString('es-ES', {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).replace('US', '');
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

function validateEmail(email) {
    const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return regex.test(email);
}