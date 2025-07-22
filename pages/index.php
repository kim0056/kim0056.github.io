<?php
include_once '../conexion.php';
session_start();

if (isset($_SESSION['usuario'])) {
    header("Location: home.php");
    exit();
}

$usuario = isset($_POST['user']) ? trim($_POST['user']) : '';
$clave = isset($_POST['pass']) ? trim($_POST['pass']) : '';

if ($usuario && $clave) {
    $stmt = $conn->prepare("SELECT * FROM reservar.inicio WHERE correo_usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Debug temporal: mostrar los hashes en pantalla
        $hashIngresado = strtolower(sha1($clave));
        $hashGuardado = strtolower($user['contrasena']);

        // Solo para pruebas: eliminar en producción
        echo "<strong>Debug temporal:</strong><br>";
        echo "Hash ingresado: $hashIngresado<br>";
        echo "Hash guardado: $hashGuardado<br><br>";

        if ($hashIngresado === $hashGuardado) {
            $_SESSION['usuario'] = $user['correo_usuario'];
            header("Location: home.php");
            exit();
        } else {
            header("Location: index.php?error=wrong_password");
            exit();
        }
    } else {
        header("Location: index.php?error=user_not_found");
        exit();
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Iniciar Sesión - GlamAgenda</title>
  <link href="../static/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-image: url('../Static/images/maq.png'); background-size: cover; background-repeat: no-repeat; background-position: center; min-height: 100vh; margin: 0; padding: 0;">

<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <div class="container-fluid justify-content-center">
    <a href="#" class="navbar-brand text-white fw-bold">GlamAgenda</a>
  </div>
</nav>

<div class="container mt-4">
  <?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger text-center">
      <?php
        switch ($_GET['error']) {
          case 'wrong_password':
            echo "Contraseña incorrecta.";
            break;
          case 'user_not_found':
            echo "El usuario no existe.";
            break;
          default:
            echo "Usuario o contraseña incorrectos.";
            break;
        }
      ?>
    </div>
  <?php endif; ?>

  <div class="d-flex justify-content-center mt-5">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
      <h4 class="text-center mb-4">Iniciar sesión</h4>
      <form method="POST" action="index.php">
        <input name="user" type="email" class="form-control mb-3" placeholder="Correo electrónico" required>
        <input name="pass" type="password" class="form-control mb-3" placeholder="Contraseña" required>
        <button type="submit" class="btn btn-primary w-100">Ingresar</button>
      </form>
    </div>
  </div>
</div>

<script src="../static/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

<script>
  const urlParams = new URLSearchParams(window.location.search);
  const error = urlParams.get('error');
  if (error) {
    console.error("Error de login:", error);
  }
</script>

</body>
</html>
