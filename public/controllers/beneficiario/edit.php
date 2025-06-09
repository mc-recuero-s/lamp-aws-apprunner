<?php
  require("../../includes/dsn_open.php");
 

 $idd = $_POST['idUp'];
 $nombreUp = $_POST['nombreUp'];
 
//$query = "UPDATE tipo_beneficiado SET nombre ='$nombreUp' WHERE id=$idd";

//$conexion->query($query);


/*if ($query == 0) {
    echo mysqli_query($conexion, 0);
} else {
    echo mysqli_query($conexion, $query);
}


  mysqli_rollback($conexion);

  mysqli_close($conexion);*/

        
        //$query .= "(idZona, nombre, nombreLaborSocial, nit, dv, contactoInstitucional, cargo, telefono, celular, email, aniosUltimaVisita, departamento, municipio, subRegion, comuna, barrio, zonaUrbanaORural, direccion, recomienda, protocoloBio, fechaEntrega, frecuenciaDonacion, diaDonacion, semanaDonacion, frecuenciaServicioC, diaServicioC, semanaServicioC, jornadaServicioC, adultoMayor, proteccionNin, proteccionNinias, proteccionNinios, hogarDePaso, comedor, comunidadReligiosaOLaicos, SeminaristasOreligiosos, familiasVulnerables, capacitacionFormacion, arteCultura, deporte, EnfermosYDesvalidos, educacion, nutricion, legal, espiritual, salud, recreacion, vivienda, artes, artesaniasYManualidades, biblioteca, computadores, costuraYCofeccion, consutorioYDispensario, culinariaYPanaderia, ludoteca, musica, pintura, peluqueriaYBelleza, ventasDeRopero, otros, cuales) ";
        //$query .= "VALUES ('$zonas', '$nombre', '$nombreLabor', '$nit', '$dv', '$contactoInstitucional', '$cargo', '$tel', '$cel', '$email','$anio', '$departamento', '$municipio', '$subRegion', '$comuna', '$barrio', '$zonaUrbana', '$direccion', '$recomienda', '$protocolo', '$fechaEntrega', '$frecuenciaDonacion', '$diaDonacion', '$semaDonacion', '$frecuenciaServicio', '$diaServicio', '$semanaServicio', '$jornadaServicio', '$adultoMayor', '$proteccionN', '$proteccionNias',  '$proteccionNios', '$hogar','$comedor', '$comunidad', '$seminaristas', '$fVulnerables',  '$capacitacion', '$arte', '$deporte', '$enfermos',  '$educacion', '$nutricion', '$legal', '$espiritual',  '$salud', '$recreacion', '$vivienda', '$arteCultura', '$artesanias', '$biblioteca', '$computadores', '$costura', '$consultorio', '$culinario', '$ludoteca',  '$musica',  '$pintura', '$peluqueria', '$ventaRopero', '$otros', '$otrosCuales')";
?>