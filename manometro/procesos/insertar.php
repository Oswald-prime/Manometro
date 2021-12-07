<?php
require_once "../cnx/cnx.php";

if(isset($_POST['btn']) && $_POST['btn'] == "insertar"){
    $presion = $_POST['presion'];
    $fecha = $_POST['fecha'];
    $pozo = $_POST['pozo'];

    /*Comprobantes*/
    if($pozo == '#' || $presion == null || $fecha == null){
        echo '<script>alert("Error, datos faltantes..");
            location.href = "../index.php";
            </script>';

    /*Sentencia SQL*/
    } else {
        $insert = "INSERT INTO mediciones (nombre_pozo, fecha, presion) VALUES ('$pozo', '$fecha', '$presion')";
        $query = mysqli_query($con, $insert);

        if($query){
            echo '<script>alert("Guardado correctamente.");
            location.href = "../index.php";
            </script>';
        } else {
            echo '<script>alert("Error al guardar los datos.");
            location.href = "../index.php";
            </script>';
        }
    }
}

?>