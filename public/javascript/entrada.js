// Datepicker Config

var cssFactura =
	'@charset "UTF-8";@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,800&effect=3d-float);@import url(../../styles/includes/all.css);@import url(https://fonts.googleapis.com/css?family=Lato:400,400i,700);@import url(https://fonts.googleapis.com/css?family=Inconsolata:400,400i,700);a{text-decoration:none}*{font-family:Lato;font-weight:400;list-style:none;margin:0;padding:0}h1{font-size:28px;font-weight:600;font-stretch:normal;font-style:normal;line-height:1.14;letter-spacing:normal;color:#000}h2{font-size:20px;font-weight:400;font-stretch:normal;font-style:normal;line-height:1.2;letter-spacing:normal;color:#000}h3{font-size:16px;font-weight:700;font-stretch:normal;font-style:normal;line-height:1;letter-spacing:normal;color:#000}h4{font-size:14px;font-weight:700;font-stretch:normal;font-style:normal;line-height:1.71;letter-spacing:normal;color:#000}h5{font-size:14px;font-weight:400;font-stretch:normal;font-style:normal;line-height:1.14;letter-spacing:normal;color:#000}p{font-size:14px;font-weight:400;font-stretch:normal;font-style:normal;line-height:1.14;letter-spacing:normal;color:#000}p.small{font-size:12px;font-weight:400;font-stretch:normal;font-style:normal;line-height:1.33;letter-spacing:normal;color:#000}p.bold{font-weight:700;font-stretch:normal;font-style:normal;line-height:1.14;letter-spacing:normal;color:#000}.tab{text-transform:uppercase;font-size:12px;font-weight:900;font-stretch:normal;font-style:normal;line-height:1.33;letter-spacing:1.5px;color:#D9D90D}.labelSmall{width:72px;font-size:12px;font-weight:400;font-stretch:normal;font-style:normal;line-height:1.33;letter-spacing:1px;color:#D9D90D}.labelSmallLink{width:110px;font-size:12px;font-weight:900;font-stretch:normal;font-style:normal;line-height:1.33;letter-spacing:1px;color:#D9D90D}.dropdownMenu{width:186px;height:16px;font-size:13px;font-weight:600;font-stretch:normal;font-style:normal;line-height:1.85;letter-spacing:normal;color:#D9D90D}.navigationLink{width:94px;height:24px;font-size:14px;font-weight:600;font-stretch:normal;font-style:normal;line-height:1.14;letter-spacing:normal;color:#D9D90D}.rectangle1{cursor:pointer;margin:5px 0;width:210px;height:40px;background-color:#D9D90D;color:#fff;display:flex;justify-content:center;align-items:center;font-size:14px;font-weight:700;font-stretch:normal;font-style:normal;line-height:1.14;letter-spacing:normal}.rectangle1:hover{background-color:#d48404}.rectangle2{cursor:pointer;margin:5px 0;width:210px;height:40px;background-color:#64a405;color:#fff;display:flex;justify-content:center;align-items:center;font-size:14px;font-weight:700;font-stretch:normal;font-style:normal;line-height:1.14;letter-spacing:normal}.rectangle2:hover{background-color:#71bf8f}.rectangle3{cursor:pointer;margin:5px 0;width:210px;height:40px;background-color:#71bf8f;color:#000;display:flex;justify-content:center;align-items:center;font-size:14px;font-weight:700;font-stretch:normal;font-style:normal;line-height:1.14;letter-spacing:normal}.rectangle3:hover{background-color:#4b805f}.rectangle4{display:flex;justify-content:center;align-items:center;cursor:pointer;width:212px;height:64px;box-shadow:0 0 2px 0 rgba(42,47,51,.4);background-color:#fff}.rectangle4 .ico{width:20%}.rectangle4 p{width:70%;margin-left:10%;font-family:Lato;font-size:14px;font-weight:700;font-stretch:normal;font-style:normal;line-height:1.14;letter-spacing:normal;color:#ddf69a}.separe{width:350px;height:1px;background-color:#e5e5e6;margin:20px 0}.tab{cursor:pointer;font-size:12px;font-weight:900;font-stretch:normal;font-style:normal;line-height:1.33;letter-spacing:1.5px;color:#4b805f;height:30px;padding:3px 10px;display:flex;justify-content:center;align-items:center;border-bottom:2px #fff solid}.tab:hover{color:#4b805f;border-bottom:2px #4b805f solid}.tab.active{color:#D9D90D;border-bottom:2px #F58634 solid}.tab.active:hover{color:#D9D90D;border-bottom:2px #F58634 solid}input{padding:0 2px}input[type=radio]{width:20px;height:20px;position:relative;cursor:pointer}input[type=radio]:before{cursor:pointer;content:"";width:20px;height:20px;position:absolute;top:0;bottom:0;left:0;right:0;margin:auto;border:solid 1px #4b805f;border-radius:50%;background:#fff}input[type=radio]:checked{width:20px;height:20px;position:relative;cursor:pointer}input[type=radio]:checked:before{content:"";width:20px;height:20px;position:absolute;top:0;bottom:0;left:0;right:0;margin:auto;border:solid 1px #F58634;border-radius:50%;background:#fff;cursor:pointer}input[type=radio]:checked:after{content:"";width:12px;height:12px;position:absolute;top:4px;bottom:0;left:5px;right:0;border-radius:50%;background:#F58634;cursor:pointer}input[type=checkbox]{width:20px;height:20px;position:relative;cursor:pointer}input[type=checkbox]:before{content:"";width:20px;height:20px;position:absolute;top:0;bottom:0;left:0;right:0;margin:auto;border:solid 1px #4b805f;border-radius:3px;background:#fff;cursor:pointer}input[type=checkbox]:checked{width:20px;height:20px;position:relative;cursor:pointer}input[type=checkbox]:checked:before{content:"";width:20px;height:20px;position:absolute;top:0;bottom:0;left:0;right:0;margin:auto;border:solid 1px #F58634;border-radius:3px;background:#fff;cursor:pointer}input[type=checkbox]:checked:after{content:"";width:12px;height:12px;font-size:14px;font-family:FontAwesome;font-weight:200;position:absolute;top:3px;bottom:0;left:4px;right:0;color:#F58634}.groupForm{display:flex;flex-wrap:wrap;margin:10px 0;max-width:200px;box-shadow:none!important;outline:0!important}.groupForm label{width:100%;font-size:12px;color:#F58634;position:relative}.groupForm label:before{content:"";width:12px;height:12px;font-size:12px;font-family:FontAwesome;font-weight:200;position:relative;color:#F58634;margin-right:5px}.groupForm input{width:100%;margin-left:5px;height:20px;border:1px solid #D9D90D}.groupForm input:focus{box-shadow:none!important;outline:0!important}.groupForm select{width:100%;margin-left:5px;height:21px;border:1px solid #D9D90D;background:#fff;border-radius:0!important}.groupForm select:focus{box-shadow:none!important;outline:0!important}.btn{cursor:pointer;margin:5px 2px;padding:3px 10px;height:40px;color:#000;display:flex;justify-content:center;align-items:center;font-size:14px;font-weight:700;font-stretch:normal;font-style:normal;line-height:1.14;letter-spacing:normal;display:flex;flex-wrap:nowrap;justify-content:center;align-items:center}.btn:after{content:"";width:12px;height:12px;font-size:14px;font-family:FontAwesome;font-weight:200;color:#71bf8f}.btn:hover:after{color:#d48404}*{list-style:none;font-family:Inconsolata}.hide{display:none}.factura{display:flex;flex-wrap:wrap;width:90%;padding:0 5% 5% 5%}.factura .header{display:flex;flex-wrap:nowrap;justify-content:center;align-items:center;flex-wrap:wrap;width:90%;padding:0 5%;height:110px;margin-bottom:10px}.factura .header > p{color: white; font-size:0px;} .factura .header .logo{height:90%;width:50%;display:flex;flex-wrap:nowrap;justify-content:center;align-items:center;justify-content:flex-start}.factura .header .logo img{margin-right: 15px;max-width:50%;max-height:80px}.factura .header .logo .abaco{max-height:60px; margin-top: 20px }.factura .header .informe{width:50%;height:90%}.factura .header .informe *{text-align:right}.factura .header .informe h4{margin:20px 0 0 0}.factura .header .fecha{height:10%;width:100%;display:flex;flex-wrap:nowrap;justify-content:center;align-items:center}.factura .header .fecha p{text-align:right;width:20%}.factura .header .fecha p:first-child{width:80%;text-align:left}.factura .header .fecha p:first-child span{text-decoration:underline}.factura .lotes{width:100%}.factura .lotes ul span{display:none}.factura .lotes ul li{display:flex;flex-wrap:nowrap;justify-content:center;align-items:center;flex-wrap:nowrap;justify-content:space-between;height:16px;width:100%}.factura .lotes ul li p:nth-child(1){text-align:rigth}.factura .lotes ul li p:nth-child(2){}.factura .lotes ul li:first-child{border-bottom: 1px solid black;background:#bbb;text-transform:uppercase;height:20px}.factura .lotes ul li:first-child p{text-align:center;font-size:14px}.factura .lotes ul li p{text-align:center;width:100%;text-transform:uppercase;font-size:13px;overflow:hidden;white-space: nowrap;}.factura .lotes ul li p:first-child{width:50%}.factura .lotes ul li p:nth-child(2){width:15%}.factura .lotes ul li p:nth-child(3){width:25%}.factura .lotes ul li p:nth-child(4){width:45%}.factura .footer{width:100%;flex-wrap:wrap}.factura .footer .institucion{border-top:1px solid #000;border-bottom:1px solid #000;width:96%;padding:1% 2% 3px 2%}.factura .footer .institucion .nombre{display:flex;flex-wrap:nowrap;justify-content:center;align-items:center;flex-wrap:wrap;width:100%}.factura .footer .institucion .nombre>div{display:flex;flex-wrap:nowrap;justify-content:center;align-items:center;width:70%;flex-wrap:nowrap;justify-content:flex-start}.factura .footer .institucion .nombre>div:first-child{flex-wrap:wrap;width:100%}.factura .footer .institucion .nombre>div:first-child h4{width:100%}.factura .footer .institucion .nombre>div:first-child p{width:100%}.factura .footer .institucion .nombre>div h4{text-transform:uppercase;text-align:left;font-size:15px}.factura .footer .institucion .nombre>div p{text-transform:uppercase;font-size:15px}.factura .footer .institucion .nombre h6{width:30%;font-size:15px;text-align:right}.factura .footer .factura{display:flex;flex-wrap:nowrap;justify-content:center;align-items:center;flex-wrap:wrap;border-bottom:1px solid #000;padding:1% 2% 3px 2%;width:96%}.factura .footer .factura>div{width:100%;display:flex;flex-wrap:nowrap;justify-content:center;align-items:center;flex-wrap:wrap}.factura .footer .factura>div p{margin:5px 0;width:100%;font-size:15px}.factura .footer .factura h6{font-size:14px;width:100%;font-style:italic;text-align:center;font-weight:700;padding-top:3px;border-top:1px solid #000}.factura .footer .direccion{width:100%;padding-top:5px;font-size:13px}.factura .footer .direccion p{display:flex;flex-wrap:nowrap;justify-content:center;align-items:center;flex-wrap:nowrap;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;font-size:9.2px}';

