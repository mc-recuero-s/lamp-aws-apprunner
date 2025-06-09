
$(document).ready(function() {
	var uriControllers= "./controllers/";

	$(".crear-trazabilidad-btn").click(function(){
		$(".loading").stop().css("display","flex");
		$.ajax({			
			type: "POST",
			url: uriControllers+"trazabilidad1/crearTrazabilidad.php",
		})
		.done(function( response, textStatus, jqXHR ) {
			let result=JSON.parse(response);	
			$(".trazabilidad table tbody").empty();		
			result.data.map((it)=>{
				if(!it.success){									
					let row=$("<tr><td>"+it.lote+"</td><td></td></tr>");
					if(it.data){
						it.data.map((jt)=>{
							row.find("td").eq(1).append("<p>"+jt+"</p>");
						})
					}else{
						row.find("td").eq(1).append("<p>"+it+"</p>");
					}					
					$(".trazabilidad table tbody").append(row);
				}				
			})
			$(".trazabilidad table").show();
			$(".loading").stop().fadeOut();
		})
	});

});
