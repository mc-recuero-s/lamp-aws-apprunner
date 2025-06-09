
$(buscarDatos());

function buscarDatos(consulta) {

  var datos = {
    consulta: consulta,
    opcion: 1
  }
  $.ajax({
    url: './controllers/beneficiario/beneficiados.php',
    type: 'POST',
    dataType: 'html',
    data: datos,
  })
    .done(function (respuesta) {
      $("#datos").html(respuesta);
    })
    .fail(function () {
      console.log("error");
    })
}

$(document).on('keyup', '#inputBuscar', function () {
  var valor = $(this).val();
  if (valor != "") {
    buscarDatos(valor);
  }
  else {
    buscarDatos();
  }

});


$('#btnAgregar').click(function (r) {
  console.log('hola no manda nada');
  alert('hola');
  r.preventDefault();

  var datos = $('#formulario').serialize();
  var zona = document.getElementById('selectZonas').value;


  /*var nit = document.getElementById("nit").value;
  var tel = document.getElementById("tel").value;
  var cel = document.getElementById("cel").value;*/
  var nombre = document.getElementById("nombre").value;
  var nombreLabor = document.getElementById("nombreLabor").value;


  var nitV = document.getElementById('nit').value;

  var dv = document.getElementById('dv').value;
  var contactoInstitucional = document.getElementById('contactoInstitucional').value;
  var cargo = document.getElementById('cargo').value;

  var telV = document.getElementById('tel').value;
  var celV = document.getElementById('cel').value;

  var correo = document.getElementById('correo').value;

  var anioV = document.getElementById('aniosUltima').value;

  var departamento = document.getElementById('departamento').value;
  var municipio = document.getElementById('municipio').value;
  var subRegion = document.getElementById('subRegion').value;
  var comuna = document.getElementById('comuna').value;
  var barrio = document.getElementById('barrio').value;
  var direccion = document.getElementById('direccion').value;
  var zonaUrbana = document.getElementById('zonaUrbana').value;
  var recomienda = document.getElementById('recomienda').value;
  var protocolo = document.getElementById('protocolo').value;
  var fechaEntrega = document.getElementById('fechaEntrega').value;
  var frecuenciaDonacion = document.getElementById('frecuenciaDonacion').value;
  var diaDonacion = document.getElementById('diaDonacion').value;
  var semanaDonacion = document.getElementById('semanaDonacion').value;
  var frecuenciaServicio = document.getElementById('frecuenciaServicio').value;
  var diaServicio = document.getElementById('diaServicio').value;
  var semanaServicio = document.getElementById('semanaServicio').value;
  var jornadaServicio = document.getElementById('jornadaServicio').value;

  var valoresAceptados = /^[0-9]+$/;


  var el = document.getElementById('respuesta'); //se define la variable "el" igual a nuestro div
  //damos un atributo display:none que oculta el div


  // alert(zona);
  if (zona == 0) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Debes seleccionar una zona.',
    })

    /*el.innerHTML = `
      <div class="alert alert-danger" role="alert" id="respuestaUp">
  
      Debes seleccionar la Zona
      </div>
      `*/
  }
  else if(nombre==""){
    document.getElementById("nombre").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo nombre no puede estar vacío',
    })

  }
  else if(nombreLabor==""){
    document.getElementById("nombreLabor").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo nombre labor no puede estar vacío',
    })
    
  }
  else if (!nitV.match(valoresAceptados)) {
    document.getElementById("nit").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El nit debe ser númerico.',
    })
    /*el.innerHTML = `
      <div id="respuestaUp" class="alert alert-danger" role="alert">
  
      El nit debe ser númerico
      </div>
      `*/
  }
  else if (!dv.match(valoresAceptados)) {
    document.getElementById("dv").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El dv debe ser númerico.',
    })
  }
  else if (contactoInstitucional=="") {
    document.getElementById("contactoInstitucional").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo contacto no debe estar vacío.',
    })
  }
  else if (cargo=="") {
    document.getElementById("cargo").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo cargo no debe estar vacío.',
    })
  }
  else if (!telV.match(valoresAceptados)) {
    document.getElementById("tel").focus();

    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El teléfono debe ser númerico..',
    })

    /*el.innerHTML = `
      <div id="respuestaUp" class="alert alert-danger" role="alert">
  
      El teléfono debe ser númerico
      </div>
      `*/

  }
  else if (!celV.match(valoresAceptados)) {

    document.getElementById("cel").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El celular debe ser númerico.',
    })

    /*el.innerHTML = `
      <div  id="respuestaUp" class="alert alert-danger" role="alert">
  
      El celular debe ser númerico
      </div>
      `*/
  }
  else if (correo=="") {
    document.getElementById("correo").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo correo no debe estar vacío.',
    })
  }
  else if (!anioV.match(valoresAceptados)) {
    document.getElementById("aniosUltima").focus();

    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El año debe ser númerico.',
    })

    /*el.innerHTML = `
      <div  id="respuestaUp" class="alert alert-danger" role="alert">
      El año debe ser númerico
      </div>
      `*/
  }
  else if (departamento=="") {
    document.getElementById("departamento").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo departamento no debe estar vacío.',
    })
  }
  else if (municipio=="") {
    document.getElementById("municipio").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo municipio no debe estar vacío.',
    })
  }
  else if (subRegion=="") {
    document.getElementById("subRegion").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo sub region no debe estar vacío.',
    })
  }
  else if (comuna=="") {
    document.getElementById("comuna").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo comuna no debe estar vacío.',
    })
  }
  else if (barrio=="") {
    document.getElementById("barrio").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo barrio no debe estar vacío.',
    })
  }
  else if (direccion=="") {
    document.getElementById("direccion").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo dirección no debe estar vacío.',
    })
  }
  else if (zonaUrbana=="") {
    document.getElementById("zonaUrbana").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo zona no debe estar vacío.',
    })
  }
  else if (recomienda=="") {
    document.getElementById("recomienda").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo recomienda no debe estar vacío.',
    })
  }
  else if (protocolo=="") {
    document.getElementById("protocolo").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo protocolo de bioseguridad no debe estar vacío.',
    })
  }
  else if (fechaEntrega=="") {
    document.getElementById("fechaEntrega").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo fecha de entrega no debe estar vacío.',
    })
  }
  else if (frecuenciaDonacion=="") {
    document.getElementById("frecuenciaDonacion").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo frecuencia donación no debe estar vacío.',
    })
  }
  else if (diaDonacion=="") {
    document.getElementById("diaDonacion").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo día de la donación no debe estar vacío.',
    })
  }
  else if (semanaDonacion=="") {
    document.getElementById("semanaDonacion").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo semana de la donación no debe estar vacío.',
    })
  }
  else if (frecuenciaServicio=="") {
    document.getElementById("frecuenciaServicio").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo frecuencia del servicio comunitario no debe estar vacío.',
    })
  }
  else if (diaServicio=="") {
    document.getElementById("diaServicio").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo día servicio no debe estar vacío.',
    })
  }
  else if (semanaServicio=="") {
    document.getElementById("semanaServicio").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo semana servicio comunitario no debe estar vacío.',
    })
  }
  else if (jornadaServicio=="") {
    document.getElementById("jornadaServicio").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo jornada servicio comunitario no debe estar vacío.',
    })
  }
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
          buscarDatos();
        } else {
          alert("no Se registró correctamente");
          console.log(datos);


        }

      }
    });
    return false;

  }

});


