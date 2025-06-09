$(document).ready(function () {
  let startEntradas=null;
  let endEntradas=null;
  let labelEntradas=null;
  let startSalidas=null;
  let endSalidas=null;
  let labelSalidas=null;
  $('input[name="daterange"]').daterangepicker({
    opens: 'left',
		"locale": {
        "format": "DD/MM/YYYY",
        "separator": " - ",
        "applyLabel": "Confirmar",
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
  }, function(start, end, label) {
    startEntradas= start;
    endEntradas= end;
    labelEntradas= label;
  });

  $("#exportar-entradas").click(()=>{
    buscarEntradas();
  })

  var buscarEntradas=function(){
		var data1 = {
			inicio: startEntradas.format('YYYY-MM-DD'),
			fin: endEntradas.format('YYYY-MM-DD'),
		};
    $(".loading").stop().css("display","flex");
		$.ajax({
      data: data1,
			type: "POST",
			url: "./controllers/exportar/exportar-referencias.php",
      dataType: 'text', 
      success: function(data) {
        
        var csvContent = "\uFEFF" + data;
        var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        var url = URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        a.download = 'referencias-'+startEntradas.format('YYYY-MM-DD')+" "+endEntradas.format('YYYY-MM-DD')+'.csv';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);


        $.ajax({
          data: data1,
          type: "POST",
          url: "./controllers/exportar/exportar-entradas-salidas.php",
          dataType: 'text', 
          success: function(data) {
            
            var csvContent = "\uFEFF" + data;
            var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            var url = URL.createObjectURL(blob);
            var a = document.createElement('a');
            a.href = url;
            a.download = 'entradas-salidas-'+startEntradas.format('YYYY-MM-DD')+" "+endEntradas.format('YYYY-MM-DD')+'.csv';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
            $(".loading").stop().fadeOut();
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error en la descarga:', textStatus, errorThrown);
          }
        })
        .done(function( data, textStatus, jqXHR ) {
          console.log(data);
        })
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.error('Error en la descarga:', textStatus, errorThrown);
      }
		})
		.done(function( data, textStatus, jqXHR ) {
      console.log(data);
    })
  }
})