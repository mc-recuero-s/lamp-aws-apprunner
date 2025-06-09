
$('#btnAgregar').click(function (r) {
  r.preventDefault();

  var datos = $('#formulario').serialize();
  var zona = document.getElementById('selectZonas').value;


  /*var nit = document.getElementById("nit").value;
  var tel = document.getElementById("tel").value;
  var cel = document.getElementById("cel").value;*/

  var nitV = document.getElementById('nit').value;
  var telV = document.getElementById('tel').value;
  var celV = document.getElementById('cel').value;
  var anioV = document.getElementById('aniosUltima').value;

  var valoresAceptados = /^[0-9]+$/;


  var el = document.getElementById('respuesta'); //se define la variable "el" igual a nuestro div
  //damos un atributo display:none que oculta el div


  // alert(zona);
  if (zona == 0) {
    //alert('Debes escoger la zona');
    alert("Debes selccionar una zona");

    el.innerHTML = `
    <div class="alert alert-primary" role="alert" id="respuesta">

    Debes seleccionar la Zona
    </div>
    `
    /*if (!dato_a_comprobar.match(valoresAceptados)) {
      /*$.ajax({
        type: 'POST',
        url: 'controllers/beneficiario/agregarBeneficiario.php',
        data: datos,
        success: function (r) {
          if (r == 1) {
            alert("Se registró correctamente");
          } else {
            alert("no Se registró correctamente");
            //console.log(datos);
  
          }
  
        }
      });
      return false;
    }
    else{
      alert('debe ser numerico');
    }*/

  }
  else if (!nitV.match(valoresAceptados)) {

    alert('El nit debe ser númerico');
    el.innerHTML = `
    <div id="respuesta" class="alert alert-danger" role="alert">

    El nit debe ser númerico
    </div>
    `
  }
  else if (!telV.match(valoresAceptados)) {
    alert('El teléfono debe ser númerico');

    el.innerHTML = `
    <div id="respuesta" class="alert alert-danger" role="alert">

    El teléfono debe ser númerico
    </div>
    `

  }
 /* else if (!celV.match(valoresAceptados)) {
    alert('El celular debe ser númerico');
    el.innerHTML = `
    <div  id="respuesta" class="alert alert-danger" role="alert">

    El celular debe ser númerico
    </div>
    `
  }*/
  /*else if (!anioV.match(valoresAceptados)) {
    alert('El año debe ser númerico');

    el.innerHTML = `
    <div  id="respuesta" class="alert alert-danger" role="alert">
    El año debe ser númerico
    </div>
    `
  }*/
  else {
    $.ajax({
      type: 'POST',
      url: 'controllers/beneficiario/agregarBeneficiario.php',
      data: datos,
      success: function (r) {
        if (r == 1) {
          
          el.innerHTML = `
          <div class="alert alert-success" role="alert"  id="respuesta">
          El registro se guardó correctamente.
          </div>
          `
        } else {
          alert("no Se registró correctamente");
          console.log(datos);

   
        }

      }
    });
    return false;

  }

});

$(buscarDatos());

function buscarDatos(consulta) {
    $.ajax({
        url: './controllers/beneficiario/beneficiados.php',
        type: 'POST',
        dataType: 'html',
        data: { consulta: consulta },
    })
        .done(function (respuesta) {
            $("#datos").html(respuesta);
        })
        .fail(function () {
            console.log("error");
        })

}

$(document).on('keyup','#inputBuscar', function(){
    var valor = $(this).val();
    if(valor !=""){
        buscarDatos(valor);
    }
    else{
        buscarDatos();
    }
    
});


function editar(id){

  console.log('boton editar click');
  /*var url = 'agregarBeneficiados.php';
  $.ajax({
      type: "POST",
      url: url,
      data: 'id='+id,
      type: "json",
      success: function(response){
          alert(response);
          location.href ="prubaBe.php";
      }
  })*/
}

/*const on = (element, event, selector, handler)=>{
  element,addEventListener(event, e=>{
    if(e.target.closest(selector)){
      handler(e);
    }
  })
}

on(document, 'clcik', '.btnBorrar', e =>{
  console.log('boton de borrado');
})






/*var formulario = document.getElementById('formulario');
var respuest = document.getElementById('respuesta');

//var key1 = document.getElementById('selectZonas').value;

var key1 = document.getElementById('selectZonas');
//alert(key1);


formulario.addEventListener('submit', function (e) {

  e.preventDefault();

  //alert('tocaste el botón');

  var datos = new FormData(formulario);

  //alert(datos.get('nombre'));
  //console.log(datos.get('nombre'));
  console.log(datos.get('selectZonas'));
  //alert(key1);

  if(datos.get('selectZonas') === '0'){
    alert('errorrrrrrr');
    respuest.innerHTML = `
          <div class="alert alert-primary" role="alert" id="respuesta">

          Debes seleccionar la Zona
          </div>
          `
  }
  else{
    fetch('./controllers/beneficiario/agregarBeneficiario.php', {

      method: 'POST',
      body: datos
    })
      .then(res => res.json())
      .then(data => {
        console.log(data);

        if (data === 'error') {
          respuest.innerHTML = `
          <div class="alert alert-primary" role="alert" id="respuesta">

          no esta seleccionado
          </div>
          `
        }
        else{
          respuest.innerHTML = `
          <div class="alert alert-primary" role="alert" id="respuesta">
          bien
          </div>
          `
        }
      })
  }
});*/