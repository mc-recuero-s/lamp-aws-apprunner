$(document).ready(function () {

	var uriControllers = "./controllers/";
	var benefactores = [];
	var benefactor = [];
	var facturas = [];		

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

    $.ajax({
        type: "POST",
        url: uriControllers + "datos/benefactor-especie.php",
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
                text: benefactor.nombre,
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
                $(".numero_documento input").val(benefactor.nit);
                $("#tipo_identificacion").val("nit");
                
                $(".benefactor-info").css("display","flex");
                $(".benefactor-info2").css("display","flex");
            }else{                
                $(".benefactor-info").hide();
                $(".benefactor-info2").hide();
            }
        }
    });

    var editar = function (data) {
        data.id = $(".editando-certificado").data("id");

        $.ajax({
            data: data,
            type: "POST",
            url: uriControllers + "certificacion/editar-mercadeo.php",
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

    if ($(".editando-certificado") && $(".editando-certificado").data("id")) {
        $("#crear-especie").text("Editar solicitud");
    }

    $("#crear-especie").click(function () {

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
        if ($(".especie_valor input").val() == "") {
            mensaje = mensaje + "<br> - Debe ingresar un monto.";
            valido = false;
        }
        if ($(".descripcion input").val() == "") {
            mensaje = mensaje + "<br> - Debe ingresar una descripción.";
            valido = false;
        }
        if ($(".factura input").val() == "") {
            mensaje = mensaje + "<br> - Debe ingresar una factura.";
            valido = false;
        }
        if ($(".expedicion_factura input").val() == "") {
            mensaje = mensaje + "<br> - Debe ingresar una fecha de expedición";
            valido = false;
        }  
        if ($(".efectivo_asignacion select").val() == 0) {
            mensaje = mensaje + "<br> - Debe seleccionar una asignación.";
            valido = false;
        }
        if (facturas.length < 1 && !($(".editando-certificado") && $(".editando-certificado").data("id"))) {
            mensaje = mensaje + "<br> - Debe adjuntar una factura.";
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
                "monto": $(".especie_valor input").val().replace(/\./g, ''),
                "descripcion": $(".descripcion input").val(),
                "factura": $(".factura input").val(),
                "tipo": 2,
                "expedicion": moment($(".expedicion_factura input").val()).format("YYYY-MM-DD HH:mm:ss"),
                "asignacion": $(".especie_asignacion select").val(),
                "asignacion": $(".anio_expedicion select").val(),
                "categoria": "1",
                facturas                
            }
            console.log(data); 
            
            if ($(".editando-certificado") && $(".editando-certificado").data("id")) {                
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
                                data.redirect = "1";
                            }
                            if (result.dismiss && result.dismiss == "cancel") {
                                data.redirect = "2";
                            }
                            editar(data);
                        }
                    });
                } else {
                    data.redirect = "1";
                    editar(data);
                }
            }else{
                $.ajax({
                    data: data,
                    type: "POST",
                    url: uriControllers + "certificacion/crear-mercadeo.php",
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
                    $(".especie_valor input").val("");
                    $(".descripcion input").val("");
                    $(".factura input").val("");
                    $(".expedicion_factura input").val("");
                    $(".especie_asignacion select").val(0);
                    $(".anio_expedicion select").val(0);
                    $(".facturas input").val("");
                    selectBenefactor[0].selectize.setValue("");
                })
            }
        }

    });
    
    $(document).on("change", '.facturas input[type="file"]', function (e) {
        var input = e.target;
        console.log(e);        
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {                
                facturas.push(input.files[0].name);
                facturas.push(e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }        
    });

    $('.especie_valor input').on('input', function () {
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
            url: uriControllers + "certificacion/certificacion-mercadeo.php",
        })
        .done(function (data, textStatus, jqXHR) {
            var data = JSON.parse(data);
            let currentCertificacion=data.certificacion;
            console.log(data);
            selectBenefactor[0].selectize.setValue(currentCertificacion.codigo + "-" + currentCertificacion.id_institucion + "-" + currentCertificacion.documento);
            $(".especie_valor input").val(currentCertificacion.monto);
            $(".descripcion input").val(currentCertificacion.descripcion);
            $(".factura input").val(currentCertificacion.factura);
            $(".expedicion_factura input").val(moment(currentCertificacion.expedicion, "YYYY-MM-DD HH:mm:ss.SSSSSS").format("DD MMMM YYYY"));
            $(".especie_asignacion select").val(currentCertificacion.asignacion);
            $(".anio_expedicion select").val(currentCertificacion.anio);
        })
    }
    
});

  let crearHoverVer = function (certificacion) {
      let element = $('<div><div class="article-info"><section class="article-info-data"></section><ul></ul></div></div>');
      let fecha_envio = (certificacion.fecha_envio) ? ("<h5>factura de envio: " + moment(certificacion.fecha_envio).format("DD-MM-YYYY HH:mm") + "</h5>") : "";
      element.find(".article-info-data").append("<h5>Id: " + certificacion.id + "</h5><h5>Institución : " + certificacion.institucion + "</h5><h5>Tipo Documento: " + certificacion.tipo_documento + "</h5><h5>Documento: " + certificacion.documento + "</h5><h5>Correo: " + certificacion.correo + "</h5><h5>Celular: " + certificacion.celular + " </h5><h5>Monto: $" + certificacion.monto + "</h5><h5>Destino: " + certificacion.destinatario + "</h5><h5>Fecha Donación: " + certificacion.fecha_donacion + "</h5><h5>Remitente: " + certificacion.remitente + "</h5><h5>Destinación de la donación:  " + certificacion.asignacion + "</h5>" + fecha_envio);

      if (certificacion.historial && certificacion.historial.length > 0) {
        console.log(certificacion.historial);        
        certificacion.historial.map((it, i) => {
            element.find("ul").append("<li><h5>Rechazo: " + (certificacion.historial.length - i) + "</h5><h5>Observación : " + it.observacion + "</h5><h5>Creado : " + it.creado + "</h5></li>");
         })
      }
      return element;
  }