<?php

require("../../includes/dsn_open.php");

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = $_POST['idUp'];
$zonas = $_POST['selectZonasUp'];
$nombre = $_POST['nombreUp'];
$nombreLabor = $_POST['nombreLaborUp'];
$nit = $_POST['nitUp'];
$dv = $_POST['dvUp'];
$contactoInstitucional = $_POST['contactoInstitucionalUp'];
$cargo = $_POST['cargoUp'];
$tel = $_POST['telUp'];
$cel = $_POST['celUp'];
$email = $_POST['correoUp'];
$anio = $_POST['aniosUltimaUp'];
$departamento = $_POST['departamentoUp'];
$municipio = $_POST['municipioUp'];
$subRegion = $_POST['subRegionUp'];
$comuna = $_POST['comunaUp'];
$barrio = $_POST['barrioUp'];
$direccion = $_POST['direccionUp'];
$zonaUrbana = $_POST['zonaUrbanaUp'];
$recomienda = $_POST['recomiendaUp'];
$protocolo = $_POST['protocoloUp'];
$fechaEntrega = $_POST['fechaEntregaUp'];
$frecuenciaDonacion = $_POST['frecuenciaDonacionUp'];
$diaDonacion = $_POST['diaDonacionUp'];
$semanaDonacion = $_POST['semaDonacionUp'];
$frecuenciaServicio = $_POST['frecuenciaServicioUp'];
$diaServicio = $_POST['diaServicioUp'];
$semanaServicioC = $_POST['semanaServicioUp'];
$jornadaServicioC = $_POST['jornadaServicioUp'];

if ($_POST['selectZonasUp'] == 1) {
    $zonas = 1;
    //echo json_encode('bien');
}
if ($_POST['selectZonasUp'] == 2) {
    $zonas = 2;
}
if ($_POST['selectZonasUp'] == 3) {
    $zonas = 3;
}
if ($_POST['selectZonasUp'] == 4) {
    $zonas = 4;;
}
if ($_POST['selectZonasUp'] == 5) {
    $zonas = 5;
}
if ($_POST['selectZonasUp'] == 6) {
    $zonas = 6;
}
if ($_POST['selectZonasUp'] == 7) {
    $zonas = 7;
}
if ($_POST['selectZonasUp'] == 8) {
    $zonas = 8;
}


$adultoMayor = "";
$proteccionN = "";
$proteccionNias = "";
$proteccionNios = "";
$hogar = "";
$comedor = "";
$comunidad = "";
$seminaristas = "";
$fVulnerables = "";
$capacitacion = "";
$arte = "";
$deporte = "";
$enfermos = "";
$educacion = "";
$nutricion = "";
$legal = "";
$espiritual = "";
$salud = "";
$recreacion = "";
$vivienda = "";
$arteCultura = "";
$artesanias = "";
$biblioteca = "";
$computadores = "";
$costura = "";
$consultorio = "";
$culinario = "";
$ludoteca = "";
$musica = "";
$pintura = "";
$peluqueria = "";
$ventaRopero = "";
$otros = "";
if (isset($_POST['checkAdultoM'])) {
    $adultoMayor = 'x';
}

//echo($adultoMayor);
//echo('hola');