$(document).ready(function() {

	var uriControllers= "../../controllers/";


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
	var bodega=[];
	var defaultBodega="5";

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
  $(".check-in").datepicker({
    dateFormat: "d MM yy",
    duration: "medium",
		closeText: 'Cerrar',
		prevText: '<Ant',
		nextText: 'Sig>',
		currentText: 'Hoy',
		// monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		// monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
		// dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		// dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
		// dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
		weekHeader: 'Sm',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''
  });

	$('.fechaInput').datepicker().datepicker("setDate", "0");
	$('.vencimiento').datepicker().datepicker("setDate", "1");

	$('.lote').datepicker({
    dateFormat: "ddmmy"
	}).datepicker("setDate", "0");

  $(".check-out").datepicker({
    dateFormat: "d MMMM yy",
    duration: "medium"
  });

  if(currentProfile.type=="bodega"){
	$(".bodega .groupForm").hide();
  }

	// if($(".info .factura input").val()==""){
	// 	var facturaActual="";
	// 	if($("body .info .factura p").text()!=""){
	// 		facturaActual=($("body .info .factura p").text()).split("-")[1];
	// 	}
	// 	$(".info .factura input").val(moment().format("YYYY-")+(Number(facturaActual)+1));
	// }

	$("input.decimal").on("keydown", function(e) {
		if (
		$.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
		($.inArray(e.keyCode, [65, 67, 88]) !== -1 && (e.ctrlKey === true || e.metaKey === true)) ||
		(e.keyCode >= 35 && e.keyCode <= 39)) {
		return;
		}
		if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
		e.preventDefault();
		}
	});
	$("input.decimal2").on("keydown", function(e) {
		console.log(e.keyCode);

		if (
		$.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 188]) !== -1 ||
		($.inArray(e.keyCode, [65, 67, 88]) !== -1 && (e.ctrlKey === true || e.metaKey === true)) ||
		(e.keyCode >= 35 && e.keyCode <= 39)) {
		return;
		}
		if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
		e.preventDefault();
		}
	});
	$("input.entero").on("keydown", function(e) {
		console.log(e.keyCode);
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
	function redondearDecimales(numero, decimales) {
		return Math.round(numero * Math.pow(10, decimales)) / Math.pow(10, decimales);
	}

	$(".unidad1 input").on("keyup", function (e) {
		if ($.inArray(e.keyCode, [65, 67, 88]) !== -1 &&  (e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
			e.preventDefault();
		}else{
			if (!($(".cantidad input").val() || ($(".cantidad input").val()==""))) {
				$(".cantidad-unidad input").val(1)
				if ($(".cantidad-unidad input").val() || ($(".cantidad-unidad input").val() == "")) {
					$(".cantidad input").val(redondearDecimales($(".cantidad-unidad input").val() / e.target.value,2));
				}
			}else{
				$(".cantidad input").val(redondearDecimales($(".cantidad-unidad input").val() * e.target.value,2));
			}
		}
	});
	$(".cantidad-unidad input").on("keyup", function (e) {
		if ($.inArray(e.keyCode, [65, 67, 88]) !== -1 && (e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
			e.preventDefault();
		}else{
			if (!($(".cantidad input").val() || ($(".cantidad input").val() == ""))) {
				$(".unidad1 input").val(1)
				if ($(".unidad1 input").val() || ($(".unidad1 input").val() == "")) {
					$(".cantidad input").val(redondearDecimales($(".unidad1 input").val() / e.target.value, 2));
				}
			} else {
				$(".cantidad input").val(redondearDecimales($(".unidad1 input").val() * e.target.value, 2));
			}
		}
	});
	$(".cantidad input").on("keyup", function (e) {
		if ($.inArray(e.keyCode, [65, 67, 88]) !== -1 &&  (e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
			e.preventDefault();
		}else{
			$(".cantidad-unidad input").val("");
			$(".unidad1 input").val("");
		}
	});

	$(document).on("change", ".unidad", function (evt) {
		if(!($(this).val()=="lt" ||  $(this).val()=="kg" || $(this).val()=="un")){
			$(this).val("");
		}
	});

	$(document).on("keypress", ".number", function (
		evt
	) {
		evt = evt ? evt : window.event;
		var charCode = evt.which ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	});

	var isNumber = function isNumber(value) {
		return typeof value === 'number' && isFinite(value);
	}

	$(".vencimiento > .ui-datepicker-inline").remove();
	$(".lote > .ui-datepicker-inline").remove();

	$(".nuevo .save").click(function(){
		if (
			isNumber(Number($(".nuevo .cantidad input").val())) &&
			$(".nuevo .cantidad input").val() != "" &&
			$(".nuevo .cantidad input").val() != "0" &&
			Number($(".nuevo .cantidad input").val()) > 0
		) {
			if (
				($("#certificado").val()=="2" && (valorIva>=0 && valorUnitario!="" && valorUnitario>0)) || $("#certificado").val() =="3"
			) {
				if (!(
					$(".nuevo .unidad-peso select").val() == "" ||
					$(".nuevo .categoria select").val() == "" ||
					$(".nuevo .lote input").val() == "" ||
					$(".nuevo .producto input").val() == "" ||
					$(".nuevo .vencimiento input").val() == ""
				)){
					if(editando==-1){
						var entrada= localStorage.getItem('entrada');
						entrada=(entrada)?JSON.parse(entrada):[];

						var item={};
						item.individual = ($(".nuevo .unidad1 input").val()) ? $(".nuevo .unidad1 input").val():null;
						item.individualCantidad = ($(".nuevo .cantidad-unidad input").val())?redondearDecimales($(".nuevo .cantidad-unidad input").val(), 2):null;
						item.cantidad = $(".nuevo .cantidad input").val();
						item.unidad = $(".nuevo .unidad-peso select").val();
						item.categoria= $(".nuevo .categoria select").val();
						item.lote= $(".nuevo .lote input").val();
						item.producto= $(".nuevo .producto input").val();
						item.bodega= $(".ubicacion p").html();
						item.vencimiento= $(".nuevo .vencimiento input").val();
						item.valorUnitario= ($("#certificado").val()=="2")?valorUnitario:0;
						item.valorIva= ($("#certificado").val()=="2")?valorIva:0;
						entrada.push(item);

						let total=0;
						entrada.map((it)=>{
							total+=it.valorUnitario+(it.valorUnitario*(it.valorIva/100));
						});
						total=redondearDecimales(total,2);
						$("#valor").val(total);
						$(".total-certificado p").html("$"+total);

						localStorage.setItem("entrada",JSON.stringify(entrada));

						var nuevoLi=$("<li></li>");
						if ($(".nuevo .unidad1 input").val() == "" || $(".nuevo .unidad1 input").val() == ""){
							nuevoLi.append("<div><p>" + ($(".content-lote > ul li").length + 1) + "</p><p><span class='cantidad-item'>" + (redondearDecimales($(".nuevo .cantidad input").val(), 2)) + " </span>" + $(".nuevo .unidad-peso select").val() + "</p></div>");
						}else{
							nuevoLi.append("<div><p>" + ($(".content-lote > ul li").length + 1) + "</p><p><span class='unidad1-item'>" + $(".nuevo .unidad1 input").val() + "</span> Unidades de <span class='cantidad-unidad-item'>" + (redondearDecimales($(".nuevo .cantidad-unidad input").val(), 2)) + "</span>" + $(".nuevo .unidad-peso select").val() + "  =   <span class='cantidad-item'>" + (redondearDecimales($(".nuevo .cantidad input").val(), 2)) + " </span>" + $(".nuevo .unidad-peso select").val() + "</p></div>");
						}

						nuevoLi.append("<div><p>"+$(".nuevo .unidad-peso select").val()+"</p></div>");
						nuevoLi.append("<div><p>"+$(".nuevo .categoria select").val()+"</p></div>");
						nuevoLi.append("<div><p>"+$(".nuevo .lote input").val()+"</p></div>");

						nuevoLi.append("<div><p>"+$(".nuevo .producto input").val()+"</p></div>");

						nuevoLi.append("<div><p>"+$(".nuevo .vencimiento input").val()+"</p></div>");
						nuevoLi.append("<div><p>"+$(".ubicacion p").html()+"</p></div>");

						if($("#certificado").val()=="2"){
							nuevoLi.append("<div class='valor-content-item'><p>$<span class='valor-item'>" + valorUnitario  + " </span> x <span class='iva-item'>"+valorIva+"</span>% = <span class='total-item'>$"+redondearDecimales(valorUnitario+(valorUnitario*(valorIva/100)),2)+"</span></p></div>");
						}else{
							nuevoLi.append("<div class='valor-content-item'><p>$<span class='valor-item'>0</span> x <span class='iva-item'>0</span>% = <span class='total-item'>$0</span></p></div>");
						}

						nuevoLi.append("<div class='btns'><div class='btn edit' title='Editar'></div><div class='btn delete' title='Eliminar'></div><div class='btn duplicate' title='Duplicar'></div></div>");
						selectIva[0].selectize.setValue("");
						$(".content-lote > ul li").removeClass("inactive");
						$(".content-lote > ul li").removeClass("active");
						$(".nuevo input").val("");
						$(".article-info ul > li.active").removeClass("active");
						$(".ubicacion p").html("");
						$(".article-info ul > li.active").removeClass("active");
						$('.vencimiento').datepicker().datepicker("setDate", "1");
						$('.lote').val(moment($("body .info .fechaInput").val()).format("DDMMYY"));
						selectCategoria[0].selectize.setValue("");
						// selectBodega[0].selectize.setValue("");
						$(".content-lote > ul").append(nuevoLi);

						if($("#certificado").val()!="2"){
							$(".valor-content-item").hide();
						}

						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Hecho',
							showConfirmButton: false,
							timer: 1500
						})
					}else{

						if ($(".nuevo .unidad1 input").val() == "" || $(".nuevo .unidad1 input").val() == "") {
							$(".content-lote > ul li").eq(editando).find("> div").eq(0).empty();
							$(".content-lote > ul li").eq(editando).find("> div").eq(0).append("<div><p>" + ($(".content-lote > ul li").length + 1) + "</p><p><span class='unidad1-item'>" + $(".nuevo .unidad1 input").val() + " <span class='cantidad-item'>" + (redondearDecimales($(".nuevo .cantidad input").val(), 2)) + " </span>" + $(".nuevo .unidad-peso select").val() + "</p></div>");
						} else {
							$(".content-lote > ul li").eq(editando).find("> div").eq(0).empty();
							$(".content-lote > ul li").eq(editando).find("> div").eq(0).append("<div><p>" + ($(".content-lote > ul li").length + 1) + "</p><p><span class='unidad1-item'>" + $(".nuevo .unidad1 input").val() + "</span> Unidades de <span class='cantidad-unidad-item'>" + (redondearDecimales($(".nuevo .cantidad-unidad input").val(), 2)) + "</span>" + $(".nuevo .unidad-peso select").val() + "  =   <span class='cantidad-item'>" + (redondearDecimales($(".nuevo .cantidad input").val(), 2)) + " </span>" + $(".nuevo .unidad-peso select").val() + "</p></div>");
						}

						$(".content-lote > ul li").eq(editando).find("> div").eq(1).find("p").text($(".nuevo .unidad-peso select").val());
						$(".content-lote > ul li").eq(editando).find("> div").eq(2).find("p").text($(".nuevo .categoria select").val());
						$(".content-lote > ul li").eq(editando).find("> div").eq(3).find("p").text($(".nuevo .lote input").val());

						// $(".content-lote > ul li").eq(editando).find("> div").eq(4).find("p").text($(".nuevo input").eq(4).val());
						// $(".content-lote > ul li").eq(editando).find("> div").eq(0).find("p").text($(".nuevo select").eq(0).val());
						// $(".content-lote > ul li").eq(editando).find("> div").eq(6).find("p").text($(".nuevo input").eq(6).val());

						$(".content-lote > ul li").eq(editando).find("> div").eq(4).find("p").text($(".nuevo .producto input").eq(5).val());
						$(".content-lote > ul li").eq(editando).find("> div").eq(5).find("p").text($(".nuevo .vencimiento input").eq(6).val());

						$(".content-lote > ul li").eq(editando).find("> div").eq(6).find("p").html($(".ubicacion p").html());

						$(".content-lote > ul li").eq(editando).find("> div").eq(7).empty();
						$(".content-lote > ul li").eq(editando).find("> div").eq(7).append("<p>$<span class='valor-item'>" + valorUnitario  + " </span> x <span class='iva-item'>"+valorIva+"</span>% = <span class='total-item'>$"+redondearDecimales(valorUnitario+(valorUnitario*(valorIva/100)),2)+"</span></p>");

						var item={};
						item.individual = ($(".nuevo .unidad1 input").val()) ? $(".nuevo .unidad1 input").val() : null;
						item.individualCantidad = ($(".nuevo .cantidad-unidad input").val()) ? redondearDecimales($(".nuevo .cantidad-unidad input").val(), 2) : null;
						item.cantidad = $(".nuevo .cantidad input").val();
						item.unidad = $(".nuevo .unidad-peso select").val();
						item.categoria = $(".nuevo .categoria select").val();
						item.lote = $(".nuevo .lote input").val();
						item.producto = $(".nuevo .producto input").val();
						item.bodega = $(".ubicacion p").html();
						item.vencimiento = $(".nuevo .vencimiento input").val();
						item.valorUnitario= ($("#certificado").val()=="2")?valorUnitario:0;
						item.valorIva= ($("#certificado").val()=="2")?valorIva:0;
						selectIva[0].selectize.setValue("");

						var items=JSON.parse(localStorage.getItem("entrada"));
						items[editando]=item;
						localStorage.setItem("entrada",JSON.stringify(items));
						$(".nuevo .cancel").hide();
						$(".content-lote > ul li").animate({opacity:1});
						$(".nuevo input").val("");
						$('.vencimiento').datepicker().datepicker("setDate", "1");
						$('.lote').datepicker().datepicker("setDate", "0");
						$(".ubicacion p").html("");
						$(".article-info ul > li.active").removeClass("active");
						$('.acciones').show();
						editando=-1;
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Editado',
							showConfirmButton: false,
							timer: 1500
						})
					}
				}
			}
		}
	})

	$(document).on('click', ".content-lote > ul li .edit", function(){
		console.log(moment($(this).parent().parent().find("> div").eq(6).find("p").html()).format("DD MMMM YYYY"));
	});

	var editando= -1;

	$(document).on('click', ".content-lote > ul li .edit", function(){
		var el=$(this)
		$(".nuevo .unidad1 input").eq(0).val((el.parent().parent().find("> div").eq(0).find(".unidad1-item").length) ? el.parent().parent().find("> div").eq(0).find(".unidad1-item").text():"");
		$(".nuevo .cantidad-unidad input").eq(0).val((el.parent().parent().find("> div").eq(0).find(".cantidad-unidad-item").length) ? el.parent().parent().find("> div").eq(0).find(".cantidad-unidad-item").text() : "");
		$(".nuevo .cantidad input").eq(0).val(el.parent().parent().find("> div").eq(0).find(".cantidad-item").text());
		// $(".nuevo select").eq(0).val(el.parent().parent().find("> div").eq(1).find("p").text());
		selectUnidad[0].selectize.setValue(el.parent().parent().find("> div").eq(1).find("p").text());
		selectCategoria[0].selectize.setValue(el.parent().parent().find("> div").eq(2).find("p").text());
		$(".nuevo .lote input").val(el.parent().parent().find("> div").eq(3).find("p").text());
		$(".nuevo .producto input").val(el.parent().parent().find("> div").eq(4).find("p").text());
		$(".nuevo .vencimiento input").val(el.parent().parent().find("> div").eq(5).find("p").text());
		$(".ubicacion p").html(el.parent().parent().find("> div").eq(6).find("p").html());

		valorUnitario=Number(el.parent().parent().find("> .valor-content-item").find(".valor-item").text());
		valorIva=Number(el.parent().parent().find("> .valor-content-item").find(".iva-item").text());
		$(".nuevo .valor-content .valor-unitario input").val(valorUnitario);

		selectIva[0].selectize.setValue(valorIva);
		$(".valor-unitario-total input").val(redondearDecimales(valorUnitario+(valorUnitario*(valorIva/100)),2));

		$(".article-info ul > li.active").removeClass("active");
		el.parent().parent().find("> div").eq(6).find("p span").map(function(){
			var id1=$(this).data("id");
			$(".article-info ul > li").map(function(){
				(id1==$(this).data("id"))?$(this).addClass("active"):"";
			})
		});

		// selectBodega[0].selectize.setValue(el.parent().parent().find("> div").eq(6).find("p").text());
		// $(".nuevo input").eq(5).val(el.parent().parent().find("> div").eq(5).find("p").text());

		$('.acciones').hide();
		$(".nuevo .cancel").css("display","flex");
		$(".save").removeClass("add");
		$(".save").addClass("edit-item");

		el.parent().parent().stop().removeClass("inactive");
		el.parent().parent().stop().removeClass("active");
		$(".content-lote > ul li").addClass("inactive");
		el.parent().parent().stop().removeClass("inactive")
		el.parent().parent().stop().addClass("active");

		editando= el.parent().parent().index();

	})

	$(document).on('click', ".content-lote > ul li .delete", function(){
		var el=$(this)
		Swal.fire({
			title: 'Estás seguro?',
			text: "Desea elminar este registro!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: c12,
			cancelButtonColor: '#d33',
			confirmButtonText: 'Sí, Eliminarlo!',
			cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.value) {
				$(".nuevo .cancel").click();
				// localStorage remove lote
				var items=JSON.parse(localStorage.getItem("entrada"));
				items=(items)?items:[];
				items.splice(el.parent().parent().index(), 1);

				let total=0;
				items.map((it)=>{
					total+=it.valorUnitario+(it.valorUnitario*(it.valorIva/100));
				});
				total=redondearDecimales(total,2);
				$("#valor").val(total);
				$(".total-certificado p").html("$"+total);

				localStorage.setItem("entrada",JSON.stringify(items));

				el.parent().parent().remove();
				$("body .content-lote > ul li").map(function(i,it){
					$(this).find("> div").eq(0).find("p").eq(0).text(i+1);
				})
			}
		})
	})

	$(document).on('click', ".content-lote > ul li .duplicate", function(){
		var el=$(this)
		if (el.parent().parent().find(".unidad1-item").length){
			$(".nuevo .unidad1 input").val(el.parent().parent().find(".unidad1-item").text());
			$(".nuevo .cantidad-unidad input").val(el.parent().parent().find(".cantidad-unidad-item").text());
			$(".nuevo .cantidad input").val(el.parent().parent().find(".cantidad-item").text());
		}else{
			$(".nuevo .cantidad-item input").val(el.parent().parent().find(".cantidad-item").text());
		}
		selectUnidad[0].selectize.setValue(el.parent().parent().find("> div").eq(1).find("p").text());
		selectCategoria[0].selectize.setValue(el.parent().parent().find("> div").eq(2).find("p").text());
		$(".nuevo input").eq(3).val(el.parent().parent().find("> div").eq(3).find("p").text());
		console.log($(".nuevo .producto input"), el.parent().parent().find("> div").eq(4).find("p").text());

		// selectBodega[0].selectize.setValue(el.parent().parent().find("> div").eq(5).find("p").text());
		$(".nuevo input").eq(6).val(el.parent().parent().find("> div").eq(6).find("p").text());
		$(".ubicacion p").val(el.parent().parent().find("> div").eq(7).find("p").html());

		$(".nuevo .cancel").hide();
		$(".content-lote > ul li").animate({opacity:1});
		$('.acciones').show();
		$(".nuevo .producto input").val(el.parent().parent().find("> div").eq(4).find("p").text());
		editando = el.index();
	})


	$(document).on('click', ".nuevo .cancel", function(){
		var el=$(this)
		// $(".nuevo input").eq(0).val(el.parent().parent().find("> div").eq(0).find("p").eq(1).text());
		// $(".nuevo input").eq(1).val(el.parent().parent().find("> div").eq(1).find("p").text());
		// $(".nuevo select").eq(0).val(el.parent().parent().find("> div").eq(2).find("p").text());
		// $(".nuevo input").eq(2).val(el.parent().parent().find("> div").eq(3).find("p").text());
		// $(".nuevo input").eq(4).val(el.parent().parent().find("> div").eq(4).find("p").text());
		// $(".nuevo select").eq(5).val(el.parent().parent().find("> div").eq(5).find("p").text());
		// $(".nuevo input").eq(6).val(el.parent().parent().find("> div").eq(6).find("p").text());

		$(".nuevo input").val("");
		$(".ubicacion p").html("");
		$(".article-info ul > li.active").removeClass("inactive");
		$('.vencimiento').datepicker().datepicker("setDate", "1");
		$('.lote').val(moment($("body .info .fechaInput").val()).format("DDMMYY"));
		$('.acciones').show();
		$(".content-lote > ul li").removeClass("active");
		$(".content-lote > ul li").removeClass("inactive");
		$(".nuevo .cancel").hide();
		editando=-1;
	})


	$(".content-lote > ul").css(
		"min-height",
		$(window).height() -
			($("header").outerHeight() + $(".info").outerHeight() + 160)
	);
	console.log(287,($("header").outerHeight() + $(".info").outerHeight() + 160));
	console.log($(window).height() - ($("header").outerHeight() + $(".info").outerHeight() + 160));
	//$(".content-lote > ul").height($(window ).height() - (50+$("header").outerHeight()+$(".info").outerHeight()+ $(".content-lote .nuevo").outerHeight()))

	$("body .info .fechaInput").change(function(){

		if(!($("body .info .factura .traslado input").is(":checked"))){
			var lote= moment($("body .info .fechaInput").val()).format("DDMMYY");
			$(".lote").val(lote);
			var items=JSON.parse(localStorage.getItem("entrada"));
			var newItems=[];
			items.map(function(it,i){
				it.lote=lote;
				newItems.push(it);
			})
			localStorage.setItem("entrada",JSON.stringify(newItems));

			$(".content-lote > ul li").map(function(){
				$(this).find("> div").eq(3).html("<p>"+lote+"</p>");
			})
		}

		var infoEntrada=localStorage.getItem("infoEntrada");
		if(infoEntrada){
			infoEntrada=JSON.parse(infoEntrada);
			infoEntrada.fecha=$(this).val();
			localStorage.setItem("infoEntrada",JSON.stringify(infoEntrada));
		}else{
			localStorage.setItem("infoEntrada","{}");
		}

	})

	$("body .info .recibido input").change(function(){

	})

	$("body .info .digitado input").change(function(){

	})
	$("body .info .placa input").change(function(){

	})

	$("body .info .tipo input").change(function(){

	})
	$("body .info .cCostos input").change(function(){

	})
	$("body .info .certficado input").change(function(){

	})

	$("body .info .bodega input").change(function(){

	})

	$("body .info .factura input").change(function(){

	})

	$("body .info .factura .facturaNumber").focusout(function(){
		var infoEntrada=localStorage.getItem("infoEntrada");
		if(infoEntrada){
			infoEntrada=JSON.parse(infoEntrada);
			infoEntrada.factura=$(this).val();
			localStorage.setItem("infoEntrada",JSON.stringify(infoEntrada));
		}else{
			localStorage.setItem("infoEntrada","{}");
		}
	})


	$(document).on("change", "body .info .factura .traslado input", function (evt) {
		if($(this).is(":checked")){
			$(".lote").prop( "disabled", false );
		}else{
			$(".lote").prop( "disabled", true )
			var lote= moment($("body .info .fechaInput").val()).format("DDMMYY");
			$(".lote").val(lote);
		}

		var infoEntrada=localStorage.getItem("infoEntrada");
		if(infoEntrada){
			infoEntrada=JSON.parse(infoEntrada);
			infoEntrada.traslado=$(this).is(":checked");
			localStorage.setItem("infoEntrada",JSON.stringify(infoEntrada));
		}else{
			localStorage.setItem("infoEntrada","{}");
		}

	});

	$(".subir").click(function(){
		var body = $("html, body");
		body.stop().animate({scrollTop:0}, 500, 'swing', function() {});
	})

	$(".crear").click(function(){
		var valido=true;
		var mensaje="";
		console.log($("body .info .fechaInput").val());
		console.log( moment($("body .info .fechaInput").val()).utc().format("YYYY-MM-DD HH:mm:ss"));
		if(!(moment($("body .info .fechaInput").val())._isValid)){
			mensaje=mensaje+"<br> - Debe colocar una fecha válida.";
			valido=false;
		};
		if(benefactor[1]==undefined){
			mensaje=mensaje+"<br> - Debe seleccionar un Benefactor.";
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
		if(!($("body .info .placa .selectize-control .item").html())){
			mensaje=mensaje+"<br> - Debe seleccionar la placa del vehículo.";
			valido=false;
		};
		// if(!($("body .info .digitado .selectize-control .item").html())){
		// 	mensaje=mensaje+"<br> - Debe seleccionar quien digitó.";
		// 	valido=false;
		// };
		// if($("body .info .digitado .number").val()==""){
		// 	mensaje=mensaje+"<br> - Debe digitar el documento de quien digitó.";
		// 	valido=false;
		// };
		if($("body .info .tipo .number").val()==""){
			mensaje=mensaje+"<br> - Debe seleccionar el tipo de mercancia.";
			valido=false;
		};
		if(!($("body .info .cCostos .selectize-control .item").html())){
			mensaje=mensaje+"<br> - Debe seleccionar el centro de costos.";
			valido=false;
		};
		if($("body .info .cCostos .number").val()==""){
			mensaje=mensaje+"<br> - Debe digitar el codigo del centro de costos.";
			valido=false;
		};
		if(!($("body .info .certificado .selectize-control .item").html())){
			mensaje=mensaje+"<br> - Debe seleccionar si es con certificado de donación.";
			valido=false;
		};
		if($("body .info .certificado .number").val()==""){
			mensaje=mensaje+"<br> - Debe digitar el valor.";
			valido=false;
		};
		if(!($("body .info .bodega .selectize-control .item").html())){
			mensaje=mensaje+"<br> - Debe seleccionar la bodega.";
			valido=false;
		};
		if($("body .info .factura .facturaNumber").val()==""){
			mensaje=mensaje+"<br> - Debe digitar el número de la factura.";
			valido=false;
		};
		var lotes = $(".content-lote > ul li").length;
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
			Swal.fire({
				title: 'Estás seguro?',
				text: "Desea crear esta entrada con "+ lotes +" lotes!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: c12,
				cancelButtonColor: '#d33',
				confirmButtonText: 'Sí, Crear!',
				cancelButtonText: 'Cancelar'
			}).then((result) => {
				if (result.value) {
					var data={};
					$(".loading").stop().css("display","flex");
					data.fecha = moment($("body .info .fechaInput").val()).format("YYYY-MM-DD HH:mm:ss");
					// data.fecha = moment().format("YYYY-MM-DD H:M:S");
					data.benefactor = benefactor[1];
					data.benefactorCod = benefactor[0];
					data.nit = $("body .info .institucion input").eq(1).val();
					data.entregado = $("body .info .recibido .selectize-control .item").html();
					data.cedula = $("body .info .recibido .number").val();
					data.placa = $("body .info .placa .selectize-control .item").html();
					data.digitado = ($("body .info .digitado .selectize-control .item").html())?$("body .info .digitado .selectize-control .item").html():"";
					data.cedulaDigitado = $("body .info .digitado .number").val();
					data.tipo = $("body .info .tipo .selectize-control .item").html();
					data.cCostos = $("body .info #cCostos").val();
					data.certificado = $("body .info .certificado .selectize-control .item").html();
					data.valor = ($("body #valor").val())?$("body #valor").val():0;
					data.bodega = $("body .info #bodega ").val();
					data.factura = $("body .info .factura .facturaNumber").val();
					data.traslado=($("body .info .factura .traslado input").is(":checked"))?2:1;
					data.lotes= [];

					var files=[];
					$('body .info .listFiles li').map(function(i,it){
						files.push($(this).find("img").attr("src"));
					})
					data.files= files;

					$(".content-lote > ul li").map(function(i,it){
						var item={};
						item.individual = ($(this).find("> div").eq(0).find(".unidad1-item").length) ? $(this).find("> div").eq(0).find(".unidad1-item").text() : null;
						item.individualCantidad = ($(this).find("> div").eq(0).find(".cantidad-unidad-item").length) ? redondearDecimales($(this).find("> div").eq(0).find(".cantidad-unidad-item").text(), 2) : null;
						item.cantidad = $(this).find("> div").eq(0).find(".cantidad-item").text();
						item.unidad=$(this).find("> div").eq(1).find("p").text();
						item.categoria=$(this).find("> div").eq(2).find("p").text();
						item.lote=$(this).find("> div").eq(3).find("p").text();
						item.producto=$(this).find("> div").eq(4).find("p").text();
						item.vencimiento=moment($(this).find("> div").eq(5).find("p").text()).format('YYYY-MM-DD');
						
						if(currentProfile.type=="bodega"){
							item.bodega=currentProfile.id;
						}
						if(currentProfile.type=="banco"){
							var bodega="";
							$(this).find("> div").eq(6).find("p span").map(function(){
								bodega=bodega+","+$(this).data("id");
							});	
							bodega=($(this).find("> div").eq(6).find("p").text().length>0)?bodega.substring(1,bodega.length):"";
							item.bodega=($(this).find("> div").eq(6).find("p").text().length>0)?bodega.split(","):[];
						}
						
						if($("#certificado").val()=="2"){
							item.valorUnitario=$(this).find(".valor-content-item").find(".valor-item").text().substring(1,$(this).find(".valor-content-item").find(".valor-item").text().length);
							item.valorIva=$(this).find(".valor-content-item").find(".iva-item").text();
						}else{
							item.valorUnitario=0;
							item.valorIva=0;
						}

						data.lotes.push(item);
					});

					data.lotes.map((it)=>{
						if (it.individual == 0 || it.individual == "0" || it.individual == null || it.individual == "null" || it.individualCantidad == 0 || it.individualCantidad == "0.00" || it.individualCantidad == "0" || it.individualCantidad == null || it.individualCantidad == "null"){
							it.individual = null;
							it.individualCantidad = null;
						}
					})

					console.log(data);
					// Ajax crear entrada
					// $.ajax({
					// 	data: data,
					// 	type: "POST",
					// 	url: uriControllers+"entrada/crearEntrada.php",
					// })
					// .done(function( data, textStatus, jqXHR ) {
					// 	console.log(data);
					// 	$(".content-lote > ul").empty();
					// 	$("body #valor").val("0");
					// 	$("body .info .institucion input").val("")
					// 	$("body .info .recibido input").val("")
					// 	selectRecibido[0].selectize.setValue("");
					// 	selectPlaca[0].selectize.setValue("");
					// 	$(".info .placa input").val("")
					// 	$("body .info .digitado input").val("")
					// 	selectDigito[0].selectize.setValue("");
					// 	selectTipo[0].selectize.setValue("");
					// 	$(".info .tipo input").val("")
					// 	selectCCostos[0].selectize.setValue("");
					// 	$("body .info .cCostos input").val("")
					// 	selectBodega[0].selectize.setValue(defaultBodega);
					// 	$(".info .bodega input").val("")
					// 	$(".info .factura input").val("");
					// 	benefactor=[];
					// 	$('.fechaInput').datepicker().datepicker("setDate", "0");
					// 	$('.vencimiento').datepicker().datepicker("setDate", "1");
					// 	selectBenefactor[0].selectize.setValue("");
					// 	$("body .info .listFiles").empty();
					// 	localStorage.setItem("entrada","[]");
					// 	localStorage.setItem("infoEntrada","{}");

					// 	$(".loading").stop().fadeOut(function(){
					// 		Swal.fire({
					// 			position: 'top-end',
					// 			icon: 'success',
					// 			title: 'Hecho',
					// 			showConfirmButton: false,
					// 			timer: 1500
					// 		})
					// 	});
					// 	$(".total-certificado p").html("$0");
					// })
					// .fail(function( jqXHR, textStatus, errorThrown ) {
					// 	console.log(jqXHR);
					// 	$(".loading").stop().fadeOut(function(){
					// 		Swal.fire({
					// 			position: 'top-end',
					// 			icon: 'error',
					// 			title: 'Error, intentar nuevamente',
					// 			showConfirmButton: false,
					// 			timer: 1500
					// 		})
					// 	});
					// });

				}
			})
		}
	})

	var editor = CKEDITOR.replace("editor", {
		docType: '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',
		enterMode: CKEDITOR.ENTER_P,
		shiftEnterMode: CKEDITOR.ENTER_BR,
		entities: "false",
		customConfig: './config.js',
		entities_additional: "",
		entities_greek: "false",
		entities_latin: "false",
		height: "200",
		resize_enabled: "true",
		toolbar: "customize",
		uiColor: "#dddddd",
		contentsCss: cssFactura,
		title: "Fundación Saciar",
		language: "es"
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

	$(".imprimir").click(function(){
		var lotes = $(".content-lote ul li").length;
		var valido = true;
		var mensaje = "";

		if (!(moment($("body .info .fechaInput").val())._isValid)) {
			mensaje = mensaje + "<br> - Debe colocar una fecha válida.";
			valido = false;
		};
		if (benefactor[1] == undefined) {
			mensaje = mensaje + "<br> - Debe seleccionar un Benefactor.";
			valido = false;
		};
		if (!($("body .info .recibido .selectize-control .item").html())) {
			mensaje = mensaje + "<br> - Debe seleccionar quien recibe.";
			valido = false;
		};
		if ($("body .info .recibido .number").val() == "") {
			mensaje = mensaje + "<br> - Debe digitar el documento de quien recibe.";
			valido = false;
		};
		if (!($("body .info .placa .selectize-control .item").html())) {
			mensaje = mensaje + "<br> - Debe seleccionar la placa del vehículo.";
			valido = false;
		};
		// if(!($("body .info .digitado .selectize-control .item").html())){
		// 	mensaje=mensaje+"<br> - Debe seleccionar quien digitó.";
		// 	valido=false;
		// };
		// if($("body .info .digitado .number").val()==""){
		// 	mensaje=mensaje+"<br> - Debe digitar el documento de quien digitó.";
		// 	valido=false;
		// };
		if ($("body .info .tipo .number").val() == "") {
			mensaje = mensaje + "<br> - Debe seleccionar el tipo de mercancia.";
			valido = false;
		};
		if (!($("body .info .cCostos .selectize-control .item").html())) {
			mensaje = mensaje + "<br> - Debe seleccionar el centro de costos.";
			valido = false;
		};
		if ($("body .info .cCostos .number").val() == "") {
			mensaje = mensaje + "<br> - Debe digitar el codigo del centro de costos.";
			valido = false;
		};
		if (!($("body .info .certificado .selectize-control .item").html())) {
			mensaje = mensaje + "<br> - Debe seleccionar si es con certificado de donación.";
			valido = false;
		};
		if ($("body .info .certificado .number").val() == "") {
			mensaje = mensaje + "<br> - Debe digitar el valor.";
			valido = false;
		};
		if (!($("body .info .bodega .selectize-control .item").html())) {
			mensaje = mensaje + "<br> - Debe seleccionar la bodega.";
			valido = false;
		};
		if ($("body .info .factura .facturaNumber").val() == "") {
			mensaje = mensaje + "<br> - Debe digitar el número de la factura.";
			valido = false;
		};
		var lotes = $(".content-lote > ul li").length;
		if (lotes < 1) {
			mensaje = mensaje + "<br> - Debe crear como mínimo 1 lote.";
			valido = false;
		};
		if (!valido) {
			Swal.fire({
				title: 'Información faltante.',
				html: mensaje,
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: c12,
				confirmButtonText: 'Cerrar'
			})
		} else {
			$(".modalSaciar").css("display", "flex");
			$(".modalSaciar h4").text("Imprimir");
			$("body, html").css("overflow", "hidden");

			var fecha = "";
			console.log($("body .info .factura p"));
			var numFactura = $("body .info .factura p").text();
			var institucion = $("body .info .institucion .selectize-control .item").html();
			var nit = $("body .info .institucion input").eq(1).val();
			var persona = $("body .info .recibido .selectize-control .item").html();
			var cedula = $("body .info .recibido .number").val();
			var hojaLotes = 22;

			$(".factura-main").empty();
			productosLista = $("body .content-lote > ul > li");
			var productos = groupArr(productosLista, hojaLotes);
			for (var i = 0; i < productos.length; i++) {
				var currentProductos = productos[i];
				var factura = $('<div class="factura"></div>');
				factura.append(
					'<div class="header"><p>0</p><div class="logo"><img data-cke-saved-src="./images/abaco small.jpg" src="./images/abaco small.jpg"><img class="abaco" data-cke-saved-src="./images/abaco small.jpg" src="./images/abaco small.jpg"></div><div class="informe"><h3><br></h3><h4>INFORME DE ENTREGA CC-01</h4><h5><br></h5><p>' +
					numFactura +
					'</p><h6><br></h6></div><div class="fecha"><p>Fecha: ' +
					moment($("body .info .fechaInput").val()).format("DD-MM-YYYY") + ' / ' + moment().format("HH:mm:ss") +
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
							benefactor[0]) +
						"</p><p>" +
						$(it).find("> div").eq(4).find("p").text() +
						"</p></li>";
					max = j;
				});

				for (var k = max; k < 21; k++) {
					lista = lista + "<li><p></p><p></p><p></p><p></p></li>";
				}

				lista = lista + "</ul></div>";

				factura.append(lista);

				// factura.append(
				// 	'<div class="footer"><div class="institucion"><div class="nombre"><div><h4>Institucion Beneficiada</h4><p>' +
				// 		institucion +
				// 		"</p></div><div><h4>Nit:</h4><p>" +
				// 		nit +
				// 		'</p></div><h6>'+beneficiado[3]+'</h6></div></div><div class="factura"><div><p>Recibí: ' +
				// 		persona +
				// 		"</p><p>C.C. " +
				// 		cedula +
				// 		'</p></div><h6>Declaro que los productos recibidos son aptos para el consumo y no se pueden comercializar</h6></div><div class="direccion"><p>Carrera 50 No 25-261 - PBX: (604) 2351088 - info@saciar.org.co</p><p>email: info.oriente@saciar.org.co</p></div></div>'
				// );
				factura.append(
					'<div class="footer"><div class="institucion"><div class="nombre"><div><h4>Institución Benefactora</h4><p>' +
					institucion +
					"</p></div><div><h4>Nit:</h4><p>" +
					nit +
					'</p></div><h6>' + '' + '</h6></div></div><div class="factura"><div><p>Recibí: ' +
					persona +
					"</p><p>C.C. " +
					cedula +
					'</p></div><h6>Declaro que los productos recibidos son aptos para el consumo y no se pueden comercializar</h6></div><div class="direccion"><p>Carrera 50 No 25-261 - PBX: (604) 2351088 - info@saciar.org.co</p><p>email: info.oriente@saciar.org.co</p></div></div>'
				);
				$(".factura-main").append(factura);
			}

			// CKEDITOR.addCss('.cke_editable ul {background: red;}');
			console.log($(".factura-main").html());
			CKEDITOR.instances["editor"].setData($(".factura-main").html());

			CKEDITOR.on("instanceReady", function (evt) {
				var editor = evt.editor;
				editor.on("change", function (e) {});
			});
			setTimeout(function () {
				$(".modalSaciar-main #cke_1_contents").height(($(window).height() * 0.7) - ($(".modalSaciar-header").height() + $(".modalSaciar-main #cke_1_top").height()));
			}, 200)
		}
	});

	$(".limpiar").click(function(){
		var lotes = $(".content-lote > ul li").length;
		Swal.fire({
			title: 'Estás seguro?',
			text: "Desea limpiar esta entrada con "+ lotes +" lotes!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: c12,
			cancelButtonColor: '#d33',
			confirmButtonText: 'Sí, Limpiar!',
			cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.value) {
				$(".content-lote > ul").empty();
				$("body .info .institucion input").val("")
				selectRecibido[0].selectize.setValue("");
				$("body .info .recibido input").val("")
				selectPlaca[0].selectize.setValue("");
				$("body .info .placa input").val("")
				selectDigito[0].selectize.setValue("");
				$("body .info .digitado input").val("")
				selectTipo[0].selectize.setValue("");
				$("body .info .tipo input").val("")
				selectCCostos[0].selectize.setValue("");
				$("body .info .cCostos input").val("")
				selectCertificado[0].selectize.setValue("");
				$("body .info .certificado input").val("")
				selectBodega[0].selectize.setValue("");
				$("body .info .bodega input").val("")
				localStorage.setItem("entrada","[]");
			}
		})
	})

	function move(arr, old_index, new_index) {
			while (old_index < 0) {
					old_index += arr.length;
			}
			while (new_index < 0) {
					new_index += arr.length;
			}
			if (new_index >= arr.length) {
					var k = new_index - arr.length;
					while ((k--) + 1) {
							arr.push(undefined);
					}
			}
			 arr.splice(new_index, 0, arr.splice(old_index, 1)[0]);
		 return arr;
	}

	var positionInit=-1;
	$( ".content-lote > ul" ).sortable({
		update: function( event, ui ) {
			console.log(ui)
			$(".content-lote > ul li").map(function(i,it){
				$(this).find("> div").eq(0).find("p").eq(0).text(i+1);
			})

			var items=JSON.parse(localStorage.getItem("entrada"));
			items=(items)?items:[];

			var newItems=move(items,positionInit,ui.item.index())
			localStorage.setItem("entrada",JSON.stringify(newItems));
		},
		start:function( event, ui ) {
			positionInit=ui.item.index();
		}
	});
  	$( ".content-lote > ul" ).disableSelection();


	$("body .content-lote > ul").empty();
	var items=JSON.parse(localStorage.getItem("entrada"));
	items=(items)?items:[];
	items.map(function(it,i){
		var item=it;

		var benefactor = "benefactor";
		var codBenefactor = "codBenefactor";

		var nuevoLi=$('<li class="ui-sortable-handle"></li>');
		if (item.individual){
			nuevoLi.append("<div><p>" + (i + 1) + "</p><p><span class='unidad1-item'>" + item.individual + "</span> Unidades de <span class='cantidad-unidad-item'>" + item.individualCantidad + "</span>" + item.unidad + "   =   <span class='cantidad-item'>" + item.cantidad + " </span>" + item.unidad + "</p></div>");
		}else{
			nuevoLi.append("<div><p>" + (i + 1) + "</p><p><span class='cantidad-item'>" + item.cantidad + " </span>" + item.unidad + "</p></div>");
		}
		nuevoLi.append('<div><p>'+item.unidad+'</p></div>');
		nuevoLi.append('<div><p>'+item.categoria+'</p></div>');
		nuevoLi.append('<div><p>'+item.lote+'</p></div>');
		// nuevoLi.append('<div><p>'+$('.nuevo select').eq(1).val()+'</p></div>');
		// nuevoLi.append('<div><p>'+$('.nuevo input').eq(3).val()+'</p></div>');
		nuevoLi.append('<div><p>'+item.producto+'</p></div>');
		// nuevoLi.append('<div><p>'+item.bodega+'</p></div>');
		nuevoLi.append('<div><p>'+item.vencimiento+'</p></div>');
		nuevoLi.append('<div><p>'+item.bodega+'</p></div>');
		nuevoLi.append("<div class='valor-content-item'><p>$<span class='valor-item'>" + item.valorUnitario  + " </span> x <span class='iva-item'>"+item.valorIva+"</span>% = <span class='total-item'>$"+redondearDecimales(item.valorUnitario+(item.valorUnitario*(item.valorIva/100)),2)+"</span></p></div>");

		nuevoLi.append("<div class='btns'><div class='btn edit' title='Editar'></div><div class='btn delete' title='Eliminar'></div><div class='btn duplicate' title='Duplicar'></div></div>");

		$(".content-lote > ul").append(nuevoLi);
	});


	$(".nuevo .cancel").hide();
	var nuevoFijo= false;
	$( window ).scroll(function() {
		if($(window ).scrollTop() > $("header").outerHeight()+$(".info").outerHeight()+30){
			nuevoFijo= true;
			$(".nuevo").addClass("nuevoFijo")
		}else{
			nuevoFijo= false;
			$(".nuevo").removeClass("nuevoFijo")
		}
	});

	$(document).on("change", 'input[type="file"]', function(e) {
		var input = e.target;
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				console.log(input.files[0].name,e.target);
				$('body .info .listFiles').append('<li><div class="btn delete" title="Eliminar"></div><div class="btn image"></div><p>'+input.files[0].name+'</p><div class="img" style="display: none;"><img title="" src="'+e.target.result+'"></div></li>');

			};
			reader.readAsDataURL(input.files[0]);
		}
	});

	$(document).on("mouseover", "body .info .listFiles li .image", function(evt) {
		$(this).parent().find(".img").css("display","flex")
	})

	$(document).on("mouseout", "body .info .listFiles li .image", function(evt) {
		$(this).parent().find(".img").hide();
	})

	$(document).on("click", "body .info .listFiles li .delete", function(evt) {
		$(this).parent().remove();
	})

	$(document).on("click", ".ubicacion .article-info ul > li", function(evt) {
		($(this).hasClass("active"))?$(this).removeClass("active"):$(this).addClass("active");
		var ubicacion="";
		$(".ubicacion .article-info ul > .active").map(function(){
			ubicacion=ubicacion+"-<span data-id='"+$(this).data("id")+"'>"+$(this).html()+"</span>"
		});
		ubicacion=($(".ubicacion .article-info ul > .active").length>0)?ubicacion.substring(1,ubicacion.length):"";
		$(".ubicacion p").html(ubicacion)
	})

	$(".valor-content").hide();
	$(".valor-total-total").hide();
	// const valorElement = document.getElementById('valor');
	// valorElement.disabled = false;
	// valorElement.value = null;
	// $(".valor-content").show();

	var selectCertificado= $('#certificado').selectize({
	    sortField: 'text',
			onChange: function(value, isOnInitialize) {
				const valorElement = document.getElementById('valor');
				if (value === '1' || value === '3') {
					valorElement.disabled = true;
					valorElement.value = 0;
					$(".valor-content").hide();
					$(".valor-content-item").hide();
					$(".valor-total-total").hide();
				} else {
					valorElement.disabled = true;
					valorElement.value = null;
					$(".valor-content").show();
					$(".valor-content-item").show();
					$(".valor-total-total").show();

					let entrada= localStorage.getItem('entrada');
				 	entrada=(entrada)?JSON.parse(entrada):[];
					let total=0;
					entrada.map((it)=>{
						total+=it.valorUnitario+(it.valorUnitario*(it.valorIva/100));
					});
					total=redondearDecimales(total,2);
					$("#valor").val(total);
					$(".total-certificado p").html("$"+total);
				}
				var infoEntrada=localStorage.getItem("infoEntrada");
				infoEntrada=JSON.parse(infoEntrada);
				infoEntrada.certificado=value
				localStorage.setItem("infoEntrada",JSON.stringify(infoEntrada));
			}
  	});
		let valorIva=-1;
		let valorUnitario=0;
		$(".valor-iva select").on("change", function(e) {
			valorIva=Number(e.target.value);
			$(".valor-unitario-total input").val(redondearDecimales(valorUnitario+(valorUnitario*(valorIva/100)),2));
		});

		$(".valor-unitario input").on("keyup", function(e) {
			valorUnitario=Number(e.target.value);
			if(valorIva>0){
				$(".valor-unitario-total input").val(redondearDecimales(valorUnitario+(valorUnitario*(valorIva/100)),2));
			}
		});

		var selectRecibido= $('#recibido').selectize({
	    sortField: 'text',
			onChange: function(value, isOnInitialize) {
				// benefactor = value.split("-");
				$("body .recibido .number").val(value);

				var infoEntrada=localStorage.getItem("infoEntrada");
				if(infoEntrada){
					infoEntrada=JSON.parse(infoEntrada);
					infoEntrada.recibido=value
					localStorage.setItem("infoEntrada",JSON.stringify(infoEntrada));
				}else{
					localStorage.setItem("infoEntrada","{}");
				}
			}
  	});

  	var selectDigito= $('#digitado').selectize({
		sortField: 'text',
		onChange: function(value, isOnInitialize) {
			// benefactor = value.split("-");
			$("body .digitado input").val(value);

			var infoEntrada=localStorage.getItem("infoEntrada");
			if(infoEntrada){
				infoEntrada=JSON.parse(infoEntrada);
				infoEntrada.digitado=value
				localStorage.setItem("infoEntrada",JSON.stringify(infoEntrada));
			}else{
				localStorage.setItem("infoEntrada","{}");
			}
		}
	});

