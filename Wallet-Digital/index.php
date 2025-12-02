<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Wallet Digital</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- Íconos profesionales -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Tipografía profesional Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body{
            margin:0;
            padding:0;
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background: linear-gradient(135deg, #500616ff, #1c397eff);
            font-family:'Inter', sans-serif;
        }

        .box{
            width:430px;
            padding:50px 45px;
            border-radius:28px;
            text-align:center;
            background:rgba(255,255,255,0.10);
            backdrop-filter:blur(18px);
            -webkit-backdrop-filter:blur(18px);
            box-shadow:0 15px 40px rgba(0,0,0,0.2);
            border:1px solid rgba(255,255,255,0.18);
            animation: fadeIn .6s ease;
        }

        .title{
            font-size:36px;
            font-weight:700;
            color:white;
            margin-bottom:10px;
            letter-spacing:-0.5px;
        }

        .subtitle{
            font-size:16px;
            font-weight:400;
            color:rgba(255,255,255,0.85);
            margin-bottom:35px;
            line-height:1.4;
        }

        .btn-custom{
            width:100%;
            padding:14px;
            font-size:17px;
            font-weight:600;
            border-radius:12px;
            border:none;
            transition:.25s ease;
        }

        .btn-login{
            background:white;
            color:#1c5df5;
        }

        .btn-login:hover{
            background:#f2f2f2;
        }

        .btn-register{
            background:#00da68;
            color:white;
        }

        .btn-register:hover{
            background:#00c25b;
        }

        @keyframes fadeIn{
            from {opacity:0; transform:translateY(10px);}
            to   {opacity:1; transform:translateY(0);}
        }
    </style>
</head>

<body>

<div class="box">
    
    <i class="bi bi-credit-card-2-front-fill" style="
        font-size:48px;
        color:white;
        margin-bottom:15px;
    "></i>

    <h1 class="title">Wallet Digital</h1>

    <p class="subtitle">
        Administra tus tarjetas, controla tus movimientos<br>
        y maneja tu dinero de forma segura.
    </p>

    <a href="login.php" class="btn btn-custom btn-login mb-3">
        Iniciar Sesión
    </a>

    <a href="register.php" class="btn btn-custom btn-register">
        Crear Cuenta
    </a>
</div>

</body>
</html>