function editar(idUp) {

  console.log('hola');
  myData = { sid: idUp };

  $.ajax({

    url: './controllers/beneficiario/update.php',
    method: 'POST',
    dataType: 'json',
    data: JSON.stringify(myData),
    success: function (data) {
      console.log(data.estado);

      if(data.estado =='Activo'){
        var mensaje = 'Esta institución esta activa.';
        $("#divEstado").css("background", "#D7F98D");
        document.querySelector('#estado').innerText = mensaje;
        $("#estado").show();
      }
      else{

        var mensajeDos = 'Esta institución no está activa.';
        $("#divEstado").css("background", "red");
        document.querySelector('#estado').innerText = mensajeDos;
        $("#estado").show();
      }
      $('#idUp').val(data.id);
      $("#selectZonasUp").val(data.idZona);
      $("#nombreUp").val(data.nombre);
      $("#nombreLaborUp").val(data.nombreLaborSocial);
      $("#nitUp").val(data.nit);
      $("#dvUp").val(data.dv);
      $("#contactoInstitucionalUp").val(data.contactoInstitucional);
      $("#cargoUp").val(data.cargo);
      $("#telUp").val(data.telefono);
      $("#celUp").val(data.celular);
      $("#correoUp").val(data.email);
      $("#aniosUltimaUp").val(data.aniosUltimaVisita);
      $("#departamentoUp").val(data.departamento);
      $("#municipioUp").val(data.municipio);
      $("#subRegionUp").val(data.subRegion);
      $("#comunaUp").val(data.comuna);
      $("#barrioUp").val(data.barrio);
      $("#direccionUp").val(data.direccion);
      $("#zonaUrbanaUp").val(data.zonaUrbanaORural);
      $("#recomiendaUp").val(data.recomienda);
      $("#protocoloUp").val(data.protocoloBio);
      $("#fechaEntregaUp").val(data.fechaEntrega);
      $("#frecuenciaDonacionUp").val(data.frecuenciaDonacion);
      $("#diaDonacionUp").val(data.diaDonacion);
      $("#semanaDonacionUp").val(data.semanaDonacion);
      $("#frecuenciaServicioUp").val(data.frecuenciaServicioC);
      $("#diaServicioUp").val(data.diaServicioC);
      $("#semanaServicioUp").val(data.semanaServicioC);
      $("#jornadaServicioUp").val(data.jornadaServicioC);

      if (data.adultoMayor === "X" || data.adultoMayor === "x") {
        $("#checkAdultoMUp").prop("checked", true);
      }
      if (data.proteccionNin === "X" || data.proteccionNin === "x") {
        $("#checkProUp").prop("checked", true);
      }
      if (data.proteccionNinias === "X" || data.proteccionNinias === "x") {
        $("#checkProNiasUp").prop("checked", true);
      }
      if (data.proteccionNinios === "X" || data.proteccionNinios === "x") {
        $("#checkProNiosUp").prop("checked", true);
      }
      if (data.hogarDePaso === "X" || data.hogarDePaso === "x") {
        $("#checkHogarUp").prop("checked", true);
      }
      if (data.comedor === "X" || data.comedor === "x") {
        $("#checkComedorUp").prop("checked", true);
      }
      if (data.comunidadReligiosaOLaicos === "X" || data.comunidadReligiosaOLaicos === "x") {
        $("#checkComunidadUp").prop("checked", true);
      }
      if (data.SeminaristasOreligiosos === "X" || data.SeminaristasOreligiosos === "x") {
        $("#checkSeminaristasUp").prop("checked", true);
      }
      if (data.familiasVulnerables === "X" || data.familiasVulnerables === "x") {
        $("#checkFVulnerablesUp").prop("checked", true);
      }
      if (data.capacitacionFormacion === "X" || data.capacitacionFormacion === "x") {
        $("#checkCapacitacionUp").prop("checked", true);
      }
      if (data.arteCultura === "X" || data.arteCultura === "x") {
        $("#checkArteUp").prop("checked", true);
      }
      if (data.deporte === "X" || data.deporte === "x") {
        $("#checkDeporteUp").prop("checked", true);
      }
      if (data.EnfermosYDesvalidos === "X" || data.EnfermosYDesvalidos === "x") {
        $("#checkEnfermosUp").prop("checked", true);
      }
      if (data.educacion === "X" || data.educacion === "x") {
        $("#checkEducacionUp").prop("checked", true);
      }
      if (data.nutricion === "X" || data.nutricion === "x") {
        $("#checkNutricionUp").prop("checked", true);
      }
      if (data.legal === "X" || data.legal === "x") {
        $("#checkLegalUp").prop("checked", true);
      }
      if (data.espiritual === "X" || data.espiritual === "x") {
        $("#checkEspiritualUp").prop("checked", true);
      }
      if (data.salud === "X" || data.salud === "x") {
        $("#checkSaludUp").prop("checked", true);
      }
      if (data.recreacion === "X" || data.recreacion === "x") {
        $("#checkRecreacionUp").prop("checked", true);
      }
      if (data.vivienda === "X" || data.vivienda === "x") {
        $("#checkViviendaUp").prop("checked", true);
      }
      if (data.artes === "X" || data.artes === "x") {
        $("#checkArteCulturaUp").prop("checked", true);
      }
      if (data.artesaniasYManualidades === "X" || data.artesaniasYManualidades === "x") {
        $("#checkArtesaniasUp").prop("checked", true);
      }
      if (data.biblioteca === "X" || data.biblioteca === "x") {
        $("#checkBibliotecaUp").prop("checked", true);
      }
      if (data.computadores === "X" || data.computadores === "x") {
        $("#checkComputadoresUp").prop("checked", true);
      }
      if (data.costuraYCofeccion === "X" || data.costuraYCofeccion === "x") {
        $("#checkCosturaUp").prop("checked", true);
      }
      if (data.consutorioYDispensario === "X" || data.consutorioYDispensario === "x") {
        $("#checkConsultorioUp").prop("checked", true);
      }
      if (data.culinariaYPanaderia === "X" || data.culinariaYPanaderia === "x") {
        $("#checkCulinarioUp").prop("checked", true);
      }
      if (data.ludoteca === "X" || data.ludoteca === "x") {
        $("#checkLudotecaUp").prop("checked", true);
      }
      if (data.musica === "X" || data.musica === "x") {
        $("#checkMusicaUp").prop("checked", true);
      }
      if (data.pintura === "X" || data.pintura === "x") {
        $("#checkPinturaUp").prop("checked", true);
      }
      if (data.peluqueriaYBelleza === "X" || data.peluqueriaYBelleza === "x") {
        $("#checkPeluqueriaUp").prop("checked", true);
      }
      if (data.ventasDeRopero === "X" || data.ventasDeRopero === "x") {
        $("#checkVentaRoperoUp").prop("checked", true);
      }
      if (data.otros === "X" || data.otros === "x") {
        $("#checkOtrosUp").prop("checked", true);
      }

      $('#modalUpdate').modal("show");
    }
  });
}

