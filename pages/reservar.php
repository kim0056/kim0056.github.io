<?php
include_once '../conexion.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Validar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php"); 
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $cedula = $_POST['cedula'];
    $telefono = $_POST['telefono'];
    $servicio = $_POST['servicio'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];

    $sql = "INSERT INTO cita (nombre, cedula, telefono, servicio, fecha, hora)
            VALUES ('$nombre', '$cedula', '$telefono', '$servicio', '$fecha', '$hora')";

    $resultado = mysqli_query($conn, $sql);

    if ($resultado) {
        echo "<script>
            alert('¡Cita registrada con éxito!');
            window.location.href = 'reservar.php';
        </script>";
    } else {
        echo "<script>alert('Error al registrar la cita');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reservar Cita - GlamAgenda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff0f5;
            font-family: 'Poppins', sans-serif;
        }
        .container-form {
            background: #ffffff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            margin-top: 50px;
        }
        .btn-glam {
            background-color: #e91e63;
            color: white;
            border-radius: 25px;
        }
        .btn-glam:hover {
            background-color: #c2185b;
        }
        h2 {
            color: #e91e63;
        }
    </style>
</head>
<body>

<!--  Navbar con Logout -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold text-white" href="#">GlamAgenda</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="home.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="reservar.php">Reservar</a>
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

<!--  Formulario -->
<div class="container">
    <div class="container-form mx-auto col-md-6">
        <h2 class="text-center mb-4">💇‍♀️ Reservar Cita</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre completo</label>
                <input type="text" class="form-control" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="cedula" class="form-label">Cédula</label>
                <input type="text" class="form-control" name="cedula" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" name="telefono" required>
            </div>
            <div class="mb-3">
                <label for="servicio" class="form-label">Servicio</label>
                <select class="form-select" name="servicio" required>
                    <option value="">Selecciona un servicio</option>
                    <option value="Corte de cabello">✂️ Corte de cabello</option>
                    <option value="Tinte">🎨 Tinte</option>
                    <option value="Peinado">💁‍♀️ Peinado</option>
                    <option value="Manicure">💅 Manicure</option>
                    <option value="Pedicure">🦶 Pedicure</option>
                    <option value="Depilación">🪒 Depilación</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" name="fecha" required>
            </div>
            <div class="mb-3">
                <label for="hora" class="form-label">Hora</label>
                <input type="time" class="form-control" name="hora" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-glam">💖 Confirmar Cita</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
