$(document).ready(function () {

    var uriControllers = "./controllers/";


    $(".completaEntradas").click(function () {

        // console.log(JSON.stringify(data));
        // Ajax para el backup
        $(".loading").stop().css("display","flex");
        console.log(location);
        $.ajax({
            type: "GET",
            url: uriControllers + "configuracion/completarEntradas.php",
        })

        .done(function( data, textStatus, jqXHR ) {
            console.log(data);
            $(".loading").stop().fadeOut(function(){
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Hecho',
                    showConfirmButton: false,
                    timer: 1500
                })
            });
        })
        .fail(function( jqXHR, textStatus, errorThrown ) {
            console.log(jqXHR);
            $(".loading").stop().fadeOut(function(){
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Error, intentar nuevamente',
                    showConfirmButton: false,
                    timer: 1500
                })
            });
        });

    })

    $(".backup").click(function () {

        // console.log(JSON.stringify(data));
        // Ajax para el backup
        console.log(location);
        $(".loading").stop().css("display","flex");

        $.ajax({
            type: "GET",
            url: uriControllers + "configuracion/backup.php",
        })

        .done(function( data, textStatus, jqXHR ) {

            $(".loading").stop().fadeOut(function(){
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Hecho',
                    showConfirmButton: false,
                    timer: 1500
                })
            });
        })
        .fail(function( jqXHR, textStatus, errorThrown ) {
            console.log(jqXHR);
            $(".loading").stop().fadeOut(function(){
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Error, intentar nuevamente',
                    showConfirmButton: false,
                    timer: 1500
                })
            });
        });

    })

    $(".excel").click(function () {

        // console.log(JSON.stringify(data));
        // Ajax para el excel
        console.log(location);
        $(".loading").stop().css("display","flex");

        $.ajax({
            type: "GET",
            url: uriControllers + "configuracion/excel.php",
        })

        .done(function( data, textStatus, jqXHR ) {

            $(".loading").stop().fadeOut(function(){
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Hecho',
                    showConfirmButton: false,
                    timer: 1500
                })
            });
        })
        .fail(function( jqXHR, textStatus, errorThrown ) {
            console.log(jqXHR);
            $(".loading").stop().fadeOut(function(){
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Error, intentar nuevamente',
                    showConfirmButton: false,
                    timer: 1500
                })
            });
        });

    })

});
