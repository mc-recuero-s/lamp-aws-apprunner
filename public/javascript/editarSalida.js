// Datepicker Config

var cssFactura =
	'@charset "UTF-8";@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,800&effect=3d-float);@import url(./styles/includes/all.css);@import url(https://fonts.googleapis.com/css?family=Lato:400,400i,700);@import url(https://fonts.googleapis.com/css?family=Inconsolata:400,400i,700);a{text-decoration:none}*{font-family:Lato;font-weight:400;list-style:none;margin:0;padding:0}h1{font-size:28px;font-weight:600;font-stretch:normal;font-style:normal;line-height:1.14;letter-spacing:normal;color:#000}h2{font-size:20px;font-weight:400;font-stretch:normal;font-style:normal;line-height:1.2;letter-spacing:normal;color:#000}h3{font-size:16px;font-weight:700;font-stretch:normal;font-style:normal;line-height:1;letter-spacing:normal;color:#000}h4{font-size:14px;font-weight:700;font-stretch:normal;font-style:normal;line-height:1.71;letter-spacing:normal;color:#000}h5{font-size:14px;font-weight:400;font-stretch:normal;font-style:normal;line-height:1.14;letter-spacing:normal;color:#000}p{font-size:14px;font-weight:400;font-stretch:normal;font-style:normal;line-height:1.14;letter-spacing:normal;color:#000}p.small{font-size:12px;font-weight:400;font-stretch:normal;font-style:normal;line-height:1.33;letter-spacing:normal;color:#000}p.bold{font-weight:700;font-stretch:normal;font-style:normal;line-height:1.14;letter-spacing:normal;color:#000}.tab{text-transform:uppercase;font-size:12px;font-weight:900;font-stretch:normal;font-style:normal;line-height:1.33;letter-spacing:1.5px;color:#D9D90D}.labelSmall{width:72px;font-size:12px;font-weight:400;font-stretch:normal;font-style:normal;line-height:1.33;letter-spacing:1px;color:#D9D90D}.labelSmallLink{width:110px;font-size:12px;font-weight:900;font-stretch:normal;font-style:normal;line-height:1.33;letter-spacing:1px;color:#D9D90D}.dropdownMenu{width:186px;height:16px;font-size:13px;font-weight:600;font-stretch:normal;font-style:normal;line-height:1.85;letter-spacing:normal;color:#D9D90D}.navigationLink{width:94px;height:24px;font-size:14px;font-weight:600;font-stretch:normal;font-style:normal;line-height:1.14;letter-spacing:normal;color:#D9D90D}.rectangle1{cursor:pointer;margin:5px 0;width:210px;height:40px;background-color:#D9D90D;color:#fff;display:flex;justify-content:center;align-items:center;font-size:14px;font-weight:700;font-stretch:normal;font-style:normal;line-height:1.14;letter-spacing:normal}.rectangle1:hover{background-color:#d48404}.rectangle2{cursor:pointer;margin:5px 0;width:210px;height:40px;background-color:#64a405;color:#fff;display:flex;justify-content:center;align-items:center;font-size:14px;font-weight:700;font-stretch:normal;font-style:normal;line-height:1.14;letter-spacing:normal}.rectangle2:hover{background-color:#71bf8f}.rectangle3{cursor:pointer;margin:5px 0;width:210px;height:40px;background-color:#71bf8f;color:#000;display:flex;justify-content:center;align-items:center;font-size:14px;font-weight:700;font-stretch:normal;font-style:normal;line-height:1.14;letter-spacing:normal}.rectangle3:hover{background-color:#4b805f}.rectangle4{display:flex;justify-content:center;align-items:center;cursor:pointer;width:212px;height:64px;box-shadow:0 0 2px 0 rgba(42,47,51,.4);background-color:#fff}.rectangle4 .ico{width:20%}.rectangle4 p{width:70%;margin-left:10%;font-family:Lato;font-size:14px;font-weight:700;font-stretch:normal;font-style:normal;line-height:1.14;letter-spacing:normal;color:#ddf69a}.separe{width:350px;height:1px;background-color:#e5e5e6;margin:20px 0}.tab{cursor:pointer;font-size:12px;font-weight:900;font-stretch:normal;font-style:normal;line-height:1.33;letter-spacing:1.5px;color:#4b805f;height:30px;padding:3px 10px;display:flex;justify-content:center;align-items:center;border-bottom:2px #fff solid}.tab:hover{color:#4b805f;border-bottom:2px #4b805f solid}.tab.active{color:#D9D90D;border-bottom:2px #F58634 solid}.tab.active:hover{color:#D9D90D;border-bottom:2px #F58634 solid}input{padding:0 2px}input[type=radio]{width:20px;height:20px;position:relative;cursor:pointer}input[type=radio]:before{cursor:pointer;content:"";width:20px;height:20px;position:absolute;top:0;bottom:0;left:0;right:0;margin:auto;border:solid 1px #4b805f;border-radius:50%;background:#fff}input[type=radio]:checked{width:20px;height:20px;position:relative;cursor:pointer}input[type=radio]:checked:before{content:"";width:20px;height:20px;position:absolute;top:0;bottom:0;left:0;right:0;margin:auto;border:solid 1px #F58634;border-radius:50%;background:#fff;cursor:pointer}input[type=radio]:checked:after{content:"";width:12px;height:12px;position:absolute;top:4px;bottom:0;left:5px;right:0;border-radius:50%;background:#F58634;cursor:pointer}input[type=checkbox]{width:20px;height:20px;position:relative;cursor:pointer}input[type=checkbox]:before{content:"";width:20px;height:20px;position:absolute;top:0;bottom:0;left:0;right:0;margin:auto;border:solid 1px #4b805f;border-radius:3px;background:#fff;cursor:pointer}input[type=checkbox]:checked{width:20px;height:20px;position:relative;cursor:pointer}input[type=checkbox]:checked:before{content:"";width:20px;height:20px;position:absolute;top:0;bottom:0;left:0;right:0;margin:auto;border:solid 1px #F58634;border-radius:3px;background:#fff;cursor:pointer}input[type=checkbox]:checked:after{content:"";width:12px;height:12px;font-size:14px;font-family:FontAwesome;font-weight:200;position:absolute;top:3px;bottom:0;left:4px;right:0;color:#F58634}.groupForm{display:flex;flex-wrap:wrap;margin:10px 0;max-width:200px;box-shadow:none!important;outline:0!important}.groupForm label{width:100%;font-size:12px;color:#F58634;position:relative}.groupForm label:before{content:"";width:12px;height:12px;font-size:12px;font-family:FontAwesome;font-weight:200;position:relative;color:#F58634;margin-right:5px}.groupForm input{width:100%;margin-left:5px;height:20px;border:1px solid #D9D90D}.groupForm input:focus{box-shadow:none!important;outline:0!important}.groupForm select{width:100%;margin-left:5px;height:21px;border:1px solid #D9D90D;background:#fff;border-radius:0!important}.groupForm select:focus{box-shadow:none!important;outline:0!important}.btn{cursor:pointer;margin:5px 2px;padding:3px 10px;height:40px;color:#000;display:flex;justify-content:center;align-items:center;font-size:14px;font-weight:700;font-stretch:normal;font-style:normal;line-height:1.14;letter-spacing:normal;display:flex;flex-wrap:nowrap;justify-content:center;align-items:center}.btn:after{content:"";width:12px;height:12px;font-size:14px;font-family:FontAwesome;font-weight:200;color:#71bf8f}.btn:hover:after{color:#d48404}*{list-style:none;font-family:Inconsolata}.hide{display:none}.factura{display:flex;flex-wrap:wrap;width:90%;padding:0 5% 5% 5%}.factura .header{display:flex;flex-wrap:nowrap;justify-content:center;align-items:center;flex-wrap:wrap;width:90%;padding:0 5%;height:110px;margin-bottom:10px}.factura .header > p{color: white; font-size:0px;} .factura .header .logo{height:90%;width:50%;display:flex;flex-wrap:nowrap;justify-content:center;align-items:center;justify-content:flex-start}.factura .header .logo img{max-width:50%;max-height:80px}.factura .header .informe{width:50%;height:90%}.factura .header .informe *{text-align:right}.factura .header .informe h4{margin:20px 0 0 0}.factura .header .fecha{height:10%;width:100%;display:flex;flex-wrap:nowrap;justify-content:center;align-items:center}.factura .header .fecha p{text-align:right;width:20%}.factura .header .fecha p:first-child{width:80%;text-align:left}.factura .header .fecha p:first-child span{text-decoration:underline}.factura .lotes{width:100%}.factura .lotes ul span{display:none}.factura .lotes ul li{display:flex;flex-wrap:nowrap;justify-content:center;align-items:center;flex-wrap:nowrap;justify-content:space-between;height:16px;width:100%}.factura .lotes ul li p:nth-child(1){text-align:rigth}.factura .lotes ul li p:nth-child(2){}.factura .lotes ul li:first-child{border-bottom: 1px solid black;background:#bbb;text-transform:uppercase;height:20px}.factura .lotes ul li:first-child p{text-align:center;font-size:14px}.factura .lotes ul li p{text-align:center;width:100%;text-transform:uppercase;font-size:13px;overflow:hidden}.factura .lotes ul li p:first-child{width:15%}.factura .lotes ul li p:nth-child(2){width:15%}.factura .lotes ul li p:nth-child(3){width:25%}.factura .lotes ul li p:nth-child(4){width:45%}.factura .footer{width:100%;flex-wrap:wrap}.factura .footer .institucion{border-top:1px solid #000;border-bottom:1px solid #000;width:96%;padding:1% 2% 3px 2%}.factura .footer .institucion .nombre{display:flex;flex-wrap:nowrap;justify-content:center;align-items:center;flex-wrap:wrap;width:100%}.factura .footer .institucion .nombre>div{display:flex;flex-wrap:nowrap;justify-content:center;align-items:center;width:70%;flex-wrap:nowrap;justify-content:flex-start}.factura .footer .institucion .nombre>div:first-child{flex-wrap:wrap;width:100%}.factura .footer .institucion .nombre>div:first-child h4{width:100%}.factura .footer .institucion .nombre>div:first-child p{width:100%}.factura .footer .institucion .nombre>div h4{text-transform:uppercase;text-align:left;font-size:15px}.factura .footer .institucion .nombre>div p{text-transform:uppercase;font-size:15px}.factura .footer .institucion .nombre h6{width:30%;font-size:15px;text-align:right}.factura .footer .factura{display:flex;flex-wrap:nowrap;justify-content:center;align-items:center;flex-wrap:wrap;border-bottom:1px solid #000;padding:1% 2% 3px 2%;width:96%}.factura .footer .factura>div{width:100%;display:flex;flex-wrap:nowrap;justify-content:center;align-items:center;flex-wrap:wrap}.factura .footer .factura>div p{margin:5px 0;width:100%;font-size:15px}.factura .footer .factura h6{font-size:14px;width:100%;font-style:italic;text-align:center;font-weight:700;padding-top:3px;border-top:1px solid #000}.factura .footer .direccion{width:100%;padding-top:5px;font-size:13px}.factura .footer .direccion p{display:flex;flex-wrap:nowrap;justify-content:center;align-items:center;flex-wrap:nowrap;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;font-size:9.2px}';


