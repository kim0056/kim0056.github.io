<?php 
include_once '../conexion.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Si no hay sesión iniciada, redirige al login
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php"); 
    exit();
}

if(isset($_POST['registro'])) {
   $nombre_usuario = isset($_POST['usuario']) ? mysqli_real_escape_string($conn, $_POST['usuario']) : '';
   $direccion = isset($_POST['direccion']) ? mysqli_real_escape_string($conn, $_POST['direccion']) : '';
   $cedula = isset($_POST['cedula']) ? mysqli_real_escape_string($conn, $_POST['cedula']) : '';
   $correo_usuario = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
   $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';

   // Hashear la contraseña antes de insertar
   $contrasena_hashed = password_hash($contrasena, PASSWORD_DEFAULT);

   $insertarDatos = "INSERT INTO estudiante (nombre_usuario, cedula, direccion, correo_usuario, contrasena)
                     VALUES('$nombre_usuario', '$cedula', '$direccion', '$correo_usuario', '$contrasena_hashed')";

   $ejecutarInsertar = mysqli_query($conn, $insertarDatos);
   ?>
   <div class="alert alert-success" role="alert">
       <?php echo 'Usuario registrado correctamente'; ?>
   </div>
   <?php
}

$cont=0;
// Consulta de Usuarios
$lisestudiantes = mysqli_query($conn, 'SELECT * FROM estudiante ORDER BY id_usuario DESC');

// Botón Eliminar
if (isset($_POST['eliminar_id'])) {
    $idEliminar = mysqli_real_escape_string($conn, $_POST['eliminar_id']);
    $eliminar = "DELETE FROM estudiante WHERE id_usuario = '$idEliminar'";
    
    if (mysqli_query($conn, $eliminar)) {
        header("Location: usuario.php"); // Redirige para actualizar la lista
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error al eliminar: " . mysqli_error($conn) . "</div>";
    }
}

// Botón Actualizar
if (isset($_POST['actualizar'])) {
    $id_usuario = mysqli_real_escape_string($conn, $_POST['id_actualizar']);
    $nombre_usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
    $direccion = mysqli_real_escape_string($conn, $_POST['direccion']);
    $cedula = mysqli_real_escape_string($conn, $_POST['cedula']);
    $correo_usuario = mysqli_real_escape_string($conn, $_POST['email']);
    $contrasena = $_POST['contrasena'];

    // Hashear la contraseña antes de actualizar
    $contrasena_hashed = password_hash($contrasena, PASSWORD_DEFAULT);

    $actualizar = "UPDATE estudiante SET 
                    nombre_usuario = '$nombre_usuario',
                    cedula = '$cedula',
                    direccion = '$direccion',
                    correo_usuario = '$correo_usuario',
                    contrasena = '$contrasena_hashed'
                   WHERE id_usuario = '$id_usuario'";

    if (mysqli_query($conn, $actualizar)) {
        header("Location: usuario.php"); // Redirige para mostrar cambios
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error al actualizar: " . mysqli_error($conn) . "</div>";
    }
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../static/libs/bootstrap/css/bootstrap.min.css">
    <title>Usuarios</title>
</head>
<body>
  <div class="container">
    <?php include ('navbar.php');?>

    
  </div>
 <!-- Button trigger modal   
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Mi cuenta</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="home.php">Inicio</a>
                    </li>
                    <li class="nav-item">                        
                        <a class="nav-link" href="usuario.php">Usuario</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    
                    </a>             
                           <li class="nav-item dropdown">
      
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                            <li><a class="dropdown-item" href="#">Mi cuenta</a></li>
                            <li><a class="dropdown-item" href="#">Cambiar contraseña</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php">Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<!-- Button trigger modal -->

<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Crear usuario
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ingreso de Usuario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form  class="row g-3" method="post" action="usuario.php">
  <div class="col-md-6">
    <label for="id" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="inputlabel" name="usuario">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Direccion</label>
    <input type="text" class="form-control" id="inputAddress" name="direccion">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Cedula</label>
    <input type="text" class="form-control" id="inputAddress" name="cedula">
  </div>

  <div class="col-12">
    <label for="inputnombres" class="form-label">Email</label>
    <input type="text" class="form-control" id="inputAddress" name="email">
  </div>
  <div class="col-12">
    <label for="inputdireccion" class="form-label">Contraseña</label>
    <input type="password" class="form-control" id="inputPassword4" name="contrasena">
  </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary w-100" name="registro" >Ingresar</button>
      </div>
    </div>
    </form>
  </div>
</div>


<div style="display: flex; justify-content: center;">
<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Cedula</th>
      <th scope="col">Dirección</th>
      <th scope="col">Email</th>
      <th scope="col">Acción</th>    
    </tr>
  </thead>
  <tbody>
    <?php while($fila = mysqli_fetch_assoc($lisestudiantes)) { ?>
    <tr>
    <td> <?php $cont++; echo $cont ;?> </td>
    <td> <?php echo htmlspecialchars($fila['nombre_usuario']) ;?> </td>
    <td> <?php echo htmlspecialchars($fila['cedula']) ;?> </td>
    <td> <?php echo htmlspecialchars($fila['direccion']) ;?> </td>
    <td> <?php echo htmlspecialchars($fila['correo_usuario']) ;?> </td>

    <!-- Button Actualizar -->
      <!-- Botón para abrir el modal de edición -->
<td>
<!-- Botón para abrir el modal de edición -->
<button class="btn btn-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#modalActualizar<?php echo $fila['id_usuario']; ?>">
  Actualizar
</button>

<!-- Modal de actualización por usuario -->
<div class="modal fade" id="modalActualizar<?php echo $fila['id_usuario']; ?>" tabindex="-1" aria-labelledby="modalLabel<?php echo $fila['id_usuario']; ?>" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" class="modal-content" action="usuario.php">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel<?php echo $fila['id_usuario']; ?>">Actualizar Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id_actualizar" value="<?php echo $fila['id_usuario']; ?>">
        <div class="mb-3">
          <label>Nombre</label>
          <input type="text" class="form-control" name="usuario" value="<?php echo htmlspecialchars($fila['nombre_usuario']); ?>">
        </div>
        <div class="mb-3">
          <label>Cédula</label>
          <input type="text" class="form-control" name="cedula" value="<?php echo htmlspecialchars($fila['cedula']); ?>">
        </div>
        <div class="mb-3">
          <label>Dirección</label>
          <input type="text" class="form-control" name="direccion" value="<?php echo htmlspecialchars($fila['direccion']); ?>">
        </div>
        <div class="mb-3">
          <label>Email</label>
          <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($fila['correo_usuario']); ?>">
        </div>
        <div class="mb-3">
          <label>Contraseña</label>
          <input type="password" class="form-control" name="contrasena" value="<?php echo htmlspecialchars($fila['contrasena']); ?>">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="actualizar" class="btn btn-success w-100">Guardar Cambios</button>
      </div>
    </form>
  </div>
</div>
    
<!-- Button Eliminar -->
<form method="POST" action="usuario.php" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
  <input type="hidden" name="eliminar_id" value="<?php echo $fila['id_usuario']; ?>">
  <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
  </form>
    </td>
    </tr>

 <?php }?>
  </tbody>
</table>
  </div>
</div>
</div>
</body>
    <script src="../static/libs/bootstrap/js/bootstrap.bundle.min.js"></script>



</html>

