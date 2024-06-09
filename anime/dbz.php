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
      <img src="../img/animes/dbz/banner.jpg" alt="banner">
    </div>
    <!-- !End Banner -->

    <!-- !Anime Info -->
    <div class="content-info">

      <!-- ?Content Intro -->
      <div class="content-info-intro-bg">
        <div class="container content-info-intro">

          <div class="anime-cover">

            <div class="cover">
              <img src="../img/animes/dbz/cover.png" alt="cover">
            </div>

            <div class="cover-selection">
              <!-- *State -->
              <div class="completed">
                <div class="completed-message">
                  <a href=""><p class="font-Poppins">Set as Complete</p></a>
                </div>
                <a href="../addToList.php?status=Completed&anime=Dragon Ball Z&url=dbz&image=https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx813-TsHyhR3EDd2x.png"><img src="../img/icons/done.svg" alt="completed"></a>
              </div>
              <!-- *End State -->

              <!-- *State -->
              <div class="watching">
                <div class="watching-message">
                  <a href=""><p class="font-Poppins">Set as Watching</p></a>
                </div>
                <a href="../addToList.php?status=Watching&anime=Dragon Ball Z&url=dbz&image=https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx813-TsHyhR3EDd2x.png"><img src="../img/icons/progress.svg" alt="watching"></a>
              </div>
              <!-- *End State -->

              <!-- *State -->
              <div class="dropped">
              <div class="dropped-message">
                  <a href=""><p class="font-Poppins">Set as Dropped</p></a>
                </div>
                <a href="../addToList.php?status=Dropped&anime=Dragon Ball Z&url=dbz&image=https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx813-TsHyhR3EDd2x.png"><img src="../img/icons/dislike.svg" alt="dropped"></a>
              </div>
              <!-- *End State -->

              <!-- *State -->
              <div class="planning">
                <div class="planning-message">
                  <a href=""><p class="font-Poppins">Set as Planning</p></a>
                </div>
                <a href="../addToList.php?status=Planning&anime=Dragon Ball Z&url=dbz&image=https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx813-TsHyhR3EDd2x.png"><img src="../img/icons/description.svg" alt="planning"></a>
              </div>
              <!-- *End State -->
            </div>
          </div>

          <div class="info">
            <h1 class="c-white1 font-Poppins">Dragon Ball Z</h1>
            <p class="c-white4 font-Poppins">
              Goku is back with his new son, Gohan, but just when things are getting settled down, the adventures continue. Whether he is facing enemies such as Freeza, Cell, or Boo, Goku is proven to be an elite of his own and discovers his race, Saiyan. He meets many new people, gaining allies as well as enemies, as he still finds time to raise a family and be the happy-go-lucky Saiyan he is.

              <br><br>
              <span class="c-white7">(Source: Anime News Network)</span>
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
              <p class="font-Poppins c-white5">291</p>
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
              <p class="font-Poppins c-white5">Apr 26, 1989</p>
            </div>

            <div>
              <h3 class="font-Poppins c-white3">End Date</h3>
              <p class="font-Poppins c-white5">Jan 31, 1996</p>
            </div>

            <div>
              <h3 class="font-Poppins c-white3">Season</h3>
              <p class="font-Poppins c-white5">Spring 1989</p>
            </div>

            <div>
              <h3 class="font-Poppins c-white3">Mean Score</h3>
              <p class="font-Poppins c-white5">79%</p>
            </div>

            <div>
              <h3 class="font-Poppins c-white3">Studios</h3>
              <p class="font-Poppins c-white5">Toei Animation</p>
            </div>

            <div>
              <h3 class="font-Poppins c-white3">Genres</h3>
              <p class="font-Poppins c-white5">Adventure</p>
              <p class="font-Poppins c-white5">Comedy</p>
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
                      <img src="https://s4.anilist.co/file/anilistcdn/character/large/246-wsRRr6z1kii8.png" alt="Gokuu Son">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Gokuu <br> Son</p>
                      <p class="font-Poppins c-white7">Main</p>
                    </div>
                  </div>
                  <div class="second-section">
                    <div class="info">
                      <p class="font-Poppins c-white3">Masako <br> Nozawa</p>
                      <p class="font-Poppins c-white7">Japanese</p>
                    </div>
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n95557-5a2nnIBK05ul.png" alt="Masako Nozawa">
                    </div>
                  </div>

                </div>
                <!-- *End Card -->
                <!-- *Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/character/large/b913-NIFkKazWM8VO.png" alt="Vegeta">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Vegeta</p>
                      <p class="font-Poppins c-white7">Main</p>
                    </div>
                  </div>
                  <div class="second-section">
                    <div class="info">
                      <p class="font-Poppins c-white3">Ryou Horikawa</p>
                      <p class="font-Poppins c-white7">Japanese</p>
                    </div>
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n95518-6VFuLBDEPjTa.png" alt="Ryou Horikawa">
                    </div>
                  </div>

                </div>
                <!-- *End Card -->
                <!-- *Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/character/large/b914-KuS8AWjqBrqa.jpg" alt="Piccolo">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Piccolo</p>
                      <p class="font-Poppins c-white7">Main</p>
                    </div>
                  </div>
                  <div class="second-section">
                    <div class="info">
                      <p class="font-Poppins c-white3">Toshio Furukawa</p>
                      <p class="font-Poppins c-white7">Japanese</p>
                    </div>
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n95673-jNN4GqGgpssj.png" alt="Toshio Furukawa">
                    </div>
                  </div>

                </div>
                <!-- *End Card -->
                <!-- *Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/character/large/b2093-kdFZhqcNSsqW.png" alt="Gohan Son">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Gohan <br> Son</p>
                      <p class="font-Poppins c-white7">Main</p>
                    </div>
                  </div>
                  <div class="second-section">
                    <div class="info">
                      <p class="font-Poppins c-white3">Masako <br> Nozawa</p>
                      <p class="font-Poppins c-white7">Japanese</p>
                    </div>
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n95557-5a2nnIBK05ul.png" alt="Masako Nozawa">
                    </div>
                  </div>

                </div>
                <!-- *End Card -->
                <!-- *Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/character/large/b2159-qtEuMYyOUkwY.jpg" alt="Kuririn">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Kuririn</p>
                      <p class="font-Poppins c-white7">Main</p>
                    </div>
                  </div>
                  <div class="second-section">
                    <div class="info">
                      <p class="font-Poppins c-white3">Mayumi Tanaka</p>
                      <p class="font-Poppins c-white7">Japanese</p>
                    </div>
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n95075-1qD4TeW1ON92.png" alt="Mayumi Tanaka">
                    </div>
                  </div>

                </div>
                <!-- *End Card -->
                <!-- *Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/character/large/b677-PTNZaPeuV1Dx.jpg" alt="Pu'ar">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Pu'ar</p>
                      <div></div>
                      <div></div>
                      <p class="font-Poppins c-white7">Supporting</p>
                    </div>
                  </div>
                  <div class="second-section">
                    <div class="info">
                      <p class="font-Poppins c-white3">Naoko Watanabe</p>
                      <p class="font-Poppins c-white7">Japanese</p>
                    </div>
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n95674-VNsBjVJQe5kD.jpg" alt="Naoko Watanabe">
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
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n96901-f40brDFeIlzf.png" alt="Akira Toriyama">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Akira Toriyama</p>
                      <br>
                      <p class="font-Poppins c-white7">Original Creator</p>
                    </div>
                  </div>
                </div>
                <!-- *End Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n102062-7zltd67nFrOl.png" alt="Shunsuke Kikuchi">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Shunsuke Kikuchi</p>
                      <br>
                      <p class="font-Poppins c-white7">Music</p>
                    </div>
                  </div>
                </div>
                <!-- *End Card -->
                <div class="content">
                  <div class="first-section">
                    <div class="cover">
                      <img src="https://s4.anilist.co/file/anilistcdn/staff/large/n122072-YxNtfYs3C8l1.jpg" alt="Mitsuo Hashimoto">
                    </div>
                    <div class="info">
                      <p class="font-Poppins c-white3">Mitsuo Hashimoto</p>
                      <br>
                      <p class="font-Poppins c-white7">Episode Director</p>
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
                <iframe src="https://www.youtube.com/embed/ElqB359i_Os" title="Dragon Ball Z Opening (Japanese-Creditless) HQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
              </div>
              <div class="news">
                <h2 class="font-Poppins c-white1">Last News</h2>
                <!-- ?Card -->
                <div class="news-info-card">
                  <div class="news-info-card-image-container">
                    <img src="../img/animes/dbz/banner.jpg" alt="">
                  </div>
                  <div class="news-info-card-content">
                    <h1 class="c-white1 font-Poppins fw-regular">Memory of Akira Toriyama</h1>
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