$('#guardarEdit').click(function (r) {
  r.preventDefault();

  var datos = $('#formularioEdit').serialize();
  var zona = document.getElementById('selectZonasUp').value;

  var nombre = document.getElementById("nombreUp").value;
  var nombreLabor = document.getElementById("nombreLaborUp").value;

  var nitV = document.getElementById('nitUp').value;

  var dv = document.getElementById('dvUp').value;
  var contactoInstitucional = document.getElementById('contactoInstitucionalUp').value;
  var cargo = document.getElementById('cargoUp').value;

  var telV = document.getElementById('telUp').value;
  var celV = document.getElementById('celUp').value;

  var correo = document.getElementById('correoUp').value;

  var anioV = document.getElementById('aniosUltimaUp').value;

  var departamento = document.getElementById('departamentoUp').value;
  var municipio = document.getElementById('municipioUp').value;
  var subRegion = document.getElementById('subRegionUp').value;
  var comuna = document.getElementById('comunaUp').value;
  var barrio = document.getElementById('barrioUp').value;
  var direccion = document.getElementById('direccionUp').value;
  var zonaUrbana = document.getElementById('zonaUrbanaUp').value;
  var recomienda = document.getElementById('recomiendaUp').value;
  var protocolo = document.getElementById('protocoloUp').value;
  var fechaEntrega = document.getElementById('fechaEntregaUp').value;
  var frecuenciaDonacion = document.getElementById('frecuenciaDonacionUp').value;
  var diaDonacion = document.getElementById('diaDonacionUp').value;
  var semanaDonacion = document.getElementById('semanaDonacionUp').value;
  var frecuenciaServicio = document.getElementById('frecuenciaServicioUp').value;
  var diaServicio = document.getElementById('diaServicioUp').value;
  var semanaServicio = document.getElementById('semanaServicioUp').value;
  var jornadaServicio = document.getElementById('jornadaServicioUp').value;

  var valoresAceptados = /^[0-9]+$/;

  var el = document.getElementById('respuestaUp'); //se define la variable "el" igual a nuestro div
  //damos un atributo display:none que oculta el div

  if (zona == 0) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Debes seleccionar una zona.',
    })

    /*el.innerHTML = `
      <div class="alert alert-danger" role="alert" id="respuestaUp">
  
      Debes seleccionar la Zona
      </div>
      `*/
  }
  else if(nombre==""){
    document.getElementById("nombreUp").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo nombre no puede estar vacío',
    })

  }
  else if(nombreLabor==""){
    document.getElementById("nombreLaborUp").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo nombre labor no puede estar vacío',
    })
    
  }
  else if (!nitV.match(valoresAceptados)) {
    document.getElementById("nitUp").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El nit debe ser númerico.',
    })
    /*el.innerHTML = `
      <div id="respuestaUp" class="alert alert-danger" role="alert">
  
      El nit debe ser númerico
      </div>
      `*/
  }
  else if (!dv.match(valoresAceptados)) {
    document.getElementById("dvUp").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El dv debe ser númerico.',
    })
  }
  else if (contactoInstitucional=="") {
    document.getElementById("contactoInstitucionalUp").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo contacto no debe estar vacío.',
    })
  }
  else if (cargo=="") {
    document.getElementById("cargoUp").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo cargo no debe estar vacío.',
    })
  }
  else if (!telV.match(valoresAceptados)) {
    document.getElementById("telUp").focus();

    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El teléfono debe ser númerico..',
    })

    /*el.innerHTML = `
      <div id="respuestaUp" class="alert alert-danger" role="alert">
  
      El teléfono debe ser númerico
      </div>
      `*/

  }
  else if (!celV.match(valoresAceptados)) {

    document.getElementById("celUp").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El celular debe ser númerico.',
    })

    /*el.innerHTML = `
      <div  id="respuestaUp" class="alert alert-danger" role="alert">
  
      El celular debe ser númerico
      </div>
      `*/
  }
  else if (correo=="") {
    document.getElementById("correoUp").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo correo no debe estar vacío.',
    })
  }
  else if (!anioV.match(valoresAceptados)) {
    document.getElementById("aniosUltimaUp").focus();

    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El año debe ser númerico.',
    })

    /*el.innerHTML = `
      <div  id="respuestaUp" class="alert alert-danger" role="alert">
      El año debe ser númerico
      </div>
      `*/
  }
  else if (departamento=="") {
    document.getElementById("departamentoUp").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo departamento no debe estar vacío.',
    })
  }
  else if (municipio=="") {
    document.getElementById("municipioUp").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo municipio no debe estar vacío.',
    })
  }
  else if (subRegion=="") {
    document.getElementById("subRegionUp").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo sub region no debe estar vacío.',
    })
  }
  else if (comuna=="") {
    document.getElementById("comunaUp").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo comuna no debe estar vacío.',
    })
  }
  else if (barrio=="") {
    document.getElementById("barrioUp").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo barrio no debe estar vacío.',
    })
  }
  else if (direccion=="") {
    document.getElementById("direccionUp").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo dirección no debe estar vacío.',
    })
  }
  else if (zonaUrbana=="") {
    document.getElementById("zonaUrbanaUp").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo zona no debe estar vacío.',
    })
  }
  else if (recomienda=="") {
    document.getElementById("recomiendaUp").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo recomienda no debe estar vacío.',
    })
  }
  else if (protocolo=="") {
    document.getElementById("protocoloUp").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo protocolo de bioseguridad no debe estar vacío.',
    })
  }
  else if (fechaEntrega=="") {
    document.getElementById("fechaEntregaUp").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo fecha de entrega no debe estar vacío.',
    })
  }
  else if (frecuenciaDonacion=="") {
    document.getElementById("frecuenciaDonacionUp").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo frecuencia donación no debe estar vacío.',
    })
  }
  else if (diaDonacion=="") {
    document.getElementById("diaDonacionUp").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo día de la donación no debe estar vacío.',
    })
  }
  else if (semanaDonacion=="") {
    document.getElementById("semanaDonacionUp").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo semana de la donación no debe estar vacío.',
    })
  }
  else if (frecuenciaServicio=="") {
    document.getElementById("frecuenciaServicioUp").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo frecuencia del servicio comunitario no debe estar vacío.',
    })
  }
  else if (diaServicio=="") {
    document.getElementById("diaServicioUp").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo día servicio no debe estar vacío.',
    })
  }
  else if (semanaServicio=="") {
    document.getElementById("semanaServicioUp").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo semana servicio comunitario no debe estar vacío.',
    })
  }
  else if (jornadaServicio=="") {
    document.getElementById("jornadaServicioUp").focus();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'El campo jornada servicio comunitario no debe estar vacío.',
    })
  }
  else {
    $.ajax({
      type: 'POST',
      url: 'controllers/beneficiario/editar.php',
      data: datos,
      success: function (r) {
        if (r == 1) {


          /* el.innerHTML = `
           <div class="alert alert-success" role="alert"  id="respuestaUp">
           El registro se guardó correctamente.
           </div>
           `*/
          Swal.fire('Los datos se actualizaron correctamente')

          $("#modalUpdate").modal('hide');
          $("#modalUpdate").find("input,textarea,select").val("");
          $("#modalUpdate input[type='checkbox']").prop('checked', false).change();
          buscarDatos();

        } else {
          /*Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Hubo un error al actualizar la información.',
          })*/
          //alert("no Se registró correctamente");


          console.log(datos);
        }

      }
    });
    return false;

  }

});


function retirar(idUp) {

  let id = idUp;

  myData = { sid: id };

  //console.log(id);

  $.ajax({
    url: './controllers/beneficiario/retirar.php',
    method: 'POST',
    data: JSON.stringify(myData),
    success: function (data) {
      //console.log(data.estado);

      if(data == 1){
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'La institución se deshabilitó correctamente.',
          showConfirmButton: false,
          timer: 1500
        })
      }
      else{
        Swal.fire({
          position: 'top-end',
          icon: 'error',
          title: data,
          showConfirmButton: false,
          timer: 1500
        })
      }

      console.log(data);
    buscarDatos();
      
    },
    
  });

}


console.log(idUp);
  /*$('#id').val(idUp);
$.post("controllers/beneficiario/agregarBeneficiario.php",{idUp:idUp},function(data,
status){

var dataId = JSON.parse(data);
$('#nit').val(dataId.nit);

});
$('#exampleModal').modal("show");
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









