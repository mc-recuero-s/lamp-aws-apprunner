$(document).ready(function () {
    var uriControllers = "./controllers/";    
    $(".actualizar").click(function(){
        $(".loading").stop().css("display","flex");
        var item={};
        item.nombre=$(".editarPerfil input").eq(0).val();
        item.apellido=$(".editarPerfil input").eq(1).val();
        item.correo=$(".editarPerfil input").eq(2).val();
        item.usuario=$(".editarPerfil input").eq(3).val();
        item.contrasena=$(".editarPerfil input").eq(4).val();

        $.ajax({
          data: item,
          type: "POST",
          url: uriControllers+"perfil/perfil.php",
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


});
