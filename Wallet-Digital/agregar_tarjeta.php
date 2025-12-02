<?php
session_start();
include("conexion.php");

if ($_POST) {
    $numero = $_POST["numero"];
    $banco = $_POST["banco"];
    $fecha = $_POST["fecha"];
    $saldo = $_POST["saldo"];

    $imagen = $_FILES["imagen"]["name"];
    $ruta = "uploads/tarjetas/" . $imagen;
    move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);

    $id = $_SESSION["id"];

    $conexion->query("INSERT INTO tarjetas (usuario_id, numero, banco, fecha_registro, saldo, imagen)
                      VALUES ('$id','$numero','$banco','$fecha','$saldo','$imagen')");

    header("Location: mis_tarjetas.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<title>Agregar Tarjeta</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>
    body {
        background:  #0729039c;
    }
    .card-custom {
        max-width: 550px;
        margin: auto;
        margin-top: 60px;
        padding: 35px;
        border-radius: 20px;
        background: #ffffff;
        box-shadow: 0px 5px 20px rgba(0,0,0,0.15);
    }
    .title {
        font-weight: 700;
        font-size: 28px;
        text-align: center;
        margin-bottom: 25px;
        color: #3a3a3a;
    }
    .form-control {
        border-radius: 12px;
    }
    button {
        width: 100%;
        border-radius: 12px;
        padding: 12px;
        font-size: 17px;
        font-weight: 600;
    }
</style>
</head>

<body>

<div class="card-custom">
    <h2 class="title">Agregar Tarjeta</h2>

    <form method="POST" enctype="multipart/form-data">

        <label class="form-label fw-bold">Número de tarjeta</label>
        <input class="form-control" type="text" name="numero" placeholder="**** **** **** ****" required>

        <label class="form-label mt-3 fw-bold">Banco</label>
        <select class="form-control" name="banco" required>
            <option value="">Selecciona un banco</option>
            <option>BBVA</option>
            <option>Banorte</option>
            <option>Santander</option>
            <option>HSBC</option>
            <option>Scotiabank</option>
        </select>

        <label class="form-label mt-3 fw-bold">Fecha de registro</label>
        <input class="form-control" type="date" name="fecha" required>

        <label class="form-label mt-3 fw-bold">Saldo</label>
        <input class="form-control" type="number" name="saldo" placeholder="Saldo inicial" required>

        <label class="form-label mt-4 fw-bold">Imagen de la tarjeta</label>
        <input type="file" name="imagen" class="form-control" required>

        <button class="btn btn-success mt-4">Guardar Tarjeta</button>
    </form>
</div>

</body>
</html>