if (isset($_POST['checkAdultoMUp'])) {
    $adultoMayor = 'x';
}
if (isset($_POST['checkProUp'])) {
    $proteccionN = 'x';
}
if (isset($_POST['checkProNiasUp'])) {
    $proteccionNias = 'x';
}
if (isset($_POST['checkProNiosUp'])) {
    $proteccionNios = 'x';
}
if (isset($_POST['checkHogarUp'])) {
    $hogar = 'x';
}
if (isset($_POST['checkComedorUp'])) {
    $comedor = 'x';
}
if (isset($_POST['checkComunidadUp'])) {
    $comunidad = 'x';
}
if (isset($_POST['checkSeminaristasUp'])) {
    $seminaristas = 'x';
}
if (isset($_POST['checkFVulnerablesUp'])) {
    $fVulnerables = 'x';
}
if (isset($_POST['checkCapacitacionUp'])) {
    $capacitacion = 'x';
}
if (isset($_POST['checkArteUp'])) {
    $arte = 'x';
}
if (isset($_POST['checkDeporteUp'])) {
    $deporte = 'x';
}
if (isset($_POST['checkEnfermosUp'])) {
    $enfermos = 'x';
}
if (isset($_POST['checkEducacionUp'])) {
    $educacion = 'x';
}
if (isset($_POST['checkNutricionUp'])) {
    $nutricion = 'x';
}
if (isset($_POST['checkLegalUp'])) {
    $legal = 'x';
}
if (isset($_POST['checkEspiritualUp'])) {
    $espiritual = 'x';
}
if (isset($_POST['checkSaludUp'])) {
    $salud = 'x';
}
if (isset($_POST['checkRecreacionUp'])) {
    $recreacion = 'x';
}
if (isset($_POST['checkViviendaUp'])) {
    $vivienda = 'x';
}
if (isset($_POST['checkArteCulturaUp'])) {
    $arteCultura = 'x';
}
if (isset($_POST['checkArtesaniasUp'])) {
    $artesanias = 'x';
}
if (isset($_POST['checkBibliotecaUp'])) {
    $biblioteca = 'x';
}
if (isset($_POST['checkComputadoresUp'])) {
    $computadores = 'x';
}
if (isset($_POST['checkCosturaUp'])) {
    $costura = 'x';
}
if (isset($_POST['checkConsultorioUp'])) {
    $consultorio = 'x';
}
if (isset($_POST['checkCulinarioUp'])) {
    $culinario = 'x';
}
if (isset($_POST['checkLudotecaUp'])) {
    $ludoteca = 'x';
}
if (isset($_POST['checkMusicaUp'])) {
    $musica = 'x';
}
if (isset($_POST['checkPinturaUp'])) {
    $pintura = 'x';
}
if (isset($_POST['checkPeluqueriaUp'])) {
    $peluqueria = 'x';
}
if (isset($_POST['checkVentaRoperoUp'])) {
    $ventaRopero = 'x';
}
if (isset($_POST['checkOtrosUp'])) {
    $otros = 'x';
}

$otrosCuales = $_POST['cualesUp'];

//echo($zonas);

