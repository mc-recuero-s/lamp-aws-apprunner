<?php

    require("../../includes/dsn_open.php");

    $response = array();
    $response['success'] = true;
    $response['message'] = 'Hecho.';

    mysqli_autocommit($conexion,FALSE);
    
    $conexion->query("UPDATE certificacion
        SET anio = 2024
        WHERE anio IS NULL");

    $batch_size  = 1000;  // Cantidad de registros a procesar por lote
    $row_number  = 1;     // Desde dónde iniciar el consecutivo
    $offset = 0;
    while (true) {
        // 5.1) Seleccionar un lote de IDs ordenados por 'id'
        $sqlSelect = "SELECT id FROM certificacion ORDER BY id LIMIT $batch_size OFFSET $offset";
        $result    = $conexion->query($sqlSelect);
        if (!$result) {
            die("Error en SELECT: " . $conexion->error);
        }

        // 5.2) Obtener las filas en un arreglo
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $countRows = count($rows);

        // Si no hay más filas, terminamos
        if ($countRows === 0) {
            echo "Proceso completado. No hay más filas.\n";
            break;
        }

        // 5.3) Actualizar cada fila individualmente
        foreach ($rows as $row) {
            $id = $row['id'];
            // Formato: "anio-consecutivo"
            $sqlUpdate = "UPDATE certificacion
                        SET id_anual = CONCAT(anio, '-', $row_number)
                        WHERE id = $id";

            if (!$conexion->query($sqlUpdate)) {
                die("Error en UPDATE (ID=$id): " . $conexion->error);
            }

            $row_number++;  // Incrementa el consecutivo
        }

        // 5.4) Aumentar el OFFSET para el siguiente lote
        $offset += $countRows;

        // Opcional: mostrar progreso en la salida
        echo "Lote procesado: $countRows filas. Siguiente offset: $offset\n";
    }
    mysqli_commit($conexion);
    // 6) Cerrar conexión
    $conexion->close();


?>