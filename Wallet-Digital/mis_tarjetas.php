<?php
session_start();
include("conexion.php");

$id = $_SESSION["id"];
$consulta = $conexion->query("SELECT * FROM tarjetas WHERE usuario_id = $id");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Mis Tarjetas</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>
    body {
        background: linear-gradient(135deg, #dfe9f3, #ffffff);
        min-height: 100vh;
        padding-bottom: 50px;
        font-family: 'Segoe UI', sans-serif;
    }

    .wallet-title {
        text-align: center;
        font-size: 36px;
        font-weight: 700;
        margin-top: 40px;
        color: #333;
    }

    .card-wallet {
        width: 100%;
        height: 220px;
        border-radius: 20px;
        padding: 20px;
        background: rgba(255, 255, 255, 0.35);
        backdrop-filter: blur(8px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        margin-bottom: 35px;
        transition: transform .2s;
        color: white;
        overflow: hidden;
        position: relative;
    }

    .card-wallet:hover {
        transform: scale(1.03);
    }

    .card-bank {
        font-size: 22px;
        font-weight: 600;
    }

    .card-number {
        font-size: 20px;
        margin-top: 25px;
        letter-spacing: 2px;
    }

    .card-footer-info {
        position: absolute;
        bottom: 20px;
        left: 20px;
        font-size: 14px;
        opacity: 0.9;
    }

    .saldo-badge {
        position: absolute;
        right: 20px;
        bottom: 20px;
        background: rgba(0,0,0,0.45);
        padding: 8px 15px;
        font-size: 15px;
        border-radius: 12px;
    }

    /* Colores dinámicos tipo Apple Wallet */
    .bbva { background: linear-gradient(135deg, #002E6D, #0066CC); }
    .banorte { background: linear-gradient(135deg, #8B0000, #E60000); }
    .santander { background: linear-gradient(135deg, #C00000, #FF3333); }
    .hsbc { background: linear-gradient(135deg, #990000, #FF0000); }
    .scotiabank { background: linear-gradient(135deg, #BA0000, #FF4444); }

</style>
</head>

<body>

<h2 class="wallet-title">Mis Tarjetas</h2>

<div class="container mt-4">
    <div class="row">

        <?php while ($t = $consulta->fetch_assoc()): ?>

        <?php
            $clase = strtolower($t["banco"]);
            $clase = str_replace(" ", "", $clase);
        ?>

        <div class="col-md-6 col-lg-4">
            <div class="card-wallet <?= $clase ?>">

                <div class="card-bank"><?= $t["banco"] ?></div>

                <div class="card-number">
                    <?= substr($t["numero"], 0, 4) ?> •••• •••• <?= substr($t["numero"], -4) ?>
                </div>

                <div class="card-footer-info">
                    Registrada: <?= $t["fecha_registro"] ?>
                </div>

                <div class="saldo-badge">
                    Saldo: $<?= number_format($t["saldo"], 2) ?>
                </div>

            </div>
        </div>

        <?php endwhile; ?>

    </div>
</div>

</body>
</html>