$query = "UPDATE tipo_beneficiado SET idZona='$zonas', nombre ='$nombre', nombreLaborSocial='$nombreLabor', nit='$nit', 
            dv='$dv', contactoInstitucional='$contactoInstitucional', cargo='$cargo', telefono='$tel', celular='$cel', email='$email', 
            aniosUltimaVisita='$anio', departamento ='$departamento', municipio='$municipio', subRegion='$subRegion', comuna='$comuna', 
            barrio='$barrio', zonaUrbanaORural='$zonaUrbana', direccion='$direccion', recomienda='$recomienda', protocoloBio='$protocolo', 
            fechaEntrega='$fechaEntrega', frecuenciaDonacion='$frecuenciaDonacion', diaDonacion='$diaDonacion', semanaDonacion='$semanaDonacion',
            frecuenciaServicioC='$frecuenciaServicio', diaServicioC='$diaServicio', semanaServicioC='$semanaServicioC', 
            jornadaServicioC='$jornadaServicioC', adultoMayor='$adultoMayor', proteccionNin='$proteccionN', proteccionNinias='$proteccionNias', 
            proteccionNinios='$proteccionNios', hogarDePaso='$hogar', comedor='$comedor', comunidadReligiosaOLaicos='$comunidad', 
            SeminaristasOreligiosos='$seminaristas', familiasVulnerables='$fVulnerables', capacitacionFormacion='$capacitacion', 
            arteCultura='$arte', deporte='$deporte', EnfermosYDesvalidos='$enfermos', educacion='$educacion', nutricion='$nutricion', 
            legal='$legal', espiritual='$espiritual', salud='$salud', recreacion='$recreacion', vivienda='$vivienda', artes='$arteCultura', 
            artesaniasYManualidades='$artesanias', biblioteca='$biblioteca', computadores='$computadores', costuraYCofeccion='$costura', 
            consutorioYDispensario='$consultorio', culinariaYPanaderia='$culinario', ludoteca='$ludoteca', musica='$musica', pintura='$pintura', 
            peluqueriaYBelleza='$peluqueria', ventasDeRopero='$ventaRopero', otros='$otros', cuales='$otrosCuales'
            WHERE id='$id'";
            //$query .= "(idZona, nombre, nombreLaborSocial, nit, dv, contactoInstitucional, cargo, telefono, celular, email, aniosUltimaVisita, departamento, municipio, subRegion, comuna, barrio, zonaUrbanaORural, direccion, recomienda, protocoloBio, fechaEntrega, frecuenciaDonacion, diaDonacion, semanaDonacion, frecuenciaServicioC, diaServicioC, semanaServicioC, jornadaServicioC, adultoMayor, proteccionNin, proteccionNinias, proteccionNinios, hogarDePaso, comedor, comunidadReligiosaOLaicos, SeminaristasOreligiosos, familiasVulnerables, capacitacionFormacion, arteCultura, deporte, EnfermosYDesvalidos, educacion, nutricion, legal, espiritual, salud, recreacion, vivienda, artes, artesaniasYManualidades, biblioteca, computadores, costuraYCofeccion, consutorioYDispensario, culinariaYPanaderia, ludoteca, musica, pintura, peluqueriaYBelleza, ventasDeRopero, otros, cuales) ";
            //$query .= "VALUES ('$zonas', '$nombre', '$nombreLabor', '$nit', '$dv', '$contactoInstitucional', '$cargo', '$tel', '$cel', '$email','$anio', '$departamento', '$municipio', '$subRegion', '$comuna', '$barrio', '$zonaUrbana', '$direccion', '$recomienda', '$protocolo', '$fechaEntrega', '$frecuenciaDonacion', '$diaDonacion', '$semaDonacion', '$frecuenciaServicio', '$diaServicio', '$semanaServicio', '$jornadaServicio', '$adultoMayor', '$proteccionN', '$proteccionNias',  '$proteccionNios', '$hogar','$comedor', '$comunidad', '$seminaristas', '$fVulnerables',  '$capacitacion', '$arte', '$deporte', '$enfermos',  '$educacion', '$nutricion', '$legal', '$espiritual',  '$salud', '$recreacion', '$vivienda', '$arteCultura', '$artesanias', '$biblioteca', '$computadores', '$costura', '$consultorio', '$culinario', '$ludoteca',  '$musica',  '$pintura', '$peluqueria', '$ventaRopero', '$otros', '$otrosCuales')";


