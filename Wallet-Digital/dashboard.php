<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Panel Usuario</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

  <!-- Bootstrap Icons (NUEVO profesional) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <style>
    body{
        background:#eef1f5;
        font-family: 'Segoe UI', sans-serif;
    }

    .navbar{
        border-bottom: 1px solid rgba(255,255,255,0.1);
        box-shadow:0 3px 10px rgba(0,0,0,0.25);
    }

    .avatar-small {
        width:48px;
        height:48px;
        border-radius:50%;
        object-fit:cover;
        border:2px solid rgba(255,255,255,0.3);
    }

    /* Caja principal */
    .wallet-box{
        background:white;
        border-radius:22px;
        padding:40px;
        margin-top:50px;
        box-shadow:0 4px 18px rgba(0,0,0,0.12);
        transition:0.3s;
    }

    .wallet-title{
        font-size:30px;
        font-weight:700;
        margin-bottom:30px;
        color:#333;
    }

    /* Botones redondos */
    .wallet-item{
        text-align:center;
        width:130px;
        margin:15px;
        transition:0.3s;
    }

    .wallet-item:hover{
        transform: translateY(-5px);
    }

    .wallet-item-icon{
        width:100px;
        height:100px;
        display:flex;
        align-items:center;
        justify-content:center;
        background:#ece3ff;
        border-radius:50%;
        margin:auto;
        font-size:40px;
        color:#6a1b9a;
        box-shadow:0 3px 8px rgba(92, 9, 9, 0.15);
    }

    .wallet-item-icon i{
        font-size:45px; /* Tamaño profesional */
    }

    .wallet-item p{
        margin-top:10px;
        font-size:16px;
        font-weight:600;
        color:#444;
    }

    .wallet-more{
        border:2px solid #6a1b9a;
        background:white;
        font-size:45px;
    }

    .btn-custom{
        border-radius:8px;
        font-weight:600;
    }
  </style>

</head>
<body>

<nav class="navbar navbar-dark bg-dark p-3 d-flex justify-content-between">
  <div class="d-flex align-items-center">
    <a href="perfil.php" class="text-white d-flex align-items-center text-decoration-none">
      <img 
        src="<?php echo !empty($_SESSION['imagen']) ? 'uploads/usuarios/'.$_SESSION['imagen'] : 'uploads/usuarios/default.png'; ?>"
        class="avatar-small me-3"
      >
      <span style="font-size:17px;">Bienvenido, <?= htmlspecialchars($_SESSION["nombre"]) ?></span>
    </a>
  </div>

  <div>
    <a href="agregar_tarjeta.php" class="btn btn-success btn-custom me-2">Agregar Tarjeta</a>
    <a href="mis_tarjetas.php" class="btn btn-info btn-custom me-2">Mis Tarjetas</a>
    <a href="logout.php" class="btn btn-danger btn-custom">Cerrar Sesión</a>
  </div>
</nav>


<div class="container">

    <div class="wallet-box">
        <h3 class="wallet-title">¿Qué deseas hacer hoy?</h3>

        <div class="d-flex flex-wrap justify-content-center">

            <div class="wallet-item">
                <div class="wallet-item-icon">
                    <i class="bi bi-arrow-left-right"></i>
                </div>
                <p>Transferir</p>
            </div>

            <div class="wallet-item">
                <div class="wallet-item-icon">
                    <i class="bi bi-download"></i>
                </div>
                <p>Retirar</p>
            </div>

            <div class="wallet-item">
                <div class="wallet-item-icon">
                    <i class="bi bi-qr-code-scan"></i>
                </div>
                <p>Pagar con QR</p>
            </div>

            <div class="wallet-item">
                <div class="wallet-item-icon">
                    <i class="bi bi-phone"></i>
                </div>
                <p>Recargar celular</p>
            </div>

            <div class="wallet-item">
                <div class="wallet-item-icon">
                    <i class="bi bi-receipt"></i>
                </div>
                <p>Pagar servicios</p>
            </div>

            <div class="wallet-item">
                <div class="wallet-item-icon">
                    <i class="bi bi-credit-card"></i>
                </div>
                <p>Recibir de EUA</p>
            </div>

            <div class="wallet-item">
                <div class="wallet-item-icon">
                    <i class="bi bi-shop"></i>
                </div>
                <p>Depositar en OXXO</p>
            </div>

            <div class="wallet-item">
                <div class="wallet-item-icon wallet-more">+</div>
                <p>Más opciones</p>
            </div>

        </div>
    </div>

</div>

</body>
</html>
