<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/pages/form.css">
  <link rel="shortcut icon" type="image/jpg" href="./img/Logo.svg" />
  <title>Mokuroku</title>
</head>

<body>
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
        <li class="font-Poppins c-white1"><a href="./index.php">Home</a></li>
        <li class="font-Poppins c-white1"><a href="./userList.php">Anime List</a></li>
        <li class="font-Poppins c-white1"><a href="./browseAnimes.php">Browse Animes</a></li>
        
      </ul>

      <!-- < 768px Navbar Options -->
      <div class="navbar-mobile">
        <ul class="navbar-options-MB" id="optionsMobile">
          <li class="font-Poppins c-white1"><a href="./index.php">Home</a></li>
          <li class="font-Poppins c-white1"><a href="./userList.php">Anime List</a></li>
          <li class="font-Poppins c-white1"><a href="./browseAnimes.php">Browse Animes</a></li>
          
          <li><a href="#"><img src="./img/icons/x.svg" alt="exit" onclick="disableMenu()"></a></li>
        </ul>
        <ul class="navbar-menu-MB" id="menuMobile">
          <li class="c-white1"><img src="./img/icons/menu.svg" alt="menu icon" onclick="activateMenu()"></li>
        </ul>
      </div>
      <div class="navbar-UserSection">
        
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
        <div id="userLogged" style="display: none;">
          <div class="user-Container">
            <img src="./img/placeholder_avatar.png" alt="user avatar">
            <!-- <ul class="user-Dropdown">
              <li><a href="#" class="font-Poppins c-white1">Profile</a></li>
              <li><a href="#" class="font-Poppins c-white1">Notifications</a></li>
              <li><a href="#" class="font-Poppins c-white1">Settings</a></li>
            </ul> -->
          </div>
          <img src="./img/icons/down_arrow.svg" width="32" alt="down arrow" id="downArrow" style="cursor: pointer;">
        </div>
        <?php else: ?>
        <div id="userNotLogged" style="display: flex;">
          <a href="./signIn.php" class="signIn font-Poppins c-white1">Sign In</a>
          <a href="./signUp.php" class="signUp font-Poppins c-white1">Sign Up</a>
        </div>
        <?php endif; ?>
      </div>
    </nav>
  </header>

  <main class="signIn-bg">
    <div class="signIn-form-bg container">
    <?php
    session_start();
    if (isset($_SESSION['error'])) {
      echo "<p class='font-Poppins error'>" . $_SESSION['error'] . "</p>";
      unset($_SESSION['error']); // Remove a mensagem após exibir
    }
    ?>
      <form action="login.php" method="POST" class="signIn-form">
        <div>
          <label class="c-white1 font-Poppins" for="name">Username: </label>
          <input type="text" name="name" id="name" required>
        </div> <br>

        <div>
          <label class="c-white1 font-Poppins" for="pass">Password: </label>
          <input type="password" name="pass" id="pass" required>
        </div> <br>
        <button type="submit">Login</button>
      </form>
    </div>
  </main>

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