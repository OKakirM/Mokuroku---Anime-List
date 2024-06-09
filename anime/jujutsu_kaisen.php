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
      <img src="../img/animes/jk/banner.jpg" alt="banner">
    </div>
    <!-- !End Banner -->

    <!-- !Anime Info -->
    <div class="content-info">

      <!-- ?Content Intro -->
      <div class="content-info-intro-bg">
        <div class="container content-info-intro">

          <div class="anime-cover">

            <div class="cover">
              <img src="../img/animes/jk/cover.jpg" alt="cover">
            </div>

            <div class="cover-selection">
              <!-- *State -->
              <div class="completed">
                <div class="completed-message">
                  <a href=""><p class="font-Poppins">Set as Complete</p></a>
                </div>
                <a href="../addToList.php?status=Completed&anime=Jujutsu Kaisen&url=jujutsu_kaisen&image=https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx113415-bbBWj4pEFseh.jpg"><img src="../img/icons/done.svg" alt="completed"></a>
              </div>
              <!-- *End State -->

              <!-- *State -->
              <div class="watching">
                <div class="watching-message">
                  <a href=""><p class="font-Poppins">Set as Watching</p></a>
                </div>
                <a href="../addToList.php?status=Watching&anime=Jujutsu Kaisen&url=jujutsu_kaisen&image=https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx113415-bbBWj4pEFseh.jpg"><img src="../img/icons/progress.svg" alt="watching"></a>
              </div>
              <!-- *End State -->

              <!-- *State -->
              <div class="dropped">
              <div class="dropped-message">
                  <a href=""><p class="font-Poppins">Set as Dropped</p></a>
                </div>
                <a href="../addToList.php?status=Dropped&anime=Jujutsu Kaisen&url=jujutsu_kaisen&image=https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx113415-bbBWj4pEFseh.jpg"><img src="../img/icons/dislike.svg" alt="dropped"></a>
              </div>
              <!-- *End State -->

              <!-- *State -->
              <div class="planning">
                <div class="planning-message">
                  <a href=""><p class="font-Poppins">Set as Planning</p></a>
                </div>
                <a href="../addToList.php?status=Planning&anime=Jujutsu Kaisen&url=jujutsu_kaisen&image=https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx113415-bbBWj4pEFseh.jpg"><img src="../img/icons/description.svg" alt="planning"></a>
              </div>
              <!-- *End State -->
            </div>
          </div>

          <div class="info">
            <h1 class="c-white1 font-Poppins">Jujutsu Kaisen</h1>
            <p class="c-white4 font-Poppins">
              A boy fights... for "the right death."
              <br><br>
              Hardship, regret, shame: the negative feelings that humans feel become Curses that lurk in our everyday lives. The Curses run rampant throughout the world, capable of leading people to terrible misfortune and even death. What's more, the Curses can only be exorcised by another Curse.
              <br><br>
              Itadori Yuji is a boy with tremendous physical strength, though he lives a completely ordinary high school life. One day, to save a friend who has been attacked by Curses, he eats the finger of the Double-Faced Specter, taking the Curse into his own soul. From then on, he shares one body with the Double-Faced Specter. Guided by the most powerful of sorcerers, Gojou Satoru, Itadori is admitted to the Tokyo Metropolitan Technical High School of Sorcery, an organization that fights the Curses... and thus begins the heroic tale of a boy who became a Curse to exorcise a Curse, a life from which he could never turn back.
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
              <p class="font-Poppins c-white5">24</p>
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
              <p class="font-Poppins c-white5">Oct 3, 2020</p>
            </div>

            <div>
              <h3 class="font-Poppins c-white3">End Date</h3>
              <p class="font-Poppins c-white5">Mar 27, 2021</p>
            </div>

            <div>
              <h3 class="font-Poppins c-white3">Season</h3>
              <p class="font-Poppins c-white5">Fall 2020</p>
            </div>

            <div>
              <h3 class="font-Poppins c-white3">Mean Score</h3>
              <p class="font-Poppins c-white5">85%</p>
            </div>

            <div>
              <h3 class="font-Poppins c-white3">Studios</h3>
              <p class="font-Poppins c-white5">MAPPA</p>
            </div>

            <div>
              <h3 class="font-Poppins c-white3">Genres</h3>
              <p class="font-Poppins c-white5">Action</p>
              <p class="font-Poppins c-white5">Drama</p>
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
                      <img src="https://s4.anilist.co/file/anilistcdn/character/large/b126635-L0y3I92JSUkN.png" alt="Megumi Fushiguro">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Megumi <br> Fushiguro</p>
                      <p class="font-Poppins c-white7">Main</p>
                    </div>
                  </div>
                  <div class="second-section">
                    <div class="info">
                      <p class="font-Poppins c-white3">Yuuma <br> Uchida</p>
                      <p class="font-Poppins c-white7">Japanese</p>
                    </div>
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n119617-icFDk96OdV5k.png" alt="Yuuma Uchida">
                    </div>
                  </div>

                </div>
                <!-- *End Card -->
                <!-- *Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/character/large/b127212-FVm2tD0erQ5B.png" alt="Yuuji Itadori">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Yuuji Itadori</p>
                      <p class="font-Poppins c-white7">Main</p>
                    </div>
                  </div>
                  <div class="second-section">
                    <div class="info">
                      <p class="font-Poppins c-white3">Junya Enoki</p>
                      <p class="font-Poppins c-white7">Japanese</p>
                    </div>
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n119319-yIrrUOUaJuSm.png" alt="Junya Enoki">
                    </div>
                  </div>

                </div>
                <!-- *End Card -->
                <!-- *Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/character/large/b127691-UmAY8k2uXeQM.png" alt="Satoru Gojou">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Satoru Gojou</p>
                      <p class="font-Poppins c-white7">Main</p>
                    </div>
                  </div>
                  <div class="second-section">
                    <div class="info">
                      <p class="font-Poppins c-white3">Yuuichi Nakamura</p>
                      <p class="font-Poppins c-white7">Japanese</p>
                    </div>
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n95513-up9ZDuocHgRs.png" alt="Yuuichi Nakamura">
                    </div>
                  </div>

                </div>
                <!-- *End Card -->
                <!-- *Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/character/large/b133700-f6sOO3TcgLV6.png" alt="Nobara Kugisaki">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Nobara <br> Kugisaki</p>
                      <p class="font-Poppins c-white7">Main</p>
                    </div>
                  </div>
                  <div class="second-section">
                    <div class="info">
                      <p class="font-Poppins c-white3">Asami <br> Seto</p>
                      <p class="font-Poppins c-white7">Japanese</p>
                    </div>
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n106787-ojpoY7XEGYgc.jpg" alt="Asami Seto">
                    </div>
                  </div>

                </div>
                <!-- *End Card -->
                <!-- *Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/character/large/b133699-FCnXaISgazAi.png" alt="Suguru Getou">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Suguru <br> Getou</p>
                      <p class="font-Poppins c-white7">Supporting</p>
                    </div>
                  </div>
                  <div class="second-section">
                    <div class="info">
                      <p class="font-Poppins c-white3">Takahiro <br> Sakurai</p>
                      <p class="font-Poppins c-white7">Japanese</p>
                    </div>
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n95079-MdbWTLxPUvFf.jpg" alt="Takahiro Sakurai">
                    </div>
                  </div>

                </div>
                <!-- *End Card -->
                <!-- *Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/character/large/b133701-JVAThWqcAncW.png" alt="Sukuna">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Sukuna</p>
                      <p class="font-Poppins c-white7">Supporting</p>
                    </div>
                  </div>
                  <div class="second-section">
                    <div class="info">
                      <p class="font-Poppins c-white3">Junichi Suwabe</p>
                      <p class="font-Poppins c-white7">Japanese</p>
                    </div>
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n95095-DvSjTQnqcgXP.png" alt="Junichi Suwabe">
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
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n125415-B1o6NtIImcCK.png" alt="Gege Akutami">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Gege Akutami</p>
                      <br>
                      <p class="font-Poppins c-white7">Original Creator</p>
                    </div>
                  </div>
                </div>
                <!-- *End Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n123074-6tFkJXFgMNv9.png" alt="Seong-Hu Park">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Seong-Hu Park</p>
                      <br>
                      <p class="font-Poppins c-white7">Director</p>
                    </div>
                  </div>
                </div>
                <!-- *End Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n142936-wmrPkmCaZGJV.png" alt="Yui Miura">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Yui Miura</p>
                      <br>
                      <p class="font-Poppins c-white7">Assistant Director</p>
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
                <iframe src="https://www.youtube.com/embed/pkKu9hLT-t8" title="JUJUTSU KAISEN | OFFICIAL TRAILER" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
              </div>
              <div class="news">
                <h2 class="font-Poppins c-white1">Last News</h2>
                <!-- ?Card -->
                <div class="news-info-card">
                  <div class="news-info-card-image-container">
                    <img src="../img/animes/jk/banner.jpg" alt="News 1 - Lorem Ipsum">
                  </div>
                  <div class="news-info-card-content">
                    <h1 class="c-white1 font-Poppins fw-regular">NEW ARC is coming!</h1>
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