// Datepicker Config
$(document).ready(function() {

	var uriControllers= "./controllers/";


	var c1= "#64a405";
	var c2= "#F58634";
	var c3= "#D9D90D";
	var c4= "#ddf69a";
	var c5= "#f8ffb1";

	var c6= "#d48404";
	var c7= "#d48404";
	var c8= "#d48404";
	var c9= "#87E6AB";
	var c10= "#96FFBF";

	var c11= "#718077";
	var c12= "#1D9993";

	var benefactor=[];
	var categoria=[];

	/*Swal.fire({
		title: 'Error!',
		text: 'Do you want to continue',
		icon: 'error',
		confirmButtonText: 'Cool'
	});*/
	moment.lang('es', {
		months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'.split('_'),
		monthsShort: 'Enero._Feb._Mar_Abr._May_Jun_Jul._Ago_Sept._Oct._Nov._Dec.'.split('_'),
		weekdays: 'Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado'.split('_'),
		weekdaysShort: 'Dom._Lun._Mar._Mier._Jue._Vier._Sab.'.split('_'),
		weekdaysMin: 'Do_Lu_Ma_Mi_Ju_Vi_Sa'.split('_')
		}
	);
  $(".check-in").datepicker({
    dateFormat: "d MM yy",
    duration: "medium",
		closeText: 'Cerrar',
		prevText: '<Ant',
		nextText: 'Sig>',
		currentText: 'Hoy',
		monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
		dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
		weekHeader: 'Sm',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''
  });

	$(".index").css("min-height",$(window).height()-($("header").outerHeight()+$(".index").outerHeight()+70))
	var nuevoFijo= false;
	$( window ).scroll(function() {
		if($(window ).scrollTop() > $("header").outerHeight()+$(".index").outerHeight()+30){
			nuevoFijo= true;
			$(".nuevo").addClass("nuevoFijo")
		}else{
			nuevoFijo= false;
			$(".nuevo").removeClass("nuevoFijo")
		}
	});

});
