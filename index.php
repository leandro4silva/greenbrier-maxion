<?php
include_once("templates/header.php");

if (isset($_SESSION['sales'])) {
    $data = $_SESSION['sales'];

    foreach ($data as $row) {
        $names[] = $row["name"];
        $total_price[] = $row["total_sale"];
    }

}


?>

<div id="app" class="container">
    <?php if (isset($printMsg) && $printMsg != ""): ?>
    <div id="msg">
        <button id="close-msg">
            <img src="<?= $BASE_URL ?>assets/img/close-icon.svg" alt="Fechar">
        </button>
        <?= strval($printMsg) ?>
    </div>
    <?php endif; ?>

    <div class="upload-file">
        <form action="<?= $BASE_URL ?>helpers/process.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="upload_file">
            <label for="file">Faça o upload do arquivo com os registros das vendas</label>
            <input type="file" name="file" required>
            <button type="submit">Enviar</button>
        </form>
    </div>

    <div class="chart">
        <canvas id="myChart"></canvas>
    </div>
</div>

<script>
    const ctx = document.getElementById('myChart');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($names); ?>,
            datasets: [{
                label: 'total de vendas',
                data: <?php echo json_encode($total_price); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
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


<?php
include_once("templates/footer.php")
    ?>