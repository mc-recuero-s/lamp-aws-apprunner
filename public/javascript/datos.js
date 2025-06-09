// Datepicker Config
$(document).ready(function() {

	var uriControllers="../../controllers/";

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

	$("body .content").css("height",$(window).height()-260);
	// $("body .content").css("max-height",$(window).height()-280);
	$("body .listas").css("height",$(window).height()-280);

	var currentIndex=0;
	$("body .nav li").click(function(){
		var ind=$(this).index();
		console.log(ind,currentIndex);
		if(ind!=currentIndex){
			$("body .listas > div").hide();
			$("body .listas > div").eq(ind).show();

			$("body .nav li").removeClass("active");
			$(this).addClass("active");
			// $(this).parent().parent().find("h3").removeClass("activeTipo");
			// $("body .listas ul").hide();
			// (!visible)?$(this).parent().find("ul").show():"";
			// (!visible)?$(this).addClass("activeTipo"):"";
			currentIndex=ind;
		}
	})

	$(document).on('click', "body .listas ul li .btns .edit", function(){
		// $(this).parent().parent().parent().parent().find(".normalEdit").hide();
		// $(this).parent().parent().parent().parent().find(".normal").show();

		$(this).parent().parent().parent().find(".normalEdit").css("display","flex");
		$(this).parent().parent().parent().find(".normal").hide();
		$(this).parent().parent().parent().find(".normalEdit h4 input").val($(this).parent().parent().parent().find(".normal h4").text())
		$(this).parent().parent().parent().find(".normalEdit h5 input").val($(this).parent().parent().parent().find(".normal h5").text())
		$(this).parent().parent().parent().find(".normalEdit h6 input").val($(this).parent().parent().parent().find(".normal h6").text())
		$(this).parent().parent().parent().find(".normalEdit p input").val($(this).parent().parent().parent().find(".normal p").text())

	})

	$(document).on('click', "body .listas ul li .btns .delete", function(){
		var el = $(this).parent().parent().parent();

		if($(this).parent().parent().parent().parent().parent().hasClass("productos")){
			var that = $(this);

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
					$(".loading").stop().css("display","flex");
					var item={
						id: that.parent().parent().parent().data("id"),
						tipo: 'producto'
					}
					$.ajax({
							data: item,
							type: "POST",
							url: uriControllers+"datos/datosDelete.php",
					})
					 .done(function( data, textStatus, jqXHR ) {
							$(".loading").stop().fadeOut();
							el.remove();
							Swal.fire({
								position: 'top-end',
								icon: 'success',
								title: 'Hecho',
								showConfirmButton: false,
								timer: 1500
							})
					 })
					 .fail(function( jqXHR, textStatus, errorThrown ) {
							 $(".loading").stop().fadeOut();
							 Swal.fire({
			 						position: 'top-end',
			 						icon: 'error',
			 						title: 'Error, intentar nuevamente',
			 						showConfirmButton: false,
			 						timer: 1500
		 					})
					});
				}
			});
		}

		if($(this).parent().parent().parent().parent().parent().hasClass("benefactores")){
			var that = $(this);

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
					$(".loading").stop().css("display","flex");
					var item={
						id: that.parent().parent().parent().data("id"),
						tipo: 'benefactor'
					}
					$.ajax({
							data: item,
							type: "POST",
							url: uriControllers+"datos/datosDelete.php",
					})
					 .done(function( data, textStatus, jqXHR ) {
							$(".loading").stop().fadeOut();
							el.remove();
							Swal.fire({
								position: 'top-end',
								icon: 'success',
								title: 'Hecho',
								showConfirmButton: false,
								timer: 1500
							})
					 })
					 .fail(function( jqXHR, textStatus, errorThrown ) {
							 $(".loading").stop().fadeOut();
							 Swal.fire({
			 						position: 'top-end',
			 						icon: 'error',
			 						title: 'Error, intentar nuevamente',
			 						showConfirmButton: false,
			 						timer: 1500
		 					})
					});
				}
			});
		}

		if($(this).parent().parent().parent().parent().parent().hasClass("beneficiados")){
			var that = $(this);

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
					$(".loading").stop().css("display","flex");
					var item={
						id: that.parent().parent().parent().data("id"),
						tipo: 'beneficiados'
					}
					$.ajax({
							data: item,
							type: "POST",
							url: uriControllers+"datos/datosDelete.php",
					})
					 .done(function( data, textStatus, jqXHR ) {
							$(".loading").stop().fadeOut();
							el.remove();
							Swal.fire({
								position: 'top-end',
								icon: 'success',
								title: 'Hecho',
								showConfirmButton: false,
								timer: 1500
							})
					 })
					 .fail(function( jqXHR, textStatus, errorThrown ) {
							 $(".loading").stop().fadeOut();
							 Swal.fire({
			 						position: 'top-end',
			 						icon: 'error',
			 						title: 'Error, intentar nuevamente',
			 						showConfirmButton: false,
			 						timer: 1500
		 					})
					});
				}
			});
		}


		if($(this).parent().parent().parent().parent().parent().hasClass("recibidoEntrada")){
			var that = $(this);

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
					$(".loading").stop().css("display","flex");
					var item={
						id: that.parent().parent().parent().data("id"),
						tipo: 'recibidoEntrada'
					}
					$.ajax({
							data: item,
							type: "POST",
							url: uriControllers+"datos/datosDelete.php",
					})
					 .done(function( data, textStatus, jqXHR ) {
							$(".loading").stop().fadeOut();
							el.remove();
							Swal.fire({
								position: 'top-end',
								icon: 'success',
								title: 'Hecho',
								showConfirmButton: false,
								timer: 1500
							})
					 })
					 .fail(function( jqXHR, textStatus, errorThrown ) {
							 $(".loading").stop().fadeOut();
							 Swal.fire({
			 						position: 'top-end',
			 						icon: 'error',
			 						title: 'Error, intentar nuevamente',
			 						showConfirmButton: false,
			 						timer: 1500
		 					})
					});
				}
			});
		}


		if($(this).parent().parent().parent().parent().parent().hasClass("recibidoSalida")){
			var that = $(this);

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
					$(".loading").stop().css("display","flex");
					var item={
						id: that.parent().parent().parent().data("id"),
						tipo: 'recibidoSalida'
					}
					$.ajax({
							data: item,
							type: "POST",
							url: uriControllers+"datos/datosDelete.php",
					})
					 .done(function( data, textStatus, jqXHR ) {
							$(".loading").stop().fadeOut();
							el.remove();
							Swal.fire({
								position: 'top-end',
								icon: 'success',
								title: 'Hecho',
								showConfirmButton: false,
								timer: 1500
							})
					 })
					 .fail(function( jqXHR, textStatus, errorThrown ) {
							 $(".loading").stop().fadeOut();
							 Swal.fire({
			 						position: 'top-end',
			 						icon: 'error',
			 						title: 'Error, intentar nuevamente',
			 						showConfirmButton: false,
			 						timer: 1500
		 					})
					});
				}
			});
		}

		if($(this).parent().parent().parent().parent().parent().hasClass("digitadores")){
			var that = $(this);

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
					$(".loading").stop().css("display","flex");
					var item={
						id: that.parent().parent().parent().data("id"),
						tipo: 'digitador'
					}
					$.ajax({
							data: item,
							type: "POST",
							url: uriControllers+"datos/datosDelete.php",
					})
					 .done(function( data, textStatus, jqXHR ) {
							$(".loading").stop().fadeOut();
							el.remove();
							Swal.fire({
								position: 'top-end',
								icon: 'success',
								title: 'Hecho',
								showConfirmButton: false,
								timer: 1500
							})
					 })
					 .fail(function( jqXHR, textStatus, errorThrown ) {
							 $(".loading").stop().fadeOut();
							 Swal.fire({
			 						position: 'top-end',
			 						icon: 'error',
			 						title: 'Error, intentar nuevamente',
			 						showConfirmButton: false,
			 						timer: 1500
		 					})
					});
				}
			});
		}

		if($(this).parent().parent().parent().parent().parent().hasClass("bodega")){
			var that = $(this);

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
					$(".loading").stop().css("display","flex");
					var item={
						id: that.parent().parent().parent().data("id"),
						tipo: 'bodega'
					}
					$.ajax({
							data: item,
							type: "POST",
							url: uriControllers+"datos/datosDelete.php",
					})
					 .done(function( data, textStatus, jqXHR ) {
							$(".loading").stop().fadeOut();
							el.remove();
							Swal.fire({
								position: 'top-end',
								icon: 'success',
								title: 'Hecho',
								showConfirmButton: false,
								timer: 1500
							})
					 })
					 .fail(function( jqXHR, textStatus, errorThrown ) {
							 $(".loading").stop().fadeOut();
							 Swal.fire({
			 						position: 'top-end',
			 						icon: 'error',
			 						title: 'Error, intentar nuevamente',
			 						showConfirmButton: false,
			 						timer: 1500
		 					})
					});
				}
			});
		}

		if($(this).parent().parent().parent().parent().parent().hasClass("ubicacionbodega")){
			var that = $(this);

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
					$(".loading").stop().css("display","flex");
					var item={
						id: that.parent().parent().parent().data("id"),
						tipo: 'bodega'
					}
					$.ajax({
							data: item,
							type: "POST",
							url: uriControllers+"datos/datosDelete.php",
					})
					 .done(function( data, textStatus, jqXHR ) {
							$(".loading").stop().fadeOut();
							el.remove();
							Swal.fire({
								position: 'top-end',
								icon: 'success',
								title: 'Hecho',
								showConfirmButton: false,
								timer: 1500
							})
					 })
					 .fail(function( jqXHR, textStatus, errorThrown ) {
							 $(".loading").stop().fadeOut();
							 Swal.fire({
			 						position: 'top-end',
			 						icon: 'error',
			 						title: 'Error, intentar nuevamente',
			 						showConfirmButton: false,
			 						timer: 1500
		 					})
					});
				}
			});
		}

		if($(this).parent().parent().parent().parent().parent().hasClass("placa")){
			var that = $(this);

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
					$(".loading").stop().css("display","flex");
					var item={
						id: that.parent().parent().parent().data("id"),
						tipo: 'placa'
					}
					$.ajax({
							data: item,
							type: "POST",
							url: uriControllers+"datos/datosDelete.php",
					})
					 .done(function( data, textStatus, jqXHR ) {
							$(".loading").stop().fadeOut();
							el.remove();
							Swal.fire({
								position: 'top-end',
								icon: 'success',
								title: 'Hecho',
								showConfirmButton: false,
								timer: 1500
							})
					 })
					 .fail(function( jqXHR, textStatus, errorThrown ) {
							 $(".loading").stop().fadeOut();
							 Swal.fire({
			 						position: 'top-end',
			 						icon: 'error',
			 						title: 'Error, intentar nuevamente',
			 						showConfirmButton: false,
			 						timer: 1500
		 					})
					});
				}
			});
		}

	});

	$("body .saveProducto").click(function(){
		var item= {};
		item.nombre = $(".productos h4 input").val();
		item.codigo = $(".productos h5 input").val();
		item.creacion = moment().format('YYYY-MM-DD');
		item.tipo = 'producto';

		if(item.nombre=='' || item.codigo==''){
			Swal.fire({
				title: 'Información faltante.',
				text: "No se puede enviar información en blanco.",
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: c12,
				confirmButtonText: 'Cerrar'
			})
		}else{
			$(".loading").stop().css("display","flex");

			var that = $(this);
			$.ajax({
					data: item,
					type: "POST",
					url: uriControllers+"datos/datos.php",
			})
			 .done(function( data, textStatus, jqXHR ) {
				 	console.log(data);
					var data1=JSON.parse(data);
					var id=data1.data;

					$(".loading").stop().fadeOut();

					$(".productos h4 input").val("");
					$(".productos h5 input").val("");
					that.parent().parent().parent().parent().find(".nuevo").after('<li data-id="'+id+'"><div class="normal"><h4>'+item.nombre+'</h4><h5>'+item.codigo+'</h5><div class="btns"><div class="btn edit"></div><div class="btn delete"></div></div></div><div class="normalEdit"><h4 class="groupForm"><label>Nombre</label><input></h4><h5 class="groupForm"><label>Código</label><input></h5><div class="btns"><div class="btn save"></div></div></div><span>1</span></li>');

					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Hecho',
						showConfirmButton: false,
						timer: 1500
					})
			 })
			 .fail(function( jqXHR, textStatus, errorThrown ) {
					 console.log(jqXHR);
					 $(".loading").stop().fadeOut();
					 Swal.fire({
 						position: 'top-end',
 						icon: 'error',
 						title: 'Error, intentar nuevamente',
 						showConfirmButton: false,
 						timer: 1500
 					})
			});
		}
	});

	$("body .saveBenefactor").click(function(){
		var item= {};
		item.nombre = $(".benefactores h4 input").val();
		item.nit = $(".benefactores h5 input").val();
		item.codigo = $(".benefactores h6 input").val();
		item.creacion = moment().format('YYYY-MM-DD');
		item.tipo = 'benefactor';

		if(item.nombre=='' || item.nit=='' || item.codigo==''){
			Swal.fire({
				title: 'Información faltante.',
				text: "No se puede enviar información en blanco.",
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: c12,
				confirmButtonText: 'Cerrar'
			})
		}else{
			$(".loading").stop().css("display","flex");

			var that = $(this);
			$.ajax({
					data: item,
					type: "POST",
					url: uriControllers+"datos/datos.php",
			})
			 .done(function( data, textStatus, jqXHR ) {
				 	console.log(data);
					var data1=JSON.parse(data);
					var id=data1.data;

					$(".loading").stop().fadeOut();

					$(".benefactores h4 input").val("");
					$(".benefactores h5 input").val("");
					$(".benefactores h6 input").val("");

					console.log(item);
					that.parent().parent().parent().parent().find(".nuevo").after('<li data-id="'+id+'"><div class="normal"><h4>'+item.nombre+'</h4><h5>'+item.nit+'</h5><h6>'+item.codigo+'</h6><div class="btns"><div class="btn edit"></div><div class="btn delete"></div></div></div><div class="normalEdit"><h4 class="groupForm"><label>Nombre</label><input></h4><h5 class="groupForm"><label>NIT</label><input></h5><h6 class="groupForm"><label>Código</label><input></h6><div class="btns"><div class="btn save"></div></div></div><span>1</span></li>');

					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Hecho',
						showConfirmButton: false,
						timer: 1500
					})
			 })
			 .fail(function( jqXHR, textStatus, errorThrown ) {
					 console.log(jqXHR);
					 $(".loading").stop().fadeOut();

					 Swal.fire({
 						position: 'top-end',
 						icon: 'error',
 						title: 'Error, intentar nuevamente',
 						showConfirmButton: false,
 						timer: 1500
 					})
			});
		}
	});

	$("body .saveBeneficiado").click(function(){
		var item= {};
		item.nombre = $(".beneficiados h4 input").val();
		item.nit = $(".beneficiados h5 input").val();
		item.municipio = $(".beneficiados h6 input").val();
		item.poblacion = $(".beneficiados p input").val();
		item.creacion = moment().format('YYYY-MM-DD');
		item.tipo = 'beneficiados';

		if(item.nombre=='' || item.nit=='' || item.municipio==''){
			Swal.fire({
				title: 'Información faltante.',
				text: "No se puede enviar información en blanco.",
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: c12,
				confirmButtonText: 'Cerrar'
			})
		}else{
			$(".loading").stop().css("display","flex");

			var that = $(this);
			$.ajax({
					data: item,
					type: "POST",
					url: uriControllers+"datos/datos.php",
			})
			 .done(function( data, textStatus, jqXHR ) {
				 	console.log(data);
					var data1=JSON.parse(data);
					var id=data1.data;

					$(".loading").stop().fadeOut();

					$(".beneficiados h4 input").val("");
					$(".beneficiados h5 input").val("");
					$(".beneficiados h6 input").val("");
					$(".beneficiados p input").val("");

					console.log(item);
					that.parent().parent().parent().parent().find(".nuevo").after('<li data-id="'+id+'"><div class="normal"><h4>'+item.nombre+'</h4><h5>'+item.nit+'</h5><h6>'+item.municipio+'</h6><div class="btns"><div class="btn edit"></div><div class="btn delete"></div></div></div><div class="normalEdit"><h4 class="groupForm"><label>Nombre</label><input></h4><h5 class="groupForm"><label>NIT</label><input></h5><h6 class="groupForm"><label>M</label><input></h6><div class="btns"><div class="btn save"></div></div></div><span>2</span></li>');

					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Hecho',
						showConfirmButton: false,
						timer: 1500
					})
			 })
			 .fail(function( jqXHR, textStatus, errorThrown ) {
					 console.log(jqXHR);
					 $(".loading").stop().fadeOut();

					 Swal.fire({
 						position: 'top-end',
 						icon: 'error',
 						title: 'Error, intentar nuevamente',
 						showConfirmButton: false,
 						timer: 1500
 					})
			});
		}
	});

	$("body .saveRecibidoEntrada").click(function(){
		var item= {};
		item.nombre = $(".recibidoEntrada h4 input").val();
		item.cedula = $(".recibidoEntrada h5 input").val();
		item.creacion = moment().format('YYYY-MM-DD');
		item.tipo = 'recibidoEntrada';

		if(item.nombre=='' || item.cedula==''){
			Swal.fire({
				title: 'Información faltante.',
				text: "No se puede enviar información en blanco.",
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: c12,
				confirmButtonText: 'Cerrar'
			})
		}else{
			$(".loading").stop().css("display","flex");

			var that = $(this);
			$.ajax({
					data: item,
					type: "POST",
					url: uriControllers+"datos/datos.php",
			})
			 .done(function( data, textStatus, jqXHR ) {
				 	console.log(data);
					var data1=JSON.parse(data);
					var id=data1.data;

					$(".loading").stop().fadeOut();

					$(".recibidoEntrada h4 input").val("");
					$(".recibidoEntrada h5 input").val("");

					console.log(item);
					that.parent().parent().parent().parent().find(".nuevo").after('<li data-id="'+id+'"><div class="normal"><h4>'+item.nombre+'</h4><h5>'+item.cedula+'</h5><div class="btns"><div class="btn edit"></div><div class="btn delete"></div></div></div><div class="normalEdit"><h4 class="groupForm"><label>Nombre</label><input></h4><h5 class="groupForm"><label>Cédula</label><input></h5><div class="btns"><div class="btn save"></div></div></div><span>2</span></li>');

					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Hecho',
						showConfirmButton: false,
						timer: 1500
					})
			 })
			 .fail(function( jqXHR, textStatus, errorThrown ) {
					 console.log(jqXHR);
					 $(".loading").stop().fadeOut();

					 Swal.fire({
 						position: 'top-end',
 						icon: 'error',
 						title: 'Error, intentar nuevamente',
 						showConfirmButton: false,
 						timer: 1500
 					})
			});
		}
	});

	$("body .saveRecibidoSalida").click(function(){
		var item= {};
		item.nombre = $(".recibidoSalida h4 input").val();
		item.cedula = $(".recibidoSalida h5 input").val();
		item.creacion = moment().format('YYYY-MM-DD');
		item.tipo = 'recibidoSalida';

		if(item.nombre=='' || item.cedula==''){
			Swal.fire({
				title: 'Información faltante.',
				text: "No se puede enviar información en blanco.",
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: c12,
				confirmButtonText: 'Cerrar'
			})
		}else{
			$(".loading").stop().css("display","flex");

			var that = $(this);
			$.ajax({
					data: item,
					type: "POST",
					url: uriControllers+"datos/datos.php",
			})
			 .done(function( data, textStatus, jqXHR ) {
				 	console.log(data);
					var data1=JSON.parse(data);
					var id=data1.data;

					$(".loading").stop().fadeOut();

					$(".recibidoSalida h4 input").val("");
					$(".recibidoSalida h5 input").val("");

					console.log(item);
					that.parent().parent().parent().parent().find(".nuevo").after('<li data-id="'+id+'"><div class="normal"><h4>'+item.nombre+'</h4><h5>'+item.cedula+'</h5><div class="btns"><div class="btn edit"></div><div class="btn delete"></div></div></div><div class="normalEdit"><h4 class="groupForm"><label>Nombre</label><input></h4><h5 class="groupForm"><label>Cédula</label><input></h5><div class="btns"><div class="btn save"></div></div></div><span>2</span></li>');

					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Hecho',
						showConfirmButton: false,
						timer: 1500
					})
			 })
			 .fail(function( jqXHR, textStatus, errorThrown ) {
					 console.log(jqXHR);
					 $(".loading").stop().fadeOut();

					 Swal.fire({
 						position: 'top-end',
 						icon: 'error',
 						title: 'Error, intentar nuevamente',
 						showConfirmButton: false,
 						timer: 1500
 					})
			});
		}
	});

	$("body .saveDigitador").click(function(){
		var item= {};
		item.nombre = $(".digitadores h4 input").val();
		item.cedula = $(".digitadores h5 input").val();
		item.creacion = moment().format('YYYY-MM-DD');
		item.tipo = 'digitador';

		if(item.nombre=='' || item.cedula==''){
			Swal.fire({
				title: 'Información faltante.',
				text: "No se puede enviar información en blanco.",
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: c12,
				confirmButtonText: 'Cerrar'
			})
		}else{
			$(".loading").stop().css("display","flex");

			var that = $(this);
			$.ajax({
					data: item,
					type: "POST",
					url: uriControllers+"datos/datos.php",
			})
			 .done(function( data, textStatus, jqXHR ) {
				 	console.log(data);
					var data1=JSON.parse(data);
					var id=data1.data;

					$(".loading").stop().fadeOut();

					$(".digitadores h4 input").val("");
					$(".digitadores h5 input").val("");

					console.log(item);
					that.parent().parent().parent().parent().find(".nuevo").after('<li data-id="'+id+'"><div class="normal"><h4>'+item.nombre+'</h4><h5>'+item.cedula+'</h5><div class="btns"><div class="btn edit"></div><div class="btn delete"></div></div></div><div class="normalEdit"><h4 class="groupForm"><label>Nombre</label><input></h4><h5 class="groupForm"><label>Cédula</label><input></h5><div class="btns"><div class="btn save"></div></div></div><span>2</span></li>');

					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Hecho',
						showConfirmButton: false,
						timer: 1500
					})
			 })
			 .fail(function( jqXHR, textStatus, errorThrown ) {
					 console.log(jqXHR);
					 $(".loading").stop().fadeOut();

					 Swal.fire({
 						position: 'top-end',
 						icon: 'error',
 						title: 'Error, intentar nuevamente',
 						showConfirmButton: false,
 						timer: 1500
 					})
			});
		}
	});

	$("body .saveBodega").click(function(){
		var item= {};
		item.ubicacion = $(".bodega h4 input").val();
		item.creacion = moment().format('YYYY-MM-DD');
		item.tipo = 'bodega';

		if(item.ubicacion==''){
			Swal.fire({
				title: 'Información faltante.',
				text: "No se puede enviar información en blanco.",
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: c12,
				confirmButtonText: 'Cerrar'
			})
		}else{
			$(".loading").stop().css("display","flex");

			var that = $(this);
			$.ajax({
					data: item,
					type: "POST",
					url: uriControllers+"datos/datos.php",
			})
			 .done(function( data, textStatus, jqXHR ) {
				 	console.log(data);
					var data1=JSON.parse(data);
					var id=data1.data;

					$(".loading").stop().fadeOut();

					that.parent().parent().parent().parent().find(".nuevo").after('<li data-id="'+id+'"><div class="normal"><h4>'+item.ubicacion+'</h4><div class="btns"><div class="btn edit"></div><div class="btn delete"></div></div></div><div class="normalEdit"><h4 class="groupForm"><label>ubicacion</label><input></h4><div class="btns"><div class="btn save"></div></div></div><span>1</span></li>');
					$(".ubicacion h4 input").val("");

					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Hecho',
						showConfirmButton: false,
						timer: 1500
					})
			 })
			 .fail(function( jqXHR, textStatus, errorThrown ) {
					 console.log(jqXHR);
					 $(".loading").stop().fadeOut();
					 Swal.fire({
 						position: 'top-end',
 						icon: 'error',
 						title: 'Error, intentar nuevamente',
 						showConfirmButton: false,
 						timer: 1500
 					})
			});
		}
	});

	$("body .savePlaca").click(function(){
		var item= {};
		item.placa = $(".placa h4 input").val();
		item.creacion = moment().format('YYYY-MM-DD');
		item.tipo = 'placa';

		if(item.ubicacion==''){
			Swal.fire({
				title: 'Información faltante.',
				text: "No se puede enviar información en blanco.",
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: c12,
				confirmButtonText: 'Cerrar'
			})
		}else{
			$(".loading").stop().css("display","flex");

			var that = $(this);
			$.ajax({
					data: item,
					type: "POST",
					url: uriControllers+"datos/datos.php",
			})
			 .done(function( data, textStatus, jqXHR ) {
				 	console.log(data);
					var data1=JSON.parse(data);
					var id=data1.data;

					$(".loading").stop().fadeOut();

					that.parent().parent().parent().parent().find(".nuevo").after('<li data-id="'+id+'"><div class="normal"><h4>'+item.placa+'</h4><div class="btns"><div class="btn edit"></div><div class="btn delete"></div></div></div><div class="normalEdit"><h4 class="groupForm"><label>placa</label><input></h4><div class="btns"><div class="btn save"></div></div></div><span>1</span></li>');
					$(".placa h4 input").val("");

					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Hecho',
						showConfirmButton: false,
						timer: 1500
					})
			 })
			 .fail(function( jqXHR, textStatus, errorThrown ) {
					 console.log(jqXHR);
					 $(".loading").stop().fadeOut();
					 Swal.fire({
 						position: 'top-end',
 						icon: 'error',
 						title: 'Error, intentar nuevamente',
 						showConfirmButton: false,
 						timer: 1500
 					})
			});
		}
	});

	$(document).on('click', "body .listas ul li .btns .save", function(){
		// $(this).parent().parent().parent().parent().find(".normalEdit").show();
		// $(this).parent().parent().parent().parent().find(".normal").show();
		if($(this).parent().parent().parent().parent().parent().hasClass("productos")){
			if($(this).parent().parent().parent().find(".normalEdit h4 input").val()=="" || $(this).parent().parent().parent().find(".normalEdit h5 input").val()==""){
				Swal.fire({
					title: 'Información faltante.',
					text: "No se puede enviar información en blanco.",
					icon: 'warning',
					showCancelButton: false,
					confirmButtonColor: c12,
					confirmButtonText: 'Cerrar'
				})
			}else{
				var that = $(this);
				$(".loading").stop().css("display","flex");

				var item={
					nombre: that.parent().parent().parent().find(".normalEdit h4 input").val(),
					codigo: that.parent().parent().parent().find(".normalEdit h5 input").val(),
					id: that.parent().parent().parent().data("id"),
					tipo: 'producto'
				}
				$.ajax({
						data: item,
						type: "POST",
						url: uriControllers+"datos/datosUpdate.php",
				})
				 .done(function( data, textStatus, jqXHR ) {
					 	console.log(data);


						$(".loading").stop().fadeOut();

						that.parent().parent().parent().find(".normalEdit").hide();
						that.parent().parent().parent().find(".normal").css("display","flex");

						that.parent().parent().parent().find(".normal h4").text(that.parent().parent().parent().find(".normalEdit h4 input").val());
						that.parent().parent().parent().find(".normal h5").text(that.parent().parent().parent().find(".normalEdit h5 input").val());
						that.parent().parent().parent().find(".normal h6").text(that.parent().parent().parent().find(".normalEdit h6 input").val());

						nombre: that.parent().parent().parent().find(".normalEdit h4 input").val("");
						codigo: that.parent().parent().parent().find(".normalEdit h5 input").val("");
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Hecho',
							showConfirmButton: false,
							timer: 1500
						})
				 })
				 .fail(function( jqXHR, textStatus, errorThrown ) {
						 console.log(jqXHR);
						 $(".loading").stop().fadeOut();
						 Swal.fire({
	 						position: 'top-end',
	 						icon: 'error',
	 						title: 'Error, intentar nuevamente',
	 						showConfirmButton: false,
	 						timer: 1500
	 					})
				});
			}
		}
		if($(this).parent().parent().parent().parent().parent().hasClass("benefactores")){
			if($(this).parent().parent().parent().find(".normalEdit h4 input").val()=="" || $(this).parent().parent().parent().find(".normalEdit h5 input").val()=="" || $(this).parent().parent().parent().find(".normalEdit h6 input").val()==""){
				Swal.fire({
					title: 'Información faltante.',
					text: "No se puede enviar información en blanco.",
					icon: 'warning',
					showCancelButton: false,
					confirmButtonColor: c12,
					confirmButtonText: 'Cerrar'
				})
			}else{
				var that = $(this);
				$(".loading").stop().css("display","flex");

				var item={
					nombre: that.parent().parent().parent().find(".normalEdit h4 input").val(),
					nit: that.parent().parent().parent().find(".normalEdit h5 input").val(),
					codigo: that.parent().parent().parent().find(".normalEdit h6 input").val(),
					id: that.parent().parent().parent().data("id"),
					tipo: 'benefactor'
				}
				$.ajax({
						data: item,
						type: "POST",
						url: uriControllers+"datos/datosUpdate.php",
				})
				 .done(function( data, textStatus, jqXHR ) {
					 	console.log(data);
						$(".loading").stop().fadeOut();

						that.parent().parent().parent().find(".normalEdit").hide();
						that.parent().parent().parent().find(".normal").css("display","flex");

						that.parent().parent().parent().find(".normal h4").text(that.parent().parent().parent().find(".normalEdit h4 input").val());
						that.parent().parent().parent().find(".normal h5").text(that.parent().parent().parent().find(".normalEdit h5 input").val());
						that.parent().parent().parent().find(".normal h6").text(that.parent().parent().parent().find(".normalEdit h6 input").val());

						that.parent().parent().parent().find(".normalEdit h4 input").val("");
						that.parent().parent().parent().find(".normalEdit h5 input").val("");
						that.parent().parent().parent().find(".normalEdit h6 input").val("");
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Hecho',
							showConfirmButton: false,
							timer: 1500
						})
				 })
				 .fail(function( jqXHR, textStatus, errorThrown ) {
						 console.log(jqXHR);
						 $(".loading").stop().fadeOut();
						 Swal.fire({
	 						position: 'top-end',
	 						icon: 'error',
	 						title: 'Error, intentar nuevamente',
	 						showConfirmButton: false,
	 						timer: 1500
	 					})
				});
			}
		}
		if($(this).parent().parent().parent().parent().parent().hasClass("beneficiados")){
			if($(this).parent().parent().parent().find(".normalEdit h4 input").val()=="" || $(this).parent().parent().parent().find(".normalEdit h5 input").val()=="" || $(this).parent().parent().parent().find(".normalEdit h6 input").val()==""){
				Swal.fire({
					title: 'Información faltante.',
					text: "No se puede enviar información en blanco.",
					icon: 'warning',
					showCancelButton: false,
					confirmButtonColor: c12,
					confirmButtonText: 'Cerrar'
				})
			}else{
				var that = $(this);
				$(".loading").stop().css("display","flex");

				var item={
					nombre: that.parent().parent().parent().find(".normalEdit h4 input").val(),
					nit: that.parent().parent().parent().find(".normalEdit h5 input").val(),
					municipio: that.parent().parent().parent().find(".normalEdit h6 input").val(),
					poblacion: that.parent().parent().parent().find(".normalEdit p input").val(),
					id: that.parent().parent().parent().data("id"),
					tipo: 'beneficiados'
				}
				$.ajax({
						data: item,
						type: "POST",
						url: uriControllers+"datos/datosUpdate.php",
				})
				 .done(function( data, textStatus, jqXHR ) {
					 	console.log(data);
						$(".loading").stop().fadeOut();

						that.parent().parent().parent().find(".normalEdit").hide();
						that.parent().parent().parent().find(".normal").css("display","flex");

						that.parent().parent().parent().find(".normal h4").text(that.parent().parent().parent().find(".normalEdit h4 input").val());
						that.parent().parent().parent().find(".normal h5").text(that.parent().parent().parent().find(".normalEdit h5 input").val());
						that.parent().parent().parent().find(".normal h6").text(that.parent().parent().parent().find(".normalEdit h6 input").val());
						that.parent().parent().parent().find(".normal p").text(that.parent().parent().parent().find(".normalEdit p input").val());

						that.parent().parent().parent().find(".normalEdit h4 input").val("");
						that.parent().parent().parent().find(".normalEdit h5 input").val("");
						that.parent().parent().parent().find(".normalEdit h6 input").val("");
						that.parent().parent().parent().find(".normalEdit p input").val("");
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Hecho',
							showConfirmButton: false,
							timer: 1500
						})
				 })
				 .fail(function( jqXHR, textStatus, errorThrown ) {
						 console.log(jqXHR);
						 $(".loading").stop().fadeOut();
						 Swal.fire({
	 						position: 'top-end',
	 						icon: 'error',
	 						title: 'Error, intentar nuevamente',
	 						showConfirmButton: false,
	 						timer: 1500
	 					})
				});
			}
		}
		if($(this).parent().parent().parent().parent().parent().hasClass("recibidoEntrada")){
			if($(this).parent().parent().parent().find(".normalEdit h4 input").val()=="" || $(this).parent().parent().parent().find(".normalEdit h5 input").val()==""){
				Swal.fire({
					title: 'Información faltante.',
					text: "No se puede enviar información en blanco.",
					icon: 'warning',
					showCancelButton: false,
					confirmButtonColor: c12,
					confirmButtonText: 'Cerrar'
				})
			}else{
				var that = $(this);
				$(".loading").stop().css("display","flex");

				var item={
					nombre: that.parent().parent().parent().find(".normalEdit h4 input").val(),
					cedula: that.parent().parent().parent().find(".normalEdit h5 input").val(),
					id: that.parent().parent().parent().data("id"),
					tipo: 'recibidoEntrada'
				}
				$.ajax({
						data: item,
						type: "POST",
						url: uriControllers+"datos/datosUpdate.php",
				})
				 .done(function( data, textStatus, jqXHR ) {
					 	console.log(data);
						$(".loading").stop().fadeOut();

						that.parent().parent().parent().find(".normalEdit").hide();
						that.parent().parent().parent().find(".normal").css("display","flex");

						that.parent().parent().parent().find(".normal h4").text(that.parent().parent().parent().find(".normalEdit h4 input").val());
						that.parent().parent().parent().find(".normal h5").text(that.parent().parent().parent().find(".normalEdit h5 input").val());

						that.parent().parent().parent().find(".normalEdit h4 input").val();
						that.parent().parent().parent().find(".normalEdit h5 input").val();

						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Hecho',
							showConfirmButton: false,
							timer: 1500
						})
				 })
				 .fail(function( jqXHR, textStatus, errorThrown ) {
						 console.log(jqXHR);
						 $(".loading").stop().fadeOut();
						 Swal.fire({
	 						position: 'top-end',
	 						icon: 'error',
	 						title: 'Error, intentar nuevamente',
	 						showConfirmButton: false,
	 						timer: 1500
	 					})
				});
			}
		}

		if($(this).parent().parent().parent().parent().parent().hasClass("recibidoSalida")){
			if($(this).parent().parent().parent().find(".normalEdit h4 input").val()=="" || $(this).parent().parent().parent().find(".normalEdit h5 input").val()==""){
				Swal.fire({
					title: 'Información faltante.',
					text: "No se puede enviar información en blanco.",
					icon: 'warning',
					showCancelButton: false,
					confirmButtonColor: c12,
					confirmButtonText: 'Cerrar'
				})
			}else{
				var that = $(this);
				$(".loading").stop().css("display","flex");

				var item={
					nombre: that.parent().parent().parent().find(".normalEdit h4 input").val(),
					cedula: that.parent().parent().parent().find(".normalEdit h5 input").val(),
					id: that.parent().parent().parent().data("id"),
					tipo: 'recibidoSalida'
				}
				$.ajax({
						data: item,
						type: "POST",
						url: uriControllers+"datos/datosUpdate.php",
				})
				 .done(function( data, textStatus, jqXHR ) {
					 	console.log(data);
						$(".loading").stop().fadeOut();

						that.parent().parent().parent().find(".normalEdit").hide();
						that.parent().parent().parent().find(".normal").css("display","flex");

						that.parent().parent().parent().find(".normal h4").text(that.parent().parent().parent().find(".normalEdit h4 input").val());
						that.parent().parent().parent().find(".normal h5").text(that.parent().parent().parent().find(".normalEdit h5 input").val());

						that.parent().parent().parent().find(".normalEdit h4 input").val();
						that.parent().parent().parent().find(".normalEdit h5 input").val();

						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Hecho',
							showConfirmButton: false,
							timer: 1500
						})
				 })
				 .fail(function( jqXHR, textStatus, errorThrown ) {
						 console.log(jqXHR);
						 $(".loading").stop().fadeOut();
						 Swal.fire({
	 						position: 'top-end',
	 						icon: 'error',
	 						title: 'Error, intentar nuevamente',
	 						showConfirmButton: false,
	 						timer: 1500
	 					})
				});
			}
		}

		if($(this).parent().parent().parent().parent().parent().hasClass("digitadores")){
			if($(this).parent().parent().parent().find(".normalEdit h4 input").val()=="" || $(this).parent().parent().parent().find(".normalEdit h5 input").val()==""){
				Swal.fire({
					title: 'Información faltante.',
					text: "No se puede enviar información en blanco.",
					icon: 'warning',
					showCancelButton: false,
					confirmButtonColor: c12,
					confirmButtonText: 'Cerrar'
				})
			}else{
				var that = $(this);
				$(".loading").stop().css("display","flex");

				var item={
					nombre: that.parent().parent().parent().find(".normalEdit h4 input").val(),
					cedula: that.parent().parent().parent().find(".normalEdit h5 input").val(),
					id: that.parent().parent().parent().data("id"),
					tipo: 'digitador'
				}
				$.ajax({
						data: item,
						type: "POST",
						url: uriControllers+"datos/datosUpdate.php",
				})
				 .done(function( data, textStatus, jqXHR ) {
					 	console.log(data);
						$(".loading").stop().fadeOut();

						that.parent().parent().parent().find(".normalEdit").hide();
						that.parent().parent().parent().find(".normal").css("display","flex");

						that.parent().parent().parent().find(".normal h4").text(that.parent().parent().parent().find(".normalEdit h4 input").val());
						that.parent().parent().parent().find(".normal h5").text(that.parent().parent().parent().find(".normalEdit h5 input").val());

						that.parent().parent().parent().find(".normalEdit h4 input").val();
						that.parent().parent().parent().find(".normalEdit h5 input").val();

						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Hecho',
							showConfirmButton: false,
							timer: 1500
						})
				 })
				 .fail(function( jqXHR, textStatus, errorThrown ) {
						 console.log(jqXHR);
						 $(".loading").stop().fadeOut();
						 Swal.fire({
	 						position: 'top-end',
	 						icon: 'error',
	 						title: 'Error, intentar nuevamente',
	 						showConfirmButton: false,
	 						timer: 1500
	 					})
				});
			}
		}

		if($(this).parent().parent().parent().parent().parent().hasClass("bodega")){
			if($(this).parent().parent().parent().find(".normalEdit h4 input").val()=="" ){
				Swal.fire({
					title: 'Información faltante.',
					text: "No se puede enviar información en blanco.",
					icon: 'warning',
					showCancelButton: false,
					confirmButtonColor: c12,
					confirmButtonText: 'Cerrar'
				})
			}else{
				var that = $(this);
				$(".loading").stop().css("display","flex");

				var item={
					ubicacion: that.parent().parent().parent().find(".normalEdit h4 input").val(),
					id: that.parent().parent().parent().data("id"),
					tipo: 'bodega'
				}
				$.ajax({
						data: item,
						type: "POST",
						url: uriControllers+"datos/datosUpdate.php",
				})
				 .done(function( data, textStatus, jqXHR ) {
					 	console.log(data);

						$(".loading").stop().fadeOut();

						that.parent().parent().parent().find(".normalEdit").hide();
						that.parent().parent().parent().find(".normal").css("display","flex");

						that.parent().parent().parent().find(".normal h4").text(that.parent().parent().parent().find(".normalEdit h4 input").val());

						that.parent().parent().parent().find(".normalEdit h4 input").val("");

						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Hecho',
							showConfirmButton: false,
							timer: 1500
						})
				 })
				 .fail(function( jqXHR, textStatus, errorThrown ) {
						 console.log(jqXHR);
						 $(".loading").stop().fadeOut();
						 Swal.fire({
	 						position: 'top-end',
	 						icon: 'error',
	 						title: 'Error, intentar nuevamente',
	 						showConfirmButton: false,
	 						timer: 1500
	 					})
				});
			}
		}

		if($(this).parent().parent().parent().parent().parent().hasClass("placa")){
			if($(this).parent().parent().parent().find(".normalEdit h4 input").val()=="" ){
				Swal.fire({
					title: 'Información faltante.',
					text: "No se puede enviar información en blanco.",
					icon: 'warning',
					showCancelButton: false,
					confirmButtonColor: c12,
					confirmButtonText: 'Cerrar'
				})
			}else{
				var that = $(this);
				$(".loading").stop().css("display","flex");

				var item={
					placa: that.parent().parent().parent().find(".normalEdit h4 input").val(),
					id: that.parent().parent().parent().data("id"),
					tipo: 'placa'
				}
				$.ajax({
						data: item,
						type: "POST",
						url: uriControllers+"datos/datosUpdate.php",
				})
				 .done(function( data, textStatus, jqXHR ) {
					 	console.log(data);

						$(".loading").stop().fadeOut();

						that.parent().parent().parent().find(".normalEdit").hide();
						that.parent().parent().parent().find(".normal").css("display","flex");

						that.parent().parent().parent().find(".normal h4").text(that.parent().parent().parent().find(".normalEdit h4 input").val());

						that.parent().parent().parent().find(".normalEdit h4 input").val("");

						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Hecho',
							showConfirmButton: false,
							timer: 1500
						})
				 })
				 .fail(function( jqXHR, textStatus, errorThrown ) {
						 console.log(jqXHR);
						 $(".loading").stop().fadeOut();
						 Swal.fire({
	 						position: 'top-end',
	 						icon: 'error',
	 						title: 'Error, intentar nuevamente',
	 						showConfirmButton: false,
	 						timer: 1500
	 					})
				});
			}
		}



	})
});