var selectPlaca= $('#placa').selectize({
	sortField: 'text',
		onChange: function(value, isOnInitialize) {
			// benefactor = value.split("-");
			$("body .placa input").val(value);

			var infoEntrada=localStorage.getItem("infoEntrada");
			if(infoEntrada){
				infoEntrada=JSON.parse(infoEntrada);
				infoEntrada.placa=value
				localStorage.setItem("infoEntrada",JSON.stringify(infoEntrada));
			}else{
				localStorage.setItem("infoEntrada","{}");
			}
		}
});

var selectTipo= $('#tipo').selectize({
	sortField: 'text',
		onChange: function(value, isOnInitialize) {
			// benefactor = value.split("-");
			$("body .tipo input").val(value);

			var infoEntrada=localStorage.getItem("infoEntrada");
			if(infoEntrada){
				infoEntrada=JSON.parse(infoEntrada);
				infoEntrada.tipo=value
				localStorage.setItem("infoEntrada",JSON.stringify(infoEntrada));
			}else{
				localStorage.setItem("infoEntrada","{}");
			}
		}
});


var selectCCostos= $('#cCostos').selectize({
	sortField: 'text',
		onChange: function(value, isOnInitialize) {
			// benefactor = value.split("-");
			$("body .cCostos input").val(value);

			var infoEntrada=localStorage.getItem("infoEntrada");
			if(infoEntrada){
				infoEntrada=JSON.parse(infoEntrada);
				infoEntrada.cCostos=value
				localStorage.setItem("infoEntrada",JSON.stringify(infoEntrada));
			}else{
				localStorage.setItem("infoEntrada","{}");
			}
		}
});

