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
        c.archivos, 
        c.categoria, 
        c.estado, 
        c.fecha_envio, 
        be.id AS id_institucion, 
        be.nombre AS institucion, 
        be.codigo, 
        be.creacion, 
        be.nit  
        FROM 
            certificacion c
        INNER JOIN 
            tipo_benefactor be ON c.institucion = be.id    
        WHERE c.id =". $_POST['id'];              

    $ejecutar = mysqli_query($conexion,$query);

    $certificaciones=fetch_all_assoc($ejecutar);

    $response['certificacion']=$certificaciones[0];

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
