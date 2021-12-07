<?php
include '../cnx/cnx.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.js" integrity="sha512-CWVDkca3f3uAWgDNVzW+W4XJbiC3CH84P2aWZXj+DqI6PNbTzXbl1dIzEHeNJpYSn4B6U8miSZb/hCws7FnUZA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="../CSS/funky.css">
    <title>Detalles - Graficas</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="../index.php">Principal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Graficas</a>
                </li>
            </ul>
        </div>
    </nav>

    <main>
        <h2>Seleccione una grafica</h2>
        <hr>
        <div class="select-grafica">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                Nombre del Pozo <br>
                <select name="pozo"><br>
                    <option value="#">Seleccione un Pozo</option>
                    <option value="pozo-1">pozo-1</option>
                    <option value="pozo-2">pozo-2</option>
                    <option value="pozo-3">pozo-3</option>
                </select><br><br>
                <input type="submit" name="grafica" value="grafica" class="btn btn-success">
            </form>
        </div>
        <hr>

        <div class="grafica">
        <?php
        if(isset($_POST['grafica']) && $_POST['grafica'] == 'grafica'){
            $nombre_pozo = $_POST['pozo'];
        ?>
            <canvas id="myChart" width="400" height="400"></canvas>
            <script>
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        <?php
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
                    ],
                    datasets: [{
                        label: 'Presion',
                        data: [
                            <?php
                            $sql_get_medicion = "SELECT presion FROM mediciones WHERE nombre_pozo = '$nombre_pozo' ORDER BY fecha ASC;";

                            if ($resul = $con->query($sql_get_medicion)) {
                                while ($datos = $resul->fetch_assoc()) {
                                ?>
                                    '<?php echo $datos["presion"]; ?>',
                                <?php 
                                }
                                $resul->free();
                            }
                            ?>
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            </script>
        </div>
        <?php
        }
        ?>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php
mysqli_close($con);
?>
</html>
