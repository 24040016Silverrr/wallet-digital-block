<?php
session_start();
include "conexion.php";

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$mensaje = "";
$errores = [];

$id = (int) $_SESSION['id'];
$res = $conexion->query("SELECT * FROM usuarios WHERE id = $id");
$usuario = $res->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["imagen"])) {

    $file = $_FILES["imagen"];
    $maxSize = 2 * 1024 * 1024;
    $allowed = ["image/jpeg", "image/png", "image/webp"];

    if ($file["error"] !== 0) {
        $errores[] = "Error al subir la imagen.";
    } elseif ($file["size"] > $maxSize) {
        $errores[] = "La imagen debe ser menor a 2 MB.";
    } elseif (!in_array(mime_content_type($file["tmp_name"]), $allowed)) {
        $errores[] = "Formato no permitido. Usa JPG, PNG o WEBP.";
    } else {

        $ext = pathinfo($file["name"], PATHINFO_EXTENSION);
        $nuevoNombre = "user_" . $id . "_" . time() . "." . $ext;

        $carpeta = "uploads/usuarios/";
        if (!is_dir($carpeta)) mkdir($carpeta, 0777, true);

        $destino = $carpeta . $nuevoNombre;

        if (move_uploaded_file($file["tmp_name"], $destino)) {

            $stmt = $conexion->prepare("UPDATE usuarios SET imagen = ? WHERE id = ?");
            $stmt->bind_param("si", $nuevoNombre, $id);
            $stmt->execute();

            $_SESSION["imagen"] = $nuevoNombre;
            $usuario["imagen"] = $nuevoNombre;

            $mensaje = "Imagen actualizada correctamente.";
        } else {
            $errores[] = "No se pudo guardar la imagen.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Mi Perfil</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>
    body{
        background:#eef1f7;
        font-family: 'Segoe UI', sans-serif;
    }

    .profile-card{
        border-radius:20px;
        background:white;
        padding:30px;
        box-shadow:0 8px 20px rgba(0,0,0,0.1);
    }

    .avatar-lg{
        width:150px;
        height:150px;
        border-radius:50%;
        object-fit:cover;
        border:4px solid #fff;
        box-shadow:0 6px 15px rgba(0,0,0,0.15);
    }

    .btn-upload{
        background:#4c32ff;
        border:none;
        padding:10px 16px;
        color:white;
        font-weight:600;
        border-radius:8px;
        cursor:pointer;
    }

    .btn-upload:hover{
        background:#3a24d9;
    }

    .btn-success{
        background:#00c27a !important;
        border:none;
        font-weight:600;
    }

    input[type="file"]{ display:none; }

    .title{
        font-size:26px;
        font-weight:700;
        color:#333;
    }

    .navbar-dark{
        background:#4c32ff !important;
    }
</style>
</head>

<body>

<nav class="navbar navbar-dark p-3">
  <div class="container-fluid">
    <a href="dashboard.php" class="navbar-brand text-white">← Volver</a>
    <span class="text-white fw-bold">Mi Perfil</span>
  </div>
</nav>

<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-md-7">

      <div class="profile-card">

        <div class="text-center mb-4">
          <img id="currentAvatar" 
               src="<?php echo !empty($usuario['imagen']) ? 'uploads/usuarios/'.$usuario['imagen'] : 'uploads/usuarios/default.png'; ?>"
               class="avatar-lg">
        </div>

        <?php if ($mensaje): ?>
            <div class="alert alert-success text-center"><?= $mensaje ?></div>
        <?php endif; ?>

        <?php if (!empty($errores)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errores as $e) echo "<div>$e</div>"; ?>
        </div>
        <?php endif; ?>

        <h4 class="title mb-3">Datos del Usuario</h4>

        <p><strong>Nombre:</strong> <?= htmlspecialchars($usuario["nombre"]) ?></p>
        <p><strong>Usuario:</strong> <?= htmlspecialchars($usuario["username"]) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($usuario["email"]) ?></p>

        <hr>

        <form method="POST" enctype="multipart/form-data">
          
          <label for="imagenInput" class="btn-upload">Seleccionar nueva imagen</label>
          <input id="imagenInput" type="file" name="imagen" accept="image/*">

          <div class="mt-3 text-center">
            <img id="preview" style="display:none; width:140px; height:140px; border-radius:50%; object-fit:cover;">
          </div>

          <button class="btn btn-success w-100 mt-4">Guardar imagen</button>
        </form>

      </div>

    </div>
  </div>
</div>

<script>
document.getElementById("imagenInput").addEventListener("change", function(e){
    const file = this.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(evt) {
        document.getElementById("preview").style.display = "block";
        document.getElementById("preview").src = evt.target.result;
        document.getElementById("currentAvatar").src = evt.target.result;
    }
    reader.readAsDataURL(file);
});
</script>

</body>
</html>

