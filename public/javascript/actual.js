$(document).ready(function() {
	const startOfMonth = moment().clone().startOf('month').format('YYYY-MM-DD');
	const endOfMonth   = moment().clone().endOf('month').format('YYYY-MM-DD');

	var itemBenefactor=$(".benefactores ul.task-items li.item").clone();
  $(".benefactores ul.task-items li.item").remove();

	var itemBeneficiado=$(".beneficiados ul.task-items li.item").clone();
  // $(".beneficiados ul.task-items li.item").remove();

  	let editando= true;
	var benefactor=[];
	var beneficiado=[];

	var inicioBeneficiados=startOfMonth;
	var finBeneficiados=endOfMonth;
	var inicioBenefactores=startOfMonth;
	var finBenefactores=endOfMonth;
	$('.fecha-benefactores').daterangepicker({
    opens: 'left',
		startDate: inicioBenefactores,
		endDate: finBenefactores,
		"locale": {
        "format": "YYYY-MM-DD",
        "separator": " - ",
        "applyLabel": "Buscar",
        "cancelLabel": "Cerrar",
        "fromLabel": "Desde",
        "toLabel": "a",
        "customRangeLabel": "Personalizado",
				"timePicker": true,
				 "autoApply": true,
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
		inicioBenefactores=start.format('YYYY-MM-DD');
		finBenefactores=end.format('YYYY-MM-DD');
		console.log(label);
		searchBenefactores(inicioBenefactores, finBenefactores, label);
  });

	var searchBenefactores =function(start, end, label){
		$(".loading").stop().css("display","flex");

		var data1 = {
			inicio: start,
			fin: end,
			benefactor: benefactor[1]
		};
		$.ajax({
			data: data1,
			type: "POST",
			url: "../../controllers/actual/buscarBenefactores.php",
		})
		.done(function( data, textStatus, jqXHR ) {
			var data=JSON.parse(data);
			console.log(data);
			$(".benefactores .instituciones").empty();
			data.benefactores.map(function(it,i){
				var found = false;
				$(".benefactores .instituciones li").map(function(j,jt){
					if($(this).data("id")==it.idbenefectador){
						found=$(this);
					}
				})
				if(!found){
					var cloneItemBenefactor=itemBenefactor.clone();
					cloneItemBenefactor.attr("data-id",it.idbenefectador);
					cloneItemBenefactor.find(".name").text(it.codigo);
					cloneItemBenefactor.find(".text").text(it.nombre);
					cloneItemBenefactor.find(".factura").text(it.nit);

					// cloneItemBenefactor.find(".unidad").text(it.codigo);
					cloneItemBenefactor.find("ol").append("<li><h5>"+it.factura+"</h5> <p>"+moment(it.fecha).format("YYYY-MM-DD")+"</p></li>");
					$(".benefactores .instituciones").append(cloneItemBenefactor);
				}else{
					found.find("ol").append("<li><h5>"+it.factura+"</h5> <p>"+moment(it.fecha).format("YYYY-MM-DD")+"</p></li>");
				}
			});

			$(".loading").stop().fadeOut();
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

	searchBenefactores(inicioBenefactores, finBenefactores, undefined);

	$(document).on("click", ".benefactores ul.task-items li.item", function () {
		if($(this).hasClass("active")){
			$(this).removeClass("active");
		}else{
			$(".benefactores ul.task-items .active").removeClass("active");
			$(this).addClass("active")
		}
	})








	$('.fecha-beneficiados').daterangepicker({
    opens: 'left',
		startDate: inicioBeneficiados,
		endDate: finBeneficiados,
		"locale": {
        "format": "YYYY-MM-DD",
        "separator": " - ",
        "applyLabel": "Buscar",
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
		inicioBeneficiados=start.format('YYYY-MM-DD');
		finBeneficiados=end.format('YYYY-MM-DD');
		searchBeneficiados(inicioBeneficiados, finBeneficiados, label);
  });

	var searchBeneficiados =function(start, end, label){
		$(".loading").stop().css("display","flex");

		var data1 = {
			inicio: start,
			fin: end,
			beneficiado: (beneficiado[0]=="")?undefined:beneficiado[0]
		};
		$.ajax({
			data: data1,
			type: "POST",
			url: "../../controllers/actual/buscarBeneficiados.php",
		})
		.done(function( data, textStatus, jqXHR ) {
			var data=JSON.parse(data);
			$(".beneficiados .instituciones").empty();
			data.beneficiados.map(function(it,i){
				var found = false;
				$(".beneficiados .instituciones li").map(function(j,jt){
					if($(this).data("id")==it.idbeneficiado){
						found=$(this);
					}
				})
				if(!found){
					var cloneItemBeneficiado=itemBeneficiado.clone();
					cloneItemBeneficiado.attr("data-id",it.idbeneficiado);
					cloneItemBeneficiado.find(".name").text(it.nombre);
					cloneItemBeneficiado.find(".text").text(it.nit);
					cloneItemBeneficiado.find(".factura").text(it.poblacion);

					// cloneItemBeneficiado.find(".unidad").text(it.codigo);
					cloneItemBeneficiado.find("ol").append("<li><h5>"+it.factura+"</h5> <p>"+moment(it.fecha).format("YYYY-MM-DD")+"</p></li>");
					$(".beneficiados .instituciones").append(cloneItemBeneficiado);
				}else{
					found.find("ol").append("<li><h5>"+it.factura+"</h5> <p>"+moment(it.fecha).format("YYYY-MM-DD")+"</p></li>");
				}
			});

			$(".loading").stop().fadeOut();
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

	searchBeneficiados(inicioBeneficiados, finBeneficiados, undefined);

	$(document).on("click", ".beneficiados ul.task-items li.item", function () {
		if($(this).hasClass("active")){
			$(this).removeClass("active");
		}else{
			$(".beneficiados ul.task-items .active").removeClass("active");
			$(this).addClass("active")
		}
	})


	$(".descargarPorEntrada").click(function(){
		$(".loading").stop().css("display", "flex");
		$.ajax({
			type: "POST",
			url: "../../controllers/actual/inventarioActual.php",
			data: {
				tipo: 1
			}
		})
		.done(function( data, textStatus, jqXHR ) {
			console.log(data);
			var data=JSON.parse(data);
			if(data && data.success){
				 window.open('./soportes/informes/'+data.data.file+'.xlsx' , '_blank');

			}else{
				Swal.fire({
					title: 'Ha ocurrido un error',
					text: "Intenta Nuevamente",
					icon: 'warning',
					showCancelButton: false,
					confirmButtonColor: "#1D9993",
					cancelButtonColor: '#d33',
					cancelButtonText: 'Cerrar'
				})
			}
			$(".loading").stop().fadeOut();
		})
		.fail(function( jqXHR, textStatus, errorThrown ) {
			Swal.fire({
				title: 'Ha ocurrido un error',
				text: "Intenta Nuevamente",
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: "#1D9993",
				cancelButtonColor: '#d33',
				cancelButtonText: 'Cerrar'
			})
			$(".loading").stop().fadeOut();
		});
	})

	$(".descargarPorLote").click(function(){
		$(".loading").stop().css("display", "flex");
		$.ajax({
			type: "POST",
			url: "../../controllers/actual/inventarioActual.php",
			data: {
				tipo: 2
			}
		})
		.done(function( data, textStatus, jqXHR ) {
			console.log(data);
			var data=JSON.parse(data);
			if(data && data.success){
				 window.open('./soportes/informes/'+data.data.file+'.xlsx' , '_blank');

			}else{
				Swal.fire({
					title: 'Ha ocurrido un error',
					text: "Intenta Nuevamente",
					icon: 'warning',
					showCancelButton: false,
					confirmButtonColor: "#1D9993",
					cancelButtonColor: '#d33',
					cancelButtonText: 'Cerrar'
				})
			}
			$(".loading").stop().fadeOut();
		})
		.fail(function( jqXHR, textStatus, errorThrown ) {
			Swal.fire({
				title: 'Ha ocurrido un error',
				text: "Intenta Nuevamente",
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: "#1D9993",
				cancelButtonColor: '#d33',
				cancelButtonText: 'Cerrar'
			})
			$(".loading").stop().fadeOut();
		});
	});

	$(".descargarCheck").click(function(){
		$(".loading").stop().css("display", "flex");
		$.ajax({
			type: "POST",
			url: "../../controllers/actual/inventarioActual.php",
			data: {
				tipo: 3
			}
		})
		.done(function( data, textStatus, jqXHR ) {
			console.log(data);
			var data=JSON.parse(data);
			if(data && data.success){
				 window.open('./soportes/informes/'+data.data.file+'.xlsx' , '_blank');

			}else{
				Swal.fire({
					title: 'Ha ocurrido un error',
					text: "Intenta Nuevamente",
					icon: 'warning',
					showCancelButton: false,
					confirmButtonColor: "#1D9993",
					cancelButtonColor: '#d33',
					cancelButtonText: 'Cerrar'
				})
			}
			$(".loading").stop().fadeOut();
		})
		.fail(function( jqXHR, textStatus, errorThrown ) {
			Swal.fire({
				title: 'Ha ocurrido un error',
				text: "Intenta Nuevamente",
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: "#1D9993",
				cancelButtonColor: '#d33',
				cancelButtonText: 'Cerrar'
			})
			$(".loading").stop().fadeOut();
		});
	});

	$(".descargarPorVencimiento").click(function(){
		$(".loading").stop().css("display", "flex");
		$.ajax({
			type: "POST",
			url: "../../controllers/actual/informes/vencimiento.php"
		})
		.done(function( data, textStatus, jqXHR ) {
			console.log(data);
			var data=JSON.parse(data);
			if(data && data.success){
				 window.open('./soportes/informes/'+data.data.file+'.xlsx' , '_blank');

			}else{
				Swal.fire({
					title: 'Ha ocurrido un error',
					text: "Intenta Nuevamente",
					icon: 'warning',
					showCancelButton: false,
					confirmButtonColor: "#1D9993",
					cancelButtonColor: '#d33',
					cancelButtonText: 'Cerrar'
				})
			}
		})
		.fail(function( jqXHR, textStatus, errorThrown ) {
			Swal.fire({
				title: 'Ha ocurrido un error',
				text: "Intenta Nuevamente",
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: "#1D9993",
				cancelButtonColor: '#d33',
				cancelButtonText: 'Cerrar'
			})
		});
	});


	$(".descargarBenefactores").click(function(){
		var data = {
			inicio: inicioBenefactores,
			fin: finBenefactores,
			benefactor: benefactor[1]
		};
		$(".loading").stop().css("display","flex");
		$.ajax({
			data: data ,
			type: "POST",
			url: "../../controllers/actual/informes/descargarBenefactores.php",
		})
		.done(function( data, textStatus, jqXHR ) {
			console.log(data);
			$(".loading").stop().hide();
			var data=JSON.parse(data);
			if(data && data.success){
				window.open('./soportes/informes/'+data.data.file+'.xlsx' , '_blank');
			}else{
				Swal.fire({
					title: 'Ha ocurrido un error',
					text: "Intenta Nuevamente",
					icon: 'warning',
					showCancelButton: false,
					confirmButtonColor: "#1D9993",
					cancelButtonColor: '#d33',
					cancelButtonText: 'Cerrar'
				})
			}
		})
		.fail(function( jqXHR, textStatus, errorThrown ) {
			$(".loading").stop().hide();
			Swal.fire({
				title: 'Ha ocurrido un error',
				text: "Intenta Nuevamente",
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: "#1D9993",
				cancelButtonColor: '#d33',
				cancelButtonText: 'Cerrar'
			})
		});
	});

	$(".descargarBeneficiados").click(function(){
		var data = {
			inicio: inicioBeneficiados,
			fin: finBeneficiados,
			beneficiado: (beneficiado[0]=="")?undefined:beneficiado[0]
		};
		console.log(data);
		$(".loading").stop().css("display","flex");
		$.ajax({
			type: "POST",
			url: "../../controllers/actual/informes/descargarBeneficiados.php",
			data: data
		})
		.done(function( data, textStatus, jqXHR ) {
			console.log(data);
			$(".loading").stop().hide();

			var data=JSON.parse(data);
			if(data && data.success){
				 window.open('./soportes/informes/'+data.data.file+'.xlsx' , '_blank');

			}else{
				Swal.fire({
					title: 'Ha ocurrido un error',
					text: "Intenta Nuevamente",
					icon: 'warning',
					showCancelButton: false,
					confirmButtonColor: "#1D9993",
					cancelButtonColor: '#d33',
					cancelButtonText: 'Cerrar'
				})
			}
		})
		.fail(function( jqXHR, textStatus, errorThrown ) {
			$(".loading").stop().hide();

			Swal.fire({
				title: 'Ha ocurrido un error',
				text: "Intenta Nuevamente",
				icon: 'warning',
				showCancelButton: false,
				confirmButtonColor: "#1D9993",
				cancelButtonColor: '#d33',
				cancelButtonText: 'Cerrar'
			})
		});
	});

	$(".grid-item .senal .type4").click(function(){
		if($(this).hasClass("active")){
			$(this).removeClass("active");
			$(".vencido").hide();
		}else{
			$(this).addClass("active");
			$(".vencido").css("display","flex");
		}
	})
	$(".grid-item .senal .type1").click(function(){
		if($(this).hasClass("active")){
			$(this).removeClass("active");
			$(".vencimiento .item.type1").hide();
		}else{
			$(this).addClass("active");
			$(".vencimiento .item.type1").css("display","flex");
		}
	})
	$(".grid-item .senal .type2").click(function(){
		if($(this).hasClass("active")){
			$(this).removeClass("active");
			$(".vencimiento .item.type2").hide();
		}else{
			$(this).addClass("active");
			$(".vencimiento .item.type2").css("display","flex");
		}
	})
	$(".grid-item .senal .type3").click(function(){
		if($(this).hasClass("active")){
			$(this).removeClass("active");
			$(".vencimiento .item.type3").hide();
		}else{
			$(this).addClass("active");
			$(".vencimiento .item.type3").css("display","flex");
		}
	});
	$(".grid-item .senal .type1").click();
	$(".grid-item .senal .type2").click();
	$(".grid-item .senal .type3").click();
	$(".grid-item").map(function(i,it){
		// $(it).height($(it).width());
	})



	// var $grid = $('.grid').packery({
	//   itemSelector: '.grid-item',
	//   // columnWidth helps with drop positioning
	//   columnWidth: 100
	// });






	// make all items draggable
	// var $items = $grid.find('.grid-item').draggable();
	// // bind drag events to Packery
	// $grid.packery( 'bindUIDraggableEvents', $items );
	//
	// function orderItems() {
	//   var itemElems = $grid.packery('getItemElements');
	//   $( itemElems ).each( function( i, itemElem ) {
	//     $( itemElem ).text( i + 1 );
	//   });
	// }
	//
	// $grid.on( 'layoutComplete', orderItems );
	// $grid.on( 'dragItemPositioned', orderItems );






	function sliceSize(dataNum, dataTotal) {
	  return (dataNum / dataTotal) * 360;
	}

	function addSlice(id, sliceSize, pieElement, offset, sliceID, color) {
	  $(pieElement).append("<div class='slice "+ sliceID + "'><span></span></div>");
	  var offset = offset - 1;
	  var sizeRotation = -179 + sliceSize;

	  $(id + " ." + sliceID).css({
	    "transform": "rotate(" + offset + "deg) translate3d(0,0,0)"
	  });

	  $(id + " ." + sliceID + " span").css({
	    "transform"       : "rotate(" + sizeRotation + "deg) translate3d(0,0,0)",
	    "background-color": color
	  });
	}

	function iterateSlices(id, sliceSize, pieElement, offset, dataCount, sliceCount, color) {
	  var
	    maxSize = 179,
	    sliceID = "s" + dataCount + "-" + sliceCount;

	  if( sliceSize <= maxSize ) {
	    addSlice(id, sliceSize, pieElement, offset, sliceID, color);
	  } else {
	    addSlice(id, maxSize, pieElement, offset, sliceID, color);
	    iterateSlices(id, sliceSize-maxSize, pieElement, offset+maxSize, dataCount, sliceCount+1, color);
	  }
	}

	function createPie(id) {
	  var
	    listData      = [],
	    listTotal     = 0,
	    offset        = 0,
	    i             = 0,
	    pieElement    = id + " .pie-chart__pie"
	    dataElement   = id + " .pie-chart__legend"

	    color         = [
	      "cornflowerblue",
	      "olivedrab",
	      "orange",
	      "tomato",
	      "crimson",
	      "purple",
	      "turquoise",
	      "forestgreen",
	      "navy"
	    ];

	  color = shuffle( color );

	  $(dataElement+" span").each(function() {
	    listData.push(Number($(this).html()));
	  });

	  for(i = 0; i < listData.length; i++) {
	    listTotal += listData[i];
	  }

	  for(i=0; i < listData.length; i++) {
	    var size = sliceSize(listData[i], listTotal);
	    iterateSlices(id, size, pieElement, offset, i, 0, color[i]);
	    $(dataElement + " li:nth-child(" + (i + 1) + ")").css("border-color", color[i]);
	    offset += size;
	  }
	}

	function shuffle(a) {
	    var j, x, i;
	    for (i = a.length; i; i--) {
	        j = Math.floor(Math.random() * i);
	        x = a[i - 1];
	        a[i - 1] = a[j];
	        a[j] = x;
	    }

	    return a;
	}

	function createPieCharts() {
	  createPie('.pieID--micro-skills' );
	  createPie('.pieID--categories' );
	  createPie('.pieID--operations' );
	}

	createPieCharts();













	console.log($(".inventarioActual .info").data("kg"));
	console.log($(".inventarioActual .info").data("lt"));
	console.log($(".inventarioActual .info").data("un"));
	var chart;
	chart = new Highcharts.Chart({
	  chart: {
	    renderTo: 'chart',
			plotBackgroundColor: null,
			plotBorderWidth: 0,
			// plotBackgroundColor: null,
		 	// plotBorderWidth: null,
		 	// plotShadow: false,
			plotShadow: false
	  },
	  credits: {
	    enabled: false
	  },
	  title: {
	    text: ''
	  },
	  tooltip: {
	    formatter: function() {
	      return '<b>' + this.point.name + '</b>: ' + this.point.label + '';
	      // return '<b>' + this.point.name + '</b>: ' + this.percentage.toFixed(2) + ' %';
	    },
      valueSuffix: 'this.point.label'
	  },
	  plotOptions: {
	    pie: {
	      // allowPointSelect: true,
	      //cursor: 'pointer',

				// dataLabels: {
				// 	enabled: false
				// },
				// startAngle: -90,
				// endAngle: 90,
				// size: 200,
				// center: ['50%', '60%'],


				// dataLabels: {
				// 	enabled: false
				// },
				// size: 200,
				innerSize: '50%',
				// center: ['50%', '40%'],

	      dataLabels: {
	        enabled: true,
	      },

				allowPointSelect: false,
				showInLegend: true,

	      // point: {
	      //   events: {
	      //     click: function() {
	      //     	var btns = document.getElementById('btns').children;
				//
	      //       btns[this.index].click()
	      //     }
	      //   }
	      // }
	    }
	  },
	  series: [
			{
			visible: true,

			dataLabels: {
			    color:'white',
			    distance: -10,
					formatter: function () {
						if(this.percentage!=0)  return this.point.label  + '';
					}
			    // formatter: function () {
			    //     if(this.percentage!=0)  return Math.round(this.percentage)  + '%';
					//
			    // }
			},

			// dataLabels: {
	    //   formatter: function () {
	    //     // display only if larger than 1
	    //     return this.y > 1 ? '<b>' + this.point.name + ':</b> ' +
	    //       this.point.label + '' : null;
	    //   }
	    // },
	    type: 'pie',
	    // type: 'variablepie',
	    name: '',
	    data: [
				{
	        name: 'Litros',
					y: Number($(".inventarioActual .info").data("lt")),
					label: $(".inventarioActual .info").data("lt")+' Litros',
	        //sliced: true,
	        //selected: true
	      },
				{
	        name: 'Kilogramos',
	        y: Number($(".inventarioActual .info").data("kg")),
					label: $(".inventarioActual .info").data("kg")+' Kilos',
	        //sliced: true,
	        //selected: true
	      },
	      {
	        name: 'Unidades',
					y: Number($(".inventarioActual .info").data("un")),
					label: $(".inventarioActual .info").data("un")+' Unidades',
	        //sliced: true,
	        //selected: true
	      }
	    ]
	  }]
	});


	var selectBenefactor= $('#benefactor').selectize({
    sortField: 'text',
		onChange: function(value, isOnInitialize) {
			benefactor = value.split("-");
			searchBenefactores(inicioBenefactores, finBenefactores);
		}
  });

	var selectBeneficiados= $('#beneficiados').selectize({
    sortField: 'text',
		onChange: function(value, isOnInitialize) {
			beneficiado = value.split("&");
			searchBeneficiados(inicioBeneficiados, finBeneficiados);
		}
  });

	$.ajax({
		type: "POST",
		url: "../../controllers/actual/buscarVencimiento.php",
	})
	.done(function( data, textStatus, jqXHR ) {
		var data2=JSON.parse(data)
		if(data2.data1){
			$(".vencimiento .container .task-items").empty();
			data2.data1.map(function(it,i){
				$(".vencimiento .container .task-items").append('<li data-id="'+it.id+'" class="item type4 vencido">				<div class="task">				<div class="icon">'+it.day+'</div>				<div class="name">'+it.producto+'</div>				</div>								<div class="status">				<div class="factura"> '+it.factura+' </div>				<div class="text"> '+it.categoria+''+it.lote+''+it.codBenefactor+' </div>				<div class="text"> '+it.benefactor+' </div>				</div>								<div class="dates">				<div class="unidad"> '+(Number(it.cantidad).toFixed(2)*1)+' / '+(Number(it.existencia).toFixed(2)*1)+it.unidad+' </div>				<div class="vencimiento"> '+it.vencimiento+' </div>				</div>								<div class="user">				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-.001 5.75c.69 0 1.251.56 1.251 1.25s.561 1.25-1.251 1.25-1.249-.56-1.249-1.25.559-1.25 1.249-1.25zm2.001 12.25h-4v-1c.484-.179 1-.201 1-.735v-4.467c0-.534-.516-.618-1-.797v-1h3v6.265c0 .535.517.558 1 .735v.999z"/></svg>				</div>				</li>');
			})
			data2.data2.map(function(it,i){
				$(".vencimiento .container .task-items").append('<li data-id="'+it.id+'" class="item '+it.type+'">				<div class="task">				<div class="icon">'+it.day+'</div>				<div class="name">'+it.producto+'</div>				</div>								<div class="status">				<div class="factura"> '+it.factura+' </div>				<div class="text"> '+it.categoria+''+it.lote+''+it.codBenefactor+' </div>				<div class="text"> '+it.benefactor+' </div>				</div>								<div class="dates">				<div class="unidad"> '+(Number(it.cantidad).toFixed(2)*1)+' / '+(Number(it.existencia).toFixed(2)*1)+it.unidad+' </div>				<div class="vencimiento"> '+it.vencimiento+' </div>				</div>								<div class="user">				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-.001 5.75c.69 0 1.251.56 1.251 1.25s.561 1.25-1.251 1.25-1.249-.56-1.249-1.25.559-1.25 1.249-1.25zm2.001 12.25h-4v-1c.484-.179 1-.201 1-.735v-4.467c0-.534-.516-.618-1-.797v-1h3v6.265c0 .535.517.558 1 .735v.999z"/></svg>				</div>				</li>');
			})
		}
	})
	.fail(function( jqXHR, textStatus, errorThrown ) {
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


	// $("*").hover(
    //     function () {
    //         if(editando) {
	// 			$(this).css("outline", "1px solid red");
	// 		}
    //     },
    //     function () {
    //         if(editando) {
	// 			$(this).css("outline", "none");
	// 		}
    //     }
    // ); 
	

    // $("*").click(function (e) {
	// 	if(editando) {
	// 		e.preventDefault();
	// 		e.stopPropagation();
	
	// 		let posX = $(this).offset().left;
	// 		let posY = $(this).offset().top;
	// 		let width = $(this).outerWidth();
	// 		let height = $(this).outerHeight();
	
	// 		console.log("Elemento seleccionado:", this);
	// 		console.log(`Ubicación: X=${posX}, Y=${posY}, Ancho=${width}, Alto=${height}`);
	
	// 		// Mostrar modal en la posición del elemento
	// 		$("#customModal")
	// 			.css({
	// 				top: posY + height + 5 + "px", // Debajo del elemento
	// 				left: posX + "px",
	// 				display: "block",
	// 			})
	// 			.html(`<p>Elemento seleccionado</p><p>X: ${posX}, Y: ${posY}</p>`);
	// 	}
    // }); 

    // Cerrar modal al hacer clic fuera
    $(document).click(function () {
        $("#customModal").hide();
    });

});






// Highcharts.chart('container', {
//   chart: {
//     type: 'pie'
//   },
//   title: {
//     text: 'Browser market share, January, 2018'
//   },
//   subtitle: {
//     text: 'Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>'
//   },
//   plotOptions: {
//     pie: {
//       shadow: false,
//       center: ['50%', '50%']
//     }
//   },
//   tooltip: {
//     valueSuffix: '%'
//   },
//   series: [{
//     name: 'Browsers',
//     data: browserData,
//     size: '60%',
//     dataLabels: {
//       formatter: function () {
//         return this.y > 5 ? this.point.name : null;
//       },
//       color: '#ffffff',
//       distance: -30
//     }
//   }, {
//     name: 'Versions',
//     data: versionsData,
//     size: '80%',
//     innerSize: '60%',
//     dataLabels: {
//       formatter: function () {
//         // display only if larger than 1
//         return this.y > 1 ? '<b>' + this.point.name + ':</b> ' +
//           this.y + '%' : null;
//       }
//     },
//     id: 'versions'
//   }],
//   responsive: {
//     rules: [{
//       condition: {
//         maxWidth: 400
//       },
//       chartOptions: {
//         series: [{
//         }, {
//           id: 'versions',
//           dataLabels: {
//             enabled: false
//           }
//         }]
//       }
//     }]
//   }
// });
