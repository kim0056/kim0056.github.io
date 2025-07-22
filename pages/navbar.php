<nav class="navbar navbar-expand-lg navbar-dark bg-primary container-fluid">
  <a class="navbar-brand" href="#">GlamAgenda</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <!-- Menú de la izquierda -->
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" href="home.php">Inicio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="usuario.php">Usuario</a>
      </li>
    </ul>

    <!-- Menú del usuario -->
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <?php echo $_SESSION['usuario']; ?>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
          <li><a class="dropdown-item" href="#">Mi Sitio</a></li>
          <li><a class="dropdown-item" href="#">Cambiar contraseña</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="logout.php">Cerrar sesión</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