// var selectCertificado= $('#certificado').selectize({
// 	sortField: 'text',
// 		onChange: function(value, isOnInitialize) {
// 			// benefactor = value.split("-");
// 			$("body .certificado input").val(value);

// 			var infoEntrada=localStorage.getItem("infoEntrada");
// 			if(infoEntrada){
// 				infoEntrada=JSON.parse(infoEntrada);
// 				infoEntrada.certificado=value
// 				localStorage.setItem("infoEntrada",JSON.stringify(infoEntrada));
// 			}else{
// 				localStorage.setItem("infoEntrada","{}");
// 			}
// 		}
// });

var selectBodega= $('#bodega').selectize({
	sortField: 'text',
		onChange: function(value, isOnInitialize) {
			// benefactor = value.split("-");
			$("body .bodega input").val(value);

			var infoEntrada=localStorage.getItem("infoEntrada");
			if(infoEntrada){
				infoEntrada=JSON.parse(infoEntrada);
				infoEntrada.bodega=value;
				localStorage.setItem("infoEntrada",JSON.stringify(infoEntrada));
			}else{
				localStorage.setItem("infoEntrada","{}");
			}
		}
});

	var selectBenefactor= $('#benefactor').selectize({
    sortField: 'text',
		onChange: function(value, isOnInitialize) {
			benefactor = value.split("-");
			$("body .info .institucion input").eq(1).val(benefactor[2]);

			var infoEntrada=localStorage.getItem("infoEntrada");
			if(infoEntrada){
				infoEntrada=JSON.parse(infoEntrada);
				infoEntrada.benefactor=value
				localStorage.setItem("infoEntrada",JSON.stringify(infoEntrada));
			}else{
				localStorage.setItem("infoEntrada","{}");
			}
		}
  	});

	var selectCategoria= $('#categorias').selectize({
		sortField: 'text',
			onChange: function(value, isOnInitialize) {
				categoria = value.split("-");
			}
	});
		var unidad="";
		var selectUnidad= $('.unidad').selectize({
		sortField: 'text',
			onChange: function(value, isOnInitialize) {
				unidad = value;
			}
	});

	var selectIva= $('.select-iva').selectize({
		sortField: 'text',
			onChange: function(value, isOnInitialize) {
			}
	});



	var infoEntrada=localStorage.getItem("infoEntrada");
	if(infoEntrada){
		infoEntrada=JSON.parse(infoEntrada);
		console.log(infoEntrada);
		if(infoEntrada.fecha){
			$(".fecha .fechaInput").val(infoEntrada.fecha);
		}
		if(infoEntrada.benefactor){
			selectBenefactor[0].selectize.setValue(infoEntrada.benefactor);
		}
		if(infoEntrada.recibido){
			selectRecibido[0].selectize.setValue(infoEntrada.recibido);
		}
		if(infoEntrada.digitado){
			selectDigito[0].selectize.setValue(infoEntrada.digitado);
		}
		if(infoEntrada.placa){
			selectPlaca[0].selectize.setValue(infoEntrada.placa);
		}
		if(infoEntrada.tipo){
			selectTipo[0].selectize.setValue(infoEntrada.tipo);
		}
		if(infoEntrada.cCostos){
			selectCCostos[0].selectize.setValue(infoEntrada.cCostos);
		}
		if(infoEntrada.certificado){
			selectCertificado[0].selectize.setValue(infoEntrada.certificado);
		}
		if(infoEntrada.bodega){
			// selectBodega[0].selectize.setValue(infoEntrada.bodega);
		}
		selectBodega[0].selectize.setValue(defaultBodega);

		if(infoEntrada.factura){
			$("body .info .factura .facturaNumber").val(infoEntrada.factura);
		}
		if(infoEntrada.fecha){
			$("body .info .fechaInput").val(infoEntrada.fecha);
		}
		console.log(infoEntrada.traslado);
		if(infoEntrada.traslado){
			$("body .info .factura .traslado input").attr('checked',(infoEntrada.traslado)?"checked":"");
			if(infoEntrada.traslado){
				$(".lote").prop( "disabled", false );
			}else{
				$(".lote").prop( "disabled", true )
				var lote= moment($("body .info .fechaInput").val()).format("DDMMYY");
				$(".lote").val(lote);
			}
		}
	}else{
		localStorage.setItem("infoEntrada","{}");
	}

	
	  
	  

});
