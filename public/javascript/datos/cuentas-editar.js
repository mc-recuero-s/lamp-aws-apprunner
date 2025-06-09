$(document).ready(function () {
    var uriControllers = "./controllers/";
    let cuentas = [];
    var table = $('#table').DataTable({
        dom: 'Bfrtip',
        buttons: []
    });

    $("#regresar-cuenta").click(() => {
        $(".table-content").show();
        $(".cuentas_efectivo").hide();
    });

    if ($(".info") && $(".info").data("id")) {
        $("#crear-cuenta").text("Editar cuenta");
        let data = { id: $(".info").data("id") };
        $.ajax({
            data,
            type: "POST",
            url: uriControllers + "datos/cuentas-get.php",
        }).done(function (res) {
            let data = JSON.parse(res);
            if (data && data.cuenta) {
                let cuenta = data.cuenta;
                $(".nombre input").val(cuenta.nombre);
                $(".tipo select").val(cuenta.tipo);
                $(".numero input").val(cuenta.numero);
                $(".banco input").val(cuenta.banco);
            }
        });
    }

    $("#guardar-cuenta").click(function () {
        var valido = true;
        var mensaje = "";

        if ($(".nombre input").val() == "") {
            mensaje += "<br> - Debe ingresar un nombre.";
            valido = false;
        }
        if ($(".tipo select").val() == 0) {
            mensaje += "<br> - Debe seleccionar un tipo de cuenta.";
            valido = false;
        }
        if ($(".numero input").val() == "") {
            mensaje += "<br> - Debe ingresar un número de cuenta.";
            valido = false;
        }
        if ($(".banco input").val() == "") {
            mensaje += "<br> - Debe ingresar un banco.";
            valido = false;
        }
        

        if (!valido) {
            Swal.fire({
                title: 'Información faltante.',
                html: mensaje,
                icon: 'warning',
                confirmButtonColor: "#1D9993",
                confirmButtonText: 'Cerrar'
            });
        } else {
            let data = {
                "nombre": $(".nombre input").val().toUpperCase(),
                "tipo": $(".tipo select").val(),
                "numero": $(".numero input").val(),
                "banco": $(".banco input").val()
            };
            let url = uriControllers + ( $(".info").data("id") ? "datos/editar-cuenta.php" : "datos/crear-cuenta.php" );
            if ($(".info").data("id")) data.id = $(".info").data("id");
            
            $.ajax({
                data,
                type: "POST",
                url: url,
            }).done(function (res) {
                console.log(res);
                if(res.success){
                    Swal.fire({
                        title: 'Cuentas',
                        html: $(".info").data("id") ? "La cuenta ha sido editada." : "La cuenta ha sido creada.",
                        icon: 'success',
                        confirmButtonColor: "#1D9993",
                        confirmButtonText: 'Cerrar'
                    }).then(() => {
                        window.location.href = "./cuentas.php";
                    });
                }else{
                    Swal.fire({
                        title: 'Cuentas',
                        html:"Ha ocurrido un error",
                        icon: 'error',
                        confirmButtonColor: "#1D9993",
                        confirmButtonText: 'Cerrar'
                    })
                }
            });
        }
    });

    $(".numero_documento input").on("blur", function () {
        let documento = $(this).val();
        let data = { documento };
        $.ajax({
            data,
            type: "POST",
            url: uriControllers + "datos/confirmar-documento.php",
        }).done(function (res) {
            let data = JSON.parse(res);
            if (data.cuenta && data.cuenta.id && data.cuenta.id != $(".info").data("id")) {
                Swal.fire({
                    title: 'Cuenta en efectivo',
                    html: "Este documento ya existe.",
                    icon: 'warning',
                    confirmButtonColor: "#1D9993",
                    confirmButtonText: 'Cerrar'
                });
            }
        });
    });

    $("input.entero").on("keydown", function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9]) !== -1 || ($.inArray(e.keyCode, [65, 67, 88]) !== -1 && (e.ctrlKey === true || e.metaKey === true)) || (e.keyCode >= 35 && e.keyCode <= 39)) {
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