$conexion->query($query);
if ($zonas == 0) {
    echo mysqli_query($conexion, 0);
} else {
    echo mysqli_query($conexion, $query);
}
/*$query = "INSERT INTO tipo_beneficiado ";
        $query .= "(idZona, nombre, nombreLaborSocial, nit, dv, contactoInstitucional, cargo, telefono, celular, email, aniosUltimaVisita, departamento, municipio, subRegion, comuna, barrio, zonaUrbanaORural, direccion, recomienda, protocoloBio, fechaEntrega, frecuenciaDonacion, diaDonacion, semanaDonacion, frecuenciaServicioC, diaServicioC, semanaServicioC, jornadaServicioC, adultoMayor, proteccionNin, proteccionNinias, proteccionNinios, hogarDePaso, comedor, comunidadReligiosaOLaicos, SeminaristasOreligiosos, familiasVulnerables, capacitacionFormacion, arteCultura, deporte, EnfermosYDesvalidos, educacion, nutricion, legal, espiritual, salud, recreacion, vivienda, artes, artesaniasYManualidades, biblioteca, computadores, costuraYCofeccion, consutorioYDispensario, culinariaYPanaderia, ludoteca, musica, pintura, peluqueriaYBelleza, ventasDeRopero, otros, cuales) ";
        $query .= "VALUES ('$zonas', '$nombre', '$nombreLabor', '$nit', '$dv', '$contactoInstitucional', '$cargo', '$tel', '$cel', '$email','$anio', '$departamento', '$municipio', '$subRegion', '$comuna', '$barrio', '$zonaUrbana', '$direccion', '$recomienda', '$protocolo', '$fechaEntrega', '$frecuenciaDonacion', '$diaDonacion', '$semaDonacion', '$frecuenciaServicio', '$diaServicio', '$semanaServicio', '$jornadaServicio', '$adultoMayor', '$proteccionN', '$proteccionNias',  '$proteccionNios', '$hogar','$comedor', '$comunidad', '$seminaristas', '$fVulnerables',  '$capacitacion', '$arte', '$deporte', '$enfermos',  '$educacion', '$nutricion', '$legal', '$espiritual',  '$salud', '$recreacion', '$vivienda', '$arteCultura', '$artesanias', '$biblioteca', '$computadores', '$costura', '$consultorio', '$culinario', '$ludoteca',  '$musica',  '$pintura', '$peluqueria', '$ventaRopero', '$otros', '$otrosCuales')";

        if ($zonas == 0) {
            echo mysqli_query($conexion, 0);
        } else {
            echo mysqli_query($conexion, $query);
        }

/*switch ($opcion) {
    case 1:

        

        break;

        case 2:

            $query = "UPDATE tipo_beneficiado SET idZona='$zonas', nombre ='$nombre', nombreLaborSocial='$nombreLabor', nit='$nit' 
            dv='$dv', contactoInstitucional='$contactoInstitucional', cargo='$cargo', telefono='$tel', celular='$cel', email='$email', 
            aniosUltimaVisita='$anio', departamento ='$departamento', municipio='$municipio', subRegion='$subRegion', comuna='$comuna', 
            barrio='$barrio', zonaUrbanaORural='$zonaUrbana', direccion='$direccion', recomienda='$recomienda', protocoloBio='$protocolo', 
            fechaEntrega='$fechaEntrega', frecuenciaDonacion='$frecuenciaDonacion', diaDonacion='$diaDonacion', semanaDonacion='$semanaDonacion',
            frecuenciaServicioC='$frecuenciaServicio', diaServicioC='$diaServicio', semanaServicioC='$semanaServicioC', 
            jornadaServicioC='$jornadaServicio', adultoMayor='$adultoMayor', proteccionNin='$proteccionN', proteccionNinias='$proteccionNias', 
            proteccionNinios='$proteccionNios', hogarDePaso='$hogar', comedor='$comedor', comunidadReligiosaOLaicos='$comunidad', 
            SeminaristasOreligiosos='$seminaristas', familiasVulnerables='$fVulnerables', capacitacionFormacion='$capacitacion', 
            arteCultura='$arte', deporte='$deporte', EnfermosYDesvalidos='$enfermos', educacion='$educacion', nutricion='$nutricion', 
            legal='$legal', espiritual='$espiritual', salud='$salud', recreacion='$recreacion', vivienda='$vivienda', artes='$arteCultura', 
            artesaniasYManualidades='$artesanias', biblioteca='$biblioteca', computadores='$computadores', costuraYCofeccion='$costura', 
            consutorioYDispensario='$consultorio', culinariaYPanaderia='$culinario', ludoteca='$ludoteca', musica='$musica', pintura='$pintura', 
            peluqueriaYBelleza='$peluqueria', ventasDeRopero='$ventaRopero', otros='$otros', cuales='$otrosCuales' 
            WHERE id='$id'";
            //$query .= "(idZona, nombre, nombreLaborSocial, nit, dv, contactoInstitucional, cargo, telefono, celular, email, aniosUltimaVisita, departamento, municipio, subRegion, comuna, barrio, zonaUrbanaORural, direccion, recomienda, protocoloBio, fechaEntrega, frecuenciaDonacion, diaDonacion, semanaDonacion, frecuenciaServicioC, diaServicioC, semanaServicioC, jornadaServicioC, adultoMayor, proteccionNin, proteccionNinias, proteccionNinios, hogarDePaso, comedor, comunidadReligiosaOLaicos, SeminaristasOreligiosos, familiasVulnerables, capacitacionFormacion, arteCultura, deporte, EnfermosYDesvalidos, educacion, nutricion, legal, espiritual, salud, recreacion, vivienda, artes, artesaniasYManualidades, biblioteca, computadores, costuraYCofeccion, consutorioYDispensario, culinariaYPanaderia, ludoteca, musica, pintura, peluqueriaYBelleza, ventasDeRopero, otros, cuales) ";
            //$query .= "VALUES ('$zonas', '$nombre', '$nombreLabor', '$nit', '$dv', '$contactoInstitucional', '$cargo', '$tel', '$cel', '$email','$anio', '$departamento', '$municipio', '$subRegion', '$comuna', '$barrio', '$zonaUrbana', '$direccion', '$recomienda', '$protocolo', '$fechaEntrega', '$frecuenciaDonacion', '$diaDonacion', '$semaDonacion', '$frecuenciaServicio', '$diaServicio', '$semanaServicio', '$jornadaServicio', '$adultoMayor', '$proteccionN', '$proteccionNias',  '$proteccionNios', '$hogar','$comedor', '$comunidad', '$seminaristas', '$fVulnerables',  '$capacitacion', '$arte', '$deporte', '$enfermos',  '$educacion', '$nutricion', '$legal', '$espiritual',  '$salud', '$recreacion', '$vivienda', '$arteCultura', '$artesanias', '$biblioteca', '$computadores', '$costura', '$consultorio', '$culinario', '$ludoteca',  '$musica',  '$pintura', '$peluqueria', '$ventaRopero', '$otros', '$otrosCuales')";
            break;
}


/*$conexion->query($query);

  if (!mysqli_commit($conexion)) {
    //$response['success'] = false;
    //$response['message'] = 'Ha ocurrido un error, intente nuevamente.';
    http_response_code(500);
    echo json_encode('error');
    exit();
  }else{
    http_response_code(200);
    echo json_encode($response);
  }

  mysqli_rollback($conexion);

  mysqli_close($conexion);

//$adultoMayor = $_POST['checkAdultoM'];

/*$proteccionN = $_POST['checkPro'];
$proteccionNias = $_POST['checkProNias'];
$proteccionNios = $_POST['checkProNios'];
$hogar = $_POST['checkHogar'];
$comunidad = $_POST['checkComunidad'];
$seminaristas = $_POST['checkSeminaristas'];
$fVulnerables = $_POST['checkFVulnerables'];
$capacitacion = $_POST['checkCapacitacion'];
$arte = $_POST['checkArte'];
$deporte = $_POST['checkDeporte'];
$enfermos = $_POST['checkEnfermos'];
$educacion = $_POST['checkEducacion'];
$nutriccion = $_POST['checkNutriccion'];
$legal = $_POST['checkLegal'];
$espiritual = $_POST['checkEspiritual'];
$salud = $_POST['checkSalud'];



$recreacion = $_POST['checkRecreacion'];
$vivienda = $_POST['checkVivienda'];
$arteCultura = $_POST['checkArteCultura'];
$artesanias = $_POST['checkArtesanias'];
$biblioteca = $_POST['checkBiblioteca'];
$computadores = $_POST['checkComputadores'];
$costrura = $_POST['checkCostura'];
$consultorio = $_POST['checkConsultorio'];
$culinario = $_POST['checkCulinario'];
$ludoteca = $_POST['checkLudoteca'];
$musica = $_POST['checkMusica'];
$pintura = $_POST['checkPintura'];
$peluqueria = $_POST['checkPeluqueria'];
$ventaRopero = $_POST['checkVentaRopero'];
$otros = $_POST['checkOtros'];
$otrosCuales = $_post['cuales'];


/*$query = "INSERT INTO tipo_beneficiado ";
$query .= "(id, nombre, codigo, creacion) ";
$query .= "VALUES (NULL,'" . $_POST["nombre"] . "','" . $_POST["codigo"] . "','" . $_POST["creacion"] . "')";*/

