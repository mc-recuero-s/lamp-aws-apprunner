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

    $query="SELECT c.id, 
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
    be.tipo_documento,
    be.codigo, 
    be.creacion, 
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
    WHERE (c.estado=2 OR c.estado=7) AND c.tipo=1
    GROUP BY 
        c.id"; 

    $ejecutar = mysqli_query($conexion,$query);

    $certificaciones1=fetch_all_assoc($ejecutar);

    foreach ($certificaciones1 as &$valor) {
        if (isset($valor["historial"])){
            $valor["historial"] = "[".$valor["historial"]."]";
        }
    }    

    $query_main = "
    SELECT 
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
        c.archivos, 
        c.categoria, 
        c.estado, 
        be.nombre AS institucion, 
        be.codigo, 
        be.creacion, 
        be.nit
    FROM 
        certificacion c
    INNER JOIN 
        tipo_benefactor be ON c.institucion = be.id
    WHERE 
        (c.estado=2 OR c.estado=7) AND c.tipo=2
    GROUP BY 
        c.id, 
        be.nombre, 
        be.codigo, 
        be.creacion, 
        be.nit        
    ";

    $result_main = mysqli_query($conexion,$query_main);
    $certificaciones2 = [];
    while ($row = mysqli_fetch_assoc($result_main)) {
        $certificaciones2[$row['id']] = $row;
        $certificaciones2[$row['id']]['historial'] = [];
        $certificaciones2[$row['id']]['entradas'] = [];
    }

    $query_historial = "
        SELECT 
            c.id AS certificacion_id,   
            ch.id,         
            ch.creado, 
            ch.estado, 
            ch.observacion
        FROM 
            certificacion c
        LEFT JOIN 
            certificacion_historial ch ON c.id = ch.certificacion
        WHERE 
             c.tipo=2
        ORDER BY 
            ch.creado DESC
    ";

    $result_historial = mysqli_query($conexion,$query_historial);
    while ($row_historial = mysqli_fetch_assoc($result_historial)) {
        if (!is_null($row_historial['id']) && isset($certificaciones2[$row_historial['certificacion_id']])) {
            $certificaciones2[$row_historial['certificacion_id']]['historial'][] = $row_historial;
        }
    }

    $query_entradas = "
        SELECT 
            c.id AS certificacion_id,  
            e.id,
            e.factura, 
            e.fecha
        FROM 
            certificacion c
        LEFT JOIN 
            certificacion_entradas ce ON c.id = ce.id_certificacion
        LEFT JOIN 
            entrada e ON ce.id_entrada = e.id
        WHERE 
            (c.estado=2 OR c.estado=7) AND c.tipo=2
    ";

    $result_entradas = mysqli_query($conexion,$query_entradas);
    while ($row_entradas = mysqli_fetch_assoc($result_entradas)) {
        if (!is_null($row_entradas['factura']) && isset($certificaciones2[$row_entradas['certificacion_id']])) {
            $certificaciones2[$row_entradas['certificacion_id']]['entradas'][] = $row_entradas;
        }
    }

    $certificaciones=array_merge($certificaciones1, $certificaciones2);
            
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
