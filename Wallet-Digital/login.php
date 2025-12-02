<?php
session_start();
include("conexion.php");

if ($_POST) {
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    $consulta = $conexion->query("SELECT * FROM usuarios 
                                  WHERE username='$usuario' OR email='$usuario'");
    
    if ($consulta->num_rows > 0) {
        $datos = $consulta->fetch_assoc();

        if (password_verify($password, $datos["password"])) {
            $_SESSION["id"] = $datos["id"];
            $_SESSION["nombre"] = $datos["nombre"];
            $_SESSION["imagen"] = $datos["imagen"];

            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Contraseña incorrecta";
        }
    } else {
        $error = "Usuario no encontrado";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<title>Iniciar Sesión</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<!-- Tipografía profesional -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

    body{
        background:#f1f3f8;
        display:flex;
        justify-content:center;
        align-items:center;
        height:100vh;
        margin:0;
        font-family:'Inter', sans-serif;
    }

    /* Tarjeta estilo premium */
    .login-card{
        width:420px;
        background:white;
        border-radius:26px;
        padding:45px 50px;
        box-shadow:0 10px 35px rgba(0,0,0,0.12);
        animation:fadeIn .5s ease;
        border:1px solid #e7e7e7;
    }

    .login-title{
        font-size:32px;
        font-weight:700;
        text-align:center;
        color:#222;
        margin-bottom:35px;
        letter-spacing:-0.5px;
    }

    /* Inputs premium estilo floating */
    .form-group{
        position:relative;
        margin-bottom:28px;
    }

    .form-control{
        height:54px;
        border-radius:14px;
        padding-left:48px;
        border:1.6px solid #d6d6d6;
        transition:all .25s;
        font-size:16px;
    }

    .form-control:focus{
        border-color:#6a1b9a;
        box-shadow:0 0 8px rgba(106,27,154,0.25);
    }

    /* Icono dentro del input */
    .input-icon{
        position:absolute;
        left:16px;
        top:50%;
        transform:translateY(-50%);
        font-size:20px;
        color:#6a1b9a;
    }

    /* Botón elegante */
    .btn-login{
        width:100%;
        height:54px;
        background:#6a1b9a;
        border:none;
        color:white;
        font-size:18px;
        font-weight:600;
        border-radius:14px;
        letter-spacing:0.5px;
        transition:.25s;
        margin-top:10px;
    }

    .btn-login:hover{
        background:#581784;
    }

    /* Animación */
    @keyframes fadeIn {
        from {opacity:0; transform:translateY(-10px);}
        to {opacity:1; transform:translateY(0);}
    }

</style>

</head>

<body>

<div class="login-card">

    <h2 class="login-title">Iniciar Sesión</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger text-center"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">

        <!-- Usuario -->
        <div class="form-group">
            <i class="bi bi-person input-icon"></i>
            <input type="text" name="usuario" class="form-control" placeholder="Usuario o Email" required>
        </div>

        <!-- Password -->
        <div class="form-group">
            <i class="bi bi-lock input-icon"></i>
            <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
        </div>

        <button class="btn btn-login">Iniciar Sesión</button>

    </form>

</div>

</body>
</html>
