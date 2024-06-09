<?php
session_start();

include('config.php');
ini_set('display_errors', 0);

// Recuperar os dados do usuário
$stmt = $conn->prepare("SELECT email, avatar FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($email, $avatar);
$stmt->fetch();
$stmt->close();
$conn->close();

// Atualizar variáveis de sessão com o avatar
$_SESSION['avatar'] = $avatar;
?>
<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/pages/browse.css">
  <link rel="shortcut icon" type="image/jpg" href="./img/Logo.svg" />
  <title>Mokuroku</title>
  <script type="module" src="./js/readData.js"></script>
</head>

<body>
  <!-- *Navbar -->
  <header class="navbar">
    <nav class="navbar-items">
      <a href="./index.php">
        <div class="navbar-logo">
          <img src="./img/Logo.svg" width="50px" alt="Logo Lyst">
          <p class="c-white1 font-Bebas"><span class="c-MainColor">Moku</span>roku</p>
        </div>
      </a>
      <!-- > 769px Navbar Options  -->
      <ul class="navbar-options">
        <li class="font-Poppins c-white1"><a href="./">Home</a></li>
        <li class="font-Poppins c-white1"><a href="./userList.php">Anime List</a></li>
        <li class="font-Poppins c-MainColor"><a href="./browseAnimes.php">Browse Animes</a></li>
      </ul>

      <!-- < 768px Navbar Options -->
      <div class="navbar-mobile">
        <ul class="navbar-options-MB" id="optionsMobile">
          <li class="font-Poppins c-white1"><a href="./index.php">Home</a></li>
          <li class="font-Poppins c-white1"><a href="./userList.php">Anime List</a></li>
          <li class="font-Poppins c-MainColor"><a href="./browseAnimes.php">Browse Animes</a></li>
          
          <li><img src="./img/icons/x.svg" alt="exit" onclick="disableMenu()"></li>
        </ul>
        <ul class="navbar-menu-MB" id="menuMobile">
          <li class="c-white1"><img src="./img/icons/menu.svg" alt="menu icon" onclick="activateMenu()"></li>
        </ul>
      </div>
      <div class="navbar-UserSection">
        
        <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
        <div id="userLogged" style="">
          <div class="user-Container">
            <img src="./uploads/<?php echo $_SESSION['avatar']; ?>" alt="user avatar">
            <ul class="user-Dropdown">
              <li><a href="./logout.php" class="font-Poppins c-white1">Logout</a></li>
            </ul>
          </div>
          <img src="./img/icons/down_arrow.svg" width="32" alt="down arrow" id="downArrow" style="cursor: pointer;">
        </div>
        <?php else: ?>
        <div id="userNotLogged" style="">
          <a href="./signIn.php" class="signIn font-Poppins c-white1">Sign In</a>
          <a href="./signUp.php" class="signUp font-Poppins c-white1">Sign Up</a>
        </div>
        <?php endif; ?>
      </div>
    </nav>
  </header>
  <!-- *End Navbar -->

  <!-- *Introduction Page -->
  <main class="main-bg">
    <div class="main-content">
      <h1 class="font-Poppins c-white1 fw-regular container">Browse Animes</h1>
      <div class="main-grid container">
        <div class="main-image-container">
          <a href="./anime/one_piece.php"><img id="oneCover" src="" alt="One Piece"></a>
        </div>

        <div class="main-image-container">
          <a href="./anime/dbz.php"><img id="dbzCover" src="" alt="Dragon Ball Z"></a>
        </div>

        <div class="main-image-container">
          <a href="./anime/demon_slayer.php"><img id="knyCover" src="" alt="Kimetsu no Yaiba"></a>
        </div>

        <div class="main-image-container">
          <a href="./anime/aot.php"><img id="aotCover" src="" alt="Attack on Titan"></a>
        </div>

        <div class="main-image-container">
          <a href="./anime/jujutsu_kaisen.php"><img id="jjkCover" src="" alt="Jujutsu Kaisen"></a>
        </div>
      </div>
    </div>
  </main>
  <!-- *End Introduction Page -->

  <!-- *Footer -->
  <footer class="footer-bg">
    <div class="container footer-info">
      <div class="footer-nav">
        <a href="./"><img src="./img/Logo.svg" alt=""></a>
        <ul>
          <li class="c-white1 font-Poppins"><a href="./">Home</a></li>
          <li class="c-white1 font-Poppins"><a href="./userList.php">Anime List</a></li>
          <li class="c-white1 font-Poppins"><a href="./browseAnimes.php">Browse Animes</a></li>
        </ul>
      </div>
      <div class="footer-description">
        <h1 class="font-Poppins fw-regular">Mokuroku is an anime and manga social networking and social cataloging application website which you can create your own account to track, discover and share your favorite animes & mangas.</h1>
        <h2 class="font-Poppins fw-regular">Mokuroku is not a true company, all of the database here was created for a final project course in Tomar, Portugal.</h2>
      </div>
    </div>
  </footer>
  <!-- *End Footer -->

  <script src="./js/navbar.js"></script>
</body>

</html>