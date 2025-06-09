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
                data1.push([cuenta.id, cuenta.nombre, cuenta.tipo, cuenta.documento, cuenta.correo, cuenta.celular, cuenta.creacion, buttons]);
            })
            table.clear();
            table.rows.add(data1);
            table.draw();
        })
    }

    init();
});