/*if($zonas === '0'){
    echo json_encode('error');
}
else {
    echo json_encode('Bien hecho');
    
}



/*if ($nombre === '' || $nombreLabor === '') {

    echo json_encode('error');
} else {
    echo json_encode('Bien hecho');
}*/





/*
<?php

require("../../includes/dsn_open.php");


$zonas = $_POST['selectZonas'];
$nombre = $_POST['nombre'];
$nombreLabor = $_POST['nombreLabor'];
$nit = $_POST['nit'];
$dv = $_POST['dv'];
$contactoInstitucional = $_POST['contactoInstitucional'];
$cargo = $_POST['cargo'];
$tel = $_POST['tel'];
$cel = $_POST['cel'];
$email = $_POST['correo'];
$anio = $_POST['aniosUltima'];
$departamento = $_POST['departamento'];
$municipio = $_POST['municipio'];
$subRegion = $_POST['subRegion'];
$comuna = $_POST['comuna'];
$barrio = $_POST['barrio'];
$direccion = $_POST['direccion'];
$zonaUrbana = $_POST['zonaUrbana'];
$recomienda = $_POST['recomienda'];
$protocolo = $_POST['protocolo'];
$fechaEntrega = $_POST['fechaEntrega'];
$frecuenciaDonacion = $_POST['frecuenciaDonacion'];
$diaDonacion = $_POST['diaDonacion'];
$semaDonacion = $_POST['semaDonacion'];
$frecuenciaServicio = $_POST['frecuenciaServicio'];
$diaServicio = $_POST['diaServicio'];
$semanaServicio = $_POST['semanaServicio'];
$jornadaServicio = $_POST['jornadaServicio'];

/*if ($_POST['selectZonas'] == 1) {
    $zonas = 1;
    echo json_encode('bien');
}
if ($_POST['selectZonas'] == 2) {
    $zonas = 2;
    echo json_encode('bien');
}
if ($_POST['selectZonas'] == 3) {
    $zonas = 3;
    echo json_encode('bien');
}
if ($_POST['selectZonas'] == 4) {
    $zonas = 4;
    echo json_encode('bien');
}
if ($_POST['selectZonas'] == 5) {
    $zonas = 5;
    echo json_encode('bien');
}
if ($_POST['selectZonas'] == 6) {
    $zonas = 6;
    echo json_encode('bien');
}
if ($_POST['selectZonas'] == 7) {
    $zonas = 7;
    echo json_encode('bien');
}
if ($_POST['selectZonas'] == 8) {
    $zonas = 8;
    echo json_encode('bien');
}


$adultoMayor ="";
$proteccionN ="";
$proteccionNias ="";
$proteccionNios ="";
$hogar ="";
$comedor = "";
$comunidad ="";
$seminaristas ="";
$fVulnerables ="";
$capacitacion ="";
$arte ="";
$deporte ="";
$enfermos ="";
$educacion ="";
$nutriccion ="";
$legal ="";
$espiritual ="";
$salud ="";
$recreacion ="";
$vivienda ="";
$arteCultura ="";
$artesanias ="";
$biblioteca ="";
$computadores ="";
$costura ="";
$consultorio ="";
$culinario ="";
$ludoteca ="";
$musica ="";
$pintura ="";
$peluqueria ="";
$ventaRopero ="";
$otros ="";

if (isset($_POST['checkAdultoM'])){
    $adultoMayor = 'x';
}
if (isset($_POST['checkPro'])){
    $proteccionN = 'x';
}
if (isset($_POST['checkProNias'])){
    $proteccionNias = 'x';
}
if (isset($_POST['checkProNios'])){
    $proteccionNios = 'x';
}
if (isset($_POST['checkHogar'])){
    $hogar = 'x';
}
if (isset($_POST['checkComedor'])){
    $comedor = 'x';
}
if (isset($_POST['checkComunidad'])){
    $comunidad = 'x';
}
if (isset($_POST['checkSeminaristas'])){
    $seminaristas = 'x';
}
if (isset($_POST['checkFVulnerables'])){
    $fVulnerables = 'x';
}
if (isset($_POST['checkCapacitacion'])){
    $capacitacion = 'x';
}
if (isset($_POST['checkArte'])){
    $arte = 'x';
}
if (isset($_POST['checkDeporte'])){
    $deporte = 'x';
}
if (isset($_POST['checkEnfermos'])){
    $enfermos = 'x';
}
if (isset($_POST['checkEducacion'])){
    $educacion = 'x';
}
if (isset($_POST['checkNutriccion'])){
    $nutriccion = 'x';
}
if (isset($_POST['checkLegal'])){
    $legal = 'x';
}
if (isset($_POST['checkEspiritual'])){
    $espiritual = 'x';
}
if (isset($_POST['checkSalud'])){
    $salud = 'x';
}
if (isset($_POST['checkRecreacion'])){
    $recreacion = 'x';
}
if (isset($_POST['checkVivienda'])){
    $vivienda = 'x';
}
if (isset($_POST['checkArteCultura'])){
    $arteCultura = 'x';
}
if (isset($_POST['checkArtesanias'])){
    $artesanias = 'x';
}
if (isset($_POST['checkBiblioteca'])){
    $biblioteca = 'x';
}
if (isset($_POST['checkComputadores'])){
    $computadores = 'x';
}
if (isset($_POST['checkCostura'])){
    $costura = 'x';
}
if (isset($_POST['checkConsultorio'])){
    $consultorio = 'x';
}
if (isset($_POST['checkCulinario'])){
    $culinario = 'x';
}
if (isset($_POST['checkLudoteca'])){
    $ludoteca = 'x';
}
if (isset($_POST['checkMusica'])){
    $musica = 'x';
}
if (isset($_POST['checkPintura'])){
    $pintura = 'x';
}
if (isset($_POST['checkPeluqueria'])){
    $peluqueria = 'x';
}
if (isset($_POST['checkVentaRopero'])){
    $ventaRopero = 'x';
}
if (isset($_POST['checkOtros'])){
    $otros = 'x';
}

$otrosCuales = $_POST['cuales'];

//echo($zonas);

$query = "INSERT INTO tipo_beneficiado ";
$query .= "(idZona, nombre, nombreLaborSocial, nit, dv, contactoInstitucional, cargo, telefono, celular, email, aniosUltimaVisita, departamento, municipio, subRegion, comuna, barrio, direccion, recomienda, protocoloBio, fechaEntrega, frecuenciaDonacion, diaDonacion, semanaDonacion, frecuenciaServicioC, diaServicioC, semanaServicioC, jornadaServicioC, adultoMayor, proteccionNin, proteccionNinios, proteccionNinias, hogarDePaso, comedor, comunidadReligiosaOLaicos, SeminaristasOreligiosos, familiasVulnerables, capacitacionFormacion, arteCultura, deporte, EnfermosYDesvalidos, educacion, nutricion, legal, espiritual, salud, recreacion, vivienda, otroCual, artes, artesaniasYManualidades, biblioteca, computadores, costuraYCofeccion, consutorioYDispensario, culinariaYPanaderia, ludoteca, musica, pintura, peluqueriaYBelleza, ventasDeRopero, otros, cuales) ";
$query .= "VALUES ('$zonas', '$nombre', '$nombreLabor', '$nit', '$dv', '$contactoInstitucional', '$cargo', '$tel', '$cel', '$email','$anio', '$anio', '$departamento', '$municipio', '$subRegion', '$comuna', '$barrio', '$direccion', '$zonaUrbana', '$recomienda', '$protocolo', '$fechaEntrega', '$frecuenciaDonacion', '$diaDonacion', '$semaDonacion', '$frecuenciaServicio', '$diaServicio', '$semanaServicio', '$jornadaServicio', '$adultoMayor', '$proteccionN', '$proteccionNias',  '$proteccionNios', '$hogar', '$comunidad', '$seminaristas', '$fVulnerables',  '$capacitacion', '$arte', '$deporte', '$enfermos',  '$educacion', '$nutriccion', '$legal', '$espiritual',  '$salud', '$recreacion', '$vivienda', '$arteCultura', '$artesanias', '$biblioteca', '$computadores', '$costura', '$consultorio', '$culinario', '$ludoteca',  '$musica',  '$pintura', '$peluqueria', '$ventaRopero', '$otros', '$cuales')";

echo mysqli_query($conexion, $query);

$query = "INSERT INTO tipo_beneficiado 
(idZona, nombre, nombreLaborSocial, nit, dv, contactoInstitucional, cargo, telefono, celular, email, departamento, municipio, subRegion, comuna, barrio, direccion, recomienda, protocoloBio, fechaEntrega, frecuenciaDonacion, diaDonacion, semanaDonacion, frecuenciaServicioC, diaServicioC, semanaServicioC, jornadaServicioC, adultoMayor, proteccionNin, proteccionNinias, proteccionNinios, hogarDePaso, comedor, comunidadReligiosaOLaicos, SeminaristasOreligiosos, familiasVulnerables, capacitacionFormacion, arteCultura, deporte, EnfermosYDesvalidos, educacion, nutricion, legal, espiritual, salud, recreacion, vivienda, artes, artesaniasYManualidades, biblioteca, computadores, costuraYCofeccion, consutorioYDispensario, culinariaYPanaderia, ludoteca, musica, pintura, peluqueriaYBelleza, ventasDeRopero, otros, cuales, aniosUltimaVisita)
VALUES ('$zonas', '$nombre', '$nombreLabor', '$nit', '$dv', '$contactoInstitucional', '$cargo', '$tel', '$cel', '$email', '$departamento', '$municipio', '$subRegion', '$comuna', '$barrio', '$direccion','$recomienda', '$zonaUrbana', '$recomienda', '$protocolo', '$fechaEntrega', '$frecuenciaDonacion', '$diaDonacion', '$semaDonacion', '$frecuenciaServicio', '$diaServicio', '$semanaServicio', '$jornadaServicio', '$adultoMayor', '$proteccionN', '$proteccionNias',  '$proteccionNios', '$hogar', '$comedor' '$comunidad', '$seminaristas', '$fVulnerables',  '$capacitacion', '$arte', '$deporte', '$enfermos',  '$educacion', '$nutriccion', '$legal', '$espiritual',  '$salud', '$recreacion', '$vivienda', '$arteCultura', '$artesanias', '$biblioteca', '$computadores', '$costura', '$consultorio', '$culinario', '$ludoteca',  '$musica',  '$pintura', '$peluqueria', '$ventaRopero', '$otros', '$otrosCuales', '$anio')";

echo mysqli_query($conexion, $query);

/*$conexion->query($query);

  if (!mysqli_commit($conexion)) {
    //$response['success'] = false;
    //$response['message'] = 'Ha ocurrido un error, intente nuevamente.';
    http_response_code(500);
    echo json_encode('error');
    exit();
  }else{
    http_response_code(200);
    echo json_encode($response);
  }

  mysqli_rollback($conexion);

  mysqli_close($conexion);

//$adultoMayor = $_POST['checkAdultoM'];

/*$proteccionN = $_POST['checkPro'];
$proteccionNias = $_POST['checkProNias'];
$proteccionNios = $_POST['checkProNios'];
$hogar = $_POST['checkHogar'];
$comunidad = $_POST['checkComunidad'];
$seminaristas = $_POST['checkSeminaristas'];
$fVulnerables = $_POST['checkFVulnerables'];
$capacitacion = $_POST['checkCapacitacion'];
$arte = $_POST['checkArte'];
$deporte = $_POST['checkDeporte'];
$enfermos = $_POST['checkEnfermos'];
$educacion = $_POST['checkEducacion'];
$nutriccion = $_POST['checkNutriccion'];
$legal = $_POST['checkLegal'];
$espiritual = $_POST['checkEspiritual'];
$salud = $_POST['checkSalud'];



$recreacion = $_POST['checkRecreacion'];
$vivienda = $_POST['checkVivienda'];
$arteCultura = $_POST['checkArteCultura'];
$artesanias = $_POST['checkArtesanias'];
$biblioteca = $_POST['checkBiblioteca'];
$computadores = $_POST['checkComputadores'];
$costrura = $_POST['checkCostura'];
$consultorio = $_POST['checkConsultorio'];
$culinario = $_POST['checkCulinario'];
$ludoteca = $_POST['checkLudoteca'];
$musica = $_POST['checkMusica'];
$pintura = $_POST['checkPintura'];
$peluqueria = $_POST['checkPeluqueria'];
$ventaRopero = $_POST['checkVentaRopero'];
$otros = $_POST['checkOtros'];
$otrosCuales = $_post['cuales'];


/*$query = "INSERT INTO tipo_beneficiado ";
$query .= "(id, nombre, codigo, creacion) ";
$query .= "VALUES (NULL,'" . $_POST["nombre"] . "','" . $_POST["codigo"] . "','" . $_POST["creacion"] . "')";*/

/*if($zonas === '0'){
    echo json_encode('error');
}
else {
    echo json_encode('Bien hecho');
    
}



/*if ($nombre === '' || $nombreLabor === '') {

    echo json_encode('error');
} else {
    echo json_encode('Bien hecho');
}*/
