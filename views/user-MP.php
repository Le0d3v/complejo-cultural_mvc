<!-- MASTER PAGE -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Eventos</title>
  <link rel="stylesheet" href="/build/css/index.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Changa&display=swap" rel="stylesheet">
  <link rel="website icon" href="/build/img/logo.png">
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdBS00JY-BYj2OyaUkxH1pDjDGY_qGmCY"></script>
</head>
<body>
  <main class="admin-main">
    <div class="fijo">
      <div class="navigation">
        <div class="menu-toogle">
          <div class="logo">
            <img src="/build/img/logoCU.png" alt="">
          </div>
        </div>
        <ul>
          <li class="list" id="s1">
            <a href="/home" style="--clr:#f44336;">
              <span class="icon">
                <ion-icon name="home-outline"></ion-icon>
              </span>
              <p class="text">Inicio</p>
            </a>
          </li>
          <li class="list" id="s2">
            <a href="/home/eventos" style="--clr:#ffa117;">
              <span class="icon">
                <ion-icon name="sparkles-outline"></ion-icon>
              </span>
              <p class="text">Eventos</p>
            </a>
          </li>
          <li class="list" id="s3">
            <a href="/home/mis-eventos" style="--clr:#2081db;">
              <span class="icon">
                <ion-icon name="mic-outline"></ion-icon>
              </span>
              <p class="text">Mis Eventos</p>
            </a>
          </li>
          <li class="list" id="s4">
            <a href="/home/config" style="--clr:#745da6;">
              <span class="icon">
                <ion-icon name="settings-outline"></ion-icon>
              </span>
              <p class="text">Configuración</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="admin-barra">
      <div class="admin-header">
        <p><span class="span">Complejo Cultural</span></p>
        <form action="/admin/logout" method="post">
          <input type="hidden">
          <input type="submit" value="Cerrar Sesión" class="logout">
        </form>
      </div>
      <div class="background">
        <?php echo $contenido; ?>
        <!-- Mostrar contenido especifico de cada página -->
      </div>
    </div>
  </main>
  <script src="/build/js/bundle.min.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