var positionArrayId=function(arr,id,property){
  var index=-1;
  var filteredObj = arr.find(function(item, i){
    if(item[property] == id){
      index = i;
      return i;
    }
  });
  return index;
}

var selectBeneficiado, selectRecibido, selectBenefactor, selectCategoria;
$(document).ready(function () {

	$("body .acciones .limpiar").hide();
	$("#myiframe").remove();
	var editarSalidaA=[];
	$("body .content-lote > ul li").map(function(i,it){
		var it2={};
		$(it).addClass("original");
		it2.original= true;
		it2.benefactor= $(it).find("> div").eq(4).find("p").text().split("-")[1];
		it2.cantidadOriginal= $(it).find("> div").eq(0).find("p").eq(1).text();
		// it2.existencia= 0;
		$(it).find("> div").eq(0).find("p").eq(1).text(Number($(it).find("> div").eq(0).find("p").eq(1).text()));
		it2.cantidad2= Number($(it).find("> div").eq(0).find("p").eq(1).text());
		it2.categoria= $(it).find("> div").eq(2).find("p").text();
		it2.codBenefactor= $(it).find("> div").eq(4).find("p").text().split("-")[0];

		it2.id= $(it).data("id");
		it2.id_lote= $(it).data("id");
		it2.id2= $(it).data("id2");
		it2.total= $(it).data("total");
		it2.cantidad= $(it).data("cantidad");
		it2.lote= $(it).find("> div").eq(3).find("p").text();;
		it2.producto= $(it).find("> div").eq(6).find("p").text();
		it2.unidad= $(it).find("> div").eq(1).find("p").text();
		it2.vencimiento= $(it).find("> div").eq(7).find("p").text();
		editarSalidaA.push(it2);
	});
	console.log(editarSalidaA);
	localStorage.setItem("editarEntradas",JSON.stringify(editarSalidaA));


	$('body header').hide();
	$('body footer').hide();

	var uriControllers= "./controllers/";

	var benefactor=[];
	var beneficiado=[];
	var categoria=[];
	var lotesActuales=[];
	var entradasActuales=[];
	var entrada="-1";

	var c1 = "#64a405";
	var c2 = "#F58634";
	var c3 = "#D9D90D";
	var c4 = "#ddf69a";
	var c5 = "#f8ffb1";

	var c6 = "#d48404";
	var c7 = "#d48404";
	var c8 = "#d48404";
	var c9 = "#87E6AB";
	var c10 = "#96FFBF";

	var c11 = "#718077";
	var c12 = "#1D9993";

	/*Swal.fire({
		title: 'Error!',
		text: 'Do you want to continue',
		icon: 'error',
		confirmButtonText: 'Cool'
	});*/
	moment.locale("es", {
		// months: "Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre".split(
		// 	"_"
		// ),
		// monthsShort: "Enero._Feb._Mar_Abr._May_Jun_Jul._Ago_Sept._Oct._Nov._Dec.".split(
		// 	"_"
		// ),
		// weekdays: "Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado".split("_"),
		// weekdaysShort: "Dom._Lun._Mar._Mier._Jue._Vier._Sab.".split("_"),
		// weekdaysMin: "Do_Lu_Ma_Mi_Ju_Vi_Sa".split("_")
	});
	$(".check-in").datepicker({
		dateFormat: "d MM yy",
		duration: "medium",
		closeText: "Cerrar",
		prevText: "<Ant",
		nextText: "Sig>",
		currentText: "Hoy",
		// monthNames: [
		// 	"Enero",
		// 	"Febrero",
		// 	"Marzo",
		// 	"Abril",
		// 	"Mayo",
		// 	"Junio",
		// 	"Julio",
		// 	"Agosto",
		// 	"Septiembre",
		// 	"Octubre",
		// 	"Noviembre",
		// 	"Diciembre"
		// ],
		// monthNamesShort: [
		// 	"Ene",
		// 	"Feb",
		// 	"Mar",
		// 	"Abr",
		// 	"May",
		// 	"Jun",
		// 	"Jul",
		// 	"Ago",
		// 	"Sep",
		// 	"Oct",
		// 	"Nov",
		// 	"Dic"
		// ],
		// dayNames: [
		// 	"Domingo",
		// 	"Lunes",
		// 	"Martes",
		// 	"Miércoles",
		// 	"Jueves",
		// 	"Viernes",
		// 	"Sábado"
		// ],
		// dayNamesShort: ["Dom", "Lun", "Mar", "Mié", "Juv", "Vie", "Sáb"],
		// dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sá"],
		weekHeader: "Sm",
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ""
	});

	setTimeout(function(){
		console.log($(".editarSalida").data("fecha"));
		console.log($(".editarSalida .fechaInput"));
		$(".editarSalida .fechaInput").val(moment($(".editarSalida").data("fecha")).format("D MMMM YYYY"));
		// $(".editarSalida .fechaInput").val("");
	},500)
	// $(".fechaInput").datepicker().datepicker("setDate", "0");
	// $(".vencimiento").datepicker().datepicker("setDate", "0");

	$(".lote")
		.datepicker({
			dateFormat: "ddmmy"
		})
		.datepicker("setDate", "0");
		$(".lote").val("");
	$(".check-out").datepicker({
		dateFormat: "d MMMM yy",
		duration: "medium"
	});

	$(".subir").click(function () {
		var body = $("html, body");
		body.stop().animate({ scrollTop: 0 }, 500, "swing", function () {});
	});

	$(".crear").click(function () {
		var lotes = $(".content-lote > ul li").length;
		var valido=true;
		var mensaje="";

		if(!(moment($("body .info .fechaInput").val())._isValid)){
			mensaje=mensaje+"<br> - Debe colocar una fecha válida.";
			valido=false;
		};
		if(beneficiado[1]==undefined){
			mensaje=mensaje+"<br> - Debe seleccionar una institución Beneficiada.";
			valido=false;
		};
		if(!($("body .info .recibido .selectize-control .item").html())){
			mensaje=mensaje+"<br> - Debe seleccionar quien recibe.";
			valido=false;
		};
		if($("body .info .recibido .number").val()==""){
			mensaje=mensaje+"<br> - Debe digitar el documento de quien recibe.";
			valido=false;
		};
		if($("body .info .factura .facturaNumber").val()==""){
			mensaje=mensaje+"<br> - Debe digitar el número de la factura.";
			valido=false;
		};
		if(lotes<1){
			mensaje=mensaje+"<br> - Debe crear como mínimo 1 lote.";
			valido=false;
		};
		if(!valido){
			Swal.fire({
				title: 'Información faltante.',
				html: mensaje,
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: c12,
				confirmButtonText: 'Cerrar'
			})
		}else{
			$(".modalSaciar").css("display", "flex");
			$(".modalSaciar-contenido > div").hide();
			$(".modalSaciar-editar-justificar").css("display", "flex");
			$(".modalSaciar h4").text("Justificar cambio");
			$("body, html").css("overflow", "hidden");
		}
	});

	$("#crear-edicion").click(function () {
		var lotes = $(".content-lote > ul li").length;
		var valido=true;
		var mensaje="";
		if($("#causa").val()==""){
			mensaje=mensaje+"<br> - Debe digitar una causa de la edición.";
			valido=false;
		};
		if($("#descripcion").val()==""){
			mensaje=mensaje+"<br> - Debe digitar una descripción de la edición.";
			valido=false;
		};
		if(!valido){
			Swal.fire({
				title: 'Información faltante.',
				html: mensaje,
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: c12,
				confirmButtonText: 'Cerrar'
			})
		}else{

			Swal.fire({
				title: "Estás seguro?",
				text: "Desea editar esta salida con " + lotes + " lotes!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: c12,
				cancelButtonColor: "#d33",
				confirmButtonText: "Sí, Editar!",
				cancelButtonText: "Cancelar",
				content: { element: "textarea" },
			}).then((result) => {
				if (result.value) {
					$(".loading").stop().css("display","flex");
					var data = {};
					data.id = $(".editarSalida").data("id");
					data.fecha = moment($("body .info .fechaInput").val()).format("YYYY-MM-DD HH:mm:ss");
					data.beneficiado = beneficiado[0];
					data.beneficiadoNombre = $("#beneficiado option").text();
					data.nit = beneficiado[1];
					data.recibido = $("body .info .recibido .selectize-control .item").html();
					data.cedula = $("body .info .recibido .number").val();
					data.factura = $("body .info .factura .facturaNumber").val();
					data.causa = $("#causa").val();
					data.justificacion = $("#descripcion").val();
					data.usuario = localStorage.getItem("user");
					data.lotes = [];
					data.lotesEliminados = [];
					data.lotesEditados = [];
					$(".content-lote > ul li").not(".original").map(function (i, it) {
						var item = {};
						item.id = $(this).data("id");
						item.cantidad = $(this).find("> div").eq(0).find("p").eq(1).text();
						item.unidad = $(this).find("> div").eq(1).find("p").text();
						item.categoria = $(this).find("> div").eq(2).find("p").text();
						item.lote = $(this).find("> div").eq(3).find("p").text();
						item.codigoBenefactor = $(this).find("> div").eq(4).find("p").text();
						item.benefactor = $(this).find("> div").eq(5).find("p").text();
						item.producto = $(this).find("> div").eq(6).find("p").text();
						item.vencimiento = $(this).find("> div").eq(7).find("p").text();
						data.lotes.push(item);
					});

					data.lotesEliminados = [];
					$(".content-lote > ul li.eliminado").map(function (i, it) {
						var item = {};
						item.id = $(this).data("id");
						item.id2 = $(this).data("id2");
						item.cantidad = $(this).find("> div").eq(0).find("p").eq(1).text();
						item.unidad = $(this).find("> div").eq(1).find("p").text();
						item.categoria = $(this).find("> div").eq(2).find("p").text();
						item.lote = $(this).find("> div").eq(3).find("p").text();
						item.codigoBenefactor = $(this).find("> div").eq(4).find("p").text();
						item.benefactor = $(this).find("> div").eq(5).find("p").text();
						item.producto = $(this).find("> div").eq(6).find("p").text();
						item.vencimiento = $(this).find("> div").eq(7).find("p").text();
						data.lotesEliminados.push(item);
					});

					data.lotesEditados = [];
					$(".content-lote > ul li.editado").map(function (i, it) {
						var item = {};
						item.id = $(this).data("id");
						item.id2 = $(this).data("id2");
						item.cantidad = $(this).find("> div").eq(0).find("p").eq(1).text();
						item.unidad = $(this).find("> div").eq(1).find("p").text();
						item.categoria = $(this).find("> div").eq(2).find("p").text();
						item.lote = $(this).find("> div").eq(3).find("p").text();
						item.codigoBenefactor = $(this).find("> div").eq(4).find("p").text();
						item.benefactor = $(this).find("> div").eq(5).find("p").text();
						item.producto = $(this).find("> div").eq(6).find("p").text();
						item.vencimiento = $(this).find("> div").eq(7).find("p").text();
						data.lotesEditados.push(item);
					});
					var files=[];
					$('body .info .listFiles li').map(function(i,it){
						files.push($(this).find("img").attr("src"));
					})
					data.files= files;
					console.log(data);
					localStorage.setItem("salidaActual",JSON.stringify(data));
					$('.editado').click();
					$.ajax({
						data: data,
						type: "POST",
						url: uriControllers+"salida/editarSalida.php",
					})
					.done(function( data, textStatus, jqXHR ) {
						console.log(data);
						// $(".content-lote ul").empty();
						// $("body .info .institucion input").val("")
						// selectRecibido[0].selectize.setValue("");
						// $("body .info .recibido input").val("")
						// $(".info .factura .facturaNumber").val("");
						// beneficiado=[];
						// $('.fechaInput').datepicker().datepicker("setDate", "0");
						// $('.vencimiento').datepicker().datepicker("setDate", "1");
						// selectBeneficiado[0].selectize.setValue("");
						// $("body .info .listFiles").empty();
						// localStorage.setItem("editarEntradas","[]");
						// localStorage.setItem("infoSalida","{}");

						$(".loading").stop().fadeOut(function(){
							Swal.fire({
								position: 'top-end',
								icon: 'success',
								title: 'Hecho',
								showConfirmButton: false,
								timer: 1500
							})
						});
						$('.reset-busqueda').click();
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
				}
			});
		}
	});

	$(".limpiar").click(function () {
		var lotes = $(".content-lote > ul li").length;
		Swal.fire({
			title: "Estás seguro?",
			text: "Desea limpiar esta salida con " + lotes + " lotes!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: c12,
			cancelButtonColor: "#d33",
			confirmButtonText: "Sí, Limpiar!",
			cancelButtonText: "Cancelar"
		}).then((result) => {
			if (result.value) {
				$(".content-lote > ul").empty();
				$("body .info .institucion input").val("");
				selectRecibido[0].selectize.setValue("");
				$("body .info .recibido input").val("");
				localStorage.setItem("editarEntradas","[]");
			}
		});
	});

	// if($(".info .factura .facturaNumber").val()==""){
	// 	var facturaActual="";
	// 	if($("body .info .factura p").text()!=""){
	// 		facturaActual=($("body .info .factura p").text()).split("-")[1];
	// 	}
	// 	$(".info .factura .facturaNumber").val(moment().format("YYYY-")+(Number(facturaActual)));
	// }

	// $("body .info .factura .facturaNumber").focusout(function(){
	// 	var infoSalida=localStorage.getItem("infoSalida");
	// 	if(infoSalida){
	// 		infoSalida=JSON.parse(infoSalida);
	// 		infoSalida.factura=$(this).val();
	// 		localStorage.setItem("infoSalida",JSON.stringify(infoSalida));
	// 	}else{
	// 		localStorage.setItem("infoSalida","{}");
	// 	}
	// })

	$(".secondMain .filters .btn").click(function () {
		$(this).parent().find(".btn").removeClass("active");
		$(this).addClass("active");
	});
	$(document).on("click", "body .entradas ol > li .masAcciones .mas", function () {
		var thisVisible = $(this).parent().find(".masAcciones-list").is(":visible");
		$(".masAcciones-list").hide();
		if (!thisVisible && $(this).parent().parent().css("opacity") == 1) {
			$(this).parent().find(".masAcciones-list").show();
		}
	});
	$("body .entradas ol > li .masAcciones .masAcciones-list li").click(
		function () {
			$(this).parent().hide();
		}
	);
	$(".busqueda .buscar").click(function () {
		$("body .entradas .listaEntradas").height(
			$(window).height() - $(".secondMain").height()
		);
		$("body .entradas > ol").height(
			$(window).height() - $(".secondMain").height()
		);
		$("body").css("overflow", "hidden");

		$(".content-lote > ul").hide();
		$(".content-lote .busqueda").hide();
		$(".acciones").hide();
		$(".info").hide();
		// $(".resultados").css('display', 'flex');
		$(".content-lote .entradas").css("display", "flex");
		$("header").hide();
		$(".secondMain").show();

		$(".masAcciones-list").hide();

		$("body .entradas .listaEntradas ul").empty();
		$("body .entradas ol").empty();

		var body = $("html, body");
		body.stop().animate({ scrollTop: 0 }, 500, "swing", function () {});

		var entradas = localStorage.getItem("editarEntradas");
		entradas = entradas ? JSON.parse(entradas) : [];
		console.log(entradas);
		manual = false;
		$("body .entradas > ol > li").map(function (j, jt) {
			if ($(this).find(".btns input").is(":checked")) {
				$(this).find(".btns input").click();
			}
		});

		var vencimiento=(moment($("body .busqueda input").eq(7).val()).format("YYYY-MM-DD")=="Invalid date")?"":moment($("body .busqueda input").eq(7).val()).format("YYYY-MM-DD");

		var data={
			entradas: entradas,
			salida: salidaActual,
			cantidad: ($("body .busqueda input").eq(0).val()).replace(",","."),
			unidad: $("body .busqueda input").eq(1).val(),
			categoria: categoria[1],
			lote: $("body .busqueda input").eq(3).val(),
			benefactor: benefactor[1],
			producto: $("body .busqueda input").eq(6).val(),
			vencimiento: vencimiento
		};

		$(".loading").stop().css("display","flex");

		$.ajax({
			data: data,
			type: "POST",
			url: uriControllers+"entrada/buscarEntradasEditar.php",
		})
		.done(function( response, textStatus, jqXHR ) {
			var data=JSON.parse(response)

			var entradasResponse=data.data.entradas;
			var lotesResponse=data.data.lotes;
			entradasActuales = entradasResponse;
			lotesActuales = lotesResponse;

			var exitenciasEntradas=0;

			entradasResponse.map(function(it,i){
				var li="<li data-id="+it.id+"><h3>"+it.factura+"</h3><h4>"+it.benefactor+"</h4><h5>"+moment(it.fecha).format("DD/MM")+"</h5><h6>"+((it.existencia).toFixed(2)*1)+" Ex</h6></li>"
				exitenciasEntradas+=it.existencia;
				$("body .entradas .listaEntradas ul").append(li);
			})
			$("body .entradas .listaEntradas ul").prepend("<li data-id='-1'><h3></h3><h4>TODOS </h4><h5></h5><h6>"+(exitenciasEntradas).toFixed(2)+" Ex</h6></li>");

			$("body .entradas .listaEntradas ul li").eq(0).addClass("active");

			entradas.map(function(it,i){
				let posArray=positionArrayId(lotesResponse,it.id,"id");
				(posArray!=-1)?lotesResponse.splice(posArray,1):"";
			});

			console.log(entradas,lotesResponse);
			lotesResponse= entradas.concat(lotesResponse);

			lotesResponse.map(function(it,i){
				// var total = ((it.total)?(Number(it.cantidad)-Number(it.total)):it.cantidad);
				// var encontroEditando=false;
				// var cantidadEditando=0;
				// entradas.map(function (it2, i2) {
				// 	if(it.id==it2.id_lote && it2.original){
				// 		encontroEditando=true;
				// 		cantidadEditando=Number(it2.cantidad2);
				// 		total=Number(total)+Number(it2.cantidadOriginal);
				// 		it.total=(it.cantidad)-Number(total);
				// 	}
				// })
				if(it.cantidadOriginal){
					var total = it.total;
				}else{
					var total = ((it.total)?(Number(it.cantidad)-Number(it.total)):it.cantidad);
				}
				if(total>0 || it.cantidadOriginal){
					if(it.cantidadOriginal){
						var cant1=(Number(it.cantidad).toFixed(2)*1)-(Number(it.total).toFixed(2)*1)-(Number(it.cantidad2).toFixed(2)*1);
						var li=$('<li data-cantidad="'+it.cantidad+'" data-total="'+cant1+'" data-id2="'+it.id2+'" data-id="'+it.id+'" data-categoria="'+it.categoria+'" data-identrada="'+it.id_lote+'" data-lote="'+it.lote+'" data-producto="'+it.producto+'" data-unidad="'+it.unidad+'" data-vencimiento="'+it.vencimiento+'" data-benefactor="'+it.benefactor+'" data-codbenefactor="'+it.codBenefactor+'"></li>');
						li.addClass("original");
						li.attr("data-cantidadoriginal",it.cantidadOriginal);
						li.attr("data-cantidad2",it.cantidad2);
					}else{
						var li=$('<li data-cantidad="'+it.cantidad+'" data-total="'+(it.total)+'" data-id2="'+it.id2+'" data-id="'+it.id+'" data-categoria="'+it.categoria+'" data-identrada="'+it.id_lote+'" data-lote="'+it.lote+'" data-producto="'+it.producto+'" data-unidad="'+it.unidad+'" data-vencimiento="'+it.vencimiento+'" data-benefactor="'+it.benefactor+'" data-codbenefactor="'+it.codBenefactor+'"></li>');
					}

					li.append('<div class="btns"><p>'+((it.categoria)?it.categoria:"")+((it.lote)?it.lote:"")+((it.codBenefactor)?it.codBenefactor:"")+'</p><input type="checkbox" name="hidden"/></div>');
					li.append('<div><p>'+((it.producto)?it.producto:"")+'</p></div>');
					li.append('<div><p>'+((it.benefactor)?it.benefactor:""));
					if(it.cantidadOriginal){
						// li.append('<div><p>'+((it.cantidad)?it.cantidad*1:"")+((it.unidad)?it.unidad:"")+'<span>/ '+Number((it.cantidad-(Number(total).toFixed(2)*1))).toFixed(2)*1+""+((it.unidad)?it.unidad:"")+'</span></p></div>');
						li.append('<div><p>'+((it.cantidad)?it.cantidad*1:"")+((it.unidad)?it.unidad:"")+'<span>/ '+(Number((Number(total).toFixed(2)*1)+it.cantidad2).toFixed(2)*1)+""+((it.unidad)?it.unidad:"")+'</span></p></div>');
					}else{
						li.append('<div><p>'+((it.cantidad)?it.cantidad*1:"")+((it.unidad)?it.unidad:"")+'<span>/ '+(Number(total).toFixed(2)*1)+""+((it.unidad)?it.unidad:"")+'</span></p></div>');
					}
					li.append('<div class="cantidad"><input class="decimal"/><p>'+((it.unidad)?it.unidad:"")+'</p></div>');
					li.append('<div><p>'+((it.vencimiento)?moment(it.vencimiento).format("DD-MMM-YY"):"")+'</p></div>');
					li.append('<div class="masAcciones"><div class="mas btn"></div><ul class="masAcciones-list"><li>desperdicio</li><li>vencido</li><li>desaparecido</li></ul></div>');

					$("body .entradas > ol").append(li);
				}
			})
			agregarDecimal();

			entradas.map(function (it, i) {
				$("body .entradas > ol > li").map(function (j, jt) {
					if(it.cantidadOriginal && $(this).hasClass("original")) {
						if (it.id_lote == $(this).data("id")) {
							$(this).find(".cantidad p").text($(this).data("cantidadOriginal"));
							if(!it.eliminado) {
								$(this).find(".btns input").click();
								$(this).find(".cantidad input").val($(this).data("cantidad2"));
							}
						}
					}else{
						if (it.id == $(this).data("id")) {
							$(this).find(".btns input").click();
							$(this).find(".cantidad input").val(it.cantidad2);
						}
					}
				});
			});
			// entradas.map(function (it, i) {
			// 	$("body .entradas > ol > li").map(function (j, jt) {
			// 		if (it.original) {
			// 			if (it.id_lote == $(this).data("id")) {
			// 				$(this).addClass("original")
			// 				$(this).find(".cantidad p").text(it.cantidadOriginal);
			// 				if(!it.eliminado) {
			// 					$(this).find(".btns input").click();
			// 					$(this).find(".cantidad input").val(it.cantidad2);
			// 					if(it.original){
			// 						// $(this).
			// 					}
			// 				}
			// 			}
			// 		}else{
			// 			if (it.id == $(this).data("id")) {
			// 				$(this).find(".btns input").click();
			// 				$(this).find(".cantidad input").val(it.cantidad2);
			// 			}
			// 		}
			// 	});
			// });
			manual = true;
			$(".loading").stop().fadeOut();
		})
		.fail(function( jqXHR, textStatus, errorThrown ) {
			console.log(jqXHR);
			$(".loading").stop().fadeOut();
		});
	});

	$(document).on("click", "body .entradas .listaEntradas ul li", function () {
		entrada=$(this).data("id");
		$("body .entradas ol").empty();

		$("body .entradas .listaEntradas ul li").removeClass("active");
		$(this).addClass("active");

		var entradas = localStorage.getItem("editarEntradas");
		entradas = entradas ? JSON.parse(entradas) : [];
		manual = false;

		lotesActuales.map(function(it,i){
			var total = ((it.total)?(Number(it.cantidad)-Number(it.total)):it.cantidad);
			if(total>0 && (it.id_entrada==entrada || entrada==-1)){
				var li=$('<li data-cantidad="'+it.cantidad+'" data-total="'+it.total+'" data-id="'+it.id+'" data-categoria="'+it.categoria+'" data-identrada="'+it.id_lote+'" data-lote="'+it.lote+'" data-producto="'+it.producto+'" data-unidad="'+it.unidad+'" data-vencimiento="'+it.vencimiento+'" data-benefactor="'+it.benefactor+'" data-codbenefactor="'+it.codBenefactor+'"></li>');
				li.append('<div class="btns"><p>'+((it.categoria)?it.categoria:"")+((it.lote)?it.lote:"")+((it.codBenefactor)?it.codBenefactor:"")+'</p><input type="checkbox" name="hidden"/></div>');
				li.append('<div><p>'+((it.producto)?it.producto:"")+'</p></div>');
				li.append('<div><p>'+((it.benefactor)?it.benefactor:""));
				li.append('<div><p>'+((it.cantidad)?it.cantidad*1:"")+((it.unidad)?it.unidad:"")+'<span>/ '+(Number(total).toFixed(2)*1)+""+((it.unidad)?it.unidad:"")+'</span></p></div>');

				li.append('<div class="cantidad"><input class="decimal"/><p>'+((it.unidad)?it.unidad:"")+'</p></div>');
				li.append('<div><p>'+((it.vencimiento)?moment(it.vencimiento).format("DD-MMM-YY"):"")+'</p></div>');
				li.append('<div class="masAcciones"><div class="mas btn"></div><ul class="masAcciones-list"><li>desperdicio</li><li>vencido</li><li>desaparecido</li></ul></div>');

				$("body .entradas > ol").append(li);
			}
		})
		agregarDecimal();

		entradas.map(function (it, i) {
			$("body .entradas > ol > li").map(function (j, jt) {
				if (it.original) {
					if (it.id_lote == $(this).data("id")) {
						$(this).addClass("original")
						$(this).find(".cantidad p").text(it.cantidadOriginal);
						if(!it.eliminado) {
							$(this).find(".btns input").click();
							$(this).find(".cantidad input").val(it.cantidad2);
							if(it.original){
								// $(this).
							}
						}
					}
				}else{
					if (it.id == $(this).data("id")) {
						$(this).find(".btns input").click();
						$(this).find(".cantidad input").val(it.cantidad2);
					}
				}
			});
		});
		manual = true;
	})


	$(".back").click(function () {
		$("body .content-lote > ul").empty();
		var items = JSON.parse(localStorage.getItem("editarEntradas"));
		items = items ? items : [];
		console.log(items);
		items.map(function (it, i) {
			var item = it;

			var benefactor = item.benefactor;
			var codBenefactor = item.codBenefactor;

			$("body .content-lote > ul").append(
				'<li data-id="' +
					item.id +
					'" data-id2="' +
					item.id2 +
					'" data-lote="'+((item.original)?item.id_lote:"")+'" class="ui-sortable-handle '+((item.original)?"original":"")+' '+((item.original && item.cantidadOriginal != item.cantidad2)?"editado":"")+' '+((item.eliminado)?"eliminado":"")+'" style=""><div><p>' +
					(i + 1) +
					"</p><p>" +
					item.cantidad2+
					"</p></div><div><p>" +
					item.unidad +
					"</p></div><div><p>" +
					item.categoria +
					"</p></div><div><p>" +
					item.lote +
					"</p></div><div><p>" +
					codBenefactor + "-" + benefactor +
					"</p></div><div><p>" +
					benefactor +
					"</p></div><div><p>" +
					item.producto +
					"</p></div><div><p>" +
					item.vencimiento +
					'</p></div><div class="btns"><div class="hide btn edit" title="Editar"></div><div class="btn delete" title="Eliminar"></div><div class="hide btn duplicate" title="Duplicar"></div><div class="hide btn reactivar" title="Reactivar"></div></div></li>'
			);
		});

		$("body .content-lote > ul li").map(function (i, it) {
			$(this)
				.find("> div")
				.eq(0)
				.find("p")
				.eq(0)
				.text(i + 1);
		});

		$("body").css("overflow", "scroll");

		$(".content-lote ul").show();
		$(".content-lote .busqueda").show();
		$(".info").show();
		// $("header").show();
		$(".acciones").show();

		$(".secondMain").hide();
		$(".resultados").hide();
		$(".content-lote .entradas").hide();

		var body = $("html, body");
		body.stop().animate({ scrollTop: 0 }, 500, "swing", function () {});
	});

	$(document).on("click", ".content-lote ul li .edit", function () {
		console.log(
			moment(
				$(this).parent().parent().find("> div").eq(7).find("p").html()
			).format("DD MMMM YYYY")
		);
	});

	$(document).on("click", ".content-lote ul li .reactivar", function () {
		var el = $(this);
		var items = JSON.parse(localStorage.getItem("editarEntradas"));
		items = items ? items : [];
		for (var i = 0; i < items.length; i++) {
			if (items[i].id == $(this).parent().parent().data("id")) {
				encontro = i;
			}
		}
		if (encontro != -1) {
			if(items[encontro].original){
				items[encontro].eliminado=false;
				el.parent().parent().removeClass("eliminado");
			}
			localStorage.setItem("editarEntradas", JSON.stringify(items));
		}
	});

	$(document).on("click", ".content-lote ul li .delete", function () {
		var el = $(this);
		Swal.fire({
			title: "Estás seguro?",
			text: "Desea elminar este registro!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: c12,
			cancelButtonColor: "#d33",
			confirmButtonText: "Sí, Eliminarlo!",
			cancelButtonText: "Cancelar"
		}).then((result) => {
			if (result.value) {
				var encontro = -1;
				var items = JSON.parse(localStorage.getItem("editarEntradas"));
				items = items ? items : [];
				for (var i = 0; i < items.length; i++) {
					if($(this).parent().parent().hasClass("original")){
						if (items[i].id_lote == $(this).parent().parent().data("id")) {
							encontro = i;
						}
					}else{
						if (items[i].id == $(this).parent().parent().data("id")) {
							encontro = i;
						}
					}
				}
				if (encontro != -1) {
					if(items[encontro].original){
						items[encontro].eliminado=true;
						el.parent().parent().addClass("eliminado");
					}else{
						items.splice(encontro, 1);
						el.parent().parent().remove();
						$("body .content-lote > ul li").map(function (i, it) {
							$(this)
							.find("> div")
							.eq(0)
							.find("p")
							.eq(0)
							.text(i + 1);
						});
					}
					localStorage.setItem("editarEntradas", JSON.stringify(items));
				}
			}
		});
	});

	//$(".content-lote ul").height($(window ).height() - (50+$("header").outerHeight()+$(".info").outerHeight()+ $(".content-lote .busqueda").outerHeight()))

	var busquedaFijo = false;
	$(window).scroll(function () {
		if (
			$(window).scrollTop() >
			$("header").outerHeight() + $(".info").outerHeight() + 30
		) {
			busquedaFijo = true;
			$(".busqueda").addClass("busquedaFijo");
		} else {
			busquedaFijo = false;
			$(".busqueda").removeClass("busquedaFijo");
		}
	});

	$(".guardarEntradas").click(function () {
		$(".back").click();
	});

	var manual = true;
	$(document).on('click', ".entradas ol > li input[type=checkbox]", function(){
		var encontro = -1;
		if ($(this).is(":checked")) {
			$(this).parent().parent().find(".cantidad input").show();
			var cantidad = $(this).parent().parent().data("cantidad");
			var total = $(this).parent().parent().data("total");
			if($(this).parent().parent().hasClass("original")){
				var items = JSON.parse(localStorage.getItem("editarEntradas"));
				var idLote=$(this).parent().parent().data("id");
				index=positionArrayId(items,idLote,"id_lote");
				console.log(items[index]);
				var total = (items[index] && items[index].cantidadOriginal)?items[index].cantidadOriginal:Number(cantidad)-total;
				total=Number(total);
			}else{
				var total = Number(cantidad)-total;
			}
			$(this).parent().parent().find(".cantidad input").val((total).toFixed(2)*1);
			$(this).parent().parent().css("opacity", 1);

			if (manual) {
				var items = JSON.parse(localStorage.getItem("editarEntradas"));
				items = items ? items : [];
				var item = {
					cantidad: $(this).parent().parent().data("cantidad"),
					categoria: $(this).parent().parent().data("categoria"),
					id: $(this).parent().parent().data("id"),
					// id_lote: $(this).parent().parent().data("identrada"),
					lote: $(this).parent().parent().data("lote"),
					producto: $(this).parent().parent().data("producto"),
					unidad: $(this).parent().parent().data("unidad"),
					vencimiento: $(this).parent().parent().data("vencimiento"),
					benefactor: $(this).parent().parent().data("benefactor"),
					codBenefactor: $(this).parent().parent().data("codbenefactor"),
				};
				item.cantidad2 = (total).toFixed(2)*1;
				if($(this).parent().parent().hasClass("original")){
					var original=false;
					for (var i = 0; i < items.length; i++) {
						if (items[i].id_lote == $(this).parent().parent().data("id")) {
							encontro = i;
						}
					}
					items[encontro].eliminado=false;
				}else{
					items.push(item);
				}
				localStorage.setItem("editarEntradas", JSON.stringify(items));
			}
		} else {
			$(this).parent().parent().find(".cantidad input").hide();
			$(this).parent().parent().css("opacity", 0.4);
			if (manual) {
				var items = JSON.parse(localStorage.getItem("editarEntradas"));
				items = items ? items : [];
				var original=false;
				for (var i = 0; i < items.length; i++) {
					if(items[i].original){
						if (items[i].id_lote == $(this).parent().parent().data("id")) {
							encontro = i;
							original=true;
						}
					}else{
						if (items[i].id == $(this).parent().parent().data("id")) {
							encontro = i;
						}
					}
				}
				if (encontro != -1) {
					if(original){
						items[encontro].eliminado=true;
					}else{
						items.splice(encontro, 1);
					}
					localStorage.setItem("editarEntradas", JSON.stringify(items));
				}
			}
		}
	});

	function move(arr, old_index, new_index) {
		while (old_index < 0) {
			old_index += arr.length;
		}
		while (new_index < 0) {
			new_index += arr.length;
		}
		if (new_index >= arr.length) {
			var k = new_index - arr.length;
			while (k-- + 1) {
				arr.push(undefined);
			}
		}
		arr.splice(new_index, 0, arr.splice(old_index, 1)[0]);
		return arr;
	}

	var positionInit = -1;
	$("body .content-lote > ul").sortable({
		update: function (event, ui) {
			console.log(ui.item.index());
			$("body .content-lote > ul li").map(function (i, it) {
				$(this)
					.find("> div")
					.eq(0)
					.find("p")
					.eq(0)
					.text(i + 1);
			});
			var items = JSON.parse(localStorage.getItem("editarEntradas"));
			items = items ? items : [];

			var newItems = move(items, positionInit, ui.item.index());
			localStorage.setItem("editarEntradas", JSON.stringify(newItems));
		},
		start: function (event, ui) {
			positionInit = ui.item.index();
		}
	});
	$("body .content-lote > ul").disableSelection();

	$(".content-lote ul").css(
		"min-height",
		$(window).height() -
			($("header").outerHeight() + $(".info").outerHeight() + 160)
	);

	var agregarDecimal=function(){
		$("input.decimal").on("keydown", function(e) {
			console.log(e.keyCode);
			if (
				$.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 188, 190]) !== -1 ||
				($.inArray(e.keyCode, [65, 67, 88]) !== -1 && (e.ctrlKey === true || e.metaKey === true)) ||
				(e.keyCode >= 35 && e.keyCode <= 39)) {
					return;
				}
				if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
					e.preventDefault();
				}
			});
	}

	$(document).on("keypress", ".entradas ol > li .cantidad input1, .number", function (
		evt
	) {
		evt = evt ? evt : window.event;
		var charCode = evt.which ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	});

	$(document).on("change", ".unidad", function (evt) {
		if(!($(this).val()=="lt" ||  $(this).val()=="kg" || $(this).val()=="un")){
			$(this).val("");
		}
	});

	$(document).on("change", ".entradas ol > li .cantidad input", function (evt) {
		if(Number($(this).val().replace(",",".")).toFixed(2)*1 && Number($(this).parent().parent().data("cantidad"))){
			var total=$(this).parent().parent().data("cantidad");
			if($(this).parent().parent().data("total")!=null){
				total=$(this).parent().parent().data("cantidad")-$(this).parent().parent().data("total");
			}
			if(Number($(this).val().replace(",",".")).toFixed(2)*1>total){
				$(this).val(((total).toFixed(2))*1);
			}
		}


		var items = JSON.parse(localStorage.getItem("editarEntradas"));
		items = items ? items : [];
		var encontro =-1;
		for (var i = 0; i < items.length; i++) {
			if (items[i].id == $(this).parent().parent().data("id")) {
				encontro = i;
			}
		}
		if (encontro != -1) {
			items[encontro].cantidad2 = Number($(this).val().replace(",",".")).toFixed(2)*1;
			localStorage.setItem("editarEntradas", JSON.stringify(items));
		}
	});

	// $("body .content-lote > ul").empty();
	// var items = JSON.parse(localStorage.getItem("editarEntradas"));
	// items = items ? items : [];
	// items.map(function (it, i) {
	// 	var item = it;
	//
	// 	var benefactor = item.benefactor;
	// 	var codBenefactor = item.codBenefactor;
	// 	$("body .content-lote > ul").append(
	// 		'<li data-id="' +
	// 			item.id +
	// 			'" class="ui-sortable-handle" style=""><div><p>' +
	// 			(i + 1) +
	// 			"</p><p>" +
	// 			item.cantidad2 +
	// 			"</p></div><div><p>" +
	// 			item.unidad +
	// 			"</p></div><div><p>" +
	// 			item.categoria +
	// 			"</p></div><div><p>" +
	// 			item.lote +
	// 			"</p></div><div><p>" +
	// 			codBenefactor + "-" + benefactor +
	// 			"</p></div><div><p>" +
	// 			benefactor +
	// 			"</p></div><div><p>" +
	// 			item.producto +
	// 			"</p></div><div><p>" +
	// 			item.vencimiento +
	// 			'</p></div><div class="btns"><div class="hide btn edit" title="Editar"></div><div class="btn delete" title="Eliminar"></div><div class="hide btn duplicate" title="Duplicar"></div></div></li>'
	// 	);
	// });

	$(document).on("mouseover", "body .info .listFiles li .image", function (evt) {
		$(this).parent().find(".img").css("display", "flex");
	});

	$(document).on("mouseout", "body .info .listFiles li .image", function (evt) {
		$(this).parent().find(".img").hide();
	});

	$(document).on("click", "body .info .listFiles li .delete", function (evt) {
		$(this).parent().remove();
	});

	$(document).on("change", 'input[type="file"]', function(e) {
		var input = e.target;
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$("body .info .listFiles").append(
					'<li><div class="btn delete" title="Eliminar"></div><div class="btn image"></div><p>' +
						input.files[0].name +
						'</p><div class="img" style="display: none;"><img title="" src="' +
						e.target.result +
						'"></div></li>'
				);
			};
			reader.readAsDataURL(input.files[0]);
		}
	});

	$(".modalSaciar .modalSaciar-close").click(function () {
		$(".modalSaciar").hide();
		$(".modalSaciar h4").text("");
		$("body, html").css("overflow", "initial");
	});

	function groupArr(data, n) {
		var group = [];
		for (var i = 0, j = 0; i < data.length; i++) {
			if (i >= n && i % n === 0) j++;
			group[j] = group[j] || [];
			group[j].push(data[i]);
		}
		return group;
	}

	var productosLista = $("body .content-lote > ul > li").not(".eliminado");

	var editor = CKEDITOR.replace("editor", {
		docType:
			'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',
		enterMode: CKEDITOR.ENTER_P,
		shiftEnterMode: CKEDITOR.ENTER_BR,
		entities: "false",
		customConfig: './config.js',
		entities_additional: "",
		entities_greek: "false",
		entities_latin: "false",
		height: "200",
		resize_enabled: "true",
		toolbar: "Basic",
		uiColor: "#dddddd",
		contentsCss: cssFactura,
		title: "Fundación Saciar",
		language: "es"
	});
	$(".imprimir").click(function () {
		var lotes = $(".content-lote ul li").length;
		var valido=true;
		var mensaje="";

		if(!(moment($("body .info .fechaInput").val())._isValid)){
			mensaje=mensaje+"<br> - Debe colocar una fecha válida.";
			valido=false;
		};
		if(beneficiado[1]==undefined){
			mensaje=mensaje+"<br> - Debe seleccionar una institución Beneficiada.";
			valido=false;
		};
		if(!($("body .info .recibido .selectize-control .item").html())){
			mensaje=mensaje+"<br> - Debe seleccionar quien recibe.";
			valido=false;
		};
		if($("body .info .recibido .number").val()==""){
			mensaje=mensaje+"<br> - Debe digitar el documento de quien recibe.";
			valido=false;
		};
		if($("body .info .factura .facturaNumber").val()==""){
			mensaje=mensaje+"<br> - Debe digitar el número de la factura.";
			valido=false;
		};
		var lotes = $(".content-lote ul li").length;
		if(lotes<2){
			mensaje=mensaje+"<br> - Debe crear como mínimo 1 lote.";
			valido=false;
		};
		if(!valido){
			Swal.fire({
				title: 'Información faltante.',
				html: mensaje,
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: c12,
				confirmButtonText: 'Cerrar'
			})
		}else{
			$(".modalSaciar").css("display", "flex");
			$(".modalSaciar-contenido > div").hide();
			$(".modalSaciar-print").css("display", "flex");
			$(".modalSaciar h4").text("Imprimir");
			$("body, html").css("overflow", "hidden");

			var fecha = "";
			var numFactura = $(".facturaNumber").val();
			var institucion = $("body .info .institucion .selectize-control .item").html();
			var nit = $("body .info .institucion input").eq(1).val();
			var persona = $("body .info .recibido .selectize-control .item").html();
			var cedula = $("body .info .recibido .number").val();
			var hojaLotes = 22;

			$(".factura-main").empty();
			productosLista = $("body .content-lote > ul > li").not(".eliminado");

			var productos = groupArr(productosLista, hojaLotes);
			for (var i = 0; i < productos.length; i++) {
				var currentProductos = productos[i];
				var factura = $('<div class="factura"></div>');
				factura.append(
					'<div class="header"><p>0</p><div class="logo"><img data-cke-saved-src="./images/abaco small.jpg" src="./images/abaco small.jpg"></div><div class="informe"><h3><br></h3><h4>INFORME DE ENTREGA CC-01</h4><h5><br></h5><p>' +
						numFactura +
						'</p><h6><br></h6></div><div class="fecha"><p>Fecha: ' +
						moment().format("DD-MM-YYYY / HH:mm:ss") +
						"</p><p>" +
						"</p></div></div>"
				);

				var items = "";
				var lista =
					'<div class="lotes"><ul><li><p>Cant.</p><p>Unidad</p><p>Lote</p><p>Producto</p></li>';
				var max = 0;
				currentProductos.map(function (it, j) {
					lista =
						lista +
						"<li><p>" +
						$(it).find("> div").eq(0).find("p").eq(1).text() +
						"</p><p>" +
						$(it).find("> div").eq(1).find("p").text() +
						"</p><p>" +
						($(it).find("> div").eq(2).find("p").text() +
							$(it).find("> div").eq(3).find("p").text() +
							($(it).find("> div").eq(4).find("p").text()).split("-")[0]) +
						"</p><p>" +
						$(it).find("> div").eq(6).find("p").text() +
						"</p></li>";
					max = j;
				});

				for (var k = max; k < 21; k++) {
					lista = lista + "<li><p></p><p></p><p></p><p></p></li>";
				}

				lista = lista + "</ul></div>";

				factura.append(lista);

				factura.append(
					'<div class="footer"><div class="institucion"><div class="nombre"><div><h4>Institucion Beneficiada</h4><p>' +
						institucion +
						"</p></div><div><h4>Nit:</h4><p>" +
						nit +
						'</p></div><h6>'+beneficiado[3]+'</h6></div></div><div class="factura"><div><p>Recibí: ' +
						persona +
						"</p><p>C.C. " +
						cedula +
						'</p></div><h6>Declaro que los productos recibidos son aptos para el consumo y no se pueden comercializar</h6></div><div class="direccion"><p>Carrera 50 No 25-261 - PBX: (604) 2351088 - info@saciar.org.co</p><p>email: info.oriente@saciar.org.co</p></div></div>'
				);
				$(".factura-main").append(factura);
			}

			// CKEDITOR.addCss('.cke_editable ul {background: red;}');
			CKEDITOR.instances["editor"].setData($(".factura-main").html());

			CKEDITOR.on("instanceReady", function (evt) {
				var editor = evt.editor;
				editor.on("change", function (e) {});
			});
			setTimeout(function(){
				$(".modalSaciar-main #cke_1_contents").height(($(window).height()*0.7)-($(".modalSaciar-header").height()+$(".modalSaciar-main #cke_1_top").height()));
			},200)
		}
	});

	$(".fecha .fechaInput").attr("disabled",false);

	selectRecibido= $('#recibido').selectize({
    sortField: 'text',
		onChange: function(value, isOnInitialize) {
			// benefactor = value.split("-");
			$("body .recibido .number").val(value);

			// var infoSalida=localStorage.getItem("infoSalida");
			// if(infoSalida){
			// 	infoSalida=JSON.parse(infoSalida);
			// 	infoSalida.recibido=value
			// 	localStorage.setItem("infoSalida",JSON.stringify(infoSalida));
			// }else{
			// 	localStorage.setItem("infoSalida","{}");
			// }
		}
  });

	selectBenefactor= $('#benefactor').selectize({
    sortField: 'text',
		onChange: function(value, isOnInitialize) {
			console.log(value);
			benefactor = value.split("-");
		}
  });

	selectBeneficiado= $('#beneficiado').selectize({
    sortField: 'text',
		onChange: function(value, isOnInitialize) {
			beneficiado = value.split("&");
			$("body .info .institucion input").eq(1).val(beneficiado[1]);
			$(".info-globo p").text(beneficiado[2]);
			if(beneficiado[2] && beneficiado[2]!= ''){
				$(".info-globo").show();
			}else{
				$(".info-globo").hide();
			}

			// var infoSalida=localStorage.getItem("infoSalida");
			// if(infoSalida){
			// 	infoSalida=JSON.parse(infoSalida);
			// 	infoSalida.beneficiado=value
			// 	localStorage.setItem("infoSalida",JSON.stringify(infoSalida));
			// }else{
			// 	localStorage.setItem("infoSalida","{}");
			// }
		}
  });

	selectCategoria= $('#categoria').selectize({
    sortField: 'text',
		onChange: function(value, isOnInitialize) {
			console.log(value);
			categoria = value.split("-");
		}
  });

});
