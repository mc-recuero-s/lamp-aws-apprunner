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
	console.log(121321);
	$("body section").addClass("visible");

	$(".login").css("min-height",$(window).height()-($("header").outerHeight()+$(".info").outerHeight()+160))

	$("body .login .btns .btn-login").click(function(){
		var data1={
			usuario: $("#usuario").val(),
			contrasena: $("#contrasena").val()
		}
		$.ajax({
				type: "POST",
				url: "./controllers/login/login.php",
				data:data1,
				success: function(data) {
					var json = data;
					console.log(json);
					if(json.success){
						localStorage.setItem("token", json.data.token);
						window.location.href = "./index.php";
					}else{
						Swal.fire({
							position: 'top-end',
							icon: 'error',
							title: json.message,
							showConfirmButton: false,
							timer: 1500
						})
					}
				}
		})
	})
	$("body .login .btns .btn-login2").click(function(){
		window.location.href = "./index.php";
	})
	/*Swal.fire({
		title: 'Error!',
		text: 'Do you want to continue',
		icon: 'error',
		confirmButtonText: 'Cool'
	});*/
	// moment.lang('es', {
	// 	months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'.split('_'),
	// 	monthsShort: 'Enero_Feb_Mar_Abr_May_Jun_Jul_Ago_Sept_Oct_Nov_Dec'.split('_'),
	// 	weekdays: 'Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado'.split('_'),
	// 	weekdaysShort: 'Dom_Lun_Mar_Mier_Jue_Vier_Sab'.split('_'),
	// 	weekdaysMin: 'Do_Lu_Ma_Mi_Ju_Vi_Sa'.split('_')
	// 	}
	// );

});
