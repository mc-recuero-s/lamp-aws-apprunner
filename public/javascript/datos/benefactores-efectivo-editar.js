$(document).ready(function () {
    var uriControllers = "./controllers/";
    let benefactores=[];
    var table = $('#table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            // 'copy', 'csv', 'excel', 'pdf', 'print'            
        ]
    });

    $("#crear-benefactor").click(()=>{
        $(".table-content").hide();
        $(".benefactores_efectivo").show();
    })
    
    $("#regresar-benefactor").click(() => {
        $(".table-content").show();
        $(".benefactores_efectivo").hide();
    });

    if ($(".info") && $(".info").data("id")) {
        $("#crear-benefator").text("Editar benefactor");
        let data={
            id: $(".info").data("id")
        }
        $.ajax({
            data,
            type: "POST",
            url: uriControllers + "datos/benefactor-efectivo-get.php",
        })
        .done(function (res, textStatus, jqXHR) {
            let data = JSON.parse(res);
            console.log(data);
            if (data && data.benefactor) {
                let benefactor=data.benefactor;
                console.log(benefactor);                
                $(".nombre input").val(benefactor.nombre);
                $(".tipo_documento select").val(benefactor.tipo_documento);
                $(".numero_documento input").val(benefactor.documento);
                $(".correo input").val(benefactor.correo);
                $(".celular input").val(benefactor.celular);
            }         
        });

    }

    $("#crear-benefator").click(function () {

        var valido = true;
        var mensaje = "";

        if ($(".nombre input").val() == "") {
            mensaje = mensaje + "<br> - Debe ingresar un nombre.";
            valido = false;
        }
        // if ($(".codigo input").val() == "") {
        //     mensaje = mensaje + "<br> - Debe ingresar un código.";
        //     valido = false;
        // }
        if ($(".tipo_identificacion select").val() == 0) {
            mensaje = mensaje + "<br> - Debe seleccionar un tipo de documento.";
            valido = false;
        }
        if ($(".numero_documento input").val() == "") {
            mensaje = mensaje + "<br> - Debe ingresar un documento.";
            valido = false;
        }
        if ($(".correo input").val() == 0) {
            mensaje = mensaje + "<br> - Debe seleccionar un correo.";
            valido = false;
        } else {
            console.log(validateEmail($(".correo input").val()));            
            if (!validateEmail($(".correo input").val())) {
                mensaje = mensaje + "<br> - Debe ingresar un correo electrónico válido.";
                valido = false;
            }
        }
        if ($(".celular input").val() == "") {
            mensaje = mensaje + "<br> - Debe ingresar un celular";
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
            if ($(".info") && $(".info").data("id")) {
                let data = {
                    documento: $(".numero_documento input").val()
                }
                $.ajax({
                    data: data,
                    type: "POST",
                    url: uriControllers + "datos/confirmar-documento.php",
                })
                .done(function (res, textStatus, jqXHR) {
                    let data = JSON.parse(res);
                    console.log(data);
                    if (data.benefactor && data.benefactor.id && data.benefactor.id != $(".info").data("id")) {
                        Swal.fire({
                            title: 'Benefactor en efectivo',
                            html: "Este documento ya existe.",
                            icon: 'warning',
                            showCancelButton: false,
                            confirmButtonColor: "#1D9993",
                            confirmButtonText: 'Cerrar'
                        });
                    } else {
            
                        let data = {
                            id: $(".info").data("id"),
                            "nombre": $(".nombre input").val().toUpperCase(),
                            "codigo": "CD",
                            "tipo_documento": $(".tipo_documento select").val(),
                            "numero_documento": $(".numero_documento input").val(),
                            "correo": $(".correo input").val(),
                            "celular": $(".celular input").val(),
                        }
                        console.log(data);
                        $.ajax({
                            data: data,
                            type: "POST",
                            url: uriControllers + "datos/editar-benefactor-efectivo.php",
                        })
                        .done(function (data, textStatus, jqXHR) {
                            console.log(data);                    
                            Swal.fire({
                                title: 'Benefactor en efectivo',
                                html: "El benefactor ha sido editado.",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: "#1D9993",
                                confirmButtonText: 'Cerrar'
                            }).then((result) => {
                                window.location.href = "./benefactores-efectivo.php";
                            });                                
                        });
                    }
                })
            }else{
                let data = {
                    documento: $(".numero_documento input").val()
                }
                $.ajax({
                    data: data,
                    type: "POST",
                    url: uriControllers + "datos/confirmar-documento.php",
                })
                .done(function (res, textStatus, jqXHR) {
                    let data = JSON.parse(res);
                    console.log(data);
                    if (data.benefactor && data.benefactor.id) {
                        Swal.fire({
                            title: 'Benefactor en efectivo',
                            html: "Este documento ya existe.",
                            icon: 'warning',
                            showCancelButton: false,
                            confirmButtonColor: "#1D9993",
                            confirmButtonText: 'Cerrar'
                        });
                    }else{
                        let data = {
                            "nombre": $(".nombre input").val().toUpperCase(),
                            "codigo": "CD",
                            "tipo_documento": $(".tipo_documento select").val(),
                            "numero_documento": $(".numero_documento input").val(),
                            "correo": $(".correo input").val(),
                            "celular": $(".celular input").val(),
                        }
                        console.log(data);
                        $.ajax({
                            data: data,
                            type: "POST",
                            url: uriControllers + "datos/crear-benefactor-efectivo.php",
                        })
                        .done(function (data, textStatus, jqXHR) {
                            console.log(data);                    
                            Swal.fire({
                                title: 'Benefactor en efectivo',
                                html: "El benefactor ha sido creado.",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: "#1D9993",
                                confirmButtonText: 'Cerrar'
                            });
                            $(".nombre input").val("");
                            $(".codigo input").val("");
                            $(".tipo_documento select").val(0);
                            $(".numero_documento input").val("");
                            $(".correo input").val("");
                            $(".celular input").val("");                                       
                        });
                    }
                })
            }                
        }

    })
   

    $('.numero_documento input').on('blur', function () {
        let documento = $(this).val();
        console.log(documento);
        let data={
            documento
        }
        $.ajax({
            data: data,
            type: "POST",
            url: uriControllers + "datos/confirmar-documento.php",
        })
        .done(function (res, textStatus, jqXHR) {
            let data = JSON.parse(res);
            console.log(data);
            if (data.benefactor && data.benefactor.id && data.benefactor.id != $(".info").data("id")) {
                Swal.fire({
                    title: 'Benefactor en efectivo',
                    html: "Este documento ya existe.",
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: "#1D9993",
                    confirmButtonText: 'Cerrar'
                });
            }
        })
                
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

});

function validateEmail(email) {
    const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return regex.test(email);
}