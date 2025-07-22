<?php
include_once '../conexion.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Si no hay sesión iniciada, redirige al index (login)
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio</title>
  <link href="../static/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-image: url('../Static/images/maq.png'); background-size: cover; background-repeat: no-repeat; background-position: center; min-height: 100vh; margin: 0; padding: 0;">

<!--  Barra de navegación con botón de logout -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold text-white" href="#">GlamAgenda</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="home.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="usuario.php">Usuarios</a>
        </li>
      </ul>

      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo htmlspecialchars($_SESSION['usuario']); ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="perfil.php">Mi cuenta</a></li>
            <li><a class="dropdown-item" href="#">Cambiar contraseña</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="logout.php">Cerrar sesión</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!--  Mensaje de bienvenida -->
<div class="container mt-5 text-center" style="font-family: 'Georgia', serif;">
  <h1 class="fw-bold" style="
    display: inline-block;
    background: linear-gradient(90deg, #ffffff 0%, #ffffff 100%);
    padding: 10px 20px;
    border-radius: 20px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    color: #000;
  ">
    Bienvenido <?php echo htmlspecialchars($_SESSION['usuario']); ?>
  </h1>

  <p style="
    display: inline-block;
    background: rgba(255,255,255,0.8);
    padding: 8px 16px;
    border-radius: 15px;
    margin-top: 10px;
  ">
    Has iniciado sesión exitosamente.
  </p>
</div>

<!-- ✅ Estilos del menú -->
<style>
  .card-menu {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    margin-top: 30px;
  }

  .card-item {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    width: 180px;
    height: 160px;
    text-align: center;
    padding: 20px;
    transition: transform 0.2s ease;
    cursor: pointer;
  }

  .card-item:hover {
    transform: scale(1.05);
    background: #FDE3EC;
  }

  .card-item span {
    font-size: 40px;
    display: block;
    margin-bottom: 10px;
  }

  .card-item h5 {
    font-size: 18px;
    color: #E91E63;
    font-weight: bold;
  }
</style>

<!--  Menú Principal -->
<div class="card-menu">
  <div class="card-item" onclick="location.href='reservar.php'">
    <span>💇‍♀️</span>
    <h5>Reservar Cita</h5>
  </div>
  <div class="card-item" onclick="location.href='servicios.php'">
    <span>💅</span>
    <h5>Servicios</h5>
  </div>
  <div class="card-item" onclick="location.href='mis_citas.php'">
    <span>🧾</span>
    <h5>Mis Citas</h5>
  </div>
  <div class="card-item" onclick="location.href='perfil.php'">
    <span>👩</span>
    <h5>Perfil</h5>
  </div>
  <div class="card-item" onclick="location.href='contacto.php'">
    <span>📞</span>
    <h5>Contacto</h5>
  </div>
</div>

<script src="../static/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
