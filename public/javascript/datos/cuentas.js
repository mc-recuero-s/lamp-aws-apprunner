$(document).ready(function () {
    var uriControllers = "./controllers/";
    let cuentas = [];
    var table = $('#table').DataTable({
        dom: 'Bfrtip',
        buttons: []
    });

    let init = function(){
        cuentas = [];
        $.ajax({        
            type: "POST",
            url: uriControllers + "datos/cuentas.php",
        })
        .done(function (data) {
            var data = JSON.parse(data);
            cuentas = data.cuentas;            
            let data1 = [];
            cuentas.forEach(function (cuenta) {
                let buttons = '';            
                buttons += '<a class="button btn-editar" title="Editar" href="./cuentas-editar.php?id=' + cuenta.id + '"></a>';
                buttons += '<div class="button btn-delete" title="Eliminar"></div>';
                data1.push([cuenta.id, cuenta.nombre, cuenta.banco, cuenta.tipo, cuenta.numero, buttons]);
            })
            table.clear();
            table.rows.add(data1);
            table.draw();
        })
    }

    init();


    $('#table tbody').on('click', '.btn-delete', function () {
        var data = table.row($(this).parents('tr')).data();
        let idCuenta = data[0];
        Swal.fire({
            title: 'Eliminar Cuenta',
            text: '¿Está seguro de eliminar la cuenta con ID ' + idCuenta + '?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'No'
        }).then((result) => {
            console.log(result);
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: uriControllers + 'datos/eliminar-cuenta.php',
                    data: { id: idCuenta }
                })
                .done(function (res) {
                    let response = res
                    if (response.success) {
                        Swal.fire({
                            title: 'Cuenta eliminada',
                            text: response.message,
                            icon: 'success'
                        }).then(() => {
                        });
                        init();
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: response.message,
                            icon: 'error'
                        });
                    }
                });
            }
        });
    });
});
