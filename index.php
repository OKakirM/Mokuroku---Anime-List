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
  <link rel="stylesheet" href="./css/pages/index.css">
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
        <li class="font-Poppins c-MainColor"><a href="./">Home</a></li>
        <li class="font-Poppins c-white1"><a href="./userList.php">Anime List</a></li>
        <li class="font-Poppins c-white1"><a href="./browseAnimes.php">Browse Animes</a></li>
      </ul>

      <!-- < 768px Navbar Options -->
      <div class="navbar-mobile">
        <ul class="navbar-options-MB" id="optionsMobile">
          <li class="font-Poppins c-MainColor"><a href="./index.php">Home</a></li>
          <li class="font-Poppins c-white1"><a href="./userList.php">Anime List</a></li>
          <li class="font-Poppins c-white1"><a href="./browseAnimes.php">Browse Animes</a></li>
          
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
    <div class="main-text-intro container">
      <div>
        <img src="./img/Logo.svg" class="responsive" width="50px" alt="Logo Lyst">
        <h1 class="c-white1 font-Bebas"><span class="c-MainColor">Moku</span>roku</h1>
      </div>
      <h2 class="font-Poppins fw-regular">Enjoy Your Anime List!</h2>
      <p class="c-white1 font-Poppins">Welcome to Mokuroku, your ultimate companion for discovering, tracking, and saving your favorite anime series. Join our community and never miss an episode again!</p>
      <?php if(!isset($_SESSION['loggedin']) && !$_SESSION['loggedin'] === true): ?>
      <a href="./signUp.php" class="c-white1 font-Poppins">Sign Up</a>
      <?php endif; ?>
    </div>
    <div class="main-content">
      <h2 class="font-Poppins c-white1 fw-regular container">Most Popular Animes:</h2>
      <div class="main-grid container">
        <div class="main-image-container">
          <a href="./anime/one_piece.php"><img src="https://s4.anilist.co/file/anilistcdn/media/anime/cover/medium/bx21-YCDoj1EkAxFn.jpg" alt="One Piece"></a>
        </div>

        <div class="main-image-container">
          <a href="./anime/dbz.php"><img src="https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx813-TsHyhR3EDd2x.png" alt="Dragon Ball Z"></a>
        </div>

        <div class="main-image-container">
          <a href="./anime/demon_slayer.php"><img src="https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx101922-WBsBl0ClmgYL.jpg" alt="Kimetsu no Yaiba"></a>
        </div>

        <div class="main-image-container">
          <a href="./anime/aot.php"><img src="https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx16498-73IhOXpJZiMF.jpg" alt="Attack on Titan"></a>
        </div>

        <div class="main-image-container">
          <a href="./anime/jujutsu_kaisen.php"><img src="https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx113415-bbBWj4pEFseh.jpg" alt="Jujutsu Kaisen"></a>
        </div>
      </div>
    </div>
  </main>
  <!-- *End Introduction Page -->

  <!-- *News & Forum Section -->
  <section class="news-bg">
    <div class="news-content container">
      <!-- !News -->
      <div class="news-info">
        <h1 class="font-Poppins c-white1 ">RECENT NEWS</h1>

        <!-- ?Card -->
        <div class="news-info-card">
          <div class="news-info-card-image-container">
            <img src="https://s4.anilist.co/file/anilistcdn/media/anime/banner/813-03ZLvWJgR6Wd.jpg" alt="News 1 - Lorem Ipsum">
          </div>
          <div class="news-info-card-content">
            <h1 class="c-white1 font-Poppins fw-regular">Memory of Akira Toriyama</h1>
            <p class="c-white5 font-Poppins">Japanese authorities plan to open a museum in memory of Akira Toriyama. <br> <br>
            It's the least that the sensei who created Dragon Ball deserves...
            </p>
            <div>
              <a href="#" class="font-Poppins c-white1">Read more <img src="./img/icons/arrow_forward.svg" alt=""></a>
              <p class="font-Poppins" name="date"></p>
            </div>
          </div>
        </div>
        <!-- ?End Card -->

        <!-- ?Card -->
        <div class="news-info-card">
          <div class="news-info-card-image-container">
            <img src="./img/manga/death note/banner.jpg" alt="News 1 - Lorem Ipsum">
          </div>
          <div class="news-info-card-content">
            <h1 class="c-white1 font-Poppins fw-regular">Do you know Death Note?</h1>
            <p class="c-white5 font-Poppins">Light Yagami, a high school student who stumbles upon a mysterious notebook called the "Death Note." This notebook grants its user the power to kill anyone whose name they write in it, as long as they know the person's face.</p>
            <div>
              <a href="#" class="font-Poppins c-white1">Read more<img src="./img/icons/arrow_forward.svg" alt=""></a>
              <p class="font-Poppins" name="date"></p>
            </div>
          </div>
        </div>
        <!-- ?End Card -->

        <!-- ?Card -->
        <div class="news-info-card">
          <div class="news-info-card-image-container">
            <img src="./img/animes/bna/banner.jpg" alt="News 1 - Lorem Ipsum">
          </div>
          <div class="news-info-card-content">
            <h1 class="c-white1 font-Poppins fw-regular">What's Happend?</h1>
            <p class="c-white5 font-Poppins">Japanese debate whether My Hero Academia is in decline, Although some participants recognize that “Boku no Hero Academia” remains popular in terms of manga sales and viewership on streaming platforms, they also highlight that it has lost the “hype” factor in online conversations...</p>
            <div>
              <a href="#" class="font-Poppins c-white1">Read more<img src="./img/icons/arrow_forward.svg" alt=""></a>
              <p class="font-Poppins" name="date"></p>
            </div>
          </div>
        </div>
        <!-- ?End Card -->

      </div>
      <!-- !End News -->

      <!-- !Social Media -->
      <div class="news-forum">
        <!-- !Forum -->
        <h1 class="font-Poppins c-white1">FORUM ACTIVITY</h1>

        <!-- ?Card -->
        <div class="news-forum-card">
          <div class="user-section">
            <div class="user">
              <div class="avatar-container">
                <a href="#"><img src="img/placeholder_avatar.png" class="responsive" alt="avatar"></a>
              </div>
              <a href="#">
                <p class="font-Poppins c-white1">KakirM</p>
              </a>
            </div>
            <p class="font-Poppins" name="date"></p>
          </div>
          <div class="content-section">
            <h2 class="font-Poppins c-white1 fw-regular">AWC: Action Genre Challenge</h2>
          </div>
          <div class="social-section">
            <div>
              <a href="#"><img src="./img/icons/like.svg" alt="like"></a>
              <span class="c-white5 font-Poppins">999</span>
            </div>
            <div>
              <a href="#"><img src="./img/icons/forum_chat.svg" alt="forum chat"></a>
              <span class="c-white5 font-Poppins">999</span>
            </div>
          </div>
        </div>
        <!-- ?End Card -->

        <!-- ?Card -->
        <div class="news-forum-card">
          <div class="user-section">
            <div class="user">
              <div class="avatar-container">
                <a href="#"><img src="img/placeholder_avatar.png" class="responsive" alt="avatar"></a>
              </div>
              <a href="#">
                <p class="font-Poppins c-white1">KakirM</p>
              </a>
            </div>
            <p class="font-Poppins" name="date"></p>
          </div>
          <div class="content-section">
            <h2 class="font-Poppins c-white1 fw-regular">Whats the last video you saw on youtube</h2>
          </div>
          <div class="social-section">
            <div>
              <a href="#"><img src="./img/icons/like.svg" alt="like"></a>
              <span class="c-white5 font-Poppins">999</span>
            </div>
            <div>
              <a href="#"><img src="./img/icons/forum_chat.svg" alt="forum chat"></a>
              <span class="c-white5 font-Poppins">999</span>
            </div>
          </div>
        </div>
        <!-- ?End Card -->

        <!-- ?Card -->
        <div class="news-forum-card">
          <div class="user-section">
            <div class="user">
              <div class="avatar-container">
                <a href="#"><img src="img/placeholder_avatar.png" class="responsive" alt="avatar"></a>
              </div>
              <a href="#">
                <p class="font-Poppins c-white1">KakirM</p>
              </a>
            </div>
            <p class="font-Poppins" name="date"></p>
          </div>
          <div class="content-section">
            <h2 class="font-Poppins c-white1 fw-regular">(Spoilers) Demon Slayer - Hashira Training Arc - Episode 5 [Discussion]</h2>
          </div>
          <div class="social-section">
            <div>
              <a href="#"><img src="./img/icons/like.svg" alt="like"></a>
              <span class="c-white5 font-Poppins">999</span>
            </div>
            <div>
              <a href="#"><img src="./img/icons/forum_chat.svg" alt="forum chat"></a>
              <span class="c-white5 font-Poppins">999</span>
            </div>
          </div>
        </div>
        <!-- ?End Card -->
        <!-- !End Forum -->

        <!-- !Global Feed -->
        <h1 class="font-Poppins c-white1">GLOBAL FEED</h1>

        <!-- ?Card -->
        <div class="news-feed-card">
          <div class="feed-image-container">
            <a href="#"><img src="./img/manga/naruto/cover.jpg" alt=""></a>
          </div>
          <div class="content-section">
            <div class="user-section">
              <div class="user">
                <div class="avatar-container">
                  <a href="#"><img src="img/placeholder_avatar.png" class="responsive" alt="avatar"></a>
                </div>
                <a href="#">
                  <p class="font-Poppins c-white1">KakirM</p>
                </a>
              </div>
            </div>
            <div class="info-section">
              <p class="font-Poppins c-white1">Completed <span class="c-MainColor"><a href="#">Naruto</a></span>.</p>
            </div>
            <div class="social-section">
              <img src="./img/icons/like.svg" alt="like">
              <span class="font-Poppins c-white5">999</span>
            </div>
          </div>
        </div>
        <!-- ?End Card -->

        <!-- ?Card -->
        <div class="news-feed-card">
          <div class="feed-image-container">
            <a href="#"><img src="./img/animes/bna/cover.jpg" alt=""></a>
          </div>
          <div class="content-section">
            <div class="user-section">
              <div class="user">
                <div class="avatar-container">
                  <a href="#"><img src="img/placeholder_avatar.png" class="responsive" alt="avatar"></a>
                </div>
                <a href="#">
                  <p class="font-Poppins c-white1">KakirM</p>
                </a>
              </div>
            </div>
            <div class="info-section">
              <p class="font-Poppins c-white1">Dropped <span class="c-MainColor"><a href="#">My Hero Academia</a></span>.</p>
            </div>
            <div class="social-section">
              <img src="./img/icons/like.svg" alt="like">
              <span class="font-Poppins c-white5">999</span>
            </div>
          </div>
        </div>
        <!-- ?End Card -->

        <!-- ?Card -->
        <div class="news-feed-card">
          <div class="feed-image-container">
            <a href="#"><img src="./img/animes/aot/cover.jpg" alt=""></a>
          </div>
          <div class="content-section">
            <div class="user-section">
              <div class="user">
                <div class="avatar-container">
                  <a href="#"><img src="img/placeholder_avatar.png" class="responsive" alt="avatar"></a>
                </div>
                <a href="#">
                  <p class="font-Poppins c-white1">KakirM</p>
                </a>
              </div>
            </div>
            <div class="info-section">
              <p class="font-Poppins c-white1">Watched episode 9 of <span class="c-MainColor"><a href="#">Attack on Titan</a></span>.</p>
            </div>
            <div class="social-section">
              <img src="./img/icons/like.svg" alt="like">
              <span class="font-Poppins c-white5">999</span>
            </div>
          </div>
        </div>
        <!-- ?End Card -->
        <!-- !End Global Feed -->
      </div>

      <!-- !End Social Media -->
    </div>
  </section>
  <!-- *End News & Forum Section -->

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