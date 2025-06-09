<?php include __DIR__ . '/partials/navigationRelacionesInstitucionales.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <link rel="icon" type="image/png" href="./images/favicon-32x32.png">

    <title>Saciar</title>
    <link href="./styles/includes/material-icons.css" rel="stylesheet">

    <script src="./javascript/includes/jquery.min.js"></script>
    <script src="./javascript/includes/jquery-ui.min.js"></script>
    <script src="./javascript/includes/moment.min.js"></script>

    <script src="./javascript/scripts.js?v=1.70"></script>


    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="./styles/agregarBeneficiario.css" rel="stylesheet">
    <script src="./javascript/includes/selectize.min.js"></script>


    <?php
    require("./includes/dsn_open.php");


    $date = new DateTime();
    $date->setTimezone(new DateTimeZone('America/Bogota'));

    ?>
</head>

<body>
    <section>
        <br>
        <div></div>
        <div></div>
        <div class="infoo">

            <div class="">
                <label>Aquí podrás visualizar cada institción registrada en la base de datos.</label>


            </div>

        </div>
        <div>
            <br>
        </div>

        <h2>Instituciones</h2>

          <!-- Button trigger modal -->
          <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">Agregar</button>
        <!-- Modal -->
        <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-full" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar nueva institución</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="formulario">

                            <div class="borde">
                                <div class="nuevoo ">
                                    <br><br><br><br>
                                    <div>
                                        <span style="padding-left: 10px;">Datos generales</span>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Zona</label>
                                            <select name="selectZonas" id="selectZonas">
                                                <option value="0">Selecciona
                                                <option value="1">Medellín
                                                <option value="2">Sonsón
                                                <option value="3">Urrao
                                                <option value="4">Oriente
                                                <option value="5">Suroeste
                                                <option value="6">Itsmia
                                                <option value="7">Urabá
                                                <option value="8">Esporadicas
                                            </select>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Nombre</label>
                                            <input name="nombre" id="nombre" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Nombre labor social</label>
                                            <input name="nombreLabor" id="nombreLabor" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Nit</label>
                                            <input name="nit" id="nit" type="number" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>dv</label>
                                            <input name="dv" id="dv" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Contacto institucional</label>
                                            <input name="contactoInstitucional" id="contactoInstitucional" required />
                                        </div>
                                    </div>

                                    <br><br><br><br>

                                </div>

                                <div class="nuevoo">

                                    <div></div>
                                    <div>
                                        <div class="groupFormm">
                                            <label>Cargo</label>
                                            <input name="cargo" id="cargo" required/>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="groupFormm">
                                            <label>Teléfono</label>
                                            <input name="tel" id="tel" type="number" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Celular</label>
                                            <input name="cel" id="cel" type="number" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Email</label>
                                            <input name="correo" id="correo" required />
                                        </div>
                                    </div>
                                    <div>
                                        <div class="groupFormm">
                                            <label>Año de la ultima visita</label>
                                            <input name="aniosUltima" id="aniosUltima" type="number" required />
                                        </div>
                                    </div>
                                    <div></div>
                                    <br><br><br><br>
                                </div>

                            </div>

                            <div class="borde">
                                <div class="nuevoo ">

                                    <div>
                                        <span style="padding-left: 10px;">Ubicación</span>
                                    </div>
                                    <div>
                                        <div class="groupFormm">
                                            <label>Departamento</label>
                                            <input name="departamento" id="departamento" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Municipio</label>
                                            <input name="municipio" id="municipio" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Sub region</label>
                                            <input name="subRegion" id="subRegion" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Comuna</label>
                                            <input name="comuna" id="comuna" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Barrio</label>
                                            <input name="barrio" id="barrio" required />
                                        </div>
                                    </div>
                                    <div>
                                        <div class="groupFormm">
                                            <label>Dirección</label>
                                            <input name="direccion" id="direccion" required />
                                        </div>
                                    </div>
                                    <br><br><br><br>

                                </div>

                                <div class="nuevoo ">
                                    <div></div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Zona urbana o rulal</label>
                                            <input name="zonaUrbana" id="zonaUrbana" required />
                                        </div>
                                    </div>
                                    <div>
                                        <div class="groupFormm">
                                            <label>Recomienda</label>
                                            <input name="recomienda" id="recomienda" required />
                                        </div>
                                    </div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <br><br><br><br>

                                </div>
                            </div>

                            <div class="borde">
                                <div class="nuevoo ">

                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <div>
                                        <span style="padding-left: 10px;">Datos de entrega</span>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Protocolo de bioseguridad</label>
                                            <input name="protocolo" id="protocolo" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Fecha de entrega</label>
                                            <input name="fechaEntrega" id="fechaEntrega" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Frecuencia donación</label>
                                            <input name="frecuenciaDonacion" id="frecuenciaDonacion" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Día de la donación</label>
                                            <input name="diaDonacion" id="diaDonacion" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Semana de la donación</label>
                                            <input name="semaDonacion" id="semanaDonacion" required />
                                        </div>
                                    </div>
                                    <div></div>
                                </div>

                                <div class="nuevoo">
                                    <div>
                                        <span style="padding-left: 10px;">Servicio comunitario</span>
                                    </div>
                                    <div>
                                        <div class="groupFormm">
                                            <label>F. del servicio comunitario</label>
                                            <input name="frecuenciaServicio" id="frecuenciaServicio" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Día servicio comunitario</label>
                                            <input name="diaServicio" id="diaServicio" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Semana servicio comunitario</label>
                                            <input name="semanaServicio" id="semanaServicio" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Jornada servicio comunitario</label>
                                            <input name="jornadaServicio" id="jornadaServicio" required />
                                        </div>
                                    </div>
                                    <div></div>
                                    <div></div>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                </div>
                            </div>

                            <div class="borde">

                                <div class="nuevoCheck ">
                                    <br><br><br><br>
                                    <div>
                                        <span style="padding-left: 10px;">Otros datos</span>
                                    </div>
                                </div>

                                <div class="nuevoCheck  ">

                                    <div class="col">
                                        <div class="">
                                            <input type="checkbox" name="checkAdultoM" id="checkAdultoM" value="1">
                                            <label style="size: 50px;">Adulto mayor</label>

                                        </div>

                                        <div class="">

                                            <input type="checkbox" name="checkPro" id="checkPro" value="2">
                                            <label>Proteccion niñas/os</label>

                                        </div>
                                        <div class="">

                                            <input type="checkbox" name="checkProNias" id="checkProNias" value="3">
                                            <label>Proteccion niñas</label>

                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="checkProNios" id="checkProNios" value="4">
                                            <label>Proteccion niños</label>
                                        </div>

                                    </div>

                                    <div class="col">

                                        <div class="">
                                            <input type="checkbox" name="checkHogar" id="checkHogar" value="5">
                                            <label>Hogar de paso</label>
                                        </div>

                                        <div class="">
                                            <input type="checkbox" name="checkComedor" id="checkComedor" value="6">
                                            <label>Comedor</label>

                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="checkComunidad" id="checkComunidad" value="7">
                                            <label>Comunidad Religiosa y/o Laicos</label>

                                        </div>

                                        <div class="">
                                            <input type="checkbox" name="checkSeminaristas" id="checkSeminaristas" value="8">
                                            <label>Seminaristas y/o religiosos</label>

                                        </div>

                                        <div class="">
                                            <input type="checkbox" name="checkFVulnerables" id="checkFVulnerables" value="9">
                                            <label>Familias Vulnerables</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="">
                                            <input type="checkbox" name="checkCapacitacion" id="checkCapacitacion" value="10">
                                            <label>Capacitación y fromación</label>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="checkArte" id="checkArte" value="11">
                                            <label>Arte y cultura</label>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="checkDeporte" id="checkDeporte" value="12">
                                            <label>Deporte</label>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="checkEnfermos" id="checkEnfermos" value="13">
                                            <label>Enfermos y desvalidos</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="">
                                            <input type="checkbox" name="checkEducacion" id="checkEducacion" value="14">
                                            <label>Educación</label>
                                        </div>

                                        <div class="">
                                            <input type="checkbox" name="checkNutricion" id="checkNutricion" value="15">
                                            <label>Nutrición</label>

                                        </div>

                                        <div class="">
                                            <input type="checkbox" name="checkLegal" id="checkLegal" value="16">
                                            <label>Legal</label>
                                        </div>

                                        <div class="">
                                            <input type="checkbox" name="checkEspiritual" id="checkEspiritual" value="17">
                                            <label>Espiritual</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="">
                                            <input type="checkbox" name="checkSalud" id="checkSalud" value="18">
                                            <label>Salud</label>
                                        </div>

                                        <div class="">
                                            <input type="checkbox" name="checkRecreacion" id="checkRecreacion" value="19">
                                            <label>Recreación</label>
                                        </div>

                                        <div class="">
                                            <input type="checkbox" name="checkVivienda" id="checkVivienda" value="20">
                                            <label>Vivienda</label>

                                        </div>

                                    </div>

                                </div>

                                <div class="nuevoCheck">
                                    <div>

                                    </div>
                                </div>

                                <div class="nuevoCheck ">

                                    <br><br><br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>

                                    <div class="col">
                                        <div class="">
                                            <input type="checkbox" name="checkArteCultura" id="checkArteCultura" value="21">
                                            <label>Artes</label>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="checkArtesanias" id="checkArtesanias" value="22">
                                            <label>Artesanías y Manualidades</label>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="checkBiblioteca" id="checkBiblioteca" value="23">
                                            <label>Biblioteca</label>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="checkComputadores" id="checkComputadores" value="24">
                                            <label>Computadores</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="">
                                            <input type="checkbox" name="checkCostura" id="checkCostura" value="25">
                                            <label>Costura y Cofección</label>
                                        </div>

                                        <div class="">
                                            <input type="checkbox" name="checkConsultorio" id="checkConsultorio" value="26">
                                            <label>Consultorio y Dispensario</label>

                                        </div>

                                        <div class="">
                                            <input type="checkbox" name="checkCulinario" id="checkCulinario" value="27">
                                            <label>Culinaria y Panadería</label>
                                        </div>

                                        <div class="">
                                            <input type="checkbox" name="checkLudoteca" id="checkLudoteca" value="28">
                                            <label>Ludoteca</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="">
                                            <input type="checkbox" name="checkMusica" id="checkMusica" value="29">
                                            <label>Música</label>
                                        </div>

                                        <div class="">
                                            <input type="checkbox" name="checkPintura" id="checkPintura" value="30">
                                            <label>Pintura</label>
                                        </div>

                                        <div class="">
                                            <input type="checkbox" name="checkPeluqueria" id="checkPeluqueria" value="31">
                                            <label>Peluquería y Belleza</label>

                                        </div>

                                        <div class="">

                                            <input type="checkbox" name="checkVentaRopero" id="checkVentaRopero" value="32">
                                            <label>Ventas de ropero</label>

                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="">
                                            <input type="checkbox" name="checkOtros" id="checkOtros" value="33">
                                            <label>Otros </label>
                                        </div>

                                        <div>
                                            <div class="groupForm">
                                                <label>¿Cuáles?</label>
                                                <input name="cuales" id="cuales" />
                                            </div>
                                            <div></div>
                                        </div>

                                    </div>
                                </div>
                                <input type="hidden" id="id">

                            </div>

                            <div class="nuevoCheck borde ">

                                <div class="groupForm">

                                </div>

                                <br>
                                <div class="groupForm">

                                </div>

                                <br>
                                <br>
                                <div class="groupForm">

                                </div>
                                <br>
                                <div>
                                    <div id="respuesta" style="padding-top: 10px;">

                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                    <button class="btn btn-primary" name="" id="btnAgregar">Agregar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>

        <!-- Modal -->
        <div class="modal fade " id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-full" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Actualizar información</h5>
                        <div class="contenedorEstado">
                            <div></div>
                            <div></div>
                            <div class="contenedorEstado" id="divEstado"><label id="estado" class=""></label></div>

                        </div>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="formularioEdit">

                            <div>
                                <div class="groupFormm">
                                    <input name="idUp" id="idUp" type="hidden" />
                                </div>
                            </div>
                            <div class="borde">
                                <div class="nuevoo ">
                                    <br><br><br><br>
                                    <div>
                                        <span style="padding-left: 10px;">Datos generales</span>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Zona</label>
                                            <select name="selectZonasUp" id="selectZonasUp">
                                                <option value="0">Selecciona
                                                <option value="1">Medellín
                                                <option value="2">Sonsón
                                                <option value="3">Urrao
                                                <option value="4">Oriente
                                                <option value="5">Suroeste
                                                <option value="6">Itsmia
                                                <option value="7">Urabá
                                                <option value="8">Esporadicas
                                            </select>
                                        </div>

                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Nombre</label>
                                            <input name="nombreUp" id="nombreUp" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Nombre labor social</label>
                                            <input name="nombreLaborUp" id="nombreLaborUp" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Nit</label>
                                            <input name="nitUp" id="nitUp" type="number" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>dv</label>
                                            <input name="dvUp" id="dvUp" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Contacto institucional</label>
                                            <input name="contactoInstitucionalUp" id="contactoInstitucionalUp" required />
                                        </div>
                                    </div>

                                    <br><br><br><br>

                                </div>

                                <div class="nuevoo">

                                    <div></div>
                                    <div>
                                        <div class="groupFormm">
                                            <label>Cargo</label>
                                            <input name="cargoUp" id="cargoUp" required />
                                        </div>
                                    </div>
                                    <div>
                                        <div class="groupFormm">
                                            <label>Teléfono</label>
                                            <input name="telUp" id="telUp" type="" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Celular</label>
                                            <input name="celUp" id="celUp" type="" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Email</label>
                                            <input name="correoUp" id="correoUp" required />
                                        </div>
                                    </div>
                                    <div>
                                        <div class="groupFormm">
                                            <label>Año de la ultima visita</label>
                                            <input name="aniosUltimaUp" id="aniosUltimaUp" type="number" required />
                                        </div>
                                    </div>
                                    <div></div>
                                    <br><br><br><br>
                                </div>

                            </div>

                            <div class="borde">
                                <div class="nuevoo ">

                                    <div>
                                        <span style="padding-left: 10px;">Ubicación</span>
                                    </div>
                                    <div>
                                        <div class="groupFormm">
                                            <label>Departamento</label>
                                            <input name="departamentoUp" id="departamentoUp" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Municipio</label>
                                            <input name="municipioUp" id="municipioUp" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Sub region</label>
                                            <input name="subRegionUp" id="subRegionUp" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Comuna</label>
                                            <input name="comunaUp" id="comunaUp" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Barrio</label>
                                            <input name="barrioUp" id="barrioUp" required />
                                        </div>
                                    </div>
                                    <div>
                                        <div class="groupFormm">
                                            <label>Dirección</label>
                                            <input name="direccionUp" id="direccionUp" required />
                                        </div>
                                    </div>
                                    <br><br><br><br>

                                </div>

                                <div class="nuevoo ">
                                    <div></div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Zona urbana o rulal</label>
                                            <input name="zonaUrbanaUp" id="zonaUrbanaUp" required />
                                        </div>
                                    </div>
                                    <div>
                                        <div class="groupFormm">
                                            <label>Recomienda</label>
                                            <input name="recomiendaUp" id="recomiendaUp" required />
                                        </div>
                                    </div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <br><br><br><br>

                                </div>
                            </div>

                            <div class="borde">
                                <div class="nuevoo ">

                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <div>
                                        <span style="padding-left: 10px;">Datos de entrega</span>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Protocolo de bioseguridad</label>
                                            <input name="protocoloUp" id="protocoloUp" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Fecha de entrega</label>
                                            <input name="fechaEntregaUp" id="fechaEntregaUp" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Frecuencia donación</label>
                                            <input name="frecuenciaDonacionUp" id="frecuenciaDonacionUp" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Día de la donación</label>
                                            <input name="diaDonacionUp" id="diaDonacionUp" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Semana de la donación</label>
                                            <input name="semaDonacionUp" id="semanaDonacionUp" required />
                                        </div>
                                    </div>
                                    <div></div>
                                </div>

                                <div class="nuevoo">
                                    <div>
                                        <span style="padding-left: 10px;">Servicio comunitario</span>
                                    </div>
                                    <div>
                                        <div class="groupFormm">
                                            <label>F. del servicio comunitario</label>
                                            <input name="frecuenciaServicioUp" id="frecuenciaServicioUp" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Día servicio comunitario</label>
                                            <input name="diaServicioUp" id="diaServicioUp" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Semana servicio comunitario</label>
                                            <input name="semanaServicioUp" id="semanaServicioUp" required />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="groupFormm">
                                            <label>Jornada servicio comunitario</label>
                                            <input name="jornadaServicioUp" id="jornadaServicioUp" required />
                                        </div>
                                    </div>
                                    <div></div>
                                    <div></div>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                </div>
                            </div>



                            <div class="borde">

                                <div class="nuevoCheck ">
                                    <br><br><br><br>
                                    <div>
                                        <span style="padding-left: 10px;">Otros datos</span>
                                    </div>
                                </div>

                                <div class="nuevoCheck  ">

                                    <div class="col">
                                        <div class="">
                                            <input type="checkbox" name="checkAdultoMUp" id="checkAdultoMUp" value="1">
                                            <label style="size: 50px;">Adulto mayor</label>

                                        </div>

                                        <div class="">

                                            <input type="checkbox" name="checkProUp" id="checkProUp" value="2">
                                            <label>Proteccion niñas/os</label>

                                        </div>
                                        <div class="">

                                            <input type="checkbox" name="checkProNiasUp" id="checkProNiasUp" value="3">
                                            <label>Proteccion niñas</label>

                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="checkProNiosUp" id="checkProNiosUp" value="4">
                                            <label>Proteccion niños</label>
                                        </div>

                                    </div>


                                    <div class="col">

                                        <div class="">
                                            <input type="checkbox" name="checkHogarUp" id="checkHogarUp" value="5">
                                            <label>Hogar de paso</label>
                                        </div>

                                        <div class="">
                                            <input type="checkbox" name="checkComedorUp" id="checkComedorUp" value="6">
                                            <label>Comedor</label>

                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="checkComunidadUp" id="checkComunidadUp" value="7">
                                            <label>Comunidad Religiosa y/o Laicos</label>

                                        </div>

                                        <div class="">
                                            <input type="checkbox" name="checkSeminaristasUp" id="checkSeminaristasUp" value="8">
                                            <label>Seminaristas y/o religiosos</label>

                                        </div>

                                        <div class="">
                                            <input type="checkbox" name="checkFVulnerablesUp" id="checkFVulnerablesUp" value="9">
                                            <label>Familias Vulnerables</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="">
                                            <input type="checkbox" name="checkCapacitacionUp" id="checkCapacitacionUp" value="10">
                                            <label>Capacitación y fromación</label>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="checkArteUp" id="checkArteUp" value="11">
                                            <label>Arte y cultura</label>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="checkDeporteUp" id="checkDeporteUp" value="12">
                                            <label>Deporte</label>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="checkEnfermosUp" id="checkEnfermosUp" value="13">
                                            <label>Enfermos y desvalidos</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="">
                                            <input type="checkbox" name="checkEducacionUp" id="checkEducacionUp" value="14">
                                            <label>Educación</label>
                                        </div>

                                        <div class="">
                                            <input type="checkbox" name="checkNutricionUp" id="checkNutricionUp" value="15">
                                            <label>Nutrición</label>

                                        </div>

                                        <div class="">
                                            <input type="checkbox" name="checkLegalUp" id="checkLegalUp" value="16">
                                            <label>Legal</label>
                                        </div>

                                        <div class="">
                                            <input type="checkbox" name="checkEspiritualUp" id="checkEspiritualUp" value="17">
                                            <label>Espiritual</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="">
                                            <input type="checkbox" name="checkSaludUp" id="checkSaludUp" value="18">
                                            <label>Salud</label>
                                        </div>

                                        <div class="">
                                            <input type="checkbox" name="checkRecreacionUp" id="checkRecreacionUp" value="19">
                                            <label>Recreación</label>
                                        </div>

                                        <div class="">
                                            <input type="checkbox" name="checkViviendaUp" id="checkViviendaUp" value="20">
                                            <label>Vivienda</label>

                                        </div>

                                    </div>


                                </div>


                                <div class="nuevoCheck">
                                    <div>

                                    </div>
                                </div>


                                <div class="nuevoCheck ">


                                    <br><br><br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>

                                    <div class="col">
                                        <div class="">
                                            <input type="checkbox" name="checkArteCulturaUp" id="checkArteCulturaUp" value="21">
                                            <label>Artes</label>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="checkArtesaniasUp" id="checkArtesaniasUp" value="22">
                                            <label>Artesanías y Manualidades</label>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="checkBibliotecaUp" id="checkBibliotecaUp" value="23">
                                            <label>Biblioteca</label>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="checkComputadoresUp" id="checkComputadoresUp" value="24">
                                            <label>Computadores</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="">
                                            <input type="checkbox" name="checkCosturaUp" id="checkCosturaUp" value="25">
                                            <label>Costura y Cofección</label>
                                        </div>

                                        <div class="">
                                            <input type="checkbox" name="checkConsultorioUp" id="checkConsultorioUp" value="26">
                                            <label>Consultorio y Dispensario</label>

                                        </div>

                                        <div class="">
                                            <input type="checkbox" name="checkCulinarioUp" id="checkCulinarioUp" value="27">
                                            <label>Culinaria y Panadería</label>
                                        </div>

                                        <div class="">
                                            <input type="checkbox" name="checkLudotecaUp" id="checkLudotecaUp" value="28">
                                            <label>Ludoteca</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="">
                                            <input type="checkbox" name="checkMusicaUp" id="checkMusicaUp" value="29">
                                            <label>Música</label>
                                        </div>

                                        <div class="">
                                            <input type="checkbox" name="checkPinturaUp" id="checkPinturaUp" value="30">
                                            <label>Pintura</label>
                                        </div>

                                        <div class="">
                                            <input type="checkbox" name="checkPeluqueriaUp" id="checkPeluqueriaUp" value="31">
                                            <label>Peluquería y Belleza</label>

                                        </div>

                                        <div class="">


                                            <input type="checkbox" name="checkVentaRoperoUp" id="checkVentaRoperoUp" value="32">
                                            <label>Ventas de ropero</label>

                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="">
                                            <input type="checkbox" name="checkOtrosUp" id="checkOtrosUp" value="33">
                                            <label>Otros </label>
                                        </div>

                                        <div>
                                            <div class="groupForm">
                                                <label>¿Cuáles?</label>
                                                <input name="cualesUp" id="cualesUp" />
                                            </div>
                                            <div></div>
                                        </div>

                                    </div>
                                </div>
                                <input type="hidden" id="id">

                            </div>




                            <div class="nuevoCheck borde ">
                                <div>


                                </div>
                                <div>
                                    <div id="respuestaUp" style="padding-top: 10px;">

                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                            <button class="btn btn-primary" id="guardarEdit">Guardar cambios</button>
                                <button type="button" class="btn btn-secondary" id="" data-dismiss="modal">Cerrar</button>

                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </section>



    <section class="">


        <div class="">
            <input class="form-control mr-sm-2" type="search" placeholder="buscar" aria-label="Search" id="inputBuscar">
            <table id="datos" class="table mt-2 table-bordered table-striped overflow-x: auto;">
                <thead>
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Nit</th>
                        <th>Nit</th>
                        <th>Nit</th>
                        <th>Nit</th>
                        <th>Nit</th>
                        <th>Nit</th>

                    </tr>
                </thead>

            </table>

            <div>

                <div id="datos" style="margin-bottom: 0; overflow-x: auto; max-height: 130px; width: 80%; white-space: nowrap;">

                </div>
            </div>


        </div>

    </section>



    </div>



    </section>

    <!-- <script>
        function editar(id){
            $('#hiddendata').val(id);

            $.post("update.php", {id:id}, function(data, statues){
                var userid= JSON.parse(data);

            });


            $('#modalForm').modal("show");
        }
    </script>-->


    <script src="./javascript/entrada.js?v=1.70"></script>

    <script src="./javascript/beneficiado.js?v=1.70"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>





    <?php include __DIR__ . '/partials/footer.php';
