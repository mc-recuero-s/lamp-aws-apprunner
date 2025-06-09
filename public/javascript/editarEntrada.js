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

	// if($(".info .factura input").val()==""){
	// 	var facturaActual="";
	// 	if($("body .info .factura p").text()!=""){
	// 		facturaActual=($("body .info .factura p").text()).split("-")[1];
	// 	}
	// 	$(".info .factura input").val(moment().format("YYYY-")+(Number(facturaActual)+1));
	// }

	$("input.decimal").on("keydown", function(e) {
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
	$(".nuevo .save").click(function(){
		console.log($(".nuevo select").eq(0));
		console.log($(".nuevo select").eq(0).val());
		if(editando==-1){
			// Swal.fire({
			// 	title: 'Estás seguro?',
			// 	text: "Desea guardar este registro!",
			// 	icon: 'warning',
			// 	showCancelButton: true,
			// 	confirmButtonColor: c12,
			// 	cancelButtonColor: '#d33',
			// 	confirmButtonText: 'Sí, Agregarlo!',
			// 	cancelButtonText: 'Cancelar'
			// }).then((result) => {
			// 	if (result.value) {
					// localStorage add lote
					// if(!($(".nuevo input").eq(0).val()=="" || $(".nuevo input").eq(1).val()=="" || $(".nuevo select").eq(0).val()=="" || $(".nuevo input").eq(3).val()=="" || $(".nuevo input").eq(5).val()=="" || $(".nuevo select").eq(0).val()==""  || $(".nuevo input").eq(7).val()=="")){
					if(!($(".nuevo input").eq(0).val()=="" || $(".nuevo select").eq(0).val()=="" || $(".nuevo select").eq(1).val()=="" || $(".nuevo input").eq(3).val()=="" || $(".nuevo input").eq(5).val()=="" || $(".nuevo input").eq(6).val()=="")){
						var entrada= localStorage.getItem('entrada');
						entrada=(entrada)?JSON.parse(entrada):[];

						var item={};
						console.log($(".nuevo input").eq(6).val());
						item.cantidad= ((Math.round(($(".nuevo input").eq(0).val()).replace(",",".") * 100) / 100));
						item.unidad= $(".nuevo select").eq(0).val();
						item.categoria= $(".nuevo select").eq(1).val();
						item.lote= $(".nuevo input").eq(3).val();
						item.producto= $(".nuevo input").eq(5).val();
						item.bodega= $(".ubicacion p").html();
						item.vencimiento= $(".nuevo input").eq(6).val();
						entrada.push(item);
						// localStorage.setItem("entrada",JSON.stringify(entrada));

						var nuevoLi=$("<li></li>");
						nuevoLi.append("<div style='min-width:initial'><p>"+($(".content-lote > ul li").length+1)+"</p><p>"+((Math.round(($(".nuevo input").eq(0).val()).replace(",",".") * 100) / 100))+"</p></div>");
						nuevoLi.append("<div><p>"+$(".nuevo select").eq(0).val()+"</p></div>");
						nuevoLi.append("<div><p>"+$(".nuevo select").eq(1).val()+"</p></div>");
						nuevoLi.append("<div><p>"+$(".nuevo input").eq(3).val()+"</p></div>");
						// nuevoLi.append("<div><p>"+$(".nuevo select").eq(1).val()+"</p></div>");
						// nuevoLi.append("<div><p>"+$(".nuevo input").eq(3).val()+"</p></div>");
						nuevoLi.append("<div><p>"+$(".nuevo input").eq(5).val()+"</p></div>");
						// nuevoLi.append("<div><p>"+$(".nuevo select").eq(0).val()+"</p></div>");
						nuevoLi.append("<div><p>"+$(".nuevo input").eq(6).val()+"</p></div>");
						nuevoLi.append("<div><p>"+$(".ubicacion p").html()+"</p></div>");

						nuevoLi.append("<div class='btns'><div class='btn edit' title='Editar'></div><div class='btn delete' title='Eliminar'></div><div class='btn refresh' title='Refrescar'></div></div>");

						$(".nuevo input").val("");
						$(".article-info ul > li.active").removeClass("active");
						$(".ubicacion p").html("");
						$(".article-info ul > li.active").removeClass("active");
						$('.vencimiento').datepicker().datepicker("setDate", "1");
						$('.lote').val(moment($("body .info .fechaInput").val()).format("DDMMYY"));
						selectCategoria[0].selectize.setValue("");
						// selectBodega[0].selectize.setValue("");
						$(".content-lote > ul").append(nuevoLi);
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Hecho',
							showConfirmButton: false,
							timer: 1500
						})
					}
			// 	}
			// })
		}else{
			$(".content-lote > ul li").eq(editando).addClass("editado");
			$(".content-lote > ul li").eq(editando).removeClass("eliminado");
			$(".content-lote > ul li").eq(editando).find("> div").eq(0).find("p").eq(1).text(((Math.round(($(".nuevo input").eq(0).val()).replace(",",".") * 100) / 100)));
			$(".content-lote > ul li").eq(editando).find("> div").eq(1).find("p").text($(".nuevo select").eq(0).val());
			$(".content-lote > ul li").eq(editando).find("> div").eq(2).find("p").text($(".nuevo select").eq(1).val());
			$(".content-lote > ul li").eq(editando).find("> div").eq(3).find("p").text($(".nuevo input").eq(3).val());

			// $(".content-lote > ul li").eq(editando).find("> div").eq(4).find("p").text($(".nuevo input").eq(4).val());
			// $(".content-lote > ul li").eq(editando).find("> div").eq(0).find("p").text($(".nuevo select").eq(0).val());
			// $(".content-lote > ul li").eq(editando).find("> div").eq(6).find("p").text($(".nuevo input").eq(6).val());

			$(".content-lote > ul li").eq(editando).find("> div").eq(4).find("p").text($(".nuevo input").eq(5).val());
			$(".content-lote > ul li").eq(editando).find("> div").eq(5).find("p").text($(".nuevo input").eq(6).val());
			$(".content-lote > ul li").eq(editando).find("> div").eq(6).find("p").html($(".ubicacion p").html());

			var item={};
			item.cantidad= ((Math.round(($(".nuevo input").eq(0).val()).replace(",",".") * 100) / 100));
			item.unidad= $(".nuevo select").eq(0).val();
			item.categoria= $(".nuevo select").eq(1).val();
			item.lote= $(".nuevo input").eq(3).val();

			// item.producto= $(".nuevo input").eq(4).val();
			item.bodega= $(".ubicacion p").html();
			item.producto= $(".nuevo input").eq(5).val();
			item.vencimiento= $(".nuevo input").eq(6).val();

			var items=JSON.parse(localStorage.getItem("entrada"));
			items[editando]=item;
			// localStorage.setItem("entrada",JSON.stringify(items));
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
	})

	$(document).on('click', ".content-lote > ul li .edit", function(){
		// console.log(moment($(this).parent().parent().find("> div").eq(6).find("p").html()).format("DD MMMM YYYY"));
	});

	var editando= -1;
	var editandoId= "";
	var lotesOriginales=[];

	$(document).on('click', ".content-lote > ul li .edit", function(){
		var el=$(this)
		$(".nuevo input").eq(0).val(el.parent().parent().find("> div").eq(0).find("p").eq(1).text());
		// $(".nuevo select").eq(0).val(el.parent().parent().find("> div").eq(1).find("p").text());
		selectUnidad[0].selectize.setValue(el.parent().parent().find("> div").eq(1).find("p").text());
		selectCategoria[0].selectize.setValue(el.parent().parent().find("> div").eq(2).find("p").text());
		$(".nuevo input").eq(5).val(el.parent().parent().find("> div").eq(4).find("p").text());
		$(".nuevo input").eq(6).val(el.parent().parent().find("> div").eq(5).find("p").text());
		$(".ubicacion p").html(el.parent().parent().find("> div").eq(6).find("p").html());

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
		$(".content-lote > ul li").animate({opacity:0.2});
		el.parent().parent().stop().animate({opacity:1});
		editando= el.parent().parent().index();
		editandoId=el.parent().parent().data("id");
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
				if(el.parent().parent().hasClass("original")){
					el.parent().parent().addClass("eliminado");
					el.parent().parent().removeClass("editado");
				}else{
					el.parent().parent().remove();
					$("body .content-lote > ul li").map(function(i,it){
						$(this).find("> div").eq(0).find("p").eq(0).text(i+1);
					})
				}
			}
		})
	})

	$(document).on('click', ".content-lote > ul li .duplicate", function(){
		var el=$(this)
		$(".nuevo input").eq(0).val(el.parent().parent().find("> div").eq(0).find("p").eq(1).text());
		$(".nuevo input").eq(1).val(el.parent().parent().find("> div").eq(1).find("p").text());
		selectCategoria[0].selectize.setValue(el.parent().parent().find("> div").eq(2).find("p").text());
		$(".nuevo input").eq(3).val(el.parent().parent().find("> div").eq(3).find("p").text());
		$(".nuevo input").eq(4).val(el.parent().parent().find("> div").eq(4).find("p").text());
		// selectBodega[0].selectize.setValue(el.parent().parent().find("> div").eq(5).find("p").text());
		$(".nuevo input").eq(6).val(el.parent().parent().find("> div").eq(6).find("p").text());
		$(".ubicacion p").val(el.parent().parent().find("> div").eq(7).find("p").html());

		$(".nuevo .cancel").hide();
		$(".content-lote > ul li").animate({opacity:1});
		$('.acciones').show();
		editando=-1;
	})

	$(document).on('click', ".content-lote > ul li .refresh", function(){
		$(this).parent().parent().removeClass("eliminado");
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
		$(".article-info ul > li.active").removeClass("active");
		$('.vencimiento').datepicker().datepicker("setDate", "1");
		$('.lote').val(moment($("body .info .fechaInput").val()).format("DDMMYY"));
		$('.acciones').show();
		$(".content-lote > ul li").animate({opacity:1});
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
			// var lote= moment($("body .info .fechaInput").val()).format("DDMMYY");
			// $(".lote").val(lote);
			// var items=JSON.parse(localStorage.getItem("entrada"));
			// var newItems=[];
			// items.map(function(it,i){
			// 	it.lote=lote;
			// 	newItems.push(it);
			// })
			// localStorage.setItem("entrada",JSON.stringify(newItems));
			//			
			// $(".content-lote > ul li").map(function(){
			// 	$(this).find("> div").eq(3).html("<p>"+lote+"</p>");
			// })
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

			$(".modalSaciar").css("display", "flex");
			$(".modalSaciar-contenido > div").hide();
			$(".modalSaciar-editar-justificar").css("display", "flex");
			$(".modalSaciar h4").text("Justificar cambio");
			$("body, html").css("overflow", "hidden");

		}
	})


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
					data.valor = $("body .info .certificado .number").val();
					data.bodega = $("body .info #bodega ").val();
					data.factura = $("body .info .factura .facturaNumber").val();
					data.traslado=($("body .info .factura .traslado input").is(":checked"))?2:1;
					data.causa = $("#causa").val();
					data.justificacion = $("#descripcion").val();
					data.usuario = localStorage.getItem("user");
					data.lotes= [];
					data.lotesEliminados= [];
					data.lotesEditados= [];
					data.lotesReales= [];
					data.id=$(".editarEntrada").data("id");
					var files=[];
					$('body .info .listFiles li').map(function(i,it){
						files.push($(this).find("img").attr("src"));
					})
					data.files= files;

					$(".content-lote > ul li.original").map(function(i,it){
						var item={};
						item.cantidad=$(this).find("> div").eq(0).find("p").eq(1).text();
						item.unidad=$(this).find("> div").eq(1).find("p").text();
						item.categoria=$(this).find("> div").eq(2).find("p").text();
						item.lote=$(this).find("> div").eq(3).find("p").text();
						item.producto=$(this).find("> div").eq(4).find("p").text();
						item.vencimiento=moment($(this).find("> div").eq(5).find("p").text()).format('YYYY-MM-DD');
						var bodega="";
						$(this).find("> div").eq(6).find("p span").map(function(){
							bodega=bodega+","+$(this).data("id");
						});
						bodega=($(this).find("> div").eq(6).find("p").text().length>0)?bodega.substring(1,bodega.length):"";
						item.bodega=($(this).find("> div").eq(6).find("p").text().length>0)?bodega.split(","):[];
						if($(this).hasClass("eliminado") || $(this).hasClass("editado")){
							item.id=$(this).data("id");
							if($(this).hasClass("eliminado")){
								data.lotesEliminados.push(item);
							}
							if($(this).hasClass("editado")){
								data.lotesEditados.push(item);
							}
						}else{
							item.id=$(this).data("id");
							data.lotesReales.push(item);
						}
					})

					$(".content-lote > ul li").map(function(i,it){
						var item={};
						item.cantidad=$(this).find("> div").eq(0).find("p").eq(1).text();
						item.unidad=$(this).find("> div").eq(1).find("p").text();
						item.categoria=$(this).find("> div").eq(2).find("p").text();
						item.lote=$(this).find("> div").eq(3).find("p").text();
						item.producto=$(this).find("> div").eq(4).find("p").text();
						item.vencimiento=moment($(this).find("> div").eq(5).find("p").text()).format('YYYY-MM-DD');
						var bodega="";
						$(this).find("> div").eq(6).find("p span").map(function(){
							bodega=bodega+","+$(this).data("id");
						});
						bodega=($(this).find("> div").eq(6).find("p").text().length>0)?bodega.substring(1,bodega.length):"";
						item.bodega=($(this).find("> div").eq(6).find("p").text().length>0)?bodega.split(","):[];
						if(!($(this).hasClass("original"))){
							data.lotes.push(item);
						}
					});

					console.log(data);
					// console.log(JSON.stringify(data));
					// Ajax crear entrada
					data.causa = $("#causa").val();
					data.justificacion = $("#descripcion").val();
					data.usuario = localStorage.getItem("user");
					$.ajax({
						data: data,
						type: "POST",
						url: uriControllers+"entrada/editarEntrada.php",
					})
					.done(function( data, textStatus, jqXHR ) {
						console.log(data);
					// 	$(".content-lote > ul").empty();
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
					// 	// localStorage.setItem("entrada","[]");
					// 	// localStorage.setItem("infoEntrada","{}");
					//
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
						let data= JSON.parse(jqXHR.responseText);
						$(".loading").stop().fadeOut(function(){
							Swal.fire({
								position: 'top-end',
								icon: 'error',
								title: data.message,
								// showConfirmButton: false,
								// timer: 1500
							})
						});
					});
				}
			})
		}

	})

	$(".modalSaciar .modalSaciar-close").click(function () {
		$(".modalSaciar").hide();
		$(".modalSaciar h4").text("");
		$("body, html").css("overflow", "initial");
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
				// localStorage.setItem("entrada","[]");
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
	// $( ".content-lote > ul" ).sortable({
	// 	update: function( event, ui ) {
	// 		console.log(ui)
	// 		$(".content-lote > ul li").map(function(i,it){
	// 			$(this).find("> div").eq(0).find("p").eq(0).text(i+1);
	// 		})
	//
	// 		var items=JSON.parse(localStorage.getItem("entrada"));
	// 		items=(items)?items:[];
	//
	// 		var newItems=move(items,positionInit,ui.item.index())
	// 		// localStorage.setItem("entrada",JSON.stringify(newItems));
	// 	},
	// 	start:function( event, ui ) {
	// 		positionInit=ui.item.index();
	// 	}
	// });
  $( ".content-lote > ul" ).disableSelection();


	$("body .content-lote > ul").empty();
	// var items=JSON.parse(localStorage.getItem("entrada"));
	// items=(items)?items:[];
	// items.map(function(it,i){
	// 	var item=it;
	//
	// 	var benefactor = "benefactor";
	// 	var codBenefactor = "codBenefactor";
	//
	// 	var nuevoLi=$('<li class=""></li>');
	// 	nuevoLi.append('<div><p>'+(i+1)+'</p><p>'+item.cantidad+'</p></div>');
	// 	nuevoLi.append('<div><p>'+item.unidad+'</p></div>');
	// 	nuevoLi.append('<div><p>'+item.categoria+'</p></div>');
	// 	nuevoLi.append('<div><p>'+item.lote+'</p></div>');
	// 	// nuevoLi.append('<div><p>'+$('.nuevo select').eq(1).val()+'</p></div>');
	// 	// nuevoLi.append('<div><p>'+$('.nuevo input').eq(3).val()+'</p></div>');
	// 	nuevoLi.append('<div><p>'+item.producto+'</p></div>');
	// 	// nuevoLi.append('<div><p>'+item.bodega+'</p></div>');
	// 	nuevoLi.append('<div><p>'+item.vencimiento+'</p></div>');
	// 	nuevoLi.append('<div><p>'+item.bodega+'</p></div>');
	//
	// 	nuevoLi.append("<div class='btns'><div class='btn edit' title='Editar'></div><div class='btn delete' title='Eliminar'></div><div class='btn duplicate' title='Duplicar'></div></div>");
	//
	// 	$(".content-lote > ul").append(nuevoLi);
	// });


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

var selectCertificado= $('#certificado').selectize({
	sortField: 'text',
		onChange: function(value, isOnInitialize) {
			// benefactor = value.split("-");
			$("body .certificado input").val(value);

			var infoEntrada=localStorage.getItem("infoEntrada");
			if(infoEntrada){
				infoEntrada=JSON.parse(infoEntrada);
				infoEntrada.certificado=value
				localStorage.setItem("infoEntrada",JSON.stringify(infoEntrada));
			}else{
				localStorage.setItem("infoEntrada","{}");
			}
		}
});

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
			console.log(value);
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

	console.log($(".editarEntrada").data("id"));
	$.ajax({
		data: {
			id: $(".editarEntrada").data("id")
		},
		type: "POST",
		url: uriControllers+"entrada/entrada.php",
	})
	.done(function( data, textStatus, jqXHR ) {
		let infoEntrada=JSON.parse(data);
		console.log(infoEntrada);
		let lotes=infoEntrada.data.lotes;
		lotes.map(function(it,i){
			lotes[i].cantidad1=it.cantidad;
		})
		console.log(lotes);
		infoEntrada=infoEntrada.data.entradas[0];
		if(infoEntrada.fecha){
			$(".fecha .fechaInput").val(moment(infoEntrada.fecha).format("DD MMMM YYYY"));
		}
		if(infoEntrada.benefactorSelect){
			selectBenefactor[0].selectize.setValue(infoEntrada.benefactorSelect);
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
			selectTipo[0].selectize.setValue((infoEntrada.tipo=="Compra")?"2":"1");
		}
		if(infoEntrada.cCostos){
			selectCCostos[0].selectize.setValue(infoEntrada.cCostos);
		}
		if(infoEntrada.certificadoDonacion){
			selectCertificado[0].selectize.setValue((infoEntrada.certificadoDonacion=="No")?"3":"2");
		}
		if(infoEntrada.bodega){
			selectBodega[0].selectize.setValue(infoEntrada.bodega);
		}
		selectBodega[0].selectize.setValue(defaultBodega);

		if(infoEntrada.factura){
			$("body .info .factura .facturaNumber").val(infoEntrada.factura);
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




		var items=lotes;
		items=(items)?items:[];
		lotesOriginales=items;
		items.map(function(it,i){
			var item=it;

			var benefactor = "benefactor";
			var codBenefactor = "codBenefactor";

			var nuevoLi=$('<li class=" original" data-id="'+item.id+'"></li>');
			nuevoLi.append('<div style="min-width:initial"><p>'+(i+1)+'</p><p>'+item.cantidad+'</p></div>');
			nuevoLi.append('<div><p>'+item.unidad+'</p></div>');
			nuevoLi.append('<div><p>'+item.categoria+'</p></div>');
			nuevoLi.append('<div><p>'+item.lote+'</p></div>');
			// nuevoLi.append('<div><p>'+$('.nuevo select').eq(1).val()+'</p></div>');
			// nuevoLi.append('<div><p>'+$('.nuevo input').eq(3).val()+'</p></div>');
			nuevoLi.append('<div><p>'+item.producto+'</p></div>');
			// nuevoLi.append('<div><p>'+item.bodega+'</p></div>');
			nuevoLi.append('<div><p>'+item.vencimiento+'</p></div>');
			// nuevoLi.append('<div><p>'+item.bodega+'</p></div>');
			nuevoLi.append('<div><p>'+'</p></div>');

			nuevoLi.append("<div class='btns'><div class='btn edit' title='Editar'></div><div class='btn delete' title='Eliminar'></div><div class='btn refresh' title='Refrescar'></div></div>");

			$(".content-lote > ul").append(nuevoLi);
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

});
