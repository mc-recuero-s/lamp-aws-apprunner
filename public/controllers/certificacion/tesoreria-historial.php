<?php

    require("../../includes/dsn_open.php");


    $response = array();
    $response['success'] = true;
    $response['message'] = 'Hecho.';    

    function fetch_all_assoc($result) {
        $all_rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $all_rows[] = $row;
        }
        return $all_rows;
    }

    $query="SELECT 
    c.id, 
    c.institucion,     
    c.tipo, 
    c.monto, 
    c.destinatario, 
    c.fecha_donacion, 
    c.remitente, 
    c.asignacion, 
    c.descripcion, 
    c.factura, 
    c.expedicion_factura, 
    c.expedicion, 
    c.anio, 
    c.id_anual, 
    c.archivos, 
    c.categoria, 
    c.estado, 
    be.nombre AS institucion, 
    be.codigo, 
    be.creacion, 
    be.tipo_documento,
    be.documento,
    be.correo,
    be.celular,
    GROUP_CONCAT(
        CONCAT(
            '{\"id\":\"', ch.id, '\",',
            '\"creado\":\"', ch.creado, '\",',
            '\"estado\":\"', ch.estado, '\",',
            '\"observacion\":\"', ch.observacion, '\"}'
        ) ORDER BY ch.creado DESC SEPARATOR ','        
    ) AS historial
    FROM 
        certificacion c
    INNER JOIN 
        benefactor_efectivo be ON c.institucion = be.id
    LEFT JOIN 
        certificacion_historial ch ON c.id = ch.certificacion
    WHERE c.estado > 0
    GROUP BY 
        c.id";              

    $ejecutar = mysqli_query($conexion,$query);

    $certificaciones=fetch_all_assoc($ejecutar);

    foreach ($certificaciones as &$valor) {
        if (isset($valor["historial"])){
            $valor["historial"] = "[".$valor["historial"]."]";
        }
    }

    $response['certificaciones']=$certificaciones;

    session_start();
    error_reporting(0);

    // if(isset($_SESSION['user'])){
    //     $sql = "SELECT * FROM usuario WHERE id= '".$_SESSION['user']."'";
    //     $ejecutar = mysqli_query($conexion,$sql);

    //     $user=mysqli_fetch_assoc($ejecutar);
    //     unset($user['contrasena']);
    //     $response['usuario']=$user;
    // }

    echo json_encode($response,true);
    mysqli_close($conexion);

?>
