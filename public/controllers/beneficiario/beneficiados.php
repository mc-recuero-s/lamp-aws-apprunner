<?php

  require("../../includes/dsn_open.php");



    $salida = "";
    $query = "SELECT * from tipo_beneficiado";

    if(isset($_POST['consulta'])){

        $q = $conexion->real_escape_string($_POST['consulta']);
        $query = "SELECT id, nombre, nombreLaborSocial, nit, contactoInstitucional, telefono, celular, estado FROM tipo_beneficiado
        WHERE nit LIKE '%".$q."%' OR nombre LIKE '%".$q."%' OR estado LIKE '%".$q."%' "      ;
        //OR nombreLaborSocial LIKE '%".$q."%' or nit LIKE '%".$q."%'"
    }

    //$resultado = $mysqli->query($query);
    $resultado=$conexion->query($query);

    //$buscarRegistros=$conexion->query($query);

    if($resultado->num_rows > 0){

        $salida.="<table class='tabla_datos '
        <thead>
        <tr>
        <td>Nombre</td>
        <td>Nit</td>
        <td>Contacto</td>
        <td>Telefono</td>
        <td>Celular</td>
        <td>Estado</td>
        <td>Actualizar</td>
        <td>Retirar</td>
        </tr>
        </thead>
        </tbody>";

        while($fila = $resultado->fetch_assoc()){
            /*$salida.="<tr>
            <td>".$fila['id']."</td>
            <td>".$fila['nombre']."</td>
            <td>".$fila['nombreLaborSocial']."</td>
            <td>".$fila['nit']."</td>
            <td>".$fila['contactoInstitucional']."</td>
            <td>".$fila['telefono']."</td>
            <td>".$fila['celular']."</td>
            <td>".$mStatus= (($fila['estado']=='Activo') ? 'Es de día' : 'Es de noche')."</td>
            <td class='text-center'><a class='btnEditar btn btn-primary' id='btnEditar' onClick=editar('".$fila['id']."')>Editar</a>
            <td class='text-center'><a class='btnEditar btn btn-danger' id='borrar' onClick=borrar('".$fila['id']."')>Retirar</a>
            </tr>"; */

            $salida.="<tr>
            <td>".$fila['nombre']."</td>
            <td>".$fila['nit']."</td>
            <td>".$fila['contactoInstitucional']."</td>
            <td>".$fila['telefono']."</td>
            <td>".$fila['celular']."</td>
            <td>".$fila['estado']."</td>
            <td class='text-center'><a class='btnEditar btn btn-primary' id='btnEditar' onClick=editar('".$fila['id']."')>Editar</a>
            <td class='text-center'><a class='btnEditar btn btn-danger' id='retirar' onClick=retirar('".$fila['id']."')>Retirar</a>
            </tr>";
            
            
        }

        

        $salida.="</tbody></table>";
    }else{

        $salida.="No hay datos";
    }
    echo $salida;

    mysqli_close($conexion);
















?>