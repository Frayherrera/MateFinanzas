<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$titulo?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
    .material-symbols-rounded {
      font-variation-settings:
      'FILL' 1,
      'wght' 400,
      'GRAD' 0,
      'opsz' 24
    }
    </style>
</head>
<body>
<nav class="navbar" style="background-color: #1d6ac5;">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center justify-content-center">
        <img src="<?=base_url("/public/iconoPI.png")?>" alt="" width="30" height="24" class="d-inline-block align-text-top me-2">
        <strong style="color: white;">MateFinanzas</strong></a>
        <form class="d-flex text-white" role="search">
          <?php if (isset($aUsuario['nombre'])):?>
          <li class="dropdown" style="list-style: none;">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <strong style="color: white;"><?=$aUsuario['nombre']?> <?=$aUsuario['apellido']?></strong>
                <span class="material-symbols-rounded ms-3">person</span>
            </a>
            <ul class="dropdown-menu  dropdown-menu-end">
              <li><a class="dropdown-item  d-flex align-items-center" href="?perfil=si"><span class="material-symbols-rounded">person</span> Mi perfil</a></li>
              <!-- <li><a class="dropdown-item  d-flex align-items-center" href="#"><span class="material-symbols-rounded">settings</span>Configuración</a></li> -->
            </ul>
          </li>
          <?php endif; ?>
        </form>
  </div>
</nav>