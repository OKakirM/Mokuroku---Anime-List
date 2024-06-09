<?php
session_start();



include('../config.php');

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
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/pages/contentPage.css">
  <link rel="shortcut icon" type="image/jpg" href="../img/Logo.svg" />
  <title>Mokuroku</title>
  <script type="module" src="../js/readData.js"></script>
</head>

<body>
<?php
    if (isset($_SESSION['message'])) {
      echo "<div class='alert'><p class='font-Poppins success'>" . $_SESSION['message'] . "</p></div>";
      unset($_SESSION['message']); // Remove a mensagem após exibir
    } else if (isset($_SESSION['error'])) {
      echo "<div class='alert'><p class='font-Poppins error'>" . $_SESSION['error'] . "</p></div>";
      unset($_SESSION['error']); // Remove a mensagem após exibir
    }
    ?>
  <!-- *Navbar -->
  <header class="navbar">
    <nav class="navbar-items">
      <a href="../index.php">
        <div class="navbar-logo">
          <img src="../img/Logo.svg" width="50px" alt="Logo Lyst">
          <p class="c-white1 font-Bebas"><span class="c-MainColor">Moku</span>roku</p>
        </div>
      </a>
      <!-- > 769px Navbar Options  -->
      <ul class="navbar-options">
        <li class="font-Poppins c-white1"><a href="../index.php">Home</a></li>
        <li class="font-Poppins c-white1"><a href="../userList.php">Anime List</a></li>
        <li class="font-Poppins c-MainColor"><a href="../browseAnimes.php">Browse Animes</a></li>
        
      </ul>

      <!-- < 768px Navbar Options -->
      <div class="navbar-mobile">
        <ul class="navbar-options-MB" id="optionsMobile">
          <li class="font-Poppins c-white1"><a href="../index.php">Home</a></li>
          <li class="font-Poppins c-white1"><a href="../userList.php">Anime List</a></li>
          <li class="font-Poppins c-MainColor"><a href="../browseAnimes.php">Browse Animes</a></li>
          
          <li><a href="#"><img src="../img/icons/x.svg" alt="exit" onclick="disableMenu()"></a></li>
        </ul>
        <ul class="navbar-menu-MB" id="menuMobile">
          <li class="c-white1"><img src="../img/icons/menu.svg" alt="menu icon" onclick="activateMenu()"></li>
        </ul>
      </div>
      <div class="navbar-UserSection">
        
        <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
        <div id="userLogged" style="">
          <div class="user-Container">
            <img src="../uploads/<?php echo $_SESSION['avatar']; ?>" alt="user avatar">
            <ul class="user-Dropdown">
              <li><a href="../logout.php" class="font-Poppins c-white1">Logout</a></li>
            </ul>
          </div>
          <img src="../img/icons/down_arrow.svg" width="32" alt="down arrow" id="downArrow" style="cursor: pointer;">
        </div>
        <?php else: ?>
        <div id="userNotLogged" style="">
          <a href="../signIn.php" class="signIn font-Poppins c-white1">Sign In</a>
          <a href="../signUp.php" class="signUp font-Poppins c-white1">Sign Up</a>
        </div>
        <?php endif; ?>
      </div>
    </nav>
  </header>
  <!-- *End Navbar -->

  <!-- *Anime Content -->
  <main class="content-bg">

    <!-- !Banner -->
    <div class="content-banner">
      <img src="../img/animes/kny/banner.jpg" alt="banner">
    </div>
    <!-- !End Banner -->

    <!-- !Anime Info -->
    <div class="content-info">

      <!-- ?Content Intro -->
      <div class="content-info-intro-bg">
        <div class="container content-info-intro">

          <div class="anime-cover">

            <div class="cover">
              <img src="../img/animes/kny/cover.jpg" alt="cover">
            </div>

            <div class="cover-selection">
              <!-- *State -->
              <div class="completed">
                <div class="completed-message">
                  <a href=""><p class="font-Poppins">Set as Complete</p></a>
                </div>
                <a href="../addToList.php?status=Completed&anime=Demon Slayer: Kimetsu no Yaiba&url=demon_slayer&image=https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx101922-WBsBl0ClmgYL.jpg"><img src="../img/icons/done.svg" alt="completed"></a>
              </div>
              <!-- *End State -->

              <!-- *State -->
              <div class="watching">
                <div class="watching-message">
                  <a href=""><p class="font-Poppins">Set as Watching</p></a>
                </div>
                <a href="../addToList.php?status=Watching&anime=Demon Slayer: Kimetsu no Yaiba&url=demon_slayer&image=https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx101922-WBsBl0ClmgYL.jpg"><img src="../img/icons/progress.svg" alt="watching"></a>
              </div>
              <!-- *End State -->

              <!-- *State -->
              <div class="dropped">
              <div class="dropped-message">
                  <a href=""><p class="font-Poppins">Set as Dropped</p></a>
                </div>
                <a href="../addToList.php?status=Dropped&anime=Demon Slayer: Kimetsu no Yaiba&url=demon_slayer&image=https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx101922-WBsBl0ClmgYL.jpg"><img src="../img/icons/dislike.svg" alt="dropped"></a>
              </div>
              <!-- *End State -->

              <!-- *State -->
              <div class="planning">
                <div class="planning-message">
                  <a href=""><p class="font-Poppins">Set as Planning</p></a>
                </div>
                <a href="../addToList.php?status=Planning&anime=Demon Slayer: Kimetsu no Yaiba&url=demon_slayer&image=https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx101922-WBsBl0ClmgYL.jpg"><img src="../img/icons/description.svg" alt="planning"></a>
              </div>
              <!-- *End State -->
            </div>
          </div>

          <div class="info">
            <h1 class="c-white1 font-Poppins">Demon Slayer: Kimetsu no Yaiba</h1>
            <p class="c-white4 font-Poppins">
              It is the Taisho Period in Japan. Tanjiro, a kindhearted boy who sells charcoal for a living, finds his family slaughtered by a demon. To make matters worse, his younger sister Nezuko, the sole survivor, has been transformed into a demon herself. Though devastated by this grim reality, Tanjiro resolves to become a “demon slayer” so that he can turn his sister back into a human, and kill the demon that massacred his family.
              <br><br>
              <span class="c-white7">(Source: Crunchyroll)</span>
            </p>
          </div>
        </div>
      </div>
      <!-- ?End Content Intro -->

      <!-- ?Anime Stats -->
      <div class="content-info-stats-bg">
        <div class="content-info-stats container">
          <div class="details">
            <div>
              <h3 class="font-Poppins c-white3">Format</h3>
              <p class="font-Poppins c-white5">TV</p>
            </div>

            <div>
              <h3 class="font-Poppins c-white3">Episodes</h3>
              <p class="font-Poppins c-white5">26</p>
            </div>

            <div>
              <h3 class="font-Poppins c-white3">Episode Duration</h3>
              <p class="font-Poppins c-white5">24 mins</p>
            </div>

            <div>
              <h3 class="font-Poppins c-white3">Status</h3>
              <p class="font-Poppins c-white5">Finished</p>
            </div>

            <div>
              <h3 class="font-Poppins c-white3">Start Date</h3>
              <p class="font-Poppins c-white5">Apr 6, 2019</p>
            </div>

            <div>
              <h3 class="font-Poppins c-white3">End Date</h3>
              <p class="font-Poppins c-white5">Apr 6, 2019</p>
            </div>

            <div>
              <h3 class="font-Poppins c-white3">Season</h3>
              <p class="font-Poppins c-white5">Spring 2019</p>
            </div>

            <div>
              <h3 class="font-Poppins c-white3">Mean Score</h3>
              <p class="font-Poppins c-white5">83%</p>
            </div>

            <div>
              <h3 class="font-Poppins c-white3">Studios</h3>
              <p class="font-Poppins c-white5">ufotable</p>
            </div>

            <div>
              <h3 class="font-Poppins c-white3">Genres</h3>
              <p class="font-Poppins c-white5">Action</p>
              <p class="font-Poppins c-white5">Adventure</p>
              <p class="font-Poppins c-white5">Drama</p>
              <p class="font-Poppins c-white5">Fantasy</p>
              <p class="font-Poppins c-white5">Supernatural</p>
            </div>

          </div>
          <div class="stats">
            <!-- *Characters -->
            <div>
              <h2 class="font-Poppins c-white1">Characters</h2>
              <!-- ?Stats Grid -->
              <div class="stats-grid">
                <!-- *Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/character/large/b126071-BTNEc1nRIv68.png" alt="Tanjirou Kamado">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Tanjirou <br> Kamado</p>
                      <p class="font-Poppins c-white7">Main</p>
                    </div>
                  </div>
                  <div class="second-section">
                    <div class="info">
                      <p class="font-Poppins c-white3">Natsuki <br> Hanae</p>
                      <p class="font-Poppins c-white7">Japanese</p>
                    </div>
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n111635-L385UcjTKCBq.png" alt="Natsuki Hanae">
                    </div>
                  </div>

                </div>
                <!-- *End Card -->
                <!-- *Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/character/large/b127518-NRlq1CQ1v1ro.png" alt="Nezuko Kamado">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Nezuko <br> Kamado</p>
                      <p class="font-Poppins c-white7">Main</p>
                    </div>
                  </div>
                  <div class="second-section">
                    <div class="info">
                      <p class="font-Poppins c-white3">Akari <br> Kitou</p>
                      <p class="font-Poppins c-white7">Japanese</p>
                    </div>
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n119722-Ls7ORfBejJEP.jpg" alt="Akari Kitou">
                    </div>
                  </div>

                </div>
                <!-- *End Card -->
                <!-- *Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/character/large/n129130-SJC0Kn1DU39E.jpg" alt="Inosuke Hashibira">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Inosuke <br> Hashibira</p>
                      <p class="font-Poppins c-white7">Main</p>
                    </div>
                  </div>
                  <div class="second-section">
                    <div class="info">
                      <p class="font-Poppins c-white3">Yoshitsugu <br> Matsuoka</p>
                      <p class="font-Poppins c-white7">Japanese</p>
                    </div>
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n106817-mioGQjbTWWQ6.png" alt="Yoshitsugu Matsuoka">
                    </div>
                  </div>

                </div>
                <!-- *End Card -->
                <!-- *Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/character/large/b129131-FZrQ7lSlxmEr.png" alt="Zenitsu Agatsuma">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Zenitsu <br> Agatsuma</p>
                      <p class="font-Poppins c-white7">Main</p>
                    </div>
                  </div>
                  <div class="second-section">
                    <div class="info">
                      <p class="font-Poppins c-white3">Hiro <br> Shimono</p>
                      <p class="font-Poppins c-white7">Japanese</p>
                    </div>
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n95356-PFaZRlI9oJ56.png" alt="Hiro Shimono">
                    </div>
                  </div>

                </div>
                <!-- *End Card -->
                <!-- *Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/character/large/b129132-4nIZakUZ1o8W.jpg" alt="Muzan Kibutsuji">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Muzan <br> Kibutsuji</p>
                      <p class="font-Poppins c-white7">Supporting</p>
                    </div>
                  </div>
                  <div class="second-section">
                    <div class="info">
                      <p class="font-Poppins c-white3">Toshihiko <br> Seki</p>
                      <p class="font-Poppins c-white7">Japanese</p>
                    </div>
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n95129-AAL7kfwAPpgR.jpg" alt="Toshihiko Seki">
                    </div>
                  </div>

                </div>
                <!-- *End Card -->
                <!-- *Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/character/large/b129133-VlTPowwt68rJ.png" alt="Kyoujurou Rengoku">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Kyoujurou <br> Rengoku</p>
                      <p class="font-Poppins c-white7">Supporting</p>
                    </div>
                  </div>
                  <div class="second-section">
                    <div class="info">
                      <p class="font-Poppins c-white3">Satoshi <br> Hino</p>
                      <p class="font-Poppins c-white7">Japanese</p>
                    </div>
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n95245-prBoWpg0HaGX.jpg" alt="Satoshi Hino">
                    </div>
                  </div>

                </div>
                <!-- *End Card -->
              </div>
            </div>
            <!-- ?End Stats Grid -->

            <!-- *Staff -->
            <div>
              <h2 class="font-Poppins c-white1">Staff</h2>
              <!-- ?Stats Grid -->
              <div class="stats-grid">
                <!-- *Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n119973-pzMtyCVGBWNt.jpg" alt="Koyoharu Gotouge">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Koyoharu Gotouge</p>
                      <br>
                      <p class="font-Poppins c-white7">Original Creator</p>
                    </div>
                  </div>
                </div>
                <!-- *End Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n99006-ubhRe65EcEUF.jpg" alt="Haruo Sotozaki">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Haruo Sotozaki</p>
                      <br>
                      <p class="font-Poppins c-white7">Episode Director</p>
                    </div>
                  </div>
                </div>
                <!-- *End Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n105561-bluE1C2NqCrV.png" alt="LiSA">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">LiSA</p>
                      <br>
                      <p class="font-Poppins c-white7">Theme Song Performance</p>
                    </div>
                  </div>
                </div>
                <!-- *End Card -->
              </div>
            </div>

            <!-- *Trailer & News -->
            <div class="extra-info">
              <div class="trailer">
                <h2 class="font-Poppins c-white1">Trailer</h2>
                <iframe width="1198" height="674" src="https://www.youtube.com/embed/t6MXHczeEqc" title="Demon Slayer: Kimetsu no Yaiba | OFFICIAL TRAILER" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
              </div>
              <div class="news">
                <h2 class="font-Poppins c-white1">Last News</h2>
                <!-- ?Card -->
                <div class="news-info-card">
                  <div class="news-info-card-image-container">
                    <img src="../img/animes/kny/banner.jpg" alt="News 1 - Lorem Ipsum">
                  </div>
                  <div class="news-info-card-content">
                    <h1 class="c-white1 font-Poppins fw-regular">Season 4 - How's it going?</h1>
                    <div>
                      <a href="#" class="font-Poppins c-white1">Read more <img src="../img/icons/arrow_forward.svg" alt=""></a>
                      <p class="font-Poppins" name="date"></p>
                    </div>
                  </div>
                </div>
                <!-- ?End Card -->
              </div>
            </div>
            <!-- ?End Stats Grid -->
          </div>
        </div>
      </div>
      <!-- ?End Anime Stats -->
    </div>
    <!-- !End Anime Info -->
  </main>
  <!-- *End Anime Content -->

  <!-- *Footer -->
  <footer class="footer-bg">
    <div class="container footer-info">
      <div class="footer-nav">
        <a href="../"><img src="../img/Logo.svg" alt=""></a>
        <ul>
          <li class="c-white1 font-Poppins"><a href="../">Home</a></li>
          <li class="c-white1 font-Poppins"><a href="../userList.php">Anime List</a></li>
          <li class="c-white1 font-Poppins"><a href="../browseAnimes.php">Browse Animes</a></li>
        </ul>
      </div>
      <div class="footer-description">
        <h1 class="font-Poppins fw-regular">Mokuroku is an anime and manga social networking and social cataloging application website which you can create your own account to track, discover and share your favorite animes & mangas.</h1>
        <h2 class="font-Poppins fw-regular">Mokuroku is not a true company, all of the database here was created for a final project course in Tomar, Portugal.</h2>
      </div>
    </div>
  </footer>
  <!-- *End Footer -->

  <script src="../js/navbar.js"></script>
</body>

</html>