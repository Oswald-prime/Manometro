<?php
include '../cnx/cnx.php';

$nombre_pozo = 'pozo-1';

$sql_get_fecha = "SELECT fecha FROM mediciones WHERE nombre_pozo = '$nombre_pozo' ORDER BY fecha ASC;";

if ($resul = $con->query($sql_get_fecha)) {
    while ($datos = $resul->fetch_assoc()) {
        $timestamp = strtotime($datos['fecha']);
        $nueva_fecha = date('d/m/Y H:i:s', $timestamp);
?>
        '<?php echo $nueva_fecha ?>',
<?php
    }
    $resul->free();
}
                        

?>