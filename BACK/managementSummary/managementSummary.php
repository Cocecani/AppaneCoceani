<?php

require('../../includes/db.php');
include('../header.php');

$start = $_GET["start"] ?? null;
$end   = $_GET["end"] ?? null;

$gross = 0;
$discount = 0;
$net = 0;

if($start && $end){

    $query = "
        SELECT 
            SUM(prezzo * quantita) AS gross,
            SUM(sconto) AS discount,
            SUM(totale) AS net
        FROM tordine
        WHERE consegnato = 1
        AND data BETWEEN ? AND ?
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $start, $end);
    $stmt->execute();

    $result = $stmt->get_result()->fetch_assoc();

    $gross = number_format($result["gross"] ?? 0, 2, '.', '');
    $discount = number_format($result["discount"] ?? 0, 2, '.', '');
    $net = number_format($result["net"] ?? 0, 2, '.', '');
}
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../../grafica/style.css?v=<?php echo time();?>">
    </head>

    <body>

        <div class="main-content">

            <h1>Riepilogo Incassi</h1>

            <div class="order summaryBox">

                <form method="GET" class="periodForm">

                    <div>
                        <p>Data Inizio</p>
                        <input type="date" name="start" required class="discount"
                        value="<?php echo $start ?? '' ?>">
                    </div>

                    <div>
                        <p>Data Fine</p>
                        <input type="date" name="end" required class="discount"
                        value="<?php echo $end ?? '' ?>">
                    </div>

                    <button class="btn">Calcola</button>

                </form>

            </div>

            <?php if($start && $end){ ?>

            <div class="order summaryBox">

                <div class="summaryRow">
                    <h2>💰 Soldi che dovevano arrivare</h2>
                    <h2><?php echo $gross ?> €</h2>
                </div>

                <div class="summaryRow">
                    <h2>🧾 Sconti applicati</h2>
                    <h2><?php echo $discount ?> €</h2>
                </div>

                <div class="summaryRow total">
                    <h2>✅ Soldi arrivati</h2>
                    <h2><?php echo $net ?> €</h2>
                </div>

            </div>

            <?php } ?>

        </div>

    </body>
</